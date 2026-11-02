<?php
require_once __DIR__ . '/BaseDao.php';

class NoteDao extends BaseDao {
    public function __construct() {
        parent::__construct('notes');
    }

    public function get_notes_by_user($user_id) {
        $sql = "SELECT n.*, c.title as course_title 
                FROM notes n 
                LEFT JOIN courses c ON n.course_id = c.id 
                WHERE n.user_id = :user_id 
                ORDER BY n.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}