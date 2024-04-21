<?php
require_once('../Controllers/Connection.php');

class Tickets extends Connection {
    // Method to get ticket quantity by ticket ID
    public function getTicketQuantityById($ticketId) {
        $query = "SELECT quantity FROM tickets WHERE ticket_id = ?";
        $statement = $this->conn->prepare($query);
        $statement->bind_param('i', $ticketId);
        $statement->execute();
        $result = $statement->get_result();
        
        $row = $result->fetch_assoc();
        return $row['quantity'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["ticket_id"])) {
    $ticket_id = $_GET["ticket_id"];
    
    $tickets = new Tickets();
    
    $maxQuantity = $tickets->getTicketQuantityById($ticket_id);
    
    header('Content-Type: application/json');
    echo $maxQuantity;
}
?>