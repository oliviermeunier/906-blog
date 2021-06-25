<?php 

namespace App\Model;

use App\Framework\AbstractModel;

class CommentModel extends AbstractModel {

    function addComment(string $content, int $articleId, int $userId)
    {
        // Requête SQL d'insertion du commentaire
        $sql = 'INSERT INTO comment
                (content, created_at, article_id, user_id)
                VALUES (?, NOW(), ?, ?)';

        $this->database->executeQuery($sql, [$content, $articleId, $userId]);
    }

    function getCommentsByArticleId(int $articleId)
    {
        // Requête SQL de sélection des commentaires associés à l'article
        $sql = 'SELECT C.content, C.created_at, U.firstname, U.lastname 
                FROM comment AS C
                INNER JOIN user AS U ON C.user_id = U.id_user  
                WHERE article_id = ?
                ORDER BY C.created_at DESC';

        return $this->database->selectAll($sql, [$articleId]);
    }
}