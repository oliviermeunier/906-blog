<?php 

// Déconnexion
logout();

// Message flash de confirmation 
addFlash('Vous êtes déconnecté');

// Redirection vers la page d'accueil
header('Location: /');
exit;