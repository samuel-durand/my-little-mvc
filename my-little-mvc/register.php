<?php

require 'vendor/autoload.php';

use src\Controller\AuthenticationController;


$auth = new AuthenticationController();




if (isset($_POST['submit'])) {
    $register = $auth->register($_POST['email'], $_POST['password'], $_POST['fullname']);
}




?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Shop - Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h1>Register</h1>
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