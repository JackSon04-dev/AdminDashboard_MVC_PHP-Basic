<?php
// admin/controllers/HomeController.php
require_once 'models/ProductModel.php';
require_once 'models/OrderModel.php';

class HomeController {
    public function index() {
        $productModel = new ProductModel();
        $orderModel = new OrderModel();

        $topSelling = $productModel->getTopSelling(5);
        $revenueMonth = $productModel->getRevenueByMonth();
        $revenueYear = $productModel->getRevenueByYear();

        include 'views/home/index.php';
    }
}
?>