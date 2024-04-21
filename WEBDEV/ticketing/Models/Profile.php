<?php
    require_once('Model.php');

    class Profile extends Model {
        protected $table = "profiles";

        public function getAllProfiles() {
            return $this->all();
        }
    
        public function getProfileById($columnData) {
            return $this->findByColumn($columnData);
        }

        public function searchProfile($columnData) {
            return $this->searchAllByColumn($columnData, null);
        }
    
        public function createProfile($data) {
            return $this->create($data);
        }
    
        public function updateProfile($columnData, $data) {
            return $this->update($columnData, $data);
        }
    
        public function deleteProfile($columnData) {
            return $this->delete($columnData);
        }
    }

?>