<?php

namespace App\Model;

use App\Model\Abstract\AbstractProduct;
use App\Model\Interface\StockableInterface;

class Clothing extends AbstractProduct implements StockableInterface
{
    public function __construct(
        protected ?int $id = null,
        protected ?string $name = null,
        protected ?array $photos = null,
        protected ?int $price = null,
        protected ?string $description = null,
        protected ?int $quantity = null,
        protected ?int $category_id = null,
        protected ?\DateTime $createdAt = null,
        protected ?\DateTime $updatedAt = null,
        private ?string $size = null,
        private ?string $color = null,
        private ?string $type = null,
        private ?int $material_fee = null,
        protected ?\PDO $pdo = null
    ) {
        parent::__construct($id, $name, $photos, $price, $description, $quantity, $category_id, $createdAt, $updatedAt);
    }

    public function addStock(int $quantity): static
    {
        $this->quantity += $quantity;
        $this->updatedAt = new \DateTime();
        $this->update();
        return $this;
    }

    public function removeStock(int $quantity): static
    {
        $this->quantity -= $quantity;
        $this->updatedAt = new \DateTime();
        $this->update();
        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): Clothing
    {
        $this->size = $size;
        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): Clothing
    {
        $this->color = $color;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): Clothing
    {
        $this->type = $type;
        return $this;
    }

    public function getMaterialFee(): ?int
    {
        return $this->material_fee;
    }

    public function setMaterialFee(?int $material_fee): Clothing
    {
        $this->material_fee = $material_fee;
        return $this;
    }
    public function getPdo(): \PDO
    {
        $this->pdo = $this->pdo ?? (new DatabaseConnexion())->getConnexion();
        return $this->pdo;
    }
    public function findOneById(int $id): static|false
    {
        $pdo = $this->getPdo();
        $statement = $pdo->prepare('SELECT * FROM clothing INNER JOIN product ON clothing.product_id = product.id WHERE clothing.product_id = :id');
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        if (!$result) {
            return false;
        } else {
            $newClothing = new Clothing();
            $newClothing->hydrate($result);
            return $newClothing;
        }
    }

    public function findAll(): array
    {
        $pdo = $this->getPdo();
        $statement = $pdo->prepare('SELECT * FROM clothing INNER JOIN product ON clothing.product_id = product.id');
        $statement->execute();
        $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $products = [];
        foreach ($results as $result) {
            $clothing = new Clothing();
            $clothing->hydrate($result);
            $products[] = $clothing;
        }
        return $products;
    }

    public function create(): static
    {
        $pdo = $this->getPdo();
        $sql = "INSERT INTO product (name, photos, price, description, quantity, category_id, created_at, updated_at) VALUES (:name, :photos, :price, :description, :quantity, :category_id, :created_at, :updated_at)";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':name', $this->getName());
        $statement->bindValue(':photos', json_encode($this->getPhotos()));
        $statement->bindValue(':price', $this->getPrice());
        $statement->bindValue(':description', $this->getDescription());
        $statement->bindValue(':quantity', $this->getQuantity());
        $statement->bindValue(':category_id', $this->getCategoryId());
        $statement->bindValue(':created_at', $this->getCreatedAt()->format('Y-m-d H:i:s'));
        $statement->bindValue(':updated_at', $this->getUpdatedAt() ? $this->getUpdatedAt()->format('Y-m-d H:i:s') : null);
        $statement->execute();
        $this->setId((int)$this->pdo->lastInsertId());
        $sql = "INSERT INTO clothing (product_id, size, color, type, material_fee) VALUES (:product_id, :size, :color, :type, :material_fee)";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':product_id', $this->getId());
        $statement->bindValue(':size', $this->getSize());
        $statement->bindValue(':color', $this->getColor());
        $statement->bindValue(':type', $this->getType());
        $statement->bindValue(':material_fee', $this->getMaterialFee());
        $statement->execute();
        return $this;
    }

    public function update(): static
    {
        $pdo = $this->getPdo();
        $sql = "UPDATE product SET name = :name, photos = :photos, price = :price, description = :description, quantity = :quantity, category_id = :category_id, updated_at = :updated_at WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':id', $this->getId());
        $statement->bindValue(':name', $this->getName());
        $statement->bindValue(':photos', json_encode($this->getPhotos()));
        $statement->bindValue(':price', $this->getPrice());
        $statement->bindValue(':description', $this->getDescription());
        $statement->bindValue(':quantity', $this->getQuantity());
        $statement->bindValue(':category_id', $this->getCategoryId());
        $statement->bindValue(':updated_at', (new \DateTime())->format('Y-m-d H:i:s'));
        $statement->execute();
        $sql = "UPDATE clothing SET size = :size, color = :color, type = :type, material_fee = :material_fee WHERE product_id = :product_id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':product_id', $this->getId());
        $statement->bindValue(':size', $this->getSize());
        $statement->bindValue(':color', $this->getColor());
        $statement->bindValue(':type', $this->getType());
        $statement->bindValue(':material_fee', $this->getMaterialFee());
        $statement->execute();
        return $this;
    }
    public function __sleep(): array
    {
        return ['id', 'name', 'photos', 'price', 'description', 'quantity', 'category_id', 'created_at', 'updated_at', 'size', 'color', 'type', 'material_fee'];
    }
    public function __wakeup(): void
    {
        $this->pdo = null;
    }
    public function hydrate(array $data): static
    {
        parent::hydrate($data);
        $this->setSize($data['size']);
        $this->setColor($data['color']);
        $this->setType($data['type']);
        $this->setMaterialFee($data['material_fee']);

        return $this;
    }
}