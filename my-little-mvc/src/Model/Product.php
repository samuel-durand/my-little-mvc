<?php

namespace App\Model;
require 'vendor/autoload.php';

use App\Model\Abstract\AbstractProduct;

class Product extends AbstractProduct {

    public function findPaginated($page) {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');

        $statement = $pdo->prepare('SELECT * FROM product LIMIT 10 OFFSET :offset');
        $statement->bindValue(':offset', $page, \PDO::PARAM_INT);
        $statement->execute();

        $products = $statement->fetchAll(\PDO::FETCH_ASSOC);
        
        return $products;
    }
}