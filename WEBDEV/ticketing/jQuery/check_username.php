<?php
    require_once('../Controllers/Connection.php');
    class Profiles extends Connection {
        public function checkUsernameExists($username) {
            $stmt = $this->conn->prepare('SELECT * FROM users WHERE username = ?');
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();
            return ($result->num_rows > 0);
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"])) {
        $username = $_POST["username"];
        $usernameCheck = new Profiles();
        $isUsernameExists = $usernameCheck->checkUsernameExists($username); 

        echo json_encode($isUsernameExists);
    }
?>