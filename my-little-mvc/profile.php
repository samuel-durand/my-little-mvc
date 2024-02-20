<?php

require 'vendor/autoload.php';
session_start();

use src\Controller\AuthenticationController;

$auth = new AuthenticationController();

if ($auth->profile()) {
    $user = $_SESSION['user'];
} else {
    $errors['auth'] = 'Vous devez être connecté pour accéder à cette page';
}
if (!empty($errors['auth'])) {
    sleep(5);
    header('Location: /my-little-mvc/login.php');
    exit;
}

if (isset($_POST['submit'])) {
    $update = $auth->updatecontroller($_POST['fullname'], $_POST['email'], $_POST['password']);
}

echo $_SESSION['user']['id'];

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
    <input type="text" name="fullname" id="fullname" value="<?php echo $_SESSION['user']['fullname'] ?>" placeholder="fullname">


    <label for="email">email</label>
    <input type="email" name="email" id="email" value="<?php echo $_SESSION['user']['email'] ?>" placeholder="email">

    <label for="password">password</label>
    <input type="password" name="password" id="password" value="" placeholder="password">

    <input type="submit" value="submit" name="submit">

    <a href="logout.php">logout</a>
</form>
</body>
</html>





