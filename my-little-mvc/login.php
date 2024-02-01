<?php


require 'vendor/autoload.php';

session_start();

use src\Controller\AuthenticationController;

$auth = new AuthenticationController();

if (isset($_POST['submit'])) {
    $login = $auth->login($_POST['email'], $_POST['password']);
}



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h1>Login</h1>
<form action="" method="post">

    <label for="email">email</label>
    <input type="email" name="email" id="email" placeholder="email">

    <label for="password">password</label>
    <input type="password" name="password" id="password" placeholder="password">

    <input type="submit" value="submit" name="submit">
</form>
</body>
</html>


