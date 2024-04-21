<?php
require_once('../Controllers/Connection.php');

class Tickets extends Connection {
    public function deleteTicketById($ticketId) {
        $query = "DELETE FROM tickets WHERE ticket_id = ?";
        $statement = $this->conn->prepare($query);
        $statement->bind_param('i', $ticketId);
        $success = $statement->execute();
        $statement->close();
        return $success;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ticket_id"])) {
    $ticketId = $_POST["ticket_id"];
    
    $tickets = new Tickets();
    
    $success = $tickets->deleteTicketById($ticketId);
    
    header('Content-Type: application/json');
    echo json_encode(['success' => $success]);
}
?>