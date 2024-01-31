<?php

namespace App\Controller;
use App\Model\Product;
use App\Controller\AuthenticationController;
class ShopController
{
    public function index(int $page): array
    {
        $productModel = new Product();
        return $productModel->findPaginated($page);
    }
    public function showProduct(int $id)
    {
        $auth = new AuthenticationController();

        if ($auth->isLogged()) {
            $productModel = new Product();
            return $productModel->findOneById($id);
        } else {
            header('Location: /login');
        }
    }
}