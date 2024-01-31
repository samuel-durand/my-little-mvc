<?php

namespace App\Model;

class CartProduct
{
    public function __construct(
        protected ?int $id = null,
        protected ?int $quantity = null,
        protected ?int $cart_id = null,
        protected ?int $product_id = null,
        protected ?\DateTime $createdAt = null,
        protected ?\DateTime $updatedAt = null,
        protected ?\PDO $pdo = null
    ) {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity):void
{
    $this->quantity = $quantity;
}

    public function getCartId(): ?int
    {
        return $this->cart_id;
    }

    public function setCartId(?int $cart_id): void
    {
        $this->cart_id = $cart_id;
    }

    public function getProductId(): ?int
    {
        return $this->product_id;
    }

    public function setProductId(?int $product_id): void
    {
        $this->product_id = $product_id;
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
    public function getPdo(): \PDO
    {
        $this->pdo = $this->pdo ?? (new DatabaseConnexion())->getConnexion();
        return $this->pdo;
    }
    public function hydrate(array $data): static
    {
        $this->id = $data['id'] ?? null;
        $this->quantity = $data['quantity'] ?? null;
        $this->cart_id = $data['cart_id'] ?? null;
        $this->product_id = $data['product_id'] ?? null;
        $this->createdAt = new \DateTime($data['created_at']);
        $this->updatedAt = isset($data['updated_at']) ? new \DateTime($data['updated_at']) : null;
        return $this;
    }
    public function __sleep(): array
    {
        return ['id', 'quantity', 'cart_id', 'product_id', 'created_at', 'updated_at'];
    }

    public function __wakeup(): void
    {
        $this->pdo = null;
    }
    public function verifyIfProductExist(int $id): bool
    {
        $pdo = $this->getPdo();
        $query = $pdo->prepare('SELECT id FROM cart_product WHERE id = :id');
        $query->execute(['id' => $id]);
        $result = $query->fetch();
        if ($result === false) {
            return false;
        } else {
            return true;
        }
    }
    public function addProduct(int $cart_id, int $product_id, int $quantity): void
    {
        $pdo = $this->getPdo();
        $query = $pdo->prepare('INSERT INTO cart_product (cart_id, product_id, quantity, updated_at) VALUES (:cart_id, :product_id, :quantity, NOW())');
        $query->bindParam(':cart_id', $cart_id, \PDO::PARAM_INT);
        $query->bindParam(':product_id', $product_id, \PDO::PARAM_INT);
        $query->bindParam(':quantity', $quantity, \PDO::PARAM_INT);
        $query->execute();
    }
    public function updateQuantity(int $id, int $quantity): void
    {
        $pdo = $this->getPdo();
        $query = $pdo->prepare('UPDATE cart_product SET quantity = :quantity, updated_at = NOW() WHERE id = :id');
        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        $query->bindParam(':quantity', $quantity, \PDO::PARAM_INT);
        $query->execute();
    }
    public function delete(int $id): void
    {
        $pdo = $this->getPdo();
        $query = $pdo->prepare('DELETE FROM cart_product WHERE id = :id');
        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        $query->execute();
    }
}