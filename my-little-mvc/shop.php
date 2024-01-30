<?php
    require 'vendor/autoload.php';
    use App\Model\Abstract\AbstractProduct;
    use App\Model\Electronic;
    use App\Model\Category;

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
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Marque</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($electronics as $product): ?>
                <tr>
                    <td><?php echo $product->getName(); ?></td>
                    <td><?php echo $product->getPrice(); ?></td>
                    <td><?php echo $product->getQuantity(); ?></td>
                    <td><?php echo $product->getBrand(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>