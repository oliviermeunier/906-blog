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

// Requête de sélection de l'article à afficher
$sql = 'SELECT * FROM article WHERE id_article = ?';

// Préparation de la requête SQL avec PDO pour se protéger des injections SQL
$pdoStatement = $pdo->prepare($sql);

// Exécution de la requête
$pdoStatement->execute([$articleId]);

// Récupération du résultat
$article = $pdoStatement->fetch(); // 1 SEUL article à récupérer => fetch

// Affichage : inclusion du fichier de template
$template = 'article';
require '../templates/base.phtml';



