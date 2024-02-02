<?php
require_once 'vendor/autoload.php';
session_start();

use App\Controller\ShopController;
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Shop - Cart</title>
</head>
<body>
  <?php require_once 'import/header.php'; ?>
  <main>
    <h1>Cart</h1>
    <?php if (!isset($_SESSION['products'])): ?>
        <p>Your cart is empty</p>
    <?php else: ?>
    <div>
        <h2>Products</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                $shopController = new ShopController();
                foreach ($_SESSION['products'] as $product) {
                    $idProduct = $product->getId();
                    $productDetail = $shopController->showProduct($idProduct);
                    $price = $productDetail->getPrice();
                    $quantity = $product->getQuantity();
                    $total += $price * $quantity;
                    echo '<tr>';
                    echo '<td>' . $productDetail->getName() . '</td>';
                    echo '<td>' . $price . '</td>';
                    echo '<td>' . $quantity . '</td>';
                    echo '<td>' . $price * $quantity . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <p>Total: <?php echo $total; ?></p>
    </div>
    <?php endif; ?>
  </main>  
</body>
</html>