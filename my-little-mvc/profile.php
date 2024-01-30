<?php
require_once 'vendor/autoload.php';
session_start();

use App\Controller\AuthenticationController;

$authController = new AuthenticationController();

$errors = [];

var_dump($_SESSION['user']);

if ($authController->profile()) {
    $user = $_SESSION['user'];
} else {
    $errors['auth'] = 'Vous devez être connecté pour accéder à cette page';
}
if (!empty($errors['auth'])) {
    sleep(5);
    header('Location: /my-little-mvc/my-little-mvc/login.php');
    exit;
}

$errors = [];
if (isset($_POST['submit'])) {
    $update = $authController->update($_POST['email'], $_POST['password'], $_POST['fullname']);
    $errors = $update;
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop - Profil</title>
</head>
<body>
<main>
    <?php require_once 'import/header.php'; ?>
    <h1>Profil</h1>
    <?php if (!empty($user)) : ?>
        <p>Nom : <?php echo $user->getFullname(); ?></p>
        <p>Email : <?php echo $user->getEmail(); ?></p>
        <?php foreach ($user->getRole() as $role)
            $role === 'ROLE_ADMIN' ? $role = 'Administrateur' : $role = 'Utilisateur';
        echo '<p>Role : ' . $role . '</p>';
        ?>
        <a href="/logout.php">Déconnexion</a>
    <?php else: ?>
        <a href="login.php">Connexion</a>
        <p>Vous devez être connecté pour accéder à cette page</p>
    <?php endif; ?>

    <section>
        <?php if (!empty($user)) : ?>
        <div id="containerForm">
            <h2>Modifier mes informations</h2>
            <form action="" method="post">
                <input type="text" name="fullname" id="fullname" placeholder=<?php echo $user->getFullname(); ?>>
                    <p><?php echo $errors['fullname'] ?? ''; ?></p>
                <input type="email" name="email" id="email" placeholder=<?php echo $user->getEmail();?>>
                    <p><?php echo $errors['email'] ?? ''; ?></p>
                <input type="password" name="password" id="password" placeholder="password">
                    <p><?php echo $errors['password'] ?? ''; ?></p>
                <div id="message">
                    <?php echo $errors['success'] ?? ''; ?>
                </div>
                <input type="submit" value="submit" name="submit">
            </form>
        </div>
        <?php endif; ?>
    </section>
</main>
</body>
</html>
