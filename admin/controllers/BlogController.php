<?php
// admin/controllers/BlogController.php
require_once 'models/BlogModel.php';

class BlogController {
    private $model;

    public function __construct() {
        $this->model = new BlogModel();
    }

    public function list() {
        $keyword = $_GET['keyword'] ?? '';
        $blogs = $this->model->search($keyword);
        include 'views/blogs/list.php';
    }

    public function add() {
        if ($_POST) {
            if ($this->model->create($_POST)) {
                header('Location: index.php?controller=blog&action=list');
                exit;
            }
        }
        include 'views/blogs/add.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        $blog = $this->model->getById($id);
        if ($_POST) {
            if ($this->model->update($id, $_POST)) {
                header('Location: index.php?controller=blog&action=list');
                exit;
            }
        }
        include 'views/blogs/edit.php';
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        $this->model->delete($id);
        header('Location: index.php?controller=blog&action=list');
        exit;
    }
}
?>