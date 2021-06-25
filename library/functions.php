<?php 

// Import des classes
use App\Model\UserModel;


function checkCredentials(string $email, string $password)
{
    // 1° Est-ce qu'il existe un compte associé à l'adresse email ?
    $userModel = new UserModel();
    $user = $userModel->getUserByEmail($email);

    // Si l'email n'existe pas dans la base de données OU le mot de passe n'est pas correct...
    if (!$user || !password_verify($password, $user['password'])) {
        return false; // On retourne la valeur false
    } 
    
    // Si tout est OK => on retourne les données de l'utilisateur
    return $user;

    // return !$user || !password_verify($password, $user['password']) ? false : $user;
}

/**
 * GESTION DE LA SESSION UTILISATEUR
 */

 /**
  * Démarre une session si aucune session n'est démarrée
  */
function checkSession()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

/**
 * Enregistre les données de l'utilisateur en session
 */
function register(int $userId, string $firstname, string $lastname, string $email)
{
    checkSession();

    $_SESSION['user'] = [
        'id_user' => $userId,
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email
    ];
}

/**
 * Est-ce que l'utilisateur est connecté ?
 * Retourne true s'il l'est, false sinon
 */
function isAuthenticated()
{
    checkSession();

    // Est-ce que la clé 'user' existe dans $_SESSION et y a-t-il une valeur associée ?
    return array_key_exists('user', $_SESSION) && isset($_SESSION['user']);
}

/**
 * Déconnecte l'utilisateur : efface ses données en session
 */
function logout()
{
    checkSession();

    // Effacer les données de l'utilisateur enregistrées en session
    $_SESSION['user'] = null;

    // On détruit la session
    session_destroy();
}

/**
 * Retourne l'id de l'utilisateur connecté
 */
function getUserId()
{
    if (!isAuthenticated()){
        return null;
    }

    return $_SESSION['user']['id_user'];
}

/**
 * Retourne le nom complet de l'utilisateur connecté
 */
function getUserFullname()
{
    if (!isAuthenticated()){
        return null;
    }

    return $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'];
}

/**
 * Retourne le nom complet de l'utilisateur connecté
 */
function getUserEmail()
{
    if (!isAuthenticated()){
        return null;
    }

    return $_SESSION['user']['email'];
}

/**
 * GESTION DES MESSAGES FLASH
 */
function initFlash()
{
    checkSession();

    if (!array_key_exists('flash', $_SESSION)) {
        $_SESSION['flash'] = [];
    }
}

function addFlash(string $message)
{
    initFlash();

    $_SESSION['flash'][] = $message;
}

/**
 * Est-ce qu'il y a des messages flash en session ?
 */
function hasFlash()
{
    initFlash();

    // On retourne true si le tableau de messages flash n'est PAS vide
    return !empty($_SESSION['flash']);
}

/**
 * Récupère les messages flash, les retourne et les supprime de la session
 */
function getFlash()
{
    initFlash();

    // On récupère les messages flash enregistrés en session
    $messages = $_SESSION['flash'];

    // On supprime les messages de la session
    $_SESSION['flash'] = [];

    // On retourne les messages
    return $messages;
}

/**
 * Construit une URL absolue (http://mon-site.com/ma-page) à partir d'une route et d'un tableau de paramètres
 */
function url(string $path, array $params = [])
{
    $url = SITE_BASE_URL . $path; // Ex. : http://localhost:8000/article

    if ($params) {
        $url .= '?' . http_build_query($params);
    }

    return $url;
}

/**
 * Construit l'URL absolue d'une ressource (CSS, JS? images, etc)
 */
function asset(string $path)
{
    return SITE_BASE_URL . '/' . $path;
}