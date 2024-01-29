<?php

require 'vendor/autoload.php';

use App\Model\User;

if (isset($_POST['submit'])) {

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
<h1>Register</h1>
<form action="" method="post">
    <input type="text" name="fullname" id="fullname" placeholder="fullname">
    <input type="email" name="email" id="email" placeholder="email">
    <input type="password" name="password" id="password" placeholder="password">
    <input type="submit" value="submit" name="submit">
</form>
</body>
</html>
