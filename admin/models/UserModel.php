<?php
// admin/models/UserModel.php
require_once 'config/database.php';

class UserModel {
    private $db;

    public function __construct() {
        global $db;
        $this->db = $db->getConnection();
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM users ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search($keyword = '', $role = '') {
        $sql = "SELECT * FROM users WHERE 1=1";
        $params = [];
        if ($keyword) {
            $sql .= " AND (name LIKE ? OR email LIKE ?)";
            $params = ["%$keyword%", "%$keyword%"];
        }
        if ($role) {
            $sql .= " AND role = ?";
            $params[] = $role;
        }
        $sql .= " ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, role, phone, address, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $stmt->execute([$data['name'], $data['email'], $data['password'], $data['role'], $data['phone'], $data['address'], $data['status']]);
    }

    public function update($id, $data) {
        $sql = "UPDATE users SET name = ?, email = ?, role = ?, phone = ?, address = ?, status = ? WHERE id = ?";
        $params = [$data['name'], $data['email'], $data['role'], $data['phone'], $data['address'], $data['status'], $id];
        if (!empty($data['password'])) {
            $sql = "UPDATE users SET name = ?, email = ?, password = ?, role = ?, phone = ?, address = ?, status = ? WHERE id = ?";
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $params = [$data['name'], $data['email'], $data['password'], $data['role'], $data['phone'], $data['address'], $data['status'], $id];
        }
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function authenticate($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? AND status = 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
?>