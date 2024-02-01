<?php



namespace src\Controller;

use src\Model\User;

class AuthenticationController
{
    public  function register()
    {


        //Verifie si le formulaire n'est pas vide
        if (empty($_POST['fullname']) || empty($_POST['email']) || empty($_POST['password'])) {
            echo 'Veuillez remplir tous les champs';
            return;
        }

        //Verifie si le pseudo est déjà utilisé
        $user = new User();
        if($user->findOneByFullname($_POST['fullname'])){
            echo 'Ce nom est deja utilisé';
            return;
        }

        //Verifie si l'email est valide
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo 'Veuillez entrer un email valide';
            return;
        }

        //verifie si l'email existe déjà
        $user = new User();
        if($user->findOneByEmail($_POST['email'])){
            echo 'Cet email existe deja';
            return;
        }

        //verifie si le mot de passe est assez long
        if(strlen($_POST['password']) < 8){
            echo 'Le mot de passe doit contenir au moins 8 caracteres';
            return;
        }



        //try catch pour la creation de l'utilisateur

        try {
            $user = new User();
            $user->setFullname($_POST['fullname']);
            $user->setEmail($_POST['email']);
            $user->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
            $user->setRole(['ROLE_USER']);
            $user->create();
        } catch (\PDOException $e) {
            echo $e->getMessage();
            var_dump($user);
            return;
        }

        echo 'Votre compte a bien été créé';

    }

    //connexion de l'utilisateur
    public function login()
    {
     //connecter l'user
        //verifie si le formulaire n'est pas vide
        if (empty($_POST['email']) || empty($_POST['password'])) {
            echo 'Veuillez remplir tous les champs';
            return;
        }
        //verifie si l'email existe
        $user = new User();
        //verifie si le mot de passe est bon
        if(!password_verify($_POST['password'], $user->getPassword())){
            echo 'Le mot de passe est incorrect';
            return;
        }
        //connecter l'utilisateur
        $_SESSION['user'] = $user;
        //try catch pour la connexion de l'utilisateur
        try {
            $user = new User();
            $user->setEmail($_POST['email']);
            $user->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
            $user->setRole(['ROLE_USER']);
            $user->login();
        } catch (\PDOException $e) {
            echo $e->getMessage();
            var_dump($user);
            return;
        }
    }



}