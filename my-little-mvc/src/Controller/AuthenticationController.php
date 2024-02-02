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
            var_dump($user);
        } catch (\PDOException $e) {
            echo $e->getMessage();
            var_dump($user);
            return;
        }

        echo 'Votre compte a bien été créé';

    }

    //connexion de l'utilisateur
    public function login(string $email, string $password)
    {
        // Vérification des champs vides
        if (empty($email) || empty($password)) {
            echo 'Veuillez remplir tous les champs';
            return false;
        }

        // Vérifie si l'email est valide
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Veuillez entrer un email valide';
            return false;
        }

        //vérifie si l"email correspond à un utilisateur
        $user = new User();
        $login = $user->findOneByEmail($email);

        // Vérification  si l'user existe
        if ($login === false) {
            echo 'Les identifiants fournis ne correspondent à aucun utilisateur';
            return false;
        }

        // Vérification du mot de passe
        if (password_verify($password, $login['password'])) {
            echo 'Vous êtes connecté';
            var_dump($login);
            $user = $_SESSION['user'] = $login;
            header('Location: shop.php');
            return true;
        } else {
            echo 'Mot de passe incorrect';
            return false;
        }
    }


    public static function profile()
    {
        $user = new User();
        $email = $_SESSION['user']['email'] ;
        return $user->findOneByEmail($email);
    }
    public function isLogged()
    {
        if (isset($_SESSION['user'])) {

            var_dump($_SESSION['user']);
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: login.php');
    }




}