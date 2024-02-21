


<DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="public/scripts/scripts.js"></script>
    <link rel="stylesheet" href="public/styles/styles.css">
    <title>E-SHOP - Admin</title>
</head>
<body>

<?php require_once __DIR__ . '/import/header.php';?>

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
</body>
</html>