<?php 

namespace App\Controller;

use App\Model\ArticleModel;
use App\Framework\AbstractController;
use App\Service\Renderer\PHPRenderer;

class HomeController extends AbstractController {

    /**
     * Action responsable de l'affichage de la page d'accueil
     */
    public function index()
    {
        // Récupérer des données dans la BDD
        $articleModel = new ArticleModel();
        $articles = $articleModel->getAllArticles();

        // Affichage : inclusion du fichier de template
        return $this->render('home', [
            'articles' => $articles
        ]);
    }

}