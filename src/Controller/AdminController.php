<?php

namespace App\Controller;

class AdminController
{
    public  function index(): void
    {
        require_once 'public/View/admin/index.php';
    }

    public function userAdmin(): bool
    {
        if ($_SESSION['role'] === 'ROLE_ADMIN') {
            return true;
        } else {
            return false;
        }
    }
}