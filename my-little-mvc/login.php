<?php
session_start();
//session_destroy();
require_once 'vendor/autoload.php';

use App\Controller\AuthenticationController;

$auth = new AuthenticationController();

$message = [];
if (isset($_POST['submit'])) {
    $reg = $auth->login($_POST['email'], $_POST['password']);
    $message = $reg;
}



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Shop - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h1>Login</h1>
<form action="" method="post">
    <input type="email" name="email" id="email" placeholder="email">
        <p><?php echo $message['fullname'] ?? ''; ?></p>
    <input type="password" name="password" id="password" placeholder="password">
        <p><?php echo $message['password'] ?? ''; ?></p>:
    <div id="message">
        <?php echo $message['success'] ?? ''; ?>
        <?php echo $message['errors'] ?? ''; ?>
    </div>
    <input type="submit" value="submit" name="submit" placeholder="Connexion">
</form>
</body>
</html>