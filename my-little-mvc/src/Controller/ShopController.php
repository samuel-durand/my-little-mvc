<?php

namespace App\Controller;

session_start();

class ShopController
{

    private $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function index(int $page) {
        $product->findPaginated($page);
    }

}