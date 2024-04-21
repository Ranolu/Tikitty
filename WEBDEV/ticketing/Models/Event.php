<?php
    require_once('Model.php');
    
    class Event extends Model {
        protected $table = "events";

        public function getAllEvents() {
            return $this->all();
        }

        public function getOldEvents($columnData, $limit, $tbl_id, $order) {
            return $this->selectWHERELimitedAndOrdered($columnData, $limit, $tbl_id, $order);
        }
    
        public function getEventById($columnData) {
            return $this->findByColumn($columnData);
        }

        public function getEventByColumn($columnData, $limit) {
            return $this->findAllByColumn($columnData, $limit);
        }

        public function searchEvent($columnData, $limit) {
            return $this->searchAllByColumn($columnData, $limit);
        }
    
        public function createEvent($data) {
            return $this->create($data);
        }
    
        public function updateEvent($columnData, $data) {
            return $this->update($columnData, $data);
        }
    
        public function deleteEvent($columnData) {
            return $this->delete($columnData);
        }
    }
?>