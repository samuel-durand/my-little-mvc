<?php
use App\Controller\AdminController;
use App\Controller\AuthenticationController;
use App\Controller\ShopController;

$auth = new AuthenticationController();

$router->map('GET', '/', null, 'home');

$router->map('GET', '/login', null, 'login');

$router->map('POST', '/login', function () use ($auth) {
    $message = $auth->login($_POST['email'], $_POST['password']);
    require_once 'public/View/login.php';
}, 'login_submit');

$router->map('GET', '/register', null, 'register');

$router->map('POST', '/register', function () use ($auth) {
    $message = $auth->register($_POST['email'], $_POST['password'], $_POST['fullname']);
    require_once 'public/View/register.php';
}, 'register_submit');

$router->map('GET', '/logout', function () use ($auth) {
    $auth->logout();
    header('Location: /my-little-mvc/');
}, 'logout');

$router->map('GET', '/profile', target: function () use ($auth) {
    if ($auth->isLogged() === false) {
        header('Location: /my-little-mvc/login');
        exit();
    }
}, name: 'profile');

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

$router->map('GET', '/admin', null, 'admin');

$router->map('GET', '/admin/products', function () {
    $adminController = new AdminController();
    if ($adminController->isAdmin()) {
        $adminController->showProducts();
        exit();
    } else {
        header('Location: /my-little-mvc/');
    }
}, 'admin_products');

$router->map('POST', '/admin/products/delete/[i:id_product]', function ($id_product) {
    $adminController = new AdminController();
    if ($adminController->isAdmin()) {
        $adminController->deleteProduct($id_product);
    }
    exit();
}, 'admin_products_delete');

$router->map('POST', '/admin/product/edit/[i:id_product]', function ($id_product) {
    $adminController = new AdminController();
    if ($adminController->isAdmin()) {
        $adminController->updateProduct($id_product);
    }
    exit();
}, 'admin_products_edit');

$router->map('GET', '/admin/users', function () {
    $adminController = new AdminController();
    if ($adminController->isAdmin()) {
        $adminController->showUser();
        exit();
    } else {
        header('Location: /my-little-mvc/');
    }
}, 'admin_users');

$router->map('POST', '/admin/users/delete/[i:id]', function ($id) {
    $adminController = new AdminController();
    if ($adminController->isAdmin()) {
        $adminController->deleteUserS($id);
    }
    exit();
}, 'admin_delete_user');

$router->map('POST', '/admin/users/edit/[i:id]', function ($id, ) {
    $adminController = new AdminController();
    if ($adminController->isAdmin()) {
        $adminController->updateUser($id);
    }
    exit();
}, 'admin_edit_user');
