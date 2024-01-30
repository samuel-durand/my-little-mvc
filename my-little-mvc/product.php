<?php
require_once 'vendor/autoload.php';
use App\Model\Clothing;
use App\Model\Electronic;

/* recupere les parametre de l'url */

$url_idProduct = intval($_GET['id_product']) ?? null;
$url_product_type = $_GET['product_type'] ?? null;

/* recupere le produit */
$defineProduct = null;

if ($url_idProduct !== null && $url_product_type !== null) {
    if ($url_product_type == 'clothing') {
        $defineProduct = true;
        $product = new Clothing();
        $products = $product->findOneById($url_idProduct);
    } elseif ($url_product_type == 'electronic') {
        $defineProduct = false;
        $product = new Electronic();
        $products = $product->findOneById($url_idProduct);
    } else {
        throw new Exception('Product type not found');
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
<?php if ($url_idProduct !== null && $url_product_type !== null): ?>
    <body>
    <h1>Product</h1>
    <?php if ($defineProduct): ?>
        <h2>Clothing</h2>
    <?php else: ?>
        <h2>Electronic</h2>
    <?php endif; ?>
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
