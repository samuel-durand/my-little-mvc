<?php

namespace App\Model;

class User
{
    private ?int $id;
    private ?string $fullname;
    private ?string $email;
    private ?string $password;
    private ?array $role;
    private ?\DateTime $created_at;
    private ?\DateTime $updated_at;
    private ?\PDO $pdo;

    public function __construct(?int $id = null, ?string $fullname = null, ?string $email = null, ?string $password = null, ?array $role = null, ?\DateTime $created_at = null, ?\DateTime $updated_at = null)
    {
        $this->id = $id;
        $this->fullname = $fullname;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->pdo = (new DatabaseConnexion())->getConnexion();
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

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    public function findOneById(int $id): ?User
    {
        $query = $this->pdo->prepare('SELECT * FROM user WHERE id = :id');
        $query->execute(['id' => $id]);
        $user = $query->fetchObject(User::class);
        if ($user === false) {
            return null;
        }
        return $user;
    }
    public function findAll(): array
    {
        $query = $this->pdo->query('SELECT * FROM user');
        $users = $query->fetchAll(\PDO::FETCH_CLASS, User::class);
        return $users;
    }
    public function findOneByEmail(string $email): bool
    {
        $query = $this->pdo->prepare('SELECT * FROM user WHERE email = :email');
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
        $query = $this->pdo->prepare('SELECT * FROM user WHERE email = :email');
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
        $query = $this->pdo->prepare('INSERT INTO user (fullname, email, password, role, created_at) VALUES (:fullname, :email, :password, :role, :created_at)');
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
        $this->pdo = null;
        return $this;
    }

    public function updateField(string $field, $value): void
    {
        $query = $this->pdo->prepare("UPDATE user SET $field = :value, created_at = NOW() WHERE id = :id");
        $query->execute([
            'value' => $value,
            'id' => $this->id
        ]);
    }
}