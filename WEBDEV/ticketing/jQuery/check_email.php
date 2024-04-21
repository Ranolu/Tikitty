<?php
    require_once('../Controllers/Connection.php');
    class Users extends Connection {
        public function checkEmailExists($email) {
            $stmt = $this->conn->prepare('SELECT * FROM profiles WHERE email = ?');
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            return ($result->num_rows > 0);
        }
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
        $email = $_POST["email"];
        $emailCheck = new Users();
        $isEmailExists = $emailCheck->checkEmailExists($email);

        echo json_encode($isEmailExists);
    }
?>