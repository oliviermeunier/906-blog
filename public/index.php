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

try {

    $renderer = new \App\Service\Renderer\PHPRenderer();
    //$twigRenderer = new \App\Service\Renderer\TwigRenderer();

    // Routing : on associé chaque "route" ou "path" à un contrôleur
    $routes = require '../app/routes.php';

    // Gestion des erreurs 404
    if (!array_key_exists($path, $routes)) {
        throw new NotFoundException();
    }

    $action = $routes[$path];
    $controllerClassname = '\\App\\Controller\\' . $action['controller'];
    $method = $action['method'];

    $controller = new $controllerClassname($renderer);
    echo $controller->$method();
}
catch(\App\Exception\NotFoundException $exception) {
    http_response_code(404);
    echo 'Erreur 404 : page non trouvée';
    exit;
}
catch(PDOException $exception) {
    echo 'Problème avec la BDD : ' . $exception->getMessage();
}
catch(Exception $exception) {
    echo '[ERREUR] ' . $exception->getMessage();
}