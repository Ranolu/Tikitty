<?php
    class Connection {
        private $host = "localhost";
        private $username = "root";
        private $dbpass = "";
        private $db = "tikitty";
        public $conn;
    
        public function __construct() {
            try {
                $this->conn = new mysqli($this->host, $this->username, $this->dbpass, $this->db);
                if ($this->conn->connect_error) {
                    throw new Exception("Connection failed: " . $this->conn->connect_error);
                }
            } catch(Exception $e) {
                die($e->getMessage());
            }
        }
    }    
?>