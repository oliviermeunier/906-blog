<?php 

namespace App\Framework;

class UserSession extends AbstractSession {

    /**
     * Enregistre les données de l'utilisateur en session
     */
    function register(int $userId, string $firstname, string $lastname, string $email)
    {
        $_SESSION['user'] = [
            'id_user' => $userId,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email
        ];
    }

    /**
     * Est-ce que l'utilisateur est connecté ?
     * Retourne true s'il l'est, false sinon
     */
    function isAuthenticated()
    {
        // Est-ce que la clé 'user' existe dans $_SESSION et y a-t-il une valeur associée ?
        return array_key_exists('user', $_SESSION) && isset($_SESSION['user']);
    }

    /**
     * Déconnecte l'utilisateur : efface ses données en session
     */
    function logout()
    {
        // Effacer les données de l'utilisateur enregistrées en session
        $_SESSION['user'] = null;

        // On détruit la session
        session_destroy();
    }

    /**
     * Retourne l'id de l'utilisateur connecté
     */
    function getUserId()
    {
        if (!$this->isAuthenticated()){
            return null;
        }

        return $_SESSION['user']['id_user'];
    }

    /**
     * Retourne le nom complet de l'utilisateur connecté
     */
    function getUserFullname()
    {
        if (!$this->isAuthenticated()){
            return null;
        }

        return $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'];
    }

    /**
     * Retourne le nom complet de l'utilisateur connecté
     */
    function getUserEmail()
    {
        if (!$this->isAuthenticated()){
            return null;
        }

        return $_SESSION['user']['email'];
    }


}