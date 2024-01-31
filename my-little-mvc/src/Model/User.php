<?php

namespace src\Model;

use PDO;


class User
{
    public function __construct(
        private ?int $id = null,
        private ?string $fullname = null,
        private ?string $email = null,
        private ?string $password = null,
        private ?array $role = null,
        private ?\PDO $pdo = null
    )  {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(?string $fullname): void
    {
        $this->fullname = $fullname;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getRole(): ?array
    {
        return $this->role;
    }

    public function setRole(?array $role): void
    {
        $this->role = $role;
    }


    public function findOneById(int $id): ?User
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
        $query = $pdo->prepare('SELECT * FROM user WHERE id = :id');
        $query->execute(['id' => $id]);
        $user = $query->fetchObject(User::class);
        if ($user === false) {
            return null;
        }
        return $user;
    }
    public function findAll(): array
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
        $query = $pdo->query('SELECT * FROM user');
        $users = $query->fetchAll(\PDO::FETCH_CLASS, User::class);
        return $users;
    }
    public function findOneByEmail(string $email): bool
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
        $query = $pdo->prepare('SELECT * FROM user WHERE email = :email');
        $query->execute(['email' => $email]);
        $user = $query->fetchAll(\PDO::FETCH_CLASS);
        if (empty($user)) {
            return false;
        } else {
            return true;
        }
    }




    public function create(): User
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
        $sql = $pdo->prepare('INSERT INTO user (fullname, email, password, role) VALUES (:fullname, :email, :password, :role)');
        $sql->execute([
            'fullname' => $this->fullname,
            'email' => $this->email,
            'password' => $this->password,
            'role' => json_encode($this->role),
        ]);
        return $this;
    }




}


