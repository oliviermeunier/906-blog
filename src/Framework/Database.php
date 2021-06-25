<?php 

namespace App\Framework;

use PDO;

class Database {

    private $pdo;

    public function __construct()
    {
        // Initialisation de la propriété $pdo
        $this->pdo = $this->getPDOConnection();
    }

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
        // Préparation de la requête SQL avec PDO pour se protéger des injections SQL
        $pdoStatement = $this->pdo->prepare($sql);

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
        $pdoStatement = $this->executeQuery($sql, $values);

        $results = $pdoStatement->fetchAll();

        return $results;
    }

    /**
     * Exécution d'une requête de sélection et récupération d'un seul résultat
     */
    function selectOne(string $sql, array $values = [])
    {
        $pdoStatement = $this->executeQuery($sql, $values);

        $result = $pdoStatement->fetch();

        return $result;
    }


}