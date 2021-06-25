<?php 

namespace App\Model;

use App\Framework\AbstractModel;

class CategoryModel extends AbstractModel {

    public function getAllCategories()
    {
        $sql = 'SELECT *
                FROM category
                ORDER BY label';

        return $this->database->selectAll($sql);
    }
}