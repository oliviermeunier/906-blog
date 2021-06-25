<?php 

namespace App\Model;

use App\Framework\AbstractModel;

class CategoryModel extends AbstractModel {

    public function getAllCategories()
    {
        $sql = 'SELECT C.*
                FROM category AS C
                INNER JOIN article AS A ON A.category_id = C.id_category
                GROUP BY C.id_category
                ORDER BY label';

        return $this->database->selectAll($sql);
    }
}