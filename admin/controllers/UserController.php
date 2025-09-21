<?php
// admin/controllers/UserController.php
require_once 'models/UserModel.php';

class UserController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function list() {
        $keyword = $_GET['keyword'] ?? '';
        $role = $_GET['role'] ?? '';
        $users = $this->model->search($keyword, $role);
        include 'views/users/list.php';
    }

    public function add() {
        if ($_POST) {
            if ($this->model->create($_POST)) {
                header('Location: index.php?controller=user&action=list');
                exit;
            }
        }
        include 'views/users/add.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        $user = $this->model->getById($id);
        if ($_POST) {
            if ($this->model->update($id, $_POST)) {
                header('Location: index.php?controller=user&action=list');
                exit;
            }
        }
        include 'views/users/edit.php';
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        $this->model->delete($id);
        header('Location: index.php?controller=user&action=list');
        exit;
    }
}
?>