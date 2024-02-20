<?php

namespace App\Model;

class AdminModel
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

    public function findallusers(): array
    {
        $pdo = $this->getPdo();
        $query = $pdo->prepare('SELECT * FROM users');
        $query->execute();
        return $query->fetch(\PDO::FETCH_ASSOC);
    }


}
