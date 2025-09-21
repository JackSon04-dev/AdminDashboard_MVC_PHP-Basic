<?php
// admin/models/OrderModel.php
require_once 'config/database.php';

class OrderModel {
    private $db;

    public function __construct() {
        global $db;
        $this->db = $db->getConnection();
    }

    public function getAll() {
        $stmt = $this->db->prepare("
            SELECT o.*, u.name as user_name
            FROM orders o
            LEFT JOIN users u ON o.user_id = u.id
            ORDER BY o.id DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search($keyword = '', $status = '') {
        $sql = "
            SELECT o.*, u.name as user_name
            FROM orders o
            LEFT JOIN users u ON o.user_id = u.id
            WHERE 1=1
        ";
        $params = [];
        if ($keyword) {
            $sql .= " AND (o.id LIKE ? OR u.name LIKE ?)";
            $params = ["%$keyword%", "%$keyword%"];
        }
        if ($status) {
            $sql .= " AND o.status = ?";
            $params[] = $status;
        }
        $sql .= " ORDER BY o.id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getItemsByOrder($orderId) {
        $stmt = $this->db->prepare("
            SELECT oi.*, p.name as product_name
            FROM order_items oi
            JOIN products p ON oi.product_id = p.id
            WHERE oi.order_id = ?
        ");
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE orders SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }
}
?>