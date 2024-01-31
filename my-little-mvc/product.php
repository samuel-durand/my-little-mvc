<?php
require_once 'vendor/autoload.php';
use App\Model\Clothing;
use App\Model\Electronic;

/* recupere les parametre de l'url */

$url_idProduct = intval($_GET['id_product']) ?? null;

/* recupere le produit */


if ($url_idProduct !== null) {
    $clothing = new Clothing();
    $electronic = new Electronic();
    if ($clothing->findOneById($url_idProduct) !== false) {
        $products = $clothing->findOneById($url_idProduct);
    } elseif ($electronic->findOneById($url_idProduct) !== false) {
        $products = $electronic->findOneById($url_idProduct);
    } else {
        throw new Exception('Product not found');
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Shop - Product</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php if ($url_idProduct !== null): ?>
    <body>
    <h1>Product</h1>
    <div>
        <h2><?php echo $products->getName(); ?></h2>
        <p><?php echo $products->getDescription(); ?></p>
        <p>Price: <?php echo $products->getPrice(); ?></p>
        <p>Quantity: <?php echo $products->getQuantity(); ?></p>
    </div>
    </body>
<?php else: ?>
    <body>
    <h1>Product not found</h1>
    </body>
<?php endif; ?>
</html>

