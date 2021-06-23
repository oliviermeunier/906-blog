<?php 


// Si le formulaire est soumis... 
if (!empty($_POST)) {

    // Récupérer les données du formulaire 
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

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
    } elseif (getUserByEmail($email)) {
        $errors[] = 'Il existe déjà un compte associé à cet email';
    }

    if (strlen($password) < 8) {
        $errors[] = 'Le mot de passe doit comporter au moins 8 caractères';
    }

    // Si tout est ok... 
    if (empty($errors)) {    

        // Hashage du mot de passe
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // ...on insert les données dans la base
        createUser($firstname, $lastname, $email, $hash); 

        // Message flash de confirmation 
        addFlash('Votre compte a bien été créé, vous pouvez vous connecter !');

        // Redirection vers la page de connexion
        header('Location: ' . url('/login'));
        exit;
    }
}

// Affichage : inclusion du fichier de template
$template = 'signup'; 
require '../templates/base.phtml';
