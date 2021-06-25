<?php 

//Définition de l'espace de nom dans lequel on se trouve dans ce fichier
namespace App\Model;

// Import des classes : on précise à PHP de quelles classes on va parler dans ce fichier
use App\Framework\AbstractModel;

class ArticleModel extends AbstractModel {

    /**
     * Sélectionne tous les articles par date de création décroissante
     */
    function getAllArticles()
    {
        $sql = 'SELECT * 
                FROM article AS A
                INNER JOIN category AS C ON A.category_id = C.id_category  
                ORDER BY A.created_at DESC';

        $articles = $this->database->selectAll($sql);

        return $articles;
    }

    function getArticleById(int $articleId)
    {
        // Requête de sélection de l'article à afficher
        $sql = 'SELECT * 
                FROM article AS A
                INNER JOIN category AS C ON A.category_id = C.id_category 
                WHERE id_article = ?';

        return $this->database->selectOne($sql, [$articleId]);
    }

}