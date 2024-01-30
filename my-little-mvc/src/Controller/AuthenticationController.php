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
            } else {
                $user->setEmail($email);
                $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $user->setFullname($fullname);
                $user->setRole(['ROLE_USER']);
                $user->setCreatedAt(new \DateTime());

                $user->create();
                $errors['success'] = 'Votre compte a bien été créé';
            }
            return $errors;
        } else {
            return $errors;
        }
    }

    public function login(string $email, string $password): array
    {
        $errors = [];
        if (empty($email)) {
            $errors['email'] = 'Veuillez remplir le champ email';
        }
        if (empty($password)) {
            $errors['password'] = 'Veuillez remplir le champ mot de passe';
        }

        if (empty($errors)) {
            $user = new User();
            if ($user->findOneByEmail($email) === false) {
                $errors['errors'] = 'Les identifiants fournis ne correspondent à aucun utilisateur.';
            } else {
                $users = $user->getOneByEmail($email);
                var_dump($users->getRole());
                if (password_verify($password, $users->getPassword())) {
                    $_SESSION['user'] = $users;
                    $errors['success'] = 'Vous êtes connecté';
                    header('Location: /my-little-mvc/my-little-mvc/shop.php');
                } else {
                    $errors['errors'] = 'Les identifiants sont incorrects.';
                }
            }
            return $errors;
        } else {
            return $errors;
        }
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: /my-little-mvc/my-little-mvc/shop.php');
    }

    public function isLogged(): bool
    {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }

    public function profile() : bool
    {
        if ($this->isLogged()) {
            return true;
        } else {
            return false;
        }
    }
}