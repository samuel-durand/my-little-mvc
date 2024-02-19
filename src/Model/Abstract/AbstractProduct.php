<?php

namespace App\Model\Abstract;

use App\Model\Category;
use App\Model\DatabaseConnexion;
abstract class AbstractProduct
{
    public function __construct(
    protected ?int $id = null,
    protected ?string $name = null,
    protected ?array $photos = null,
    protected ?int $price = null,
    protected ?string $description = null,
    protected ?int $quantity = null,
    protected ?int $category_id = null,
    protected ?\DateTime $created_at = null,
    protected ?\DateTime $updated_at = null,
    protected ?\PDO $pdo = null
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): AbstractProduct
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): AbstractProduct
    {
        $this->name = $name;
        return $this;
    }

    public function getPhotos(): ?array
    {
        return $this->photos;
    }

    public function setPhotos(?array $photos): AbstractProduct
    {
        $this->photos = $photos;
        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): AbstractProduct
    {
        $this->price = $price;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): AbstractProduct
    {
        $this->description = $description;
        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): AbstractProduct
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(?int $category_id): AbstractProduct
    {
        $this->category_id = $category_id;
        return $this;
    }

    public function getcreated_at(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setcreated_at(?\DateTime $created_at): AbstractProduct
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getupdated_at(): ?\DateTime
    {
        return $this->updated_at;
    }

    public function setupdated_at(?\DateTime $updated_at): AbstractProduct
    {
        $this->updated_at = $updated_at;
        return $this;
    }
    public function getPdo(): \PDO
    {
        $this->pdo = $this->pdo ?? (new DatabaseConnexion())->getConnexion();
        return $this->pdo;
    }

    public function getCategory(): Category|false
    {
        $pdo = $this->getPdo();
        $sql = "SELECT * FROM category WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':id', $this->category_id);
        $statement->execute();
        $category = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($category) {
            return new Category(
                $category['id'],
                $category['name'],
                $category['description'],
                new \DateTime($category['created_at']),
                $category['updated_at'] ? (new \DateTime($category['updated_at'])) : null
            );
        }

        return false;
    }

    public function findOneById(int $id): static|false
    {
        $pdo = $this->getPdo();
        $sql = "SELECT * FROM product WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $product = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($product) {
            return new static(
                $product['id'],
                $product['name'],
                json_decode($product['photos']),
                $product['price'],
                $product['description'],
                $product['quantity'],
                $product['category_id'],
                new \DateTime($product['created_at']),
                $product['updated_at'] ? (new \DateTime($product['updated_at'])) : null
            );
        }

        return false;
    }

    public function findAll(): array
    {
        $pdo = $this->getPdo();
        $sql = "SELECT * FROM product";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $products = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $results = [];
        foreach ($products as $product) {
            $results[] = new static(
                $product['id'],
                $product['name'],
                json_decode($product['photos']),
                $product['price'],
                $product['description'],
                $product['quantity'],
                $product['category_id'],
                new \DateTime($product['created_at']),
                $product['updated_at'] ? (new \DateTime($product['updated_at'])) : null
            );
        }

        return $results;
    }

    public function create(): static
    {
        $pdo = $this->getPdo();
        $sql = "INSERT INTO product (name, photos, price, description, quantity, category_id, created_at, updated_at) VALUES (:name, :photos, :price, :description, :quantity, :category_id, :created_at, :updated_at)";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':name', $this->name);
        $statement->bindValue(':photos', json_encode($this->photos));
        $statement->bindValue(':price', $this->price);
        $statement->bindValue(':description', $this->description);
        $statement->bindValue(':quantity', $this->quantity);
        $statement->bindValue(':category_id', $this->category_id);
        $statement->bindValue(':created_at', $this->created_at->format('Y-m-d H:i:s'));
        $statement->bindValue(':updated_at', $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : null);
        $statement->execute();
        $this->id = $pdo->lastInsertId();
        return $this;
    }

    public function update(): static
    {
        $pdo = $this->getPdo();
        $sql = "UPDATE product SET name = :name, photos = :photos, price = :price, description = :description, quantity = :quantity, category_id = :category_id, updated_at = :updated_at WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':id', $this->id);
        $statement->bindValue(':name', $this->name);
        $statement->bindValue(':photos', json_encode($this->photos));
        $statement->bindValue(':price', $this->price);
        $statement->bindValue(':description', $this->description);
        $statement->bindValue(':quantity', $this->quantity);
        $statement->bindValue(':category_id', $this->category_id);
        $statement->bindValue(':updated_at', (new \DateTime())->format('Y-m-d H:i:s'));
        $statement->execute();
        return $this;
    }

    public function hydrate(array $data): static
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->photos = json_decode($data['photos'], true);
        $this->price = $data['price'];
        $this->description = $data['description'];
        $this->quantity = $data['quantity'];
        $this->created_at = new \DateTime($data['created_at']);
        $this->updated_at = isset($data['updated_at']) ? new \DateTime($data['updated_at']) : null;
        $this->category_id = $data['category_id'];

        return $this;
    }
}