<?php

require 'vendor/autoload.php';
session_start();

use src\Controller\AuthenticationController;

$auth = new AuthenticationController();

if (isset($_SESSION['user'])) {
    // Récupération des informations de l'utilisateur

    $user = $auth->profile();

    echo "<h1>Profil de l'utilisateur</h1>";
    echo "<p>Nom : " . ($user['fullname']) . "</p>";
    echo "<p>Email : " . ($user['email']) . "</p>";
    echo "<p>Role : " . ($user['role']) . "</p>";

} else {
    
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: login.php?error=vous devez vous connecter pour accéder à cette page');
    exit;
}







