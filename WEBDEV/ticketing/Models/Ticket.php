<?php
    require_once('Model.php');
    
    class Ticket extends Model {
        protected $table = "tickets";

        public function getAlltickets() {
            return $this->all();
        }
    
        public function getTicketsById($columnData) {
            return $this->findAllByColumn($columnData);
        }

        public function getTicketById($columnData) {
            return $this->findByColumn($columnData);
        }
    
        public function createTicket($data) {
            return $this->create($data);
        }
    
        public function updateTicket($columnData, $data) {
            return $this->update($columnData, $data);
        }
    
        public function deleteTicket($columnData) {
            return $this->delete($columnData);
        }
    }
?>