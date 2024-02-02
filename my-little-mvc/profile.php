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
<main class="w-screen h-screen flex justify-center items-center">
    <?php require_once 'import/header.php'; ?>
        <?php if (!empty($user)) : ?>
        <section class="flex justify-between h-1/2 w-4/6 rounded-lg bg-[#F6F6F6]">
            <div class="w-1/2 text-white p-4">
                <h2 class="text-6xl font-semibold text-[#7B41F9]">Profil</h2>
                <div class="pt-3 text-black">
                    <p>Modifiez vos informations</p>
                </div>
            </div>
            <div id="containerForm" class="w-1/2 h-full">
                <form action="" method="post" class="flex flex-col justify-around h-full px-4">
                    <div class="flex flex-col items-start gap-y-1">
                        <label for="fullname">Nom complet</label>
                        <input type="text" name="fullname" id="fullname" class="p-2 w-full rounded border border-[#7B41F9]" placeholder=<?php echo $user->getFullname(); ?> class="">
                        <p><?php echo $errors['fullname'] ?? ''; ?></p>
                    </div>
                    <div class="flex flex-col items-start gap-y-1">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="p-2 w-full rounded border border-[#7B41F9]" placeholder=<?php echo $user->getEmail();?>>
                        <p><?php echo $errors['email'] ?? ''; ?></p>
                    </div>
                    <div class="flex flex-col items-start gap-y-1">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password" class="p-2 w-full rounded border border-[#7B41F9]" placeholder="password">
                        <p><?php echo $errors['password'] ?? ''; ?></p>
                    </div>
                    <div id="message">
                        <?php echo $errors['success'] ?? ''; ?>
                    </div>
                    <input type="submit" value="submit" name="submit" class="p-2 w-full bg-[#7B41F9] text-white text-xl rounded">
                </form>
            </div>
        </section>
        <?php endif; ?>
</main>
</body>
</html>
