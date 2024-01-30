<?php
    require 'vendor/autoload.php';
    use App\Model\Abstract\AbstractProduct;
    use App\Model\Electronic;
    use App\Model\Category;

    require 'product.php';

    $electronic = new Electronic();
    $electronics = $electronic->findAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Marque</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($electronics as $product): ?>
                <tr>
                    <td><?= $product->getName(); ?></td>
                    <td><?= $product->getPrice(); ?>€</td>
                    <td><?= $product->getQuantity(); ?></td>
                    <td><?= $product->getBrand(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>