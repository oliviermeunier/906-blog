<?php 

// Déconnexion
logout();

// Message flash de confirmation 
addFlash('VOus êtes déconnecté');

// Redirection vers la page d'accueil
header('Location: /');
exit;