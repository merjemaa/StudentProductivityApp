<?php
require_once __DIR__ . '/BaseDao.php';

class CourseDao extends BaseDao {
    public function __construct() {
        parent::__construct('courses');
    }

    public function get_by_user_id($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM courses WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}