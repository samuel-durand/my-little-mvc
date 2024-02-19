<?php

require 'vendor/autoload.php';
use App\Controller\AuthentificationController;

$authentificationController = new AuthentificationController;

if (isset($_POST['fullname']) || isset($_POST['email']) || isset($_POST['password']) || isset($_POST['password_confirm'])){
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    
    $authentificationController->register($fullname, $email, $password, $password_confirm);
} else {
    $msg = "Veuillez remplir tous les champs";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="src/CSS/register.css">
</head>
<body>
    <p><?php if (isset($msg)) { echo $msg; } ?></p>
    <form method="post">
        <label for="fullname">Nom et Prénom</label>
        <input type="text" name="fullname" id="fullname" autocomplete="off">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" autocomplete="off">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" autocomplete="off">
        <label for="password_confirm">Confirmer le mot de passe</label>
        <input type="password" name="password_confirm" id="password_confirm" autocomplete="off">
        <input type="submit" value="S'inscrire">
    </form>
    <div class="link">
        <p>Déjà un compte ?</p>
        <button><a href="login.php">Se connecter</a></button>
    </div>
</body>
</html>