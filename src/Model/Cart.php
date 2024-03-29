<?php

namespace App\Model;
use PDO;
class Cart
{
    public function __construct(
        protected ?int $id = null,
        protected ?int $total = null,
        protected ?int $user_id = null,
        protected ?\DateTime $created_at = null,
        protected ?\DateTime $updated_at = null,
        protected ?PDO $pdo = null
    ) {

    }
    public function getPdo(): \PDO
    {
        $this->pdo = $this->pdo ?? (new DatabaseConnexion())->getConnexion();
        return $this->pdo;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(?int $total): void
    {
        $this->total = $total;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(?int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getcreated_at(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setcreated_at(?\DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getupdated_at(): ?\DateTime
    {
        return $this->updated_at;
    }

    public function setupdated_at(?\DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }
    public function hydrate(array $data): static
    {
        $this->id = intval($data['id']) ?? null;
        $this->total = intval($data['total']) ?? null;
        $this->user_id = $data['user_id'] ?? null;
        $this->created_at = new \DateTime($data['created_at']);
        $this->updated_at = isset($data['updated_at']) ? new \DateTime($data['updated_at']) : null;
        return $this;
    }
    public function __sleep(): array
    {
        return ['id', 'total', 'user_id', 'created_at', 'updated_at'];
    }
    public function __wakeup(): void
    {
        $this->pdo = null;
    }
    public function create(): static
    {
        $pdo = $this->getPdo();
        $query = $pdo->prepare('INSERT INTO cart (total, user_id, created_at) VALUES (:total, :user_id, NOW())');
        $query->bindParam(':total', $this->total,\PDO::PARAM_INT);
        $query->bindParam(':user_id', $this->user_id,\PDO::PARAM_INT);
        $query->execute();

        $this->id = $pdo->lastInsertId();
        return $this;
    }
    public function findOneByUserId(int $id): Cart|false
    {
        $pdo = $this->getPdo();
        $query = $pdo->prepare('SELECT * FROM cart WHERE user_id = :user_id');
        $query->execute(['user_id' => $id]);
        $cart = $query->fetch(\PDO::FETCH_ASSOC);
        if ($cart === false) {
            return false;
        } else {
            $carts = new Cart();
            $carts->hydrate($cart);
            return $carts;
        }
    }
    public function update(): void
    {
        $pdo = $this->getPdo();
        $query = $pdo->prepare('UPDATE cart SET total = :total, updated_at = NOW() WHERE id = :id');
        $query->bindParam(':total', $this->total,\PDO::PARAM_INT);
        $query->bindParam(':id', $this->id,\PDO::PARAM_INT);
        $query->execute();
    }
}