<?php

use App\Controller\AuthenticationController;
$authController = new AuthenticationController();

$user = $_SESSION['user'] ?? null;

?>


<header class="fixed top-0 left-0 right-0 lg: h-16">
    <nav class="flex items-center py-2 px-4 border-b-2 border-[#ff2850] h-full">
        <div class="flex justify-between w-full">
            <div id="containerLogo" class="p-2">
                <h2 class="text-xl font-bold text-[#ff2850]">Shop</h2>
            </div>
            <div class="containerLink">
                <ul class="flex text-bold uppercase gap-x-2">
                    <li class="rounded bg-[#fff] border-2 border-[#ff2850] p-2">
                        <a href="/my-little-mvc/my-little-mvc/shop.php">
                            Accueil
                        </a>
                    </li>
                    <?php if ($authController->isLogged()) : ?>
                        <li class="rounded bg-[#ff2850] border-2 border-[#ff2850] p-2">
                            <a href="/my-little-mvc/my-little-mvc/profile.php">
                                <?= $user->getFullname();?>
                            </a>
                        </li>
                        <li class="rounded bg-[#ff2850] border-2 border-[#ff2850] p-2">
                            <a href="/my-little-mvc/my-little-mvc/logout.php">
                                Déconnexion
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="rounded bg-[#ff2850] border-2 border-[#ff2850] p-2">
                            <a href="/my-little-mvc/my-little-mvc/login.php">
                                Connexion
                            </a>
                        </li>
                        <li class="rounded bg-[#ff2850] border-2 border-[#ff2850]  p-2">
                            <a href="/my-little-mvc/my-little-mvc/register.php">
                                Inscription
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>