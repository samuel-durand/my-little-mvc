<?php
require_once 'vendor/autoload.php';

session_start();

use App\Controller\AuthenticationController;

$authController = new AuthenticationController();

$errors = [];
if ($authController->profile()) {
    $user = $_SESSION['user'];
} else {
    $errors['auth'] = 'Vous devez être connecté pour accéder à cette page';
}


// Autres codes...

if (!empty($errors['auth'])) {
    sleep(5); // Pause de 5 secondes
    header('Location: /my-little-mvc/my-little-mvc/login.php');
    exit;
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
        <h1>Profil</h1>
        <?php if (!empty($user)) : ?>
            <p>Nom : <?php echo $user->getFullname(); ?></p>
            <p>Email : <?php echo $user->getEmail(); ?></p>
            <?php foreach ($user->getRole() as $role)
                $role === 'ROLE_ADMIN' ? $role = 'Administrateur' : $role = 'Utilisateur';
                echo '<p>Role : ' . $role . '</p>';
            ?>
            <a href="logout.php">Déconnexion</a>
        <?php else: ?>
            <a href="login.php">Connexion</a>
            <p>Vous devez être connecté pour accéder à cette page</p>
        <?php endif; ?>
    </main>
</body>
</html>
