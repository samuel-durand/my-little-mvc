<?php

namespace App\Controller;
use App\Model\Product;
use App\Model\Clothing;
use App\Model\Electronic;
use App\Model\Cart;
use App\Model\CartProduct;
class ShopController
{
    public function index(int $page): array
    {
        $productModel = new Product();
        return $productModel->findPaginated($page);
    }
    public function showProduct(int $id) : Clothing|Electronic|null
    {
        $auth = new AuthenticationController();

        if ($auth->isLogged()) {
            $clothing = new Clothing();
            $electronic = new Electronic();
            if ($clothing->findOneById($id) !== false) {
                $products = $clothing->findOneById($id);
                return $products;
            } elseif ($electronic->findOneById($id) !== false) {
                $products = $electronic->findOneById($id);
                return $products;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
    public function addProductToCart(int $productId, int $quantity, int $user_id): void
    {
        $product = new Product();
        $products = $product->findOneById($productId);


        $cartModel = new Cart();

        if ($cartModel->findOneByUserId($user_id) === false){
            $cartModel->setUserId($user_id);
            $cartModel->setTotal(0);
            $cartModel->setCreatedAt(new \DateTime());
            $cartModel->setUpdatedAt(null);
            $cart = $cartModel->create();

            // add product to cart_product and update cart total
            $cartProductModel = new CartProduct();
            $cartProductModel
                ->setCartId($cart->getId())
                ->setProductId($productId)
                ->setQuantity($quantity)
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(null)
                ->create();

            $cart->setTotal($quantity * $products->getPrice());
            $cart->update();
            // store cart object in session
            $_SESSION['cart'] = $cart;
            $_SESSION['products'] = [$cartProductModel];
        } else {
            $cart = $cartModel->findOneByUserId($user_id);
            $cartProductModel = new CartProduct();
            $findProduct = $cartProductModel->findOneById($cart->getId());

            if ($findProduct === false) {
                $cartProductModel
                    ->setCartId($cart->getId())
                    ->setProductId($productId)
                    ->setQuantity($quantity)
                    ->setCreatedAt(new \DateTime())
                    ->setUpdatedAt(null)
                    ->create();


                $cart->setTotal($quantity * $products->getPrice());
                $cart->update();
            } else {
                $findProduct->setQuantity($findProduct->getQuantity() + $quantity);
                $findProduct->update();
                $cart->setTotal($cart->getTotal() + ($quantity * $products->getPrice()));
                $cart->update();
            }
        }
    }
}