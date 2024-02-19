<?php

namespace App\Model;
require 'vendor/autoload.php';

use App\Model\Abstract\AbstractProduct;

class Product extends AbstractProduct {

    public function findPaginated($page): array {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
        $offset = ($page - 1) * 10;

        $statement = $pdo->prepare('SELECT * FROM product LIMIT 10 OFFSET :offset');
        $statement->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $statement->execute();

        $products = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $products;
    }
}