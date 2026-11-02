<?php
require_once __DIR__ . '/../config/config.php';

class BaseDao {
    protected $conn;
    protected $table;

    public function __construct($table) {
        $this->table = $table;
        try {
            $host = DB_HOST;
            $dbname = DB_NAME;
            $port = DB_PORT;
            $this->conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", DB_USER, DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Database Connection Error: " . $e->getMessage());
        }
    }

    public function get_all() {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function get_by_id($id) {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table . " WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function insert($entity) {
        $columns = implode(", ", array_keys($entity));
        $placeholders = ":" . implode(", :", array_keys($entity));
        
        $sql = "INSERT INTO " . $this->table . " ($columns) VALUES ($placeholders)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($entity);
        $entity['id'] = $this->conn->lastInsertId();
        return $entity;
    }

    public function update($id, $entity) {
        $fields = "";
        foreach ($entity as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ", ");

        $sql = "UPDATE " . $this->table . " SET $fields WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $entity['id'] = $id;
        $stmt->execute($entity);
        return $this->get_by_id($id);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table . " WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}