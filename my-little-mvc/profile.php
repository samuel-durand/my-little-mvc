<?php

require 'vendor/autoload.php';

use App\Controller\AuthentificationController;

$authentificationController = new AuthentificationController;
$authentificationController->profile();

if (isset($_POST['edit-email'])) {
    if (isset($_POST['email'])){
        $email = $_POST['email'];
        $fullname = null;
        $password = null;

        $authentificationController->updateProfile($email, $fullname, $password);
    }
}

if (isset($_POST['edit-fullname'])) {
    if (isset($_POST['fullname'])){
        $fullname = $_POST['fullname'];
        $email = null;
        $password = null;

        $authentificationController->updateProfile($email, $fullname, $password);
    }
}

if (isset($_POST['edit-password'])) {
    if (isset($_POST['password'])){
        $password = $_POST['password'];
        $fullname = null;
        $email = null;

        $authentificationController->updateProfile($email, $fullname, $password);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="src/CSS/profile.css">
</head>
<body>

    <form method="post">
        <label for="fullname">Nom et Prénom</label>
        <input type="text" name="fullname" id="fullname" value="<?= $_SESSION['user']->getFullname() ?>">
        <input type="submit" name="edit-fullname" value="Modifier">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?= $_SESSION['user']->getEmail() ?>">
        <input type="submit" name="edit-email" value="Modifier">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" value="*********">
        <input type="submit" name="edit-password" value="Modifier">
    </form>

    <div class="link">
        <button><a href="shop.php">Retour à la boutique</a></button>
    </div>
    
</body>
</html>