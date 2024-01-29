<?php

namespace App\Controller;
use App\Model\User;
class AuthenticationController
{
    public function register(string $email,string $password,string $fullname): User|string
    {
        if (empty($email) || empty($password) || empty($fullname)) {
            return 'Veuillez remplir tous les champs';
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return 'L\'email n\'est pas valide';
            }
            if (strlen($password) < 8) {
                return 'Le mot de passe doit contenir au moins 8 caractères';
            }
            if (strlen($fullname) < 3) {
                return 'Le nom doit contenir au moins 3 caractères';
            }

            if (empty($errors)) {
                $user = new User();
                if ($user->findOneByEmail($email) === true) {
                    return 'Cet email est déjà utilisé';
                }
                $user->setEmail($email);
                $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $user->setFullname($fullname);
                $user->setRole(['ROLE_USER']);
                $user->setCreatedAt(new \DateTime());

                $user->create();
                return $user;
            }
        }
    }
}