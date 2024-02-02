<?php
require_once 'vendor/autoload.php';

session_start();

use App\Model\Clothing;
use App\Model\Electronic;
use App\Controller\ShopController;

/* Récupération de tous les produits */

/*$clothing = new Clothing();
$allClothing = $clothing->findAll();

$electronic = new Electronic();
$allElectronics = $electronic->findAll();
$allProducts = array_merge($allClothing, $allElectronics);*/

$shopController = new ShopController();

if (isset($_GET['page'])) {
    $page = intval($_GET['page']);
    $getProductPage = $shopController->index($page);
} else {
    $page = 1;
    $getProductPage = $shopController->index($page);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<?php require_once 'import/header.php'; ?>

<main class="px-8 pt-20">
    <div class="w-full flex justify-between pt-2">
        <a href="/my-little-mvc/my-little-mvc/shop.php?page=<?php echo $page - 1; ?>" class="bg-red-100 rounded p-0.5">
            Page précédente
        </a>
        <a href="/my-little-mvc/my-little-mvc/shop.php?page=<?php echo $page + 1; ?>" class="bg-red-100 rounded p-0.5">
            Page suivante
        </a>
    </div>
    <div class="w-full flex justify-center py-4">
        <h1 class="text-3xl">Products</h1>
    </div>
    <div class="flex flex-wrap">
        <?php /*foreach ($allProducts as $product): */?><!--
            <div>
                <h2><?php /*echo $product->getName(); */?></h2>
                <p><?php /*echo $product->getDescription(); */?></p>
                <p>Price: <?php /*echo $product->getPrice(); */?></p>
                <p>Quantity: <?php /*echo $product->getQuantity(); */?></p>
            </div>
        --><?php /*endforeach; */?>
        <?php foreach ($getProductPage as $product): ?>
            <div class="w-1/4 p-4">
                <h2 class="text-xl"><?php echo $product->getName(); ?></h2>
                <p class="text-sm"><?php echo $product->getId(); ?></p>
                <p class="text-sm"><?php echo $product->getDescription(); ?></p>
                <p class="text-sm">Price: <?php echo $product->getPrice(); ?></p>
                <p class="text-sm">Quantity: <?php echo $product->getQuantity(); ?></p>
                <button class="bg-red-100 rounded p-0.5">
                    <a href="/my-little-mvc/my-little-mvc/product.php?id_product=<?php echo $product->getId();?>">
                        Voir le produit
                    </a>
                </button>
                <form action="" method="post">
                    <input type="hidden" name="id_product" value="<?php echo $product->getId(); ?>">
                    <input type="submit" name="submit" value="Add to cart" class="bg-red-100 rounded p-0.5">
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</main>

</body>
</html>