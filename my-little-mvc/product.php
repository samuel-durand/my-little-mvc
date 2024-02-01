<?php
require_once 'vendor/autoload.php';

session_start();

use App\Controller\ShopController;


/* recupére les parametre de l'url */

$url_idProduct = intval($_GET['id_product']) ?? null;

/* recupére le produit */
if ($url_idProduct !== null) {
    $shopController = new ShopController();
    $products = $shopController->showProduct($url_idProduct);
}

if (isset($_POST['submit'])) {
    $user = $_SESSION['user'];
    $cartController = new ShopController();
    $cartController->addProductToCart($url_idProduct, intval($_POST['quantity']), $user->getId());
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Shop - Product</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php require_once 'import/header.php'; ?>
<?php if ($url_idProduct !== null): ?>
    <body>
    <h1>Product</h1>
    <div>
        <h2><?php echo $products->getName(); ?></h2>
        <p><?php echo $products->getDescription(); ?></p>
        <p>Price: <?php echo $products->getPrice(); ?></p>
        <p>Quantity: <?php echo $products->getQuantity(); ?></p>
        <form action="" method="post">
            <input type="number" name="quantity" id="quantity" placeholder="quantity" min="1" value="1">
            <input type="submit" name="submit" value="Ajouter au panier">
        </form>
    </div>
    </body>
<?php else: ?>
    <body>
    <h1>Product not found</h1>
    </body>
<?php endif; ?>
</html>

