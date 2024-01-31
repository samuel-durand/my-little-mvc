<?php

namespace App\Model;

use App\Model\Abstract\AbstractProduct;
use App\Model\Interface\StockableInterface;
use PDO;
class Electronic extends AbstractProduct implements StockableInterface
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
        private ?string $brand = null,
        private ?int $waranty_fee = null,
        protected ?\PDO $pdo = null
    ) {
        parent::__construct($id, $name, $photos, $price, $description, $quantity, $category_id, $createdAt, $updatedAt);
    }
    public function getPdo(): \PDO
    {
        $this->pdo = $this->pdo ?? (new DatabaseConnexion())->getConnexion();
        return $this->pdo;
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
        $pdo = $this->getPdo();
        $statement = $pdo->prepare('SELECT * FROM product INNER JOIN electronic ON product.id = electronic.product_id WHERE product.id = :id');
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
        $pdo = $this->getPdo();
        $statement = $pdo->prepare('SELECT * FROM product INNER JOIN electronic ON product.id = electronic.product_id');
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

        $this->setId((int)$pdo->lastInsertId());

        $sql = "INSERT INTO electronic (product_id, brand, waranty_fee) VALUES (:product_id, :brand, :waranty_fee)";

        $statement = $pdo->prepare($sql);

        $statement->bindValue(':product_id', $this->getId());
        $statement->bindValue(':brand', $this->getBrand());
        $statement->bindValue(':waranty_fee', $this->getWarantyFee());

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
        $statement->bindValue(':updated_at', $this->getUpdatedAt()->format('Y-m-d H:i:s'));

        $statement->execute();

        $sql = "UPDATE electronic SET brand = :brand, waranty_fee = :waranty_fee WHERE product_id = :product_id";

        $statement = $pdo->prepare($sql);

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

    public function __sleep(): array
    {
        return ['id', 'name', 'photos', 'price', 'description', 'quantity', 'category_id', 'created_at', 'updated_at', 'brand', 'waranty_fee'];
    }
    public function __wakeup(): void
    {
        $this->pdo = null;
    }
}