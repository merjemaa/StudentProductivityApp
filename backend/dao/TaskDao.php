<?php
require_once __DIR__ . '/BaseDao.php';

class TaskDao extends BaseDao {
    public function __construct() {
        parent::__construct('tasks');
    }

    public function get_tasks_by_user($user_id) {
        $sql = "SELECT t.*, c.title as course_title, c.code as course_code 
                FROM tasks t 
                LEFT JOIN courses c ON t.course_id = c.id 
                WHERE t.user_id = :user_id 
                ORDER BY t.due_date ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}