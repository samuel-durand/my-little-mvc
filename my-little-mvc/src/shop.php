<?php
    require 'Model/Abstract/AbstractProduct.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
</head>
<body>
    <?php
        $product = new AbstractProduct;
        var_dump($product->findAll());
    ?>
</body>
</html>