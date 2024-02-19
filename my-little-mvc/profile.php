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
    header('Location: login.php?error=vousdevezvousconnecterpouraccéderàcettepage');
    exit;
}


if(isset($_POST['submit'])) {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $auth->update($fullname, $email, $password);
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>profil</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h1>Mettre à jour</h1>
<form action="" method="post">
    <label for="fullname">fullname</label>
    <input type="text" name="fullname" id="fullname" placeholder="fullname">

    <label for="email">email</label>
    <input type="email" name="email" id="email" placeholder="email">

    <label for="password">password</label>
    <input type="password" name="password" id="password" placeholder="password">

    <input type="submit" value="submit" name="submit">
</form>
</body>
</html>





