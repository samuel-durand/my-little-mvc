<?php

namespace App\Model;
use PDO;
class Cart
{
    public function __construct(
        protected ?int $id = null,
        protected ?int $total = null,
        protected ?int $user_id = null,
        protected ?\DateTime $createdAt = null,
        protected ?\DateTime $updatedAt = null,
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

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
    public function hydrate(array $data): static
    {
        $this->id = $data['id'] ?? null;
        $this->total = $data['total'] ?? null;
        $this->user_id = $data['user_id'] ?? null;
        $this->createdAt = new \DateTime($data['created_at']);
        $this->updatedAt = isset($data['updated_at']) ? new \DateTime($data['updated_at']) : null;
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
        $query->execute([
            'total' => $this->total,
            'user_id' => $this->user_id
        ]);
        $this->id = $pdo->lastInsertId();
        return $this;
    }
    public function findOneByUserId(int $id): Cart|bool
    {
        $pdo = $this->getPdo();
        $query = $pdo->prepare('SELECT * FROM cart WHERE user_id = :user_id');
        $query->execute(['user_id' => $id]);
        $cart = $query->fetchObject(Cart::class);
        if ($cart === false) {
            return false;
        }
        return $cart;
    }
    public function update(): void
    {
        $pdo = $this->getPdo();
        $query = $pdo->prepare('UPDATE cart SET total = :total, updated_at = NOW() WHERE id = :id');
        $query->bindParam(':total', $total);
        $query->bindParam(':id', $id);
        $query->execute();
    }
}