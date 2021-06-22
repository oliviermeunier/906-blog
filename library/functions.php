<?php 

/**
 * Création d'une connexion à la base de données
 */
function getPDOConnection()
{
    // Connexion à la base de données
    $dsn = 'mysql:dbname=wf3-906-blog;host=localhost;charset=utf8'; // DSN : Data Source Name (informations de connexion à la BDD)
    $user = 'root'; // Utilisateur
    $password = ''; // Mot de passe
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

function addComment(string $content, int $articleId)
{
    // Requête SQL d'insertion du commentaire
    $sql = 'INSERT INTO comment
            (content, created_at, article_id)
            VALUES (?, NOW(), ?)';

    executeQuery($sql, [$content, $articleId]);
}

function getCommentsByArticleId(int $articleId)
{
    // Requête SQL de sélection des commentaires associés à l'article
    $sql = 'SELECT * 
            FROM comment 
            WHERE article_id = ?
            ORDER BY created_at DESC';

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