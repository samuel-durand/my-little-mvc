<?php

namespace App\Model;



Class User {



    public function __construct(private ?int $id = null, private ?string $fullname = null, private ?string $email = null, private ?string $password = null, private array $role = [] ){

    }

    //Getter and Setter
    public function getid()
    {
        return $this->id;
    }

    public function setid(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getfullname()
    {
        return $this->fullname;
    }

    public function setfullname(string $fullname): self
    {
        $this->fullname = $fullname;
        return $this;
    }

    public function getemail()
    {
        return $this->email;
    }

    public function setemail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getpassword()
    {
        return $this->password;
    }

    public function setpassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getrole()
    {
        return $this->role;
    }

    public function setrole(array $role): self
    {
        $this->role = $role;
        return $this;
    }

    public function findOneByid(int $id): self
    {
        $bdd = new DataBaseConnection();
        $pdo = $bdd->getConnexion();
        $sql = "SELECT * From user where id = ?";
        $sql2 = $pdo->prepare($sql);
        $sql2->execute([$id]);
        $result = $sql2->fetch();
        $this->id = $result['id'];
        $this->fullname = $result['fullname'];
        $this->email = $result['email'];
        return $this;
    }

    public function findall(): array
    {
        $bdd = new DataBaseConnection();
        $pdo = $bdd->getConnexion();
        $sql = "SELECT * From user";
        $sql2 = $pdo->prepare($sql);
        $sql2->execute();
        $result = $sql2->fetchAll();
        return $result;
    }

    public function create() {
        $bdd = new DataBaseConnection();
        $pdo = $bdd->getConnexion();
        $sql = "INSERT INTO user (fullname, email, password, role) value (?,?,?,?,?)";
        $sql2 = $pdo->prepare($sql);
    }

    public function update() {
        $bdd = new DataBaseConnection();
        $pdo = $bdd->getConnexion();
        $sql = "UPDATE user SET fullname = ?, email = ?, password = ?, role = ? WHERE id = ?";
        $sql2 = $pdo->prepare($sql);
    }


}


