<?php
require_once 'vendor/autoload.php';
use App\Model\Electronic;

$product = new Electronic();

var_dump($product->findAll());


