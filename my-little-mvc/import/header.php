<?php

use App\Controller\AuthenticationController;

$authController = new AuthenticationController();

$user = $_SESSION['user'] ?? null;

$article = 0;
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
                                <?= $user->getFullname(); ?>
                            </a>
                        </li>
                        <li>
                            <a href="/my-little-mvc/my-little-mvc/cart.php" class="flex items-center gap-x-0.5 rounded bg-[#ff2850] border-2 border-[#ff2850] p-2">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="icon icon-tabler icon-tabler-shopping-cart" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                      <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/>
                                      <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/>
                                      <path d="M17 17h-11v-14h-2"/>
                                      <path d="M6 5l14 1l-1 7h-13"/>
                                    </svg>
                                </span>
                                <span>Panier</span>
                                <span><?php echo '(' . $article . ')'; ?></span>
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