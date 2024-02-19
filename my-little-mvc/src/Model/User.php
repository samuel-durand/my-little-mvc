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
        private ?\DateTime $created_at = null,
        private ?\DateTime $updated_at = null,
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

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
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

    public function getcreated_at(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setcreated_at(?\DateTime $created_at): void
    {
        $this->created_at = $created_at;
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




    public function findOneByPassword(string $password): array|bool
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
        $query = $pdo->prepare('SELECT * FROM user WHERE password = :password');
        $query->execute(['password' => $password]);
        $user = $query->fetchAll(\PDO::FETCH_CLASS);
        if (empty($user)) {
            return false;
        } else {
            return true;
        }
    }

    public function findOneByEmail(string $email)
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
        $query = $pdo->prepare('SELECT * FROM user WHERE email = :email');
        $query->execute(['email' => $email]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }


    public function create(): User
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
        $sql = $pdo->prepare('INSERT INTO user (fullname, email, password, role, created_at) VALUES (:fullname, :email, :password, :role, :created_at)');
        $sql->execute([
            'fullname' => $this->fullname,
            'email' => $this->email,
            'password' => $this->password,
            'role' => json_encode($this->role),
            'created_at' => $this->created_at->format('Y-m-d H:i:s')
        ]);
        return $this;
    }

    public function updateProfile(string $email, string $password,string  $fullname): array
    {

        $id = $_SESSION['user'];
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
        $sql = $pdo->prepare('UPDATE user SET email = :email, password = :password, fullname = :fullname role = :role  WHERE id = :id');
        $sql->execute([
            'email' => $email,
            'password' => $password,
            'fullname' => $fullname,
            'role' => json_encode($this->role), // 'role' => '["ROLE_USER"]
            'id' => $id
        ]);
    return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function findOneByFullname(string $fullname): bool
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
        $query = $pdo->prepare('SELECT * FROM user WHERE fullname = :fullname');
        $query->execute(['fullname' => $fullname]);
        $user = $query->fetchAll(\PDO::FETCH_CLASS);
        if (empty($user)) {
            return false;
        } else {
            return true;
        }
    }






}


