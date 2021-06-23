<?php 

// Démarrage de la session pour pouvoir utiliser $_SESSION
session_start();

// Inclusion du fichier d'autoload de composer
require '../vendor/autoload.php';

// Inclusion des dépendances
require '../app/config.php';
require '../library/functions.php';

/**
 * Le fichier index.php joue le rôle de Front Controller
 * Toutes les requêtes, toutes les pages du site passent par ce fichier
 */

// Récupération du chemin de l'URL (path)

/*
$path = '/'; // Par défaut, on est sur la page d'accueil (juste un "slash")

// Si un trouve un path dans l'URL on va le chercher
if (array_key_exists('PATH_INFO', $_SERVER)){
    $path = $_SERVER['PATH_INFO'];
}
*/

$path = $_SERVER['PATH_INFO'] ?? '/';

// Routing : on associé chaque "route" ou "path" à un contrôleur
switch($path) {
    
    case '/':
        require '../controller/home.php';
        break;

    case '/article':
        require '../controller/article.php';
        break;

    case '/signup':
        require '../controller/signup.php';
        break;

    case '/login':
        require '../controller/login.php';
        break;

    case '/logout':
        require '../controller/logout.php';
        break;

    default:
        http_response_code(404);
        echo 'Erreur 404 : page non trouvée';
        exit;    
}