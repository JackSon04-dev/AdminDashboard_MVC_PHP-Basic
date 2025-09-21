<?php
// admin/controllers/ProductController.php
require_once 'models/ProductModel.php';
require_once 'models/CategoryModel.php';

class ProductController {
    private $productModel;
    private $categoryModel;

    public function __construct() {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }

    public function list() {
        $keyword = $_GET['keyword'] ?? '';
        $category = $_GET['category'] ?? '';
        $products = $this->productModel->search($keyword, $category);
        $categories = $this->categoryModel->getAll();
        include 'views/products/list.php';
    }

    public function add() {
        $categories = $this->categoryModel->getAll();
        if ($_POST) {
            if ($this->productModel->create($_POST)) {
                header('Location: index.php?controller=product&action=list');
                exit;
            }
        }
        include 'views/products/add.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        $product = $this->productModel->getById($id);
        $categories = $this->categoryModel->getAll();
        if ($_POST) {
            if ($this->productModel->update($id, $_POST)) {
                header('Location: index.php?controller=product&action=list');
                exit;
            }
        }
        include 'views/products/edit.php';
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        $this->productModel->delete($id);
        header('Location: index.php?controller=product&action=list');
        exit;
    }
}
?>