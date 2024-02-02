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
    /**
     * Displays a product.
     *
     * This function attempts to find a product by its ID. It first checks if the user is logged in.
     * If the user is logged in, it tries to find the product as a Clothing item, then as an Electronic item, and finally as a generic Product.
     * If the product is found, it is returned. If the product is not found or the user is not logged in, null is returned.
     *
     * @param int $id The ID of the product to display.
     * @return Clothing|Electronic|Product|null The found product or null if not found or user is not logged in.
     */
    public function showProduct(int $id) : Clothing|Electronic|Product|null
    {
        $auth = new AuthenticationController();

        if ($auth->isLogged()) {
            $clothing = new Clothing();
            $electronic = new Electronic();
            $product = new Product();
            if ($clothing->findOneById($id) !== false) {
                $products = $clothing->findOneById($id);
                return $products;
            } elseif ($electronic->findOneById($id) !== false) {
                $products = $electronic->findOneById($id);
                return $products;
            } else {
                $products = $product->findOneById($id);
                return $products;
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

        if ($cartModel->findOneByUserId($user_id) === false) {
            $cartModel->setUserId($user_id);
            $cartModel->setTotal(0);
            $cartModel->setcreated_at(new \DateTime());
            $cartModel->setupdated_at(null);
            $cart = $cartModel->create();

            // add product to cart_product and update cart total
            $cartProductModel = new CartProduct();
            $cartProductModel
                ->setCartId($cart->getId())
                ->setProductId($productId)
                ->setQuantity($quantity)
                ->setPrice($products->getPrice())
                ->setcreated_at(new \DateTime())
                ->setupdated_at(null)
                ->create();

            $cart->setTotal($quantity * $products->getPrice());
            $cart->update();
            // store cart object in session
            $_SESSION['cart'] = $cart;
            $_SESSION['products'][] = $cartProductModel;
        } else {
            $foundProduct = null;
            foreach ($_SESSION['products'] as $cartProduct) {
                if ($cartProduct->getProductId() == $productId) {
                    $foundProduct = $cartProduct;
                    break;
                }
            }
            if ($foundProduct !== null) {
                $foundProduct->setQuantity($foundProduct->getQuantity() + $quantity);
                $foundProduct->update();
                $cart = $_SESSION['cart'];
                $cart->setTotal($cart->getTotal() + ($quantity * $products->getPrice()));
                $cart->update();
            } else {
                $cartProductModel = new CartProduct();
                $cartProductModel
                    ->setCartId($_SESSION['cart']->getId())
                    ->setProductId($productId)
                    ->setQuantity($quantity)
                    ->setPrice($products->getPrice())
                    ->setcreated_at(new \DateTime())
                    ->setupdated_at(null)
                    ->create();

                $cart = $_SESSION['cart'];
                $cart->setTotal($cart->getTotal() + ($quantity * $products->getPrice()));
                $cart->update();
                $_SESSION['products'][] = $cartProductModel;
            }
        }
    }
    /**
     * Removes a product from the cart.
     *
     * This function attempts to find a product in the cart using the provided product_id.
     * If the product is found, it is deleted from the cart, the total price of the cart is updated,
     * and the cart is saved back to the session. If the product is not found, an error message is returned.
     *
     * @param int $product_id The ID of the product to remove from the cart.
     * @return array An associative array containing either a success message or an error message.
     */
    public function removeProductFromCart(int $product_id) : array
    {
        $errors = [];
        $cartProductModel = new CartProduct();
        $cartProduct = $cartProductModel->findOneById($product_id, $_SESSION['cart']->getId());

        if (!empty($cartProduct)) {
            if ($cartProduct->delete($product_id)) {
                $cart = $_SESSION['cart'];
                $cart->setTotal($cart->getTotal() - ($cartProduct->getQuantity() * $cartProduct->getPrice()));
                $cart->update();
                $_SESSION['cart'] = $cart;
                unset($_SESSION['products']);
                foreach ($cart->getCartProducts() as $product) {
                    $_SESSION['products'][] = $product;
                }
                $errors['success'] = 'Product removed from cart';
            } else {
                $errors['errors'] = 'An error occurred';
            }
        } else {
            $errors['errors'] = 'Product not found';
        }
        return $errors;
    }
}