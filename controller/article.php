<?php 

// Validation et récupération du paramètre 'article_id' de l'URL

// Si il y a un problème avec l'id de l'article dans l'URL...
if ( !array_key_exists('article_id', $_GET) 
     || !isset($_GET['article_id']) 
     || !ctype_digit($_GET['article_id'])
) {
    // ... alors on affiche une page 404
    http_response_code(404);
    echo 'Erreur 404 : Page non trouvée';
    exit; 
}

$articleId = intval($_GET['article_id']);

// Connexion à la base de données
$dsn = 'mysql:dbname=wf3-906-blog;host=localhost;charset=utf8'; // DSN : Data Source Name (informations de connexion à la BDD)
$user = 'root'; // Utilisateur
$password = ''; // Mot de passe
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Pour afficher les erreurs SQL
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Mode de récupération des résultats
];

$pdo = new PDO($dsn, $user, $password, $options); // Création d'un objet de la classe PDO

// Si le formulaire d'ajout de commentaire est soumis... 
if (!empty($_POST)) {

    // ... on récupère ses données pour les insérer dans la base
    $content = trim($_POST['content']); // Contenu du champ 'content' (en supprimant les espaces inutiles au début et à la fin)
    
    // Validation du formulaire : on vérifie la cohérence des données envoyées par l'internaute
    $errors = []; // Création d'un tableau qui contiendra les messages d'erreur
    
    // Si le champ content est vide...
    if (!$content) {
        $errors[] = 'Le champ "Commentaire" est obligatoire';
    }

    // Si je n'ai pas d'erreur (le tableau d'erreurs est vide)...
    if (empty($errors)) {

        // Requête SQL d'insertion du commentaire
        $sql = 'INSERT INTO comment
                (content, created_at, article_id)
                VALUES (?, NOW(), ?)';

        // Préparation de la requête SQL avec PDO pour se protéger des injections SQL
        $pdoStatement = $pdo->prepare($sql);

        // Exécution de la requête
        $pdoStatement->execute([$content, $articleId]);

        // Redirection HTTP pour repasser en GET et perdre les données (pour éviter de les poster à nouveau si on recharge la page)
        header('Location: /article?article_id=' . $articleId);
        exit;
    }
}


// Requête SQL de sélection des commentaires associés à l'article
$sql = 'SELECT * 
        FROM comment 
        WHERE article_id = ?
        ORDER BY created_at DESC';

// Préparation de la requête SQL avec PDO pour se protéger des injections SQL
$pdoStatement = $pdo->prepare($sql);

// Exécution de la requête
$pdoStatement->execute([$articleId]);

// Récupération de TOUS les résultats 
$comments = $pdoStatement->fetchAll(); // Plusieurs commentaires possibles => fetchAll()

// Requête de sélection de l'article à afficher
$sql = 'SELECT * 
        FROM article 
        WHERE id_article = ?';

// Préparation de la requête SQL avec PDO pour se protéger des injections SQL
$pdoStatement = $pdo->prepare($sql);

// Exécution de la requête
$pdoStatement->execute([$articleId]);

// Récupération du résultat
$article = $pdoStatement->fetch(); // 1 SEUL article à récupérer => fetch()

// Affichage : inclusion du fichier de template
$template = 'article';
require '../templates/base.phtml';



