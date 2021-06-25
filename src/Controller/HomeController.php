<?php 

namespace App\Controller;

use App\Model\ArticleModel;

class HomeController {

    /**
     * Action responsable de l'affichage de la page d'accueil
     */
    public function index()
    {
        // Récupérer des données dans la BDD
        $articleModel = new ArticleModel();
        $articles = $articleModel->getAllArticles();

        // Affichage : inclusion du fichier de template
        $template = 'home'; 
        require '../templates/base.phtml';
    }

}