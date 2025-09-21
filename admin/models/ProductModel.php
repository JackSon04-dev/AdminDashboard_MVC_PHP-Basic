<?php
// admin/models/ProductModel.php
require_once 'config/database.php';

class ProductModel {
    private $db;

    public function __construct() {
        global $db;
        $this->db = $db->getConnection();
    }

    public function getAll() {
        $stmt = $this->db->prepare("
            SELECT p.*, c.name as category_name 
            FROM products p 
            JOIN categories c ON p.category_id = c.id 
            ORDER BY p.id DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search($keyword = '', $category = '') {
        $sql = "
            SELECT p.*, c.name as category_name 
            FROM products p 
            JOIN categories c ON p.category_id = c.id 
            WHERE 1=1
        ";
        $params = [];
        if ($keyword) {
            $sql .= " AND p.name LIKE ?";
            $params[] = "%$keyword%";
        }
        if ($category) {
            $sql .= " AND p.category_id = ?";
            $params[] = $category;
        }
        $sql .= " ORDER BY p.id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO products (category_id, name, description, short_desc, unit, price, sale_price, image, gallery, stock, is_featured, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$data['category_id'], $data['name'], $data['description'], $data['short_desc'], $data['unit'], $data['price'], $data['sale_price'], $data['image'], $data['gallery'], $data['stock'], $data['is_featured'], $data['status']]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE products SET category_id = ?, name = ?, description = ?, short_desc = ?, unit = ?, price = ?, sale_price = ?, image = ?, gallery = ?, stock = ?, is_featured = ?, status = ? WHERE id = ?");
        return $stmt->execute([$data['category_id'], $data['name'], $data['description'], $data['short_desc'], $data['unit'], $data['price'], $data['sale_price'], $data['image'], $data['gallery'], $data['stock'], $data['is_featured'], $data['status'], $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getTopSelling($limit = 5) {
    $limit = (int)$limit; // ép kiểu số nguyên để tránh SQL Injection
    $stmt = $this->db->prepare("
        SELECT p.id, p.name, c.name as category_name, SUM(oi.quantity) as total_sold
        FROM products p
        JOIN categories c ON p.category_id = c.id
        LEFT JOIN order_items oi ON p.id = oi.product_id
        GROUP BY p.id, p.name, c.name
        ORDER BY total_sold DESC
        LIMIT $limit
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

    public function getRevenueByMonth() {
        $stmt = $this->db->prepare("
            SELECT YEAR(created_at) as year, MONTH(created_at) as month, SUM(total_price) as revenue
            FROM orders
            WHERE status = 'thanh_cong'
            GROUP BY year, month
            ORDER BY year DESC, month DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRevenueByYear() {
        $stmt = $this->db->prepare("
            SELECT YEAR(created_at) as year, SUM(total_price) as revenue
            FROM orders
            WHERE status = 'thanh_cong'
            GROUP BY year
            ORDER BY year DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>