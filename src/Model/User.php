<?php

namespace App\Model;

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

    public function getcreated_at(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setcreated_at(?\DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getupdated_at(): ?\DateTime
    {
        return $this->updated_at;
    }

    public function setupdated_at(?\DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }
    public function getPdo(): \PDO
    {
        $this->pdo = $this->pdo ?? (new DatabaseConnexion())->getConnexion();
        return $this->pdo;
    }
    public function findOneById(int $id): ?User
    {
        $pdo = $this->getPdo();
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
        $pdo = $this->getPdo();
        $query = $pdo->query('SELECT * FROM user');
        $users = $query->fetchAll(\PDO::FETCH_CLASS, User::class);
        return $users;
    }
    public function findOneByEmail(string $email): bool
    {
        $pdo = $this->getPdo();
        $query = $pdo->prepare('SELECT * FROM user WHERE email = :email');
        $query->execute(['email' => $email]);
        $user = $query->fetchAll(\PDO::FETCH_CLASS);
        if (empty($user)) {
            return false;
        } else {
            return true;
        }
    }
    public function getOneByEmail(string $email): ?User
    {
        $pdo = $this->getPdo();
        $query = $pdo->prepare('SELECT * FROM user WHERE email = :email');
        $query->execute(['email' => $email]);
        $data = $query->fetch(\PDO::FETCH_ASSOC);
        if ($data === false) {
            return null;
        }
        $user = new User();
        $user->hydrate($data);
        return $user;
    }
    public function create(): User
    {
        $pdo = $this->getPdo();
        $query = $pdo->prepare('INSERT INTO user (fullname, email, password, role, created_at) VALUES (:fullname, :email, :password, :role, :created_at)');
        $query->execute([
            'fullname' => $this->fullname,
            'email' => $this->email,
            'password' => $this->password,
            'role' => json_encode($this->role),
            'created_at' => $this->created_at->format('Y-m-d H:i:s')
        ]);
        $this->id = $this->pdo->lastInsertId();
        return $this;
    }
    public function hydrate(array $data): static
    {
        $this->id = $data['id'];
        $this->fullname = $data['fullname'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->role = json_decode($data['role'], true);
        $this->created_at = new \DateTime($data['created_at']);
        $this->updated_at = isset($data['updated_at']) ? new \DateTime($data['updated_at']) : null;
        return $this;
    }
    public function __sleep(): array
    {
        return ['id', 'fullname', 'email', 'password', 'role', 'created_at', 'updated_at'];
    }

    public function __wakeup(): void
    {
        $this->pdo = null;
    }
    public function updated_ata(string $field, string $value): void
    {
        $pdo = $this->getPdo();
        $query = $pdo->prepare("UPDATE user SET $field = :value, created_at = NOW() WHERE id = :id");
        $query->bindParam(':value', $value);
        $query->bindParam(':id', $this->id);
        $query->execute();
    }

}