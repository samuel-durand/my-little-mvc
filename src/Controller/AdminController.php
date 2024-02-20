<?php

namespace App\Controller;

class AdminController
{
    public  function index(): void
    {
        require_once 'public/View/admin.php';
    }

    public function userAdmin(): bool
    {
        if (isset($_SESSION['user'])) {
            foreach ($_SESSION['user']->getRole() as $role) {
                if ($role === 'ROLE_ADMIN') {
                    return true;
                }
            }
        }
        return false;
    }
}