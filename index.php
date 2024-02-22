<?php

require_once 'vendor/autoload.php';
session_start();

use App\Controller\AuthenticationController;
use App\Controller\ShopController;
use App\Controller\AdminController;

$router = new AltoRouter();
$auth = new AuthenticationController();

$router->setBasePath('/my-little-mvc');

$router->map('GET', '/', function () {
    require 'public/View/home.php';
});

$router->map('GET', '/login', function () {
    require 'public/View/login.php';
}, 'login');

$router->map('POST', '/login', function () use ($auth) {
    $message = $auth->login($_POST['email'], $_POST['password']);
    require_once 'public/View/login.php';
}, 'login_submit');

$router->map('GET', '/register', function () {
    require 'public/View/register.php';
}, 'register');

$router->map('POST', '/register', function () use ($auth) {
    $message = $auth->register($_POST['email'], $_POST['password'], $_POST['fullname']);
    require_once 'public/View/register.php';
}, 'register_submit');

$router->map('GET', '/logout', function () use ($auth) {
    $auth->logout();
    header('Location: /my-little-mvc/');
}, 'logout');

$router->map('GET', '/profile', function () use ($auth) {
    if ($auth->isLogged() === false) {
        header('Location: /my-little-mvc/login');
        exit();
    }
    require_once 'public/View/profile.php';
}, 'profile');

$router->map('POST', '/profile', function () use ($auth) {
    if ($auth->isLogged() === false) {
        header('Location: /my-little-mvc/login');
        exit();
    }
    $message = $auth->update($_POST['email'], $_POST['password'], $_POST['fullname']);
    require_once 'public/View/profile.php';
}, 'profile_submit');

$router->map('GET', '/shop', function () {
    header('Location: /my-little-mvc/shop/1');
    exit();
}, 'shop_default');

$router->map('GET', '/shop/[i:page]', function ($page) {
    $shopController = new ShopController();
    if ($page < 1 || empty($page)) {
        $page = 1;
    }
    $getProductPage = $shopController->index($page);
    require_once 'public/View/shop.php';
}, 'shop');

$router->map('GET', '/product/[i:id_product]', function ($id_product) {
    $shopController = new ShopController();
    $products = $shopController->showProduct($id_product);
    if ($products === null) {
        header('Location: /my-little-mvc/shop');
    }
    require_once 'public/View/product.php';

}, 'product');

$router->map('POST', '/product/[i:id_product]', function ($id_product) {
    $auth = new AuthenticationController();
    if ($auth->isLogged() === false) {
        header('Location: /my-little-mvc/login');
        exit();
    }
    $user = $_SESSION['user'];
    $cartController = new ShopController();
    $cartController->addProductToCart($id_product, intval($_POST['quantity']), $user->getId());
    header('Location: /my-little-mvc/cart/1');
}, 'product_submit');

$router->map('GET', '/cart', function () {
    header('Location: /my-little-mvc/cart/1');
    require_once 'public/View/cart.php';
}, 'cart');

$router->map('POST', '/cart/delete/[i:id_product]', function ($id_product) {
    $auth = new AuthenticationController();
    if ($auth->isLogged() === false) {
        header('Location: /my-little-mvc/login');
        exit();
    }
    $cartController = new ShopController();
    $cartController->removeProductFromCart($id_product);
    header('Location: /my-little-mvc/cart');
}, 'cart_delete');

$router->map('POST', '/cart/update/[i:id_product]/[i:id_cart]', function ($id_product, $id_cart) {
    $auth = new AuthenticationController();
    if ($auth->isLogged() === false) {
        header('Location: /my-little-mvc/login');
    }
    $quantity = $_POST['quantity'];
    $shopController = new ShopController();
    $shopController->updateProductInCart($id_product, $quantity);
    header('Location: /my-little-mvc/cart');
}, 'update_product');

$router->map('GET', '/cart/[i:page]', function ($page) {
    $shopController = new ShopController();
    if ($page < 1 || empty($page)) {
        $page = 1;
    }
    $getCartPage = $shopController->findPaginatedCart($page);
    require_once 'public/View/cart.php';
}, 'cart_default');

$router->map('GET', '/admin', function () {
    $adminController = new AdminController();
    if ($adminController->isAdmin()) {
        $adminController->index();
    } else {
        header('Location: /my-little-mvc/');
    }
}, 'admin');

$match = $router->match();

if ($match) {
    call_user_func_array($match['target'], $match['params']);
} else {
    require_once 'public/View/404.php';
}
