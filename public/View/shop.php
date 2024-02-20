<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Shop - Page <?= $page ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php require_once __DIR__ . './import/header.php'; ?>
<main>
    <div class="pt-20 w-full flex justify-center py-4">
        <h1 class="text-3xl">Products</h1>
    </div>
    <section class="flex justify-center pt-20">
        <div class="w-[80vw] h-full flex flex-col justify-center items-center p-2">
            <div class="flex justify-around flex-wrap">
                <?php foreach ($getProductPage as $product): ?>
                    <article class="w-1/4 h-1/4 p-4 border border rounded-lg border-b-3 m-2 bg-[#F8F8F8]">
                        <?php $photos = $product->getPhotos(); ?>
                        <div class="flex flex-col items-center">
                            <img src="<?php echo $photos[0]; ?>" alt="<?php echo $product->getName(); ?>"
                                 class="w-full h-48 rounded-lg object-cover">
                            <div class="flex flex-col">
                                <h2 class="text-xl"><?php echo $product->getName(); ?></h2>
                                <p class="text-2xl"><?php echo $product->getPrice(); ?> €</p>
                                <p class="text-sm">Quantité: <?php echo $product->getQuantity(); ?></p>
                                <button class="bg-red-100 rounded p-1">
                                    <a href="/my-little-mvc/product.php?id_product=<?php echo $product->getId(); ?>">
                                        Voir le produit
                                    </a>
                                </button>
                                <form action="" method="post">
                                    <input type="hidden" name="id_product" value="<?php echo $product->getId(); ?>">
                                    <input type="submit" name="submit" value="Add" class="bg-red-300 rounded p-3">
                                </form>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <div class="w-screen flex justify-around pt-2">
                <a href="/my-little-mvc/shop/<?php echo $page - 1; ?>" class="bg-red-100 rounded p-2">
                    Page précédente
                </a>
                <p><?php echo $page; ?></p>
                <a href="/my-little-mvc/shop/<?php echo $page + 1; ?>" class="bg-red-100 rounded p-2">
                    Page suivante
                </a>
            </div>
        </div>
    </section>

</main>
</body>
</html>