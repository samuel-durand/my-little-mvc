<?php

use App\Controller\ShopController;

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../style.css">
    <script defer src="../scripts/cart.js"></script>
    <title>Shop - Cart <?=$page?></title>
    <?php var_dump($_SESSION['products']) ?>
</head>
<body>
<?php require_once __DIR__ . '/import/header.php'; ?>
<main class="pt-20">
    <section class="w-screen h-fit flex justify-center items-center">
        <h1 class="text-6xl font-semibold text-[#7B41F9]">Bienvenue sur votre panier</h1>
    </section>
    <?php if (!isset($_SESSION['products'])): ?>
        <section class="w-screen h-screen flex justify-center items-center">
            <p>Votre panier est vide.</p>
        </section>
    <?php else: ?>
        <section class="w-screen h-[60vh] flex justify-center items-center">
            <div class="flex flex-col">
                <table class="border p-2">
                    <thead class="border p-2">
                    <tr class="border p-2">
                        <th class="text-center p-2">Nom</th>
                        <th class="text-center p-2">Prix</th>
                        <th class="text-center p-2">Quantité</th>
                        <th class="text-center p-2">Total</th>
                        <th class="text-center p-2">Date d'ajout</th>
                        <th class="text-center p-2">Supprimer</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $idCart = $_SESSION['cart']->getId();
                    $total = 0;
                    $shopController = new ShopController();
                    foreach ($getCartPage as $product) {
                    $idProduct = $product->getProductId();
                    $productDetail = $shopController->showProduct($idProduct);
                    $price = $productDetail->getPrice();
                    $quantity = $product->getQuantity();
                    $total += $price * $quantity;
                    $created_at = $product->getcreated_at()->format('d-m-Y H:m:s');
                    ?>
                    <tr>
                        <td class="text-center p-2 border"> <?= $productDetail->getName() ?></td>
                        <td class="text-center p-2"><?= $price ?>€</td>
                        <td class="text-center p-2 border">
                            <form action="/my-little-mvc/cart/update/<?php echo $idProduct ?>/<?php echo $idCart ?>" method="post">
                                <input type="number" name="quantity" id="quantity" placeholder="quantity" min="1"
                                       class="p-2"
                                       value="<?php echo $quantity; ?>">
                                <input type="hidden" name="id_product" value="<?php echo $idProduct; ?>">
                                <input type="hidden" name="id_cart" value="<?php echo $idCart; ?>">
                                <input type="submit" name="update" value="Update" class="p-2 text-white bg-green-400">
                            </form>
                        </td>
                        <td class="text-center p-2 border">
                            <?= $price * $quantity ?>€
                        </td>
                        <td><?php echo $created_at ?></td>
                        <td class="text-center porder p-2">
                            <form action="/my-little-mvc/cart/delete/<?php echo $idProduct; ?>" method="post" id="delete-product-form">
                                <input type="hidden" name="id_product" value="<?php echo $idProduct; ?>">
                                <input type="submit" name="remove" value="Supprimer" class="p-2 text-white bg-red-500">
                            </form>
                        </td>
                        <?php

                        echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <p>Total: <?php echo $total; ?>€</p>
            </div>

        </section>
    <?php endif; ?>
    <div class="w-screen flex justify-around pt-2">
            <a href="/my-little-mvc/cart/<?php echo $page - 1; ?>" class="bg-red-100 rounded p-2">
                Page précédente
            </a>
            <p><?php echo $page; ?></p>
            <?php if (!$getCartPage) {
                $page = 1;
            } 
            ?>
            <a href="/my-little-mvc/cart/<?php echo $page + 1; ?>" class="bg-red-100 rounded p-2">
                Page suivante
            </a>
    </div>
    <section class="w-screen h-fit flex justify-center items-center">
        <a href="/my-little-mvc/shop/1" class="text-white bg-[#7B41F9] p-2 rounded-md">Retour à la boutique</a>
    </section>
</main>
</body>
</html>