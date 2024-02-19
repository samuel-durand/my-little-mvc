<?php

namespace App\Controller;
require 'vendor/autoload.php';

session_start();

use App\Model\Product;

class ShopController
{

    private $products;

    public function __construct()
    {
        $this->products = new Product();
    }

    public function index($page) {
        $this->products->findPaginated($page);
        return $this->products->findPaginated($page);
    }

}
