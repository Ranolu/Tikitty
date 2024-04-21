<?php
    require_once('Model.php');

    class Feedback extends Model {
        protected $table = "feedbacks";

        public function getAllFeedbacks() {
            return $this->all();
        }
    
        public function getFeedbackById($columnData) {
            return $this->findByColumn($columnData);
        }

        public function searchFeedback($columnData) {
            return $this->searchAllByColumn($columnData, null);
        }
    
        public function createFeedback($data) {
            return $this->create($data);
        }
    
        public function updateFeedback($columnData, $data) {
            return $this->update($columnData, $data);
        }
    
        public function deleteFeedback($columnData) {
            return $this->delete($columnData);
        }
    }

?>