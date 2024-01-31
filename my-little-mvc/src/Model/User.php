<?php

namespace App\Model;

class User {

    private ?int $id = null;
    private ?string $fullname = null;
    private ?string $email = null;
    private ?string $password = null;
    private ?array $role = null;

    public function __construct(?int $id = null, ?string $fullname = null, ?string $email = null, ?string $password = null, ?array $role = null)
    {
        parent::__construct($id, $fullname, $email, $password, $role);
        $this->id = $id;
        $this->fullname = $fullname;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getFullname() {
        return $this->fullname;
    }

    public function setFullname(?string $fullname) {
        $this->fullname = $fullname;
        return $this;
    }

    public function getEmail() {
        return $email;
    }

    public function setEmail(?string $email) {
        $this->email = $email;
        return $this;
    }

    public function getPassword() {
        return $password;
    }

    public function setPassword(?string $password) {
        $this->password = $password;
        return $password;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole(?array $role) {
        $this->role = $role;
        return $role;
    }

    public function findOnebyId(int $id): static|false
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root' '');
        $statement = $pdo->prepare('SELECT * FROM user');
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        if (!$result) {
            return false;
        }
        return new static(
            $result['id'],
            $result['fullname'],
            $result['email'],
            $result['password'],
            $result['role'],
        );
    }

    public function findAll(): array
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
        $statement = $pdo->prepare('SELECT * FROM user');
        $statement->execute();
        $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $users = [];
        foreach ($users as $user) {
            $users[] = new static(
                $result['id'],
                $result['fullname'],
                $result['email'],
                $result['password'],
                $result['role'],
            );
        }
        return $users;
    }

    public function create(): static
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
        $sql = "INSERT INTO user (fullname, email, password, role) VALUES (:fullname, :email, :password, :role)";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':fullname', $this->getFullname());
        $statement->bindValue(':email', $this->getEmail());
        $statement->bindValue(':password', $this->getPassword());
        $statement->bindValue(':role', $this->getRole());
        $statement->execute();
        $this->setId((int)$pdo->lastInsertId());
        $sql = "INSERT INTO user (fullname, email, password, role) VALUES (:fullname, :email, :password, :role)";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':fullname', $this->getFullname());
        $statement->bindValue(':email', $this->getEmail());
        $statement->bindValue(':password', $this->getPassword());
        $statement->bindValue(':role', $this->getRole());
        $statement->execute();
        return $this;
    }

    public function update(): static
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
        $sql = "UPDATE user SET fullname = :fullname, email = :email, password = :password, email = :email, password = :password WHERE id = :id)";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':id', $this->getId());
        $statement->bindValue(':fullname', $this->getFullname());
        $statement->bindValue(':email', $this->getEmail());
        $statement->bindValue(':password', $this->getPassword());
        $statement->bindValue(':email', $this->getEmail());
        $statement->execute();
        return $this;
    }
}