<?php
require_once __DIR__ . '/../config/Database.php';
class Post {
    private $db;
    private $table = 'posts';

    public function __construct() {
        try {
            $this->db = (new Database())->conn;
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    public function read() {
        try {
            // Явно указываем подключение к БД
            error_log("Подключение к БД: " . get_class($this->db));
        
            $query = "SELECT id, label, text FROM posts ORDER BY id DESC";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("DB Error: " . $e->getMessage());
            return false;
        }
    }

    public function create($label, $text, $userId) {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table} (label, text, user_id) VALUES (:label, :text, :user_id)"
            );
            $stmt->bindParam(':label', $label, PDO::PARAM_STR);
            $stmt->bindParam(':text', $text, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $this->db->lastInsertId();
        } catch(PDOException $e) {
            error_log("Error creating post: " . $e->getMessage());
            return false;
        }
    }

    public function delete($id) {
        try {
            $stmt = $this->db->prepare(
                "DELETE FROM {$this->table} WHERE id = :id"
            );
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch(PDOException $e) {
            error_log("Error deleting post: " . $e->getMessage());
            return false;
        }
    }

    public function update($id, $label, $text) {
        try {
            $stmt = $this->db->prepare(
                "UPDATE {$this->table} SET label = :label, text = :text WHERE id = :id"
            );
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':label', $label, PDO::PARAM_STR);
            $stmt->bindParam(':text', $text, PDO::PARAM_STR);
            return $stmt->execute();
        } catch(PDOException $e) {
            error_log("Error updating post: " . $e->getMessage());
            return false;
        }
    }
}