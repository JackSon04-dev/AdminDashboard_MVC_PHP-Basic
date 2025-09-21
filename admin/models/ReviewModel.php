<?php
// admin/models/ReviewModel.php
require_once 'config/database.php';

class ReviewModel {
    private $db;

    public function __construct() {
        global $db;
        $this->db = $db->getConnection();
    }

    public function getAll() {
        $stmt = $this->db->prepare("
            SELECT r.*, p.name as product_name, u.name as user_name
            FROM reviews r
            LEFT JOIN products p ON r.product_id = p.id
            LEFT JOIN users u ON r.user_id = u.id
            ORDER BY r.id DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search($keyword = '', $approved = '') {
        $sql = "
            SELECT r.*, p.name as product_name, u.name as user_name
            FROM reviews r
            LEFT JOIN products p ON r.product_id = p.id
            LEFT JOIN users u ON r.user_id = u.id
            WHERE 1=1
        ";
        $params = [];
        if ($keyword) {
            $sql .= " AND (p.name LIKE ? OR u.name LIKE ?)";
            $params = ["%$keyword%", "%$keyword%"];
        }
        if ($approved !== '') {
            $sql .= " AND r.is_approved = ?";
            $params[] = $approved;
        }
        $sql .= " ORDER BY r.id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function approve($id) {
        $stmt = $this->db->prepare("UPDATE reviews SET is_approved = 1 WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM reviews WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>