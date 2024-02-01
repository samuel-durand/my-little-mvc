<?php

require 'vendor/autoload.php';
use App\Controller\AuthentificationController;

$authentificationController = new AuthentificationController;

if (!(isset($_POST['email'])) || !(isset($_POST['password'])) || empty($_POST['email']) || empty($_POST['password'])){
    echo "Veuillez remplir tous les champs";
} else {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $authentificationController->login($email, $password);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <form method="post">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" autocomplete="off">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" autocomplete="off">
        <input type="submit" value="Se connecter">
    </form>
</body>
</html>