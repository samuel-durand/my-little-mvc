<?php

require 'vendor/autoload.php';

use App\Model\Abstract\AbstractProduct;
use App\Model\Clothing;
use App\Model\Electronic;
use App\Model\Category;

$electronic = new Electronic();
$clothing = new Clothing();

if (isset($_GET['id_product'])){

    $id_product = intval($_GET['id_product']);
    $electronic = $electronic->findOneById($id_product);
    $clothing = $clothing->findOneById($id_product);

    if ($electronic){
        var_dump($electronic);
    }
    else if ($clothing){
        var_dump($clothing);
    }
    else {
        echo "Produit introuvable";
    }
}