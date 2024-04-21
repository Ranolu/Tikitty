<?php
    require_once('../Controllers/Connection.php');
    class Events extends Connection {
        public function checkTitleExists($title) {
            $stmt = $this->conn->prepare('SELECT * FROM events WHERE title = ?');
            $stmt->bind_param('s', $title);
            $stmt->execute();
            $result = $stmt->get_result();
            return ($result->num_rows > 0);
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["title"])) {
        $title = $_POST["title"];
        $titleCheck = new Events();
        $istitleExists = $titleCheck->checkTitleExists($title); 

        echo json_encode($istitleExists);
    }


?>