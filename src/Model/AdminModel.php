<?php

namespace App\Model;

use PDO;

class AdminModel
{
    public function __construct(
        protected ?PDO $pdo = null
    ) {
    }
    public function getPdo(): \PDO
    {
        $this->pdo = $this->pdo ?? (new DatabaseConnexion())->getConnexion();
        return $this->pdo;
    }


    public function getUser(): array
    {
        $query = $this->getPdo()->prepare('SELECT * FROM user');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteUser(int $id): bool
    {
        $query = $this->getPdo()->prepare('DELETE FROM user WHERE id = :id');
        $sql = $query->execute(['id' => $id]);
        return $sql;
    }

    public function editUser(int $id, string $email, string $fullname ): bool
    {
        $query = $this->getPdo()->prepare('UPDATE user SET email = :email,  fullname = :fullname WHERE id = :id');
        $sql = $query->execute(['id' => $id, 'email' => $email, 'fullname' => $fullname]);
        return $sql;
    }

}