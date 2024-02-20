<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Shop - Product</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php require_once __DIR__ . './import/header.php';?>
<?php if ($id_product !== null): ?>
    <main class="h-screen w-screen pt-20">
        <section class="w-screen h-screen flex justify-center items-center">
            <div>
                <h2><?php echo $products->getName(); ?></h2>
                <p><?php echo $products->getDescription(); ?></p>
                <p>Price: <?php echo $products->getPrice(); ?></p>
                <p>Quantity: <?php echo $products->getQuantity(); ?></p>
                <form action="" method="post">
                    <input type="number" name="quantity" id="quantity" placeholder="quantity" min="1" value="1">
                    <input type="submit" name="submit" value="Ajouter au panier">
                </form>
            </div>
        </section>
    </main>
<?php else: ?>
    <main>
        <section class="w-screen h-screen flex justify-center items-center">
            <h1 class="text-6xl font-semibold text-[#7B41F9]">Aucun produit trouvé</h1>
        </section>
    </main>
<?php endif;?>
</html>

