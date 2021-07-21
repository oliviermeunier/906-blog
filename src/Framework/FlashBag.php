<?php 

namespace App\Framework;

class FlashBag extends AbstractSession {

    public function __construct()
    {
        parent::__construct();

        $this->initFlash();
    }

    function initFlash()
    {
        if (!array_key_exists('flash', $_SESSION)) {
            $_SESSION['flash'] = [];
        }
    }

    function addFlash(string $message)
    {
        $_SESSION['flash'][] = $message;
    }

    /**
     * Est-ce qu'il y a des messages flash en session ?
     */
    function hasFlash()
    {
        // On retourne true si le tableau de messages flash n'est PAS vide
        return !empty($_SESSION['flash']);
    }

    /**
     * Récupère les messages flash, les retourne et les supprime de la session
     */
    function getFlash()
    {
        // On récupère les messages flash enregistrés en session
        $messages = $_SESSION['flash'];

        // On supprime les messages de la session
        $_SESSION['flash'] = [];

        // On retourne les messages
        return $messages;
    }

}