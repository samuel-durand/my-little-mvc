<?php

use App\Controller\AuthenticationController;
$authController = new AuthenticationController();

$user = $_SESSION['user'] ?? null;

?>


<header>
    <nav class="flex py-2 px-4 border-b-2">
        <ul class="flex justify-between w-full">
            <li><a href="/my-little-mvc/my-little-mvc/shop.php">Accueil</a></li>
            <?php if ($authController->isLogged()) : ?>
                <li><a href="/my-little-mvc/my-little-mvc/profile.php"><?= $user->getFullname();?></a></li>
                <li><a href="/my-little-mvc/my-little-mvc/logout.php">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="/my-little-mvc/my-little-mvc/login.php">Connexion</a></li>
                <li><a href="/my-little-mvc/my-little-mvc/register.php">Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>