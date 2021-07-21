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