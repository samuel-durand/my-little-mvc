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
        <section class="flex justify-between h-1/2 w-4/6 rounded-lg bg-[#F6F6F6]">
            <div class="w-1/2 text-white p-4">
                <h2 class="text-6xl font-semibold text-[#7B41F9]">Inscription</h2>
                <div class="pt-3 text-black">
                    <p>Rejoignez-nous et profitez de nos offres</p>
                </div>
            </div>
            <div class="w-1/2 h-full">
                <form action="" method="post" class="flex flex-col justify-around h-full px-4">
                    <div class="flex flex-col items-start gap-y-1">
                        <label for="fullname" class="font-semibold text-xl">Nom complet</label>
                        <input type="text" name="fullname" id="fullname" placeholder="fullname" class="p-2 w-full rounded border border-[#7B41F9]">
                        <p><?php echo $message['fullname'] ?? ''; ?></p>
                    </div>
                    <div class="flex flex-col items-start gap-y-1">
                        <label for="email" class="font-semibold text-xl">Email</label>
                        <input type="email" name="email" id="email" placeholder="email" class="p-2 w-full rounded border border-[#7B41F9]">
                        <p><?php echo $message['email'] ?? ''; ?></p>
                    </div>
                    <div class="flex flex-col items-start gap-y-1">
                        <label for="password" class="font-semibold text-xl">Mot de passe</label>
                        <input type="password" name="password" id="password" placeholder="password" class="p-2 w-full rounded border border-[#7B41F9]">
                        <p><?php echo $message['password'] ?? ''; ?></p>
                    </div>
                    <div id="message">
                        <?php echo $message['success'] ?? ''; ?>
                    </div>
                    <div class="text-center">
                        <p>Vous avez déjà un compte ? <a href="/my-little-mvc/my-little-mvc/login.php" class="text-[#7B41F9]">Connectez-vous</a></p>
                    </div>
                    <div>
                        <input type="submit" value="S'inscrire" name="submit"
                                class="p-2 w-full bg-[#7B41F9] text-white text-xl rounded">
                    </div>
                </form>
            </div>
        </section>
    </article>
</main>
</body>
</html>
