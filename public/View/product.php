<?php
$pageTitle = 'Produits';
$pageDescription = 'Découvrez nos produits';
?>
    <?php if ($id_product !== null): ?>
        <main class="h-screen w-screen">
            <section class="w-screen h-screen flex justify-center items-center">
                <div class="flex">
                <?php $photos = $products->getPhotos();?>
                    <div>
                        <img src="<?php echo $photos[0]; ?>" alt="<?php echo $products->getName(); ?>" class="w-full h-48 rounded-lg object-cover">
                    </div>
                    <div>
                        <h2 class="text-4xl"><?php echo $products->getName(); ?></h2>
                        <p><?php echo $products->getDescription(); ?></p>
                        <p class="text-xl"><?php echo $products->getPrice(); ?> €</p>
                        <p>Quantity: <?php echo $products->getQuantity(); ?></p>
                        <form action="" method="post" class="flex flex-col gap-2">
                            <input type="number" name="quantity" id="quantity" placeholder="quantity" min="1" value="1" class="border p-2 rounded-lg">
                            <input type="submit" name="submit" value="Ajouter au panier" class="bg-red-100 rounded-lg">
                        </form>
                    </div>
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


