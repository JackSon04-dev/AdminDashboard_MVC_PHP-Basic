<?php
// admin/models/CategoryModel.php
require_once 'config/database.php';

class CategoryModel {
    private $db;

    public function __construct() {
        global $db;
        $this->db = $db->getConnection();
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM categories ORDER BY id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>