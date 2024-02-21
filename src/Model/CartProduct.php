<?php

namespace App\Model;

class CartProduct
{
    public function __construct(
        protected ?int $id = null,
        protected ?int $quantity = null,
        protected ?int $price = null,
        protected ?int $cart_id = null,
        protected ?int $product_id = null,
        protected ?\DateTime $created_at = null,
        protected ?\DateTime $updated_at = null,
        protected ?\PDO $pdo = null
    ) {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }
    public function setPrice(?int $price): self
    {
        $this->price = $price;
        return $this;
    }
    public function getCartId(): ?int
    {
        return $this->cart_id;
    }

    public function setCartId(?int $cart_id): self
    {
        $this->cart_id = $cart_id;
        return $this;
    }

    public function getProductId(): ?int
    {
        return $this->product_id;
    }

    public function setProductId(?int $product_id): self
    {
        $this->product_id = $product_id;
        return $this;
    }
    public function getcreated_at(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setcreated_at(?\DateTime $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getupdated_at(): ?\DateTime
    {
        return $this->updated_at;
    }

    public function setupdated_at(?\DateTime $updated_at): self
    {
        $this->updated_at = $updated_at;
        return $this;
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
        $this->price = $data['price'] ?? null;
        $this->cart_id = $data['cart_id'] ?? null;
        $this->product_id = $data['product_id'] ?? null;
        $this->created_at = new \DateTime($data['created_at']);
        $this->updated_at = isset($data['updated_at']) ? new \DateTime($data['updated_at']) : null;
        return $this;
    }
    public function __sleep(): array
    {
        return ['id', 'quantity', 'cart_id', 'price' , 'product_id', 'created_at', 'updated_at'];
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
    /**
     * Finds a CartProduct by its product_id and cart_id.
     *
     * This function searches for an entry in the cart_product table that matches both the given product_id and cart_id.
     * If such an entry is found, it creates a new CartProduct object, hydrates it with the found data, and returns it.
     * If no such entry is found, it returns false.
     *
     * @param int $product_id The ID of the product.
     * @param int $cart_id The ID of the cart.
     * @return CartProduct|false The CartProduct object if found, false otherwise.
     */
    public function findOneById(int $product_id, int $cart_id) : static|false
    {
        $pdo = $this->getPdo();
        $query = $pdo->prepare('SELECT * FROM cart_product WHERE cart_id = :cart_id AND product_id = :product_id');
        $query->bindParam(':cart_id', $cart_id, \PDO::PARAM_INT);
        $query->bindParam(':product_id', $product_id, \PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            $cartProduct = new CartProduct();
            $cartProduct->hydrate($result[0]);
            return $cartProduct;
        } else {
            return false;
        }
    }
    public function findAll(int $id) : array
    {
        $pdo = $this->getPdo();
        $query = $pdo->prepare('SELECT * FROM cart_product WHERE cart_id = :id');
        $query->execute(['id' => $id]);
        $results = $query->fetchAll(\PDO::FETCH_ASSOC);
        $cartProducts = [];
        foreach ($results as $result) {
            $cartProduct = new CartProduct();
            $cartProduct->hydrate($result);
            $cartProducts[] = $cartProduct;
        }
        return $cartProducts;
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
    public function update(): bool
    {
        $pdo = $this->getPdo();
        $query = $pdo->prepare('UPDATE cart_product SET quantity = :quantity, updated_at = NOW() WHERE id = :id');
        $query->bindParam(':id', $this->id, \PDO::PARAM_INT);
        $query->bindParam(':quantity', $this->quantity, \PDO::PARAM_INT);
        return $query->execute();
    }
    public function delete(int $id): bool
    {
        $pdo = $this->getPdo();
        $query = $pdo->prepare('DELETE FROM cart_product WHERE id = :id');
        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        return $query->execute();
    }
    public function create(): static
    {
        $pdo = $this->getPdo();

        $query = $pdo->prepare('INSERT INTO cart_product (cart_id, product_id, quantity, price, created_at) VALUES (:cart_id, :product_id, :quantity, :price, NOW())');
        $query->bindParam(':cart_id', $this->cart_id, \PDO::PARAM_INT);
        $query->bindParam(':product_id', $this->product_id, \PDO::PARAM_INT);
        $query->bindParam(':quantity', $this->quantity, \PDO::PARAM_INT);
        $query->bindParam(':price', $this->price, \PDO::PARAM_INT);
        $query->execute();

        $this->id = $pdo->lastInsertId();
        return $this;
    }
    public function findAllByCartId(int $cart_id) : array
    {
        $pdo = $this->getPdo();
        $query = $pdo->prepare('SELECT * FROM cart_product WHERE cart_id = :cart_id');
        $query->bindParam(':cart_id', $cart_id, \PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetchAll(\PDO::FETCH_ASSOC);
        $cartProducts = [];
        foreach ($results as $result) {
            $cartProduct = new CartProduct();
            $cartProduct->hydrate($result);
            $cartProducts[] = $cartProduct;
        }
        return $cartProducts;
    }
}