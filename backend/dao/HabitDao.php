<?php
require_once __DIR__ . '/BaseDao.php';

class HabitDao extends BaseDao {
    public function __construct() {
        parent::__construct('habits');
    }

    public function get_habits_by_user($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM habits WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}