<?php
session_start();
require_once('../Controllers/Connection.php');

class Feedback extends Connection {
    public function fetchFeedbacksWithUsername($offset, $limit) {
        $user_id = $_SESSION['user_id'];

        $query = "
            SELECT f.*, u.username
            FROM feedbacks f
            INNER JOIN users u ON f.user_id = u.user_id
            WHERE f.user_id != '$user_id'
            ORDER BY feedback_id DESC
            LIMIT $offset, $limit
        ";
        $result = $this->conn->query($query);
        $feedbacksWithUsername = array();
        while ($row = $result->fetch_assoc()) {
            $feedbacksWithUsername[] = $row;
        }
        return $feedbacksWithUsername;
    }
}

$offset = $_POST['offset'];
$limit = $_POST['limit'];

$feedbackInstance = new Feedback();
$feedbacksWithUsername = $feedbackInstance->fetchFeedbacksWithUsername($offset, $limit);
echo json_encode($feedbacksWithUsername);
?>