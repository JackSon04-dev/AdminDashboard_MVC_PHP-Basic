<?php
// admin/controllers/AuthController.php
require_once 'models/UserModel.php';

class AuthController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function login() {
        if ($_POST) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->model->authenticate($email, $password);
            if ($user && $user['role'] == 'admin') {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                header('Location: index.php?controller=home');
                exit;
            } else {
                $error = 'Invalid credentials or not admin';               
            }
        }
        include 'views/auth/login.php';
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?controller=auth&action=login');
        exit;
    }
}
?>