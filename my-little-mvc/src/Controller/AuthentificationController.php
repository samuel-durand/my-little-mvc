<?php

namespace App\Controller;

session_start();

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
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "L'email n'est pas valide";
            }
            else {
                if ($password < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)){
                    echo "Le mot de passe doit contenir au moins 8 caractères, avoir une majuscule et un chiffre";
                }
                else if ($password != $password_confirm) {
                    echo "Les mots de passe ne correspondent pas";
                }
                else {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $user = new User();
                    $user->setFullname($fullname);
                    $user->setEmail($email);
                    $user->setPassword($password);
                    $user->setRole('ROLE_USER');
                    $user->create();
        
                    echo "Vous êtes bien inscrit";
                }
            }
        }

        else {
            echo "L'email existe déjà";
        }
    }

    // Function that checks if the email and password exist in the database
    public function login($email, $password) {
        $searched_user = $this->user->findOneByEmail($email);

        if ($searched_user && password_verify($password, $searched_user->getPassword())) {
            $_SESSION['user'] = $searched_user;
            header('Location: shop.php');
        }
        else {
            echo "Les identifiants fournis ne correspondent à aucun utilisateur";
        }
    }

    public function profile() {
        if ($_SESSION['user']) {
            return true;
        }
        else {
            header('Location: login.php');
            echo "Vous n'êtes pas connecté";
        }
    }

    public function updateProfile($email, $fullname, $password) {
        $_SESSION['user'] = $this->user->findOneById($_SESSION['user']->getId());

        if ($_SESSION['user']) {
            if (isset($_POST['edit-email'])) {
                if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
                    echo "L'email n'est pas valide";
                }
                else {
                    $_SESSION['user']->setEmail($email);
                    $_SESSION['user']->update();
                    echo "L'email a bien été modifié";
                }
            }
            else if (isset($_POST['edit-fullname'])) {
                $_SESSION['user']->setFullname($fullname);
                $_SESSION['user']->update();
                echo "Le nom et prénom ont bien été modifiés";
            }
            else if (isset($_POST['edit-password'])) {
                if ($password < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)){
                    echo "Le mot de passe doit contenir au moins 8 caractères, avoir une majuscule et un chiffre";
                }
                else {
                    $password = password_hash($password, PASSWORD_DEFAULT);

                    $_SESSION['user']->setPassword($password);
                    $_SESSION['user']->update();
                    echo "Le mot de passe a bien été modifié";
                }
            }
        }

        else {
            echo "Erreur fatale. L'utilisateur n'existe pas";
        }
    }
}

?>