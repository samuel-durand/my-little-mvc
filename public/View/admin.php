<DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="../scripts/scripts.js"></script>
    <title>E-SHOP - Admin</title>
</head>
<body>

<?php require_once __DIR__ . '/import/header.php';?>

    <main>
        <section class="w-screen h-screen flex justify-center items-center">
            <div class="flex flex-col">
                <h1 class="text-6xl font-semibold text-[#7B41F9]">Bienvenue sur votre espace administrateur</h1>
                <article class="flex justify-center items-center gap-4">
                    <button id="btnUser" class="bg-[#7B41F9] text-white p-2 rounded-lg">Utilisateurs</button>
                    <button id="btnProduct" class="bg-[#7B41F9] text-white p-2 rounded-lg">Produits</button>
                </article>
                <div id="userList"></div>
                <div id="productList"></div>
            </div>

        </section>
    </main>

</body>
</html>