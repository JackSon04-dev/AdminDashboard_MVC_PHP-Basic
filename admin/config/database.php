<?php
// admin/config/database.php
class Database {
    private $host = 'localhost';
    private $dbname = 'foodmart_full_v1'; // Sử dụng DB từ script
    private $username = 'root'; // Thay bằng user của bạn
    private $password = ''; // Thay bằng pass của bạn
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->username,
                $this->password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}

$db = new Database();
?>