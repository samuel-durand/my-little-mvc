
<?php

use App\Controller\AuthenticationController;
$authController = new AuthenticationController();
?>


<header>
    <nav>
        <ul>
            <li><a href="../shop.php">Accueil</a></li>
            <?php if ($authController->isLogged()) : ?>
                <li><a href="../profile.php">Profil</a></li>
                <li><a href="../logout.php">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="../login.php">Connexion</a></li>
                <li><a href="../register.php"></a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>