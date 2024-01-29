<?php
require_once 'vendor/autoload.php';
use App\Model\Clothing;
use App\Model\Electronic;

/* Récupération de tous les produits */

$clothing = new Clothing();
$allClothing = $clothing->findAll();

$electronic = new Electronic();
$allElectronics = $electronic->findAll();


$allProducts = array_merge($allClothing, $allElectronics);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h1>Products</h1>
<?php foreach ($allProducts as $product): ?>
    <div>
        <h2><?php echo $product->getName(); ?></h2>
        <p><?php echo $product->getDescription(); ?></p>
        <p>Price: <?php echo $product->getPrice(); ?></p>
        <p>Quantity: <?php echo $product->getQuantity(); ?></p>
    </div>
<?php endforeach; ?>
</body>
</html>