<?php

require_once 'vendor/autoload.php';
session_start();
use App\Controller\Renderer;
$router = new AltoRouter();

$router->setBasePath('/my-little-mvc');

require_once 'config/routes.php';

$match = $router->match();

if (is_array($match)) {
    $render = new Renderer();
    $render->processRoute($match);
} else {
    require_once 'public/View/404.php';
}
