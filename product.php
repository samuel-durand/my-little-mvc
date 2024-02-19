<?php
require_once 'vendor/autoload.php';
session_start();

use App\Controller\ShopController;


/* get url params in get */

$url_idProduct = intval($_GET['id_product']) ?? null;

/* get product */
if ($url_idProduct !== null) {
    $shopController = new ShopController();
    $products = $shopController->showProduct($url_idProduct);
    if ($products === null) {
        header('Location: /my-little-mvc/shop.php');
    }
};

/* add product to cart */
if (isset($_POST['submit'])) {
    $user = $_SESSION['user'];
    $cartController = new ShopController();
    $cartController->addProductToCart($url_idProduct, intval($_POST['quantity']), $user->getId());
}
var_dump($_SESSION['products']);

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
    <main class="h-screen w-screen pt-20">
        <section>
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
        </section>
    </main>
<?php else: ?>
    <body>
    <h1>Product not found</h1>
    </body>
<?php endif; ?>
</html>

