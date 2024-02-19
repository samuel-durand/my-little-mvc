<?php
    require 'vendor/autoload.php';
    use App\Model\Abstract\AbstractProduct;
    use App\Model\Clothing;
    use App\Model\Electronic;
    use App\Model\Category;
    use App\Model\Product;
    use App\Controller\ShopController;

    $Clothing = new Clothing();
    $Clothings = $Clothing->findAll();

    $electronic = new Electronic();
    $electronics = $electronic->findAll();

    $product = new Product();
    $products = $product->findAll();

    $shopController = new ShopController();

    if (isset($_GET['page'])) {
        $page = intval($_GET['page']);

        if ($page < 1) {
            $page = 1;
        }
        $shopController->index($page);
        $products = $shopController->index($page);
    } else {
        $page = 1;
        $shopController->index($page);
        $products = $shopController->index($page);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="src/CSS/shop.css">
</head>
<body>
    <div class="link">
        <button><a href="profile.php">Profil</a></button>
    </div>
    <h1>Produits</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Quantité</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (empty($products)) {
                echo '<tr><td colspan="4">Aucun produit</td></tr>';
            }
            foreach ($products as $product): 
            ?>
                <tr>
                    <td><?= $product['name']; ?></td>
                    <td><?= $product['description']; ?></td>
                    <td><?= $product['price']; ?>€</td>
                    <td><?= $product['quantity']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">
                    <a href="shop.php?page=<?= $page - 1; ?>">Précédent</a>
                    <a href="shop.php?page=<?= $page + 1; ?>">Suivant</a>
                </td>
            </tr>
        </tfoot>
    </table>
</body>
</html>