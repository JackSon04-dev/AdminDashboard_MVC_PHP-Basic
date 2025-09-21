<?php
// admin/controllers/ReviewController.php
require_once 'models/ReviewModel.php';

class ReviewController {
    private $model;

    public function __construct() {
        $this->model = new ReviewModel();
    }

    public function list() {
        $keyword = $_GET['keyword'] ?? '';
        $approved = $_GET['approved'] ?? '';
        $reviews = $this->model->search($keyword, $approved);
        include 'views/reviews/list.php';
    }

    public function approve() {
        $id = $_GET['id'] ?? null;
        $this->model->approve($id);
        header('Location: index.php?controller=review&action=list');
        exit;
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        $this->model->delete($id);
        header('Location: index.php?controller=review&action=list');
        exit;
    }
}
?>