<?php 

namespace App\Framework;

abstract class AbstractSession {

    public function __construct()
    {
        $this->checkSession();
    }

    /**
    * Démarre une session si aucune session n'est démarrée
    */
    function checkSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
}