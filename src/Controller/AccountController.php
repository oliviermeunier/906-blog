<?php 

namespace App\Controller;

use App\Model\UserModel;
use App\Framework\FlashBag;
use App\Framework\AbstractController;
use App\Exception\UserAlreadyExistsException;

class AccountController extends AbstractController {

    public function signup()
    {
        // Si le formulaire est soumis... 
        if (!empty($_POST)) {

            // Récupérer les données du formulaire 
            $firstname = trim($_POST['firstname']);
            $lastname = trim($_POST['lastname']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            // Création d'un objet UserModel
            $userModel = new UserModel();

            // Valider les données du formulaire
            $errors = [];

            if (!$firstname){
                $errors[] = 'Le champ "Prénom" est obligatoire';
            }

            if (!$lastname){
                $errors[] = 'Le champ "Nom" est obligatoire';
            }

            if (!$email){
                $errors[] = 'Le champ "Email" est obligatoire';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] =  "\"$email\" n'est pas un email valide";
            } 

            if (strlen($password) < 8) {
                $errors[] = 'Le mot de passe doit comporter au moins 8 caractères';
            }

            // Si tout est ok... 
            if (empty($errors)) {    

                // Hashage du mot de passe
                $hash = password_hash($password, PASSWORD_DEFAULT);

                try {

                    // ...on insert les données dans la base
                    $userModel->createUser($firstname, $lastname, $email, $hash); 

                    // Message flash de confirmation 
                    $this->addFlash('Votre compte a bien été créé, vous pouvez vous connecter !');

                    // Redirection vers la page de connexion
                    header('Location: ' . url('/login'));
                    exit;
                }
                catch(UserAlreadyExistsException $exception) {
                    $errors[] = $exception->getMessage();
                }
            }
        }

        // Affichage : inclusion du fichier de template
        $template = 'signup'; 
        require '../templates/base.phtml';
    }
}