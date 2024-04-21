<?php
    require_once('Model.php');

    class User extends Model {
        protected $table = "users";

        public function getAllUsers() {
            return $this->all();
        }
    
        public function getUserById($columnData) {
            return $this->findByColumn($columnData);
        }

        public function searchUser($columnData) {
            return $this->searchAllByColumn($columnData, null);
        }
    
        public function createUser($data) {
            return $this->create($data);
        }
    
        public function updateUser($columnData, $data) {
            return $this->update($columnData, $data);
        }
    
        public function deleteUser($columnData) {
            return $this->delete($columnData);
        }
    }
?>