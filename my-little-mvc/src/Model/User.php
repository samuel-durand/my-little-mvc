<?php

namespace App\Model;

class User {

    

    public function __construct(
        private ?int $id = null,
        private ?string $fullname = null,
        private  ?string $email = null,
        private ?string $password = null,
        private ?string $role = null)
    {}

    public function getId() {
        return $this->id;
    }

    public function setId(?int $id) {
        $this->id = $id;
        return $this;
    }

    public function getFullname() {
        return $this->fullname;
    }

    public function setFullname(?string $fullname) {
        $this->fullname = $fullname;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail(?string $email) {
        $this->email = $email;
        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword(?string $password) {
        $this->password = $password;
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole(?string $role) {
        $this->role = $role;
        return $role;
    }

    public function findOneById(int $id): static|false
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
        $statement = $pdo->prepare('SELECT * FROM user WHERE id = :id');
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

        return $this;
    }

    public function update(): static
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
        $sql = "UPDATE user SET fullname = :fullname, email = :email, password = :password, role = :role WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':id', $this->getId());
        $statement->bindValue(':fullname', $this->getFullname());
        $statement->bindValue(':email', $this->getEmail());
        $statement->bindValue(':password', $this->getPassword());
        $statement->bindValue(':role', $this->getRole());
        $statement->execute();
        return $this;
    }

    public function findOneByEmail(?string $email): static|false
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
        $sql = "SELECT * FROM user WHERE email = :email";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':email', $email, \PDO::PARAM_STR);
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
}