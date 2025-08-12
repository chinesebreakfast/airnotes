<?php
class Database {
    private $host = "MySQL-8.0"; // Специальное имя для OpenServer
    private $db_name = "airnotes";
    private $username = "root";
    private $password = "";
    public $conn;

    public function __construct(){
        $this->getConnection();
    }

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name}", 
                $this->username, 
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Убираем дублирование ключей
                ]
            );
            error_log("Database connection established successfully"); // Добавьте логирование
        } catch(PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
        return $this->conn;
    }
}