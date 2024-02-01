<?php

require 'vendor/autoload.php';

use App\Controller\AuthentificationController;

$authentificationController = new AuthentificationController;
$authentificationController->profile();

if (isset($_POST['edit'])) {
    if (isset($_POST['email']) || isset($_POST['fullname']) || isset($_POST['password'])){
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

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
</head>
<body>

    <form>
        <label for="fullname">Nom et Prénom</label>
        <input type="text" name="fullname" id="fullname" value="<?= $_SESSION['user']->getFullname() ?>">
        <input type="submit" name="edit" value="Modifier">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?= $_SESSION['user']->getEmail() ?>">
        <input type="submit" name="edit" value="Modifier">
        <input type="text" name="password" id="password" value="*********">
        <input type="submit" name="edit" value="Modifier">
    </form>
    
</body>
</html>