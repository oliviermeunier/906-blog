<?php 

// Récupérer des données dans la BDD
$articles = getAllArticles();

// Affichage : inclusion du fichier de template
$template = 'home'; 
require '../templates/base.phtml';



