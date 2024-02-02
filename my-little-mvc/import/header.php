<?php

use App\Controller\AuthenticationController;
$authController = new AuthenticationController();

$user = $_SESSION['user'] ?? null;

?>


<header class="fixed top-0 left-0 right-0 lg: h-16">
    <nav class="flex items-center py-2 px-4 border-b-2 h-full">
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