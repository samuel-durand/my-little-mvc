<?php
require_once 'vendor/autoload.php';
use src\Model\Electronic;

$product = new Electronic();

var_dump($product->findAll());

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des produits</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Photos</th>
                <th>Price</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Category Id</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Brand</th>
                <th>Waranty Fee</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($product->findAll() as $product) : ?>
                <tr>
                    <td><?= $product->getName() ?></td>
                    <td><?= $product->getphotos(["photo"]) ?></td>
                    <td><?= $product->getPrice() ?></td>
                    <td><?= $product->getDescription() ?></td>
                    <td><?= $product->getQuantity() ?></td>
                    <td><?= $product->getCreatedAt()->format('Y-m-d H:i:s') ?></td>
                    <td><?= $product->getUpdatedAt()->format('Y-m-d H:i:s') ?></td>
                    <td><?= $product->getCategoryid() ?></td>

                    <td><?= $product->getBrand() ?></td>
                    <td><?= $product->getWarantyFee() ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</body>
</html>