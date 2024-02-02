<?php
session_start();
require 'vendor/autoload.php';

use App\Controller\AuthenticationController;

$auth = new AuthenticationController();

$message = [];
if (isset($_POST['submit'])) {
    $reg = $auth->register($_POST['email'], $_POST['password'], $_POST['fullname']);
    $message = $reg;
}




?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Shop - Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php require_once 'import/header.php'; ?>
<main class="">
    <article class="w-screen h-screen flex justify-center items-center">
        <section class="flex justify-between h-1/2 w-4/6 border-2 rounded">
            <div>
                <h2 class="text-6xl font-semibold">Inscription</h2>
                <div>
                    <p>Rejoignez-nous et profitez de nos offres</p>
                </div>
            </div>
            <div class="w-[40%] h-full">
                <form action="" method="post">
                    <label for="fullname">Nom complet</label>
                    <input type="text" name="fullname" id="fullname" placeholder="fullname">
                    <p><?php echo $message['fullname'] ?? ''; ?></p>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="email">
                    <p><?php echo $message['email'] ?? ''; ?></p>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="password">
                    <p><?php echo $message['password'] ?? ''; ?></p>
                    <div id="message">
                        <?php echo $message['success'] ?? ''; ?>
                    </div>
                    <input type="submit" value="S'inscrire" name="submit" class="p-2 w-11/12 border-2 border-[#ff2850] bg-[#ff2850] text-white text-xl rounded">
                </form>
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </section>
    </article>
</main>
</body>
</html>
