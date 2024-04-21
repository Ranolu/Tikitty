<?php
    require_once('Connection.php');
    require_once('./Models/Feedback.php');

    class FeedbackController extends Connection {
        public function makeFeedback() {
            if(!isset($_SESSION['user_id'])) {
                $user_id = null;
            } else {
                $user_id = $_SESSION['user_id'];
            }

            $data = [
                'user_id' => $user_id,
                'rate' => $_POST['rating'],
                'feedback' => $_POST['feedback'],
            ];
            
            $feedback = new Feedback($this->conn);
            $result = $feedback->createFeedback($data);
            if($result) {
                return true;
            } else { return false; }
        }

        public function getAllFeedback() {
            $feedback = new Feedback($this->conn);
            return $feedback->getAllFeedbacks();
        }

        public function getFeedbackById($columnData) {
            $feedback = new Feedback($this->conn);
            return $feedback->getFeedbackById($columnData);
        }

        public function updateFeedback($columnData) {
            $data = [
                'rate' => $_POST['rating'],
                'feedback' => $_POST['feedback'],
            ];

            $feedback = new Feedback($this->conn);
            $result = $feedback->updateFeedback($columnData, $data);
            if($result) {
                return true;
            } else { return false; }
        }

        public function deleteFeedback($columnData) {
            $feedback = new Feedback($this->conn);
            $result = $feedback->deleteFeedback($columnData);
            if($result) {
                return true;
            } else { return false; }
        }
    }
?>