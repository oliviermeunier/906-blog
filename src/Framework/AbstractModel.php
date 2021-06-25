<?php 

namespace App\Framework;


class AbstractModel {

    protected $database;

    public function __construct()
    {
        // Initialisation de la propriété $database
        $this->database = new Database();
    }
}