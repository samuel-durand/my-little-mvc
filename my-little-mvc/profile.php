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
    <script src="https://cdn.tailwindcss.com"></script>
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
        <div id="containerForm" class="">
            <h2>Modifier mes informations</h2>
            <form action="" method="post">
                <div>
                    <label for="fullname">Nom complet</label>
                    <input type="text" name="fullname" id="fullname" placeholder=<?php echo $user->getFullname(); ?> class="">
                    <p><?php echo $errors['fullname'] ?? ''; ?></p>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder=<?php echo $user->getEmail();?>>
                    <p><?php echo $errors['email'] ?? ''; ?></p>
                </div>
                <div>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="password">
                    <p><?php echo $errors['password'] ?? ''; ?></p>
                </div>
                <div id="message">
                    <?php echo $errors['success'] ?? ''; ?>
                </div>
                <input type="submit" value="submit" name="submit" class="p-2 border rounded bg-red-100">
            </form>
        </div>
        <?php endif; ?>
    </section>
</main>
</body>
</html>
