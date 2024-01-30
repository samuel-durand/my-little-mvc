<?php

namespace App\Model;
use PDO;


class DataBaseConnection
{

    public function __construct() {
        $this->getConnexion();
    }

    public function getConnexion(): PDO
    {
        $pdo = new PDO('mysql:host=localhost;dbname=draft-shop;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}