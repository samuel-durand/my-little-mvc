<?php

namespace App\Model;

use App\Model\Abstract\AbstractProduct;
use App\Model\Interface\StockableInterface;

class Electronic extends AbstractProduct implements StockableInterface
{

    private ?string $brand = null;
    private ?int $waranty_fee = null;
    private \PDO $pdo;

    public function __construct(?int $id = null, ?string $name = null, ?array $photos = null, ?int $price = null, ?string $description = null, ?int $quantity = null, ?int $category_id = null, ?\DateTime $createdAt = null, ?\DateTime $updatedAt = null, ?string $brand = null, ?int $waranty_fee = null)
    {
        parent::__construct($id, $name, $photos, $price, $description, $quantity, $category_id, $createdAt, $updatedAt);
        $this->brand = $brand;
        $this->waranty_fee = $waranty_fee;
        $this->pdo = (new DatabaseConnexion())->getConnexion();
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

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): Electronic
    {
        $this->brand = $brand;
        return $this;
    }

    public function getWarantyFee(): ?int
    {
        return $this->waranty_fee;
    }

    public function setWarantyFee(?int $waranty_fee): Electronic
    {
        $this->waranty_fee = $waranty_fee;
        return $this;
    }

    public function findOneById(int $id): static|false
    {
        $statement = $this->pdo->prepare('SELECT * FROM product INNER JOIN electronic ON product.id = electronic.product_id WHERE product.id = :id');
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        if ($result === false) {
            return false;
        } else {
            $newElectronic = new Electronic();
            $newElectronic->hydrate($result);
            return $newElectronic;
        }
    }

    public function findAll(): array
    {
        $statement = $this->pdo->prepare('SELECT * FROM product INNER JOIN electronic ON product.id = electronic.product_id');
        $statement->execute();
        $results = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $products = [];

        foreach ($results as $result) {
            $electronic = new Electronic();
            $electronic->hydrate($result);
            $products[] = $electronic;
        }

        return $products;
    }

    public function create(): static
    {
        $sql = "INSERT INTO product (name, photos, price, description, quantity, category_id, created_at, updated_at) VALUES (:name, :photos, :price, :description, :quantity, :category_id, :created_at, :updated_at)";
        $statement = $this->pdo->prepare($sql);

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

        $sql = "INSERT INTO electronic (product_id, brand, waranty_fee) VALUES (:product_id, :brand, :waranty_fee)";

        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(':product_id', $this->getId());
        $statement->bindValue(':brand', $this->getBrand());
        $statement->bindValue(':waranty_fee', $this->getWarantyFee());

        $statement->execute();

        return $this;
    }

    public function update(): static
    {
        $sql = "UPDATE product SET name = :name, photos = :photos, price = :price, description = :description, quantity = :quantity, category_id = :category_id, updated_at = :updated_at WHERE id = :id";

        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(':id', $this->getId());
        $statement->bindValue(':name', $this->getName());
        $statement->bindValue(':photos', json_encode($this->getPhotos()));
        $statement->bindValue(':price', $this->getPrice());
        $statement->bindValue(':description', $this->getDescription());
        $statement->bindValue(':quantity', $this->getQuantity());
        $statement->bindValue(':category_id', $this->getCategoryId());
        $statement->bindValue(':updated_at', $this->getUpdatedAt()->format('Y-m-d H:i:s'));

        $statement->execute();

        $sql = "UPDATE electronic SET brand = :brand, waranty_fee = :waranty_fee WHERE product_id = :product_id";

        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(':product_id', $this->getId());
        $statement->bindValue(':brand', $this->getBrand());
        $statement->bindValue(':waranty_fee', $this->getWarantyFee());

        $statement->execute();

        return $this;
    }

    public function hydrate(array $data): static
    {
        parent::hydrate($data);
        $this->brand = $data['brand'];
        $this->waranty_fee = $data['waranty_fee'];

        return $this;
    }

}