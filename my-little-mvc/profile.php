<?php

require 'vendor/autoload.php';

use App\Controller\AuthentificationController;

$authentificationController = new AuthentificationController;
$authentificationController->profile();

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
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?= $_SESSION['user']->getEmail() ?>">
    </form>
    
</body>
</html>