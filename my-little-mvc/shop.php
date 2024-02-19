<?php
    require 'vendor/autoload.php';
    use App\Model\Abstract\AbstractProduct;
    use App\Model\Clothing;
    use App\Model\Electronic;
    use App\Model\Category;
    use App\Model\Product;
    use App\Controller\ShopController;

    $clothing = new Clothing();
    $clothings = $clothing->findAll();

    $electronic = new Electronic();
    $electronics = $electronic->findAll();

    $shopController = new ShopController();
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    $result = $shopController->index($page);

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
            <?php foreach ($clothings as $clothing): ?>
                <tr>
                    <td><?= $clothing->getName(); ?></td>
                    <td><?= $clothing->getDescription(); ?></td>
                    <td><?= $clothing->getPrice(); ?>€</td>
                    <td><?= $clothing->getQuantity(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tbody>
            <?php foreach ($electronics as $electronic): ?>
                <tr>
                    <td><?= $electronic->getName(); ?></td>
                    <td><?= $electronic->getDescription(); ?></td>
                    <td><?= $electronic->getPrice(); ?>€</td>
                    <td><?= $electronic->getQuantity(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>