<?php

namespace App\Controller;
use App\Model\Product;
use App\Model\Clothing;
use App\Model\Electronic;
class ShopController
{
    public function index(int $page): array
    {
        $productModel = new Product();
        return $productModel->findPaginated($page);
    }
    public function showProduct(int $id) : Clothing|Electronic|false
    {
        $auth = new AuthenticationController();

        if ($auth->isLogged()) {
            $clothing = new Clothing();
            $electronic = new Electronic();
            if ($clothing->findOneById($id) !== false) {
                $products = $clothing->findOneById($id);
            } elseif ($electronic->findOneById($id) !== false) {
                $products = $electronic->findOneById($id);
            } else {
                header('Location: /login');
            }
        }
        return $products;
    }
    public function addProductToCart(int $productId, int $quantity, int $user_id): void
    {
        var_dump($productId, $quantity, $user_id);
    }
}