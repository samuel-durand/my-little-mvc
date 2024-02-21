<?php

use App\Controller\AdminController;
use App\Controller\AuthenticationController;

$adminController = new AdminController();
$authController = new AuthenticationController();

$user = $_SESSION['user'] ?? null;

$article = 0;
if (isset($_SESSION['products'])) {
    foreach ($_SESSION['products'] as $product) {
        $article += $product->getQuantity();
    }
}
?>

<header class="fixed top-0 left-0 right-0 lg: h-16 bg-[#F8F8F8]">
    <nav class="flex items-center py-2 px-4 border-b border-[#E4DFD9] h-full">
        <div class="flex justify-between items-center w-full">
            <div id="containerLogo" class="p-2">
                <a href='/my-little-mvc/'>
                    <h2 class="text-xl font-bold text-black">E-Shop</h2>
                </a>
            </div>
            <div id="containerLink" class="h-full flex items-center">
                <ul class="flex text-bold uppercase gap-x-2 font-medium items-center">
                    <li class="">
                        <a href="/my-little-mvc/shop">
                            Shop
                        </a>
                    </li>
                    <?php if ($authController->isLogged()): ?>
                        <li class="">
                            <a href="/my-little-mvc/profile">
                                <?=$user->getFullname();?>
                            </a>
                        </li>
                        <li>
                            <a href="/my-little-mvc/cart" class="flex items-center gap-x-0.5 ">
                                <span class="rounded-full bg-[#F8F8F8] px-2 py-1">
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
                                <span class="relative top-[12px] left-[-10px]"><?php echo $article; ?></span>
                            </a>
                        </li>
                        <li class="">
                            <a href="/my-little-mvc/logout">
                                Déconnexion
                            </a>
                            <?php if ($adminController->isAdmin()): ?>
                                <li class="">
                                    <a href="/my-little-mvc/admin">
                                        Admin
                                    </a>
                                </li>
                            <?php endif;?>
                        </li>
                    <?php else: ?>
                        <li class="">
                            <a href="/my-little-mvc/login">
                                Connexion
                            </a>
                        </li>
                        <li class="">
                            <a href="/my-little-mvc/register">
                                Inscription
                            </a>
                        </li>
                    <?php endif;?>
                </ul>
            </div>
        </div>
    </nav>
</header>