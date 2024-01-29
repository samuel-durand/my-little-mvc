<?php

require_once 'vendor/autoload.php';

use App\Model\Clothing;

$category = new Clothing();
$category->setName('T-shirt');
var_dump($category);




