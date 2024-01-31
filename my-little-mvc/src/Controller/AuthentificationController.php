<?php

namespace App\Controller;

use App\Model\User;

class AuthentificationController
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function register($fullname, $email, $password, $password_confirm) {

        $searched_user = $this->user->findOneByEmail($email);

        if ($searched_user == false) {
            if ($password < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)){
                echo "Le mot de passe doit contenir au moins 8 caractères, avoir une majuscule et un chiffre";
            }
            else if ($password != $password_confirm) {
                echo "Les mots de passe ne correspondent pas";
            }
            else {
                // $password = password_hash($password, PASSWORD_DEFAULT);
                $user = new User();
                $user->setFullname($fullname);
                $user->setEmail($email);
                $user->setPassword($password);
                $user->setRole('ROLE_USER');
                $user->create();
    
                echo "Vous êtes bien inscrit";
            }
        }

        else {
            echo "L'email existe déjà";
        }
    }
}

?>