<?php
/**
 * =============================================
 * FoodMart Admin Panel - Pure PHP MVC
 * =============================================
 * 
 * Cấu trúc dự án:
 * - admin/config/database.php: Kết nối database
 * - admin/models/: Các model (UserModel, ProductModel, OrderModel, ReviewModel, BlogModel)
 * - admin/controllers/: Các controller (HomeController, UserController, ProductController, OrderController, ReviewController, BlogController)
 * - admin/views/: Các view (layout, home, users/list, users/add, etc.)
 * - admin/public/: Assets (CSS, JS, images)
 * - admin/index.php: Router chính
 * 
 * Chức năng:
 * - Trang Chủ: Dashboard với thống kê (doanh thu, bán chạy) và link điều hướng
 * - QL User: List, search, filter by role, add, edit, delete
 * - QL Sản Phẩm: List, search by name/category, filter by category/status, add, edit, delete
 * - QL Đơn Hàng: List, search by ID/user, filter by status, view details, update status
 * - QL Đánh Giá: List, search by product/user, filter by approved, approve/delete
 * - QL Bài Đăng: List, search by title, add, edit, delete
 * - Thống kê: Bán chạy (top products), Doanh thu theo tháng/năm (chart JS)
 * 
 * Giao diện: Bootstrap 5 + Tailwind CSS for responsive, beautiful UI
 * - Sidebar navigation
 * - DataTables for list with search/filter/pagination
 * - Chart.js for stats
 * - SweetAlert2 for confirm delete
 * - Form validation JS
 * 
 * Login: Simple session-based (admin only, password hashed)
 * 
 * Luồng hoạt động:
 * 1. admin/index.php: Router - Parse URL ?controller=products&action=list&id=1
 * 2. Controller: Load model, process action (list/add/edit/delete), load view
 * 3. Model: CRUD database with PDO, prepared statements for security
 * 4. View: Render HTML with data from controller, use partials (header, sidebar, footer)
 * 
 * Run: http://localhost/admin/index.php?controller=home (after login)
 * Login: Email admin@demo.com / Password: 123456 (hashed in code)
 * 
 * =============================================
 */

// admin/index.php - Router chính
session_start();

// Kiểm tra login
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    if (isset($_GET['action']) && $_GET['action'] == 'login') {
        // Proceed to login
    } else {
        header('Location: index.php?controller=auth&action=login');
        exit;
    }
}

require_once 'config/database.php';
require_once 'models/UserModel.php';
require_once 'models/ProductModel.php';
require_once 'models/OrderModel.php';
require_once 'models/ReviewModel.php';
require_once 'models/BlogModel.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/OrderController.php';
require_once 'controllers/ReviewController.php';
require_once 'controllers/BlogController.php';
require_once 'controllers/AuthController.php';

$controllerName = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

$controllerName = ucfirst($controllerName) . 'Controller';

if (class_exists($controllerName)) {
    $controller = new $controllerName();
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "Action not found";
    }
} else {
    echo "Controller not found";
}
?>