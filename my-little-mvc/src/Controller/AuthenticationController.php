<?php

namespace App\Controller;

use App\Model\User;

class AuthenticationController
{
    private function validateEmail(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
    private function validatePassword(string $password): bool
    {
        if (strlen($password) < 8 || strlen($password) > 20) {
            return false;
        } else {
            return true;
        }
    }
    public function register(string $email, string $password, string $fullname): array
    {
        $errors = [];

        if (empty($email)) {
            $errors['email'] = 'Veuillez remplir le champ email';
        } else {
            if ($this->validateEmail($email) === false) {
                $errors['email'] = 'L\'email n\'est pas valide';
            }
        }
        if (empty($password)) {
            $errors['password'] = 'Veuillez remplir le champ mot de passe';
        } else {
            if ($this->validatePassword($password) === false) {
                $errors['password'] = 'Le mot de passe doit contenir au moins 8 caractères';
            }
        }
        if (empty($fullname)) {
            $errors['fullname'] = 'Veuillez remplir le champ nom complet';
        }
        if (empty($errors)) {
            $user = new User();
            if ($user->findOneByEmail($email) === true) {
                $errors['email'] = 'Cet email existe déjà';
            }
            $user->setEmail($email);
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $user->setFullname($fullname);
            $user->setRole(['ROLE_USER']);
            $user->setCreatedAt(new \DateTime());

            $user->create();
            $errors['success'] = 'Votre compte a bien été créé';
            return $errors;
        } else {
            return $errors;
        }
    }

    public function login(string $email, string $password): User|string
    {
        if (empty($email) || empty($password)) {
            return 'Veuillez remplir tous les champs';
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return 'L\'email n\'est pas valide';
            }
            if (strlen($password) < 8) {
                return 'Le mot de passe doit contenir au moins 8 caractères';
            }
            if (empty($errors)) {
                $user = new User();
                if ($user->findOneByEmail($email) === false) {
                    return 'Cet email n\'existe pas';
                }
                $user->findOneByEmail($email);
                if (password_verify($password, $user->getPassword())) {
                    return $user;
                } else {
                    return 'Les identifiants fournis ne correspondent à aucun utilisateur.';
                }
            } else {
                return 'Une erreur est survenue';
            }
        }
    }
}