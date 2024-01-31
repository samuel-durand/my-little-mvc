<?php



namespace src\Controller;

use src\Model\User;

class AuthenticationController
{
    public  function register()
    {
        $user = new User();
        $user->setFullname($_POST['fullname']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setRole(['ROLE_USER']);
        $user->create();
    }
}