<?php 

// Connexion à la base de données
$dsn = 'mysql:dbname=wf3-906-blog;host=localhost;charset=utf8'; // DSN : Data Source Name (informations de connexion à la BDD)
$user = 'root'; // Utilisateur
$password = ''; // Mot de passe
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Pour afficher les erreurs SQL
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Mode de récupération des résultats
];

$pdo = new PDO($dsn, $user, $password, $options); // Création d'un objet de la classe PDO

// Récupérer des données dans la BDD
$sql = 'SELECT * FROM article ORDER BY created_at DESC';

$pdoStatement = $pdo->query($sql);
$articles = $pdoStatement->fetchAll();

// dump($articles);

// Affichage : inclusion du fichier de template
$template = 'home';
require '../templates/base.phtml';



