<?php

require_once 'vendor/autoload.php';

use App\Model\User;
use App\Controller\AuthenticationController;

$auth = new AuthenticationController();

$message = null;
if (isset($_POST['submit'])) {
    $reg = $auth->register($_POST['email'], $_POST['password'], $_POST['fullname']);
    if ($reg != User::class) {
        var_dump($reg);
        $message = 'Login';
    } else {
        echo 'Login Failed';
    }
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h1>Login</h1>
<form action="" method="post">
    <input type="email" name="email" id="email" placeholder="email">
    <input type="password" name="password" id="password" placeholder="password">
    <input type="submit" value="submit" name="submit" placeholder="Connexion">
</form>
</body>
</html>