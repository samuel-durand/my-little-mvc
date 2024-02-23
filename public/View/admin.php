<?php
$pageTitle = 'Admin';
$pageDescription = 'Bienvenue sur votre espace administrateur';

use App\Controller\AdminController;
$adminController = new AdminController();
if ($adminController->isAdmin()) {
    $javascript = '<script defer src="public/scripts/scripts.js"></script>';
    ?>
<main>
    <section class="w-screen h-screen flex justify-center items-strech pt-20">
        <div class="flex flex-col">
            <div class="h-fit">
                <h1 class="text-6xl font-semibold text-[#7B41F9]">Bienvenue sur votre espace administrateur</h1>
                <article class="flex justify-center items-center gap-4 py-4">
                    <button id="btnUser" class="bg-[#7B41F9] text-white p-2 rounded-lg">Utilisateurs</button>
                    <button id="btnProduct" class="bg-[#7B41F9] text-white p-2 rounded-lg">Produits</button>
                </article>
            </div>
            <div id="messageNotif" class="h-6"></div>
            <div id="containerFormEdit"></div>
            <div id="formEditUser"></div>
            <div class="w-full">
                <div id="userList" class="flex justify-center"></div>
            </div>
            <div class="w-full">
                <div id="productList" class="flex justify-center"></div>
            </div>
        </div>
    </section>
</main>
<?php
} else {
    header('Location: /my-little-mvc/');
}
?>