<?php
    require_once('Model.php');
    
    class Order extends Model {
        protected $table = "orders";

        public function getAllOrders() {
            return $this->all();
        }

        public function getNewOrders($limit, $tbl_id, $order) {
            return $this->selectLimitedAndOrdered($limit, $tbl_id, $order);
        }
    
        public function getOrderById($columnData) {
            return $this->findByColumn($columnData);
        }

        public function getOrderByColumn($columnData, $limit) {
            return $this->findAllByColumn($columnData, $limit);
        }

        public function searchOrder($columnData, $limit) {
            return $this->searchAllByColumn($columnData, $limit);
        }
    
        public function createOrder($data) {
            return $this->create($data);
        }
    
        public function updateOrder($columnData, $data) {
            return $this->update($columnData, $data);
        }
    
        public function deleteOrder($columnData) {
            return $this->delete($columnData);
        }
    }
?>