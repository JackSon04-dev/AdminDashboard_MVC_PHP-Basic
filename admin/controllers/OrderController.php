<?php
// admin/controllers/OrderController.php
require_once 'models/OrderModel.php';

class OrderController {
    private $model;

    public function __construct() {
        $this->model = new OrderModel();
    }

    public function list() {
        $keyword = $_GET['keyword'] ?? '';
        $status = $_GET['status'] ?? '';
        $orders = $this->model->search($keyword, $status);
        include 'views/orders/list.php';
    }

    public function view() {
        $id = $_GET['id'] ?? null;
        $order = $this->model->getById($id);
        $items = $this->model->getItemsByOrder($id);
        include 'views/orders/view.php';
    }

    public function updateStatus() {
        $id = $_POST['id'] ?? null;
        $status = $_POST['status'] ?? '';
        if ($this->model->updateStatus($id, $status)) {
            header('Location: index.php?controller=order&action=list');
            exit;
        }
    }
}
?>