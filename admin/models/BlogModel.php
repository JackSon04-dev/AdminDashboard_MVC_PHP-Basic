<?php
// admin/models/BlogModel.php
require_once 'config/database.php';

class BlogModel {
    private $db;

    public function __construct() {
        global $db;
        $this->db = $db->getConnection();
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM blogs ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search($keyword = '') {
        $sql = "SELECT * FROM blogs WHERE title LIKE ? OR content LIKE ? ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["%$keyword%", "%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM blogs WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO blogs (title, content, thumbnail) VALUES (?, ?, ?)");
        return $stmt->execute([$data['title'], $data['content'], $data['thumbnail']]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE blogs SET title = ?, content = ?, thumbnail = ? WHERE id = ?");
        return $stmt->execute([$data['title'], $data['content'], $data['thumbnail'], $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM blogs WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>