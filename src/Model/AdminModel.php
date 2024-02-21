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
    public function getOneById(int $id): array
    {
        $query = $this->getPdo()->prepare('SELECT * FROM product WHERE id = :id');
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getProducts(): array
    {
        $query = $this->getPdo()->prepare('SELECT * FROM product');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteProduct(int $id): bool
    {
        $query = $this->getPdo()->prepare('DELETE FROM product WHERE id = :id');
        return $query->execute(['id' => $id]);
    }

    public function getUser(): array
    {
        $query = $this->getPdo()->prepare('SELECT * FROM user');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateProduct(int $id, string $name, string $description, int $price, int $quantity): bool
    {
        $query = $this->getPdo()->prepare('UPDATE product SET name = :name, description = :description, price = :price, quantity = :quantity, updated_at = NOW() WHERE id = :id');
        return $query->execute(['id' => $id, 'name' => $name, 'description' => $description, 'price' => $price, 'quantity' => $quantity]);
    }
}
