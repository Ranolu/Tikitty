<?php
    require_once('Connection.php');
    require_once('./Models/Profile.php');

    class ProfileController extends Connection {

        public function makeprofile() {
            if(empty($_POST['affiliation'])) {
                $affiliation = NULL;
            } else {
                $affiliation = $_POST['affiliation'];
            }

            $data = [
                'name' => $_POST['name'],
                'birthdate' => $_POST['birthdate'],
                'email' => $_POST['email'],
                'contact_num' => '+63'.$_POST['contact_num'],
                'affiliation' => $affiliation
                
            ];

            $profile = new Profile($this->conn);
            if($profile->createProfile($data)){
                return true;
            } else { return false; }
        }

        public function getAllProfiles() {
            $profile = new Profile($this->conn);
            return $profile->getAllProfiles();
        }

        public function searchProfiles($columnData) {
            $searchTerm = "%" . $columnData . "%";
            $sql = "SELECT profiles.*, users.username
            FROM profiles
            LEFT JOIN users ON profiles.profile_id = users.profile_id
            WHERE profiles.name LIKE ? OR users.username LIKE ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ss", $searchTerm, $searchTerm);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $stmt->close();
            return $data;
        }

        public function profileView($columnData){
            $profile = new Profile($this->conn);
            return $profile->getProfileById($columnData);
        }

        public function updateProfile($columnData) {
            if(empty($_POST['affiliation'])) {
                $affiliation = NULL;
            } else {
                $affiliation = $_POST['affiliation'];
            }

            $data = [
                'name' => $_POST['name'],
                'birthdate' => $_POST['birthdate'],
                'email' => $_POST['email'],
                'contact_num' => '+63'.$_POST['contact_num'],
                'affiliation' => $affiliation
            ];

            $profile = new Profile($this->conn);
            $result = $profile->updateProfile($columnData, $data);

            if($result) {
                return true;
            } else { return false; }
        }

        public function deleteProfile($columnData) {
            $profile = new Profile($this->conn);
            return $profile->deleteProfile($columnData);
        }

    }
?>