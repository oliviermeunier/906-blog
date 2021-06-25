<?php 

namespace App\Controller;


class AuthController {

    public function login()
    {
        // Si le formulaire est soumis... 
        if (!empty($_POST)) {

            // Récupérer les données du formulaire 
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Vérification des identifiants (email + mot de passe)
            $user = checkCredentials($email, $password);

            $errors = [];

            if (!$user) {
                $errors[] = 'Identifiants incorrects';
            }

            if (empty($errors)) {

                // Enregistrement des informations de l'utilisateur en session
                register(
                    $user['id_user'],
                    $user['firstname'],
                    $user['lastname'],
                    $user['email']
                );

                // Message flash de confirmation 
                addFlash('Connexion réussie !');

                // Redirection vers la page d'accueil
                header('Location: ' . url('/'));
                exit;
            }  
        }

        // Affichage : inclusion du fichier de template
        $template = 'login'; 
        require '../templates/base.phtml';
    }


    public function logout()
    {
        // Déconnexion
        logout();

        // Message flash de confirmation 
        addFlash('Vous êtes déconnecté');

        // Redirection vers la page d'accueil
        header('Location: ' . url('/'));
        exit;
    }
}