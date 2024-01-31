<?php

namespace App\Model;
use App\Model\Abstract\AbstractProduct;
use App\Model\DatabaseConnexion;

class Product extends AbstractProduct
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
        protected ?\PDO $pdo = null
    ) {
        parent::__construct($id, $name, $photos, $price, $description, $quantity, $category_id, $createdAt, $updatedAt);
    }
    public function getPdo(): \PDO
    {
        $this->pdo = $this->pdo ?? (new DatabaseConnexion())->getConnexion();
        return $this->pdo;
    }
    public function hydrate(array $data): static
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->photos = json_decode($data['photos'], true);
        $this->price = $data['price'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->quantity = $data['quantity'] ?? null;
        $this->category_id = $data['category_id'] ?? null;
        $this->createdAt = new \DateTime($data['created_at']);
        $this->updatedAt = isset($data['updated_at']) ? new \DateTime($data['updated_at']) : null;
        return $this;
    }
    public function __sleep(): array
    {
        return ['id', 'name', 'photos', 'price', 'description', 'quantity', 'category_id', 'created_at', 'updated_at'];
    }

    public function __wakeup(): void
    {
        $this->pdo = null;
    }
    private function jsonToArray(string $json): array
    {
        return json_decode($json, true);
    }
    public function findPaginated(int $page) : array
    {
        $pdo = $this->getPdo();
        $offset = ($page - 1) * 10;
        $query = $pdo->prepare('SELECT * FROM product LIMIT 10 OFFSET :offset');
        $query->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetchAll(\PDO::FETCH_ASSOC);

        $products = [];
        foreach ($results as $result) {
            $product = new Product();
            $product->hydrate($result);
            $products[] = $product;
        }
        return $products;
    }

}