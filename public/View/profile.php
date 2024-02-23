<?php
$pageTitle = 'Profil';
$pageDescription = 'Modifier votre profil';
?>

<main class="w-screen h-screen flex justify-center items-center">
        <?php if (!empty($user)): ?>
        <section class="flex justify-between h-1/2 w-4/6 rounded-lg bg-[#F6F6F6]">
            <div class="w-1/2 text-white p-4">
                <h2 class="text-6xl font-semibold text-[#7B41F9]">Profil</h2>
                <div class="pt-3 text-black">
                    <p>Modifiez vos informations</p>
                </div>
            </div>
            <div id="containerForm" class="w-1/2 h-full">
                <form action="" method="post" class="flex flex-col justify-around h-full px-4">
                    <div class="flex flex-col items-start gap-y-1">
                        <label for="fullname">Nom complet</label>
                        <input type="text" name="fullname" id="fullname" class="p-2 w-full rounded border border-[#7B41F9]" placeholder=<?php echo $user->getFullname(); ?> class="">
                        <p><?php echo $message['fullname'] ?? ''; ?></p>
                    </div>
                    <div class="flex flex-col items-start gap-y-1">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="p-2 w-full rounded border border-[#7B41F9]" placeholder=<?php echo $user->getEmail(); ?>>
                        <p><?php echo $message['email'] ?? ''; ?></p>
                    </div>
                    <div class="flex flex-col items-start gap-y-1">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password" class="p-2 w-full rounded border border-[#7B41F9]" placeholder="password">
                        <p><?php echo $message['password'] ?? ''; ?></p>
                    </div>
                    <div id="message">
                        <?php echo $message['success'] ?? ''; ?>
                    </div>
                    <input type="submit" value="submit" name="submit" class="p-2 w-full bg-[#7B41F9] text-white text-xl rounded">
                </form>
            </div>
        </section>
        <?php endif;?>
</main>

