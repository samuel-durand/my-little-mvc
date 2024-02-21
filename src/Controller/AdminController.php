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
        if ($this->isAdmin() === false) {
            header('Location: /my-little-mvc/shop');
        }

        $adminModel = new AdminModel();
        $products = $adminModel->getProducts();
        if (empty($products)) {
            echo json_encode(['error' => 'Aucun produit trouvé']);
        } else {
            echo json_encode($products);
        }
    }

    public function deleteProduct(int $id): void
    {
        if (!$this->isAdmin()) {
            echo json_encode(['error' => 'Vous n\'avez pas les droits']);
        }
        $adminModel = new AdminModel();
        if (empty($adminModel->getOneById($id))) {
            echo json_encode(['error' => 'Le produit n\'existe pas']);
        } else {
            if ($adminModel->deleteProduct($id)) {
                echo json_encode(['success' => 'Le produit a bien été supprimé']);
            } else {
                echo json_encode(['error' => 'Le produit n\'a pas pu être supprimé']);

            }
        }
    }

    public function updateProduct(int $id): void
    {
        if (!$this->isAdmin()) {
            echo json_encode(['error' => 'Vous n\'avez pas les droits']);
        }
        $adminModel = new AdminModel();
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        if (empty($adminModel->getOneById($id))) {
            echo json_encode(['error' => 'Le produit n\'existe pas']);
        } else {
            if ($adminModel->updateProduct($id, $name, $description, $price, $quantity)) {
                echo json_encode(['success' => 'Le produit a bien été modifié']);
            } else {
                echo json_encode(['error' => 'Le produit n\'a pas pu être modifié']);
            }
        }
    }

    public function showUser(): void
    {
        if ($this->isAdmin() === false) {
            header('Location: /my-little-mvc/shop');
        }

        $adminModel = new AdminModel();
        $products = $adminModel->getUser();
        if (empty($products)) {
            echo json_encode(['error' => 'Aucun produit trouvé']);
        } else {
            echo json_encode($products);
        }
    }
}
