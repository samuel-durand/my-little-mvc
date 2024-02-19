<?php

require_once 'vendor/autoload.php';
session_start();

use App\Controller\AuthenticationController;

$router = new AltoRouter();
$auth = new AuthenticationController();

$router->setBasePath('/my-little-mvc');

$router->map('GET', '/', function () {
    require 'public/View/home.php';
});

$router->map('GET', '/shop', function () {
    require 'public/View/shop.php';
});

$router->map('GET', '/login', function () {
    require 'public/View/login.php';
}, 'login');

$router->map('POST', '/login', function () use ($auth) {
    $reg = $auth->login($_POST['email'], $_POST['password']);
    $message = $reg;
    require 'public/View/login.php';
}, 'login_submit');

$router->map('GET', '/blogs', function () {
    echo 'Blogs';
});

$match = $router->match();

if ($match) {
    call_user_func_array($match['target'], $match['params']);
} else {
    require_once 'public/View/404.php';
}

?>






