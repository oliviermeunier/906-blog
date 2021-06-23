<?php 

/**
 * Création d'une connexion à la base de données
 */
function getPDOConnection()
{
    // Connexion à la base de données
    $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8'; // DSN : Data Source Name (informations de connexion à la BDD)
    $user = DB_USER; // Utilisateur
    $password = DB_PASSWORD; // Mot de passe
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Pour afficher les erreurs SQL
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Mode de récupération des résultats
    ];

    $pdo = new PDO($dsn, $user, $password, $options); // Création d'un objet de la classe PDO

    return $pdo;
}

/**
 * Préparation et exécution d'une requête SQL
 */
function executeQuery(string $sql, array $values = [])
{
    // Création de la connexion PDO
    $pdo = getPDOConnection();

    // Préparation de la requête SQL avec PDO pour se protéger des injections SQL
    $pdoStatement = $pdo->prepare($sql);

    // Exécution de la requête
    $pdoStatement->execute($values);

    // On retourne en résultat l'objet PDOStatement qui permettra de récupérer des résultats
    return $pdoStatement;
}

/**
 * Exécution d'une requête de sélection et récupération de plusieurs résultats
 */
function selectAll(string $sql, array $values = [])
{
    $pdoStatement = executeQuery($sql, $values);

    $results = $pdoStatement->fetchAll();

    return $results;
}

/**
 * Exécution d'une requête de sélection et récupération d'un seul résultat
 */
function selectOne(string $sql, array $values = [])
{
    $pdoStatement = executeQuery($sql, $values);

    $result = $pdoStatement->fetch();

    return $result;
}

/**
 * Sélectionne tous les articles par date de création décroissante
 */
function getAllArticles()
{
    $sql = 'SELECT * 
            FROM article AS A
            INNER JOIN category AS C ON A.category_id = C.id_category  
            ORDER BY A.created_at DESC';

    $articles = selectAll($sql);

    return $articles;
}

function addComment(string $content, int $articleId, int $userId)
{
    // Requête SQL d'insertion du commentaire
    $sql = 'INSERT INTO comment
            (content, created_at, article_id, user_id)
            VALUES (?, NOW(), ?, ?)';

    executeQuery($sql, [$content, $articleId, $userId]);
}

function getCommentsByArticleId(int $articleId)
{
    // Requête SQL de sélection des commentaires associés à l'article
    $sql = 'SELECT C.content, C.created_at, U.firstname, U.lastname 
            FROM comment AS C
            INNER JOIN user AS U ON C.user_id = U.id_user  
            WHERE article_id = ?
            ORDER BY C.created_at DESC';

    return selectAll($sql, [$articleId]);
}

function getArticleById(int $articleId)
{
    // Requête de sélection de l'article à afficher
    $sql = 'SELECT * 
            FROM article AS A
            INNER JOIN category AS C ON A.category_id = C.id_category 
            WHERE id_article = ?';

    return selectOne($sql, [$articleId]);
}

function createUser(string $firstname, string $lastname, string $email, string $hash)
{
    $sql = 'INSERT INTO user
            (firstname, lastname, email, password, created_at)
            VALUES (?,?,?,?, NOW())';

    executeQuery($sql, [$firstname, $lastname, $email, $hash]);
}

function getUserByEmail(string $email)
{
    $sql = 'SELECT * 
            FROM user
            WHERE email = ?';

    return selectOne($sql, [$email]);
}

function checkCredentials(string $email, string $password)
{
    // 1° Est-ce qu'il existe un compte associé à l'adresse email ?
    $user = getUserByEmail($email);

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