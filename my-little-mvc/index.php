<?php

require_once __DIR__ . '/vendor/autoload.php';

use src\Controller\AuthenticationController;
$auth = new AuthenticationController();

$router = new AltoRouter();

$router->setBasePath('/my-little-mcv/');

$router->map( 'GET', '/test', function() {
    require __DIR__ . '../my-little-mvc/index.php';
});




$router->map( 'POST', '/register', function() {
    $auth = new AuthenticationController();
    $auth->register();
    require __DIR__ . '../my-little-mvc/register.php';
}, 'register');

$router->map( 'POST', '/login', function() {
    $auth = new AuthenticationController();
    $auth->login();
    require __DIR__ . '../my-little-mvc/login.php';
},'login');

$router->map( 'GET', '/profile', function() {
    $auth = new AuthenticationController();
    $auth->profile();
    require __DIR__ . '../my-little-mvc/profile.php';
},'profile');




















