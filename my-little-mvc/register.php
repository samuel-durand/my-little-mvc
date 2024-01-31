<?php

require 'vendor/autoload.php';

use src\Controller\AuthenticationController;


$auth = new AuthenticationController();




if (isset($_POST['submit'])) {
    $reg = $auth->register($_POST['email'], $_POST['password'], $_POST['fullname']);
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
    <input type="text" name="fullname" id="fullname" placeholder="fullname">
    <p><?php echo $message['fullname'] ?? ''; ?></p>
    <input type="email" name="email" id="email" placeholder="email">
    <p><?php echo $message['email'] ?? ''; ?></p>
    <input type="password" name="password" id="password" placeholder="password">
    <p><?php echo $message['password'] ?? ''; ?></p>:
    <div id="message">
        <?php echo $message['success'] ?? ''; ?>
    </div>
    <input type="submit" value="submit" name="submit">
</form>
</body>
</html>