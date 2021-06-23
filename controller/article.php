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

        addComment($content, $articleId, getUserId());

        // Redirection HTTP pour repasser en GET et perdre les données (pour éviter de les poster à nouveau si on recharge la page)
        // header('Location: /article?article_id=' . $articleId);
        header('Location: ' . url('/article', ['article_id' => $articleId]));
        exit;
    }
}

$comments = getCommentsByArticleId($articleId);

$article = getArticleById($articleId);

// Affichage : inclusion du fichier de template
$template = 'article';
require '../templates/base.phtml';



