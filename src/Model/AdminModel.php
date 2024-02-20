<?php

namespace App\Model;

use PDO;

class AdminModel
{
    public function __construct(
        protected ?PDO $pdo = null
    ) {
    }
    public function getPdo(): \PDO
    {
        $this->pdo = $this->pdo ?? (new DatabaseConnexion())->getConnexion();
        return $this->pdo;
    }
    public function getProducts(): array
    {
        $query = $this->getPdo()->prepare('SELECT * FROM product');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUser(): array
    {
        $query = $this->getPdo()->prepare('SELECT * FROM user');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
