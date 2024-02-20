<?php

namespace App\Controller;

use App\Model\AdminModel;

class AdminController
{
    public function index(): void
    {
        require_once 'public/View/admin.php';
    }

    public function isAdmin(): bool
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

    public function showProducts(): void
    {
            $adminModel = new AdminModel();
            $products = $adminModel->getProducts();
        var_dump($products);
    }
}
