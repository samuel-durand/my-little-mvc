<?php
require_once 'vendor/autoload.php';
session_start();

use App\Controller\ShopController;

if (isset($_POST['remove'])) {
    $idProduct = $_POST['id_product'];
    $shopController = new ShopController();
    $shopController->removeProductFromCart($idProduct);
}

if (isset($_POST['update'])) {
    $idProduct = $_POST['id_product'];
    $quantity = $_POST['quantity'];
    $shopController = new ShopController();
    $shopController->updateProductInCart($idProduct, $quantity);
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <script defer src="public/scripts/cart.js"></script>
    <title>Shop - Cart</title>
</head>
<body>
<?php require_once 'import/header.php'; ?>
<main class="pt-20">
    <h1>Cart</h1>
    <?php if (!isset($_SESSION['products'])): ?>
        <section class="w-screen h-screen flex justify-center items-center">
            <p>Votre panier est vide.</p>
        </section>
    <?php else: ?>
        <section class="w-screen h-screen flex justify-center items-center">
            <h2>Products</h2>
            <table>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Remove</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $total = 0;
                $shopController = new ShopController();
                foreach ($_SESSION['products'] as $product) {
                    $idProduct = $product->getProductId();
                    $productDetail = $shopController->showProduct($idProduct);
                    $price = $productDetail->getPrice();
                    $quantity = $product->getQuantity();
                    $total += $price * $quantity;
                    echo '<tr>';
                    echo '<td>' . $productDetail->getName() . '</td>';
                    echo '<td>' . $price . '</td>'; ?>
                    <td>
                        <form action="" method="post">
                            <input type="number" name="quantity" id="quantity" placeholder="quantity" min="1"
                                   value="<?php echo $quantity; ?>">
                            <input type="hidden" name="id_product" value="<?php echo $idProduct; ?>">
                            <input type="submit" name="update" value="Update">
                        </form>
                    </td>
                    <?php
                    echo '<td>' . $price * $quantity . '</td>'; ?>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="id_product" value="<?php echo $idProduct; ?>">
                            <input type="submit" name="remove" value="Remove">
                        </form>
                    </td>
                    <?php

                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>
            <p>Total: <?php echo $total; ?></p>
        </section>
    <?php endif; ?>
</main>
</body>
</html>