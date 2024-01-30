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

    public function adduser() {
        $bdd = "mysql:host=localhost;dbname=draft-shop";
        $username = "root";
        $password = "";
        $pdo = new PDO ($bdd, $username, $password);
    }


}


