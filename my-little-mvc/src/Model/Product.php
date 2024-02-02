<?php

namespace App\Model;

use App\Model\Abstract\AbstractProduct;

class Product extends AbstractProduct {
    private $product;

    public function __construct() {
        $this->product = new Product();
    }
}