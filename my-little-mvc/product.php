<?php
require_once 'vendor/autoload.php';
use App\Model\Clothing;
use App\Model\Electronic;

/* recupere les parametre de l'url */

$url_idProduct = $GET['id_product'] ?? null;
$url_product_type = $GET['product_type'] ?? null;

if ($url_idProduct !== null && intval($url_idProduct) && $url_product_type !== null) {
    if ($url_product_type === 'clothing') {
        $product = new Clothing();
    } elseif ($url_product_type === 'electronic') {
        $product = new Electronic();
    } else {
        throw new Exception('Product type not found');
    }
}