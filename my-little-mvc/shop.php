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

        $product = new AbstractProduct(1, 'name', ['photo1', 'photo2'], 100, 'description', 10, 1, new \DateTime(), new \DateTime());

    ?>
</body>
</html>