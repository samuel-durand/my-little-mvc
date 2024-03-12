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
            echo json_encode(['error' => 'Aucun user trouvé']);
        } else {
            echo json_encode($products);
        }
    }


    public function showUserroute(): void
    {
        if ($this->isAdmin() === false) {
            header('Location: /my-little-mvc/shop');
        }

        $adminModel = new AdminModel();
        $user = $adminModel->getUser();
        if (empty($user)) {
            echo json_encode(['error' => 'Aucun user trouvé']);
        } else {
            echo json_encode($user);
        }
    }


    public function showUserById($id): void
    {
        if ($this->isAdmin() === false) {
            header('Location: /my-little-mvc/shop');
        }

        $adminModel = new AdminModel();
        $products = $adminModel->getUserById($id);
        if (empty($products)) {
            echo json_encode(['error' => 'Aucun user trouvé']);
        } else {
            echo json_encode($products);
        }
    }

    public function deleteUserS(int $id): void
    {
        if ($this->isAdmin() === false) {
            header('Location: /my-little-mvc/shop');
        }

        $adminModel = new AdminModel();

        if($adminModel->deleteUser($id)){
            echo json_encode(['success' => 'User supprimé']);
        } else {
            echo json_encode(['error' => 'User non supprimé']);
        }
    }

    public function updateUser(int $id ): void
    {
        if (!$this->isAdmin()) {
            echo json_encode(['error' => 'Vous n\'avez pas les droits']);
        }
        $adminModel = new AdminModel();
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];


        if (empty($adminModel->getUserById($id))) {
            echo json_encode(['error' => 'L\'user n\'existe pas']);
        } else {
            if ($adminModel->editUser($id, $fullname, $email,)) {
                echo json_encode(['success' => 'L\'user a bien été modifié']);
            } else {
                echo json_encode(['error' => 'L\'user n\'a pas pu être modifié']);
            }
        }
    }
}
