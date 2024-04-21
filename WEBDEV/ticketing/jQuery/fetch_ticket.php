<?php
require_once('../Controllers/Connection.php');

class Tickets extends Connection {
    public function getTicketsByEventId($eventId) {
        $query = "SELECT * FROM tickets WHERE event_id = ?";
        $statement = $this->conn->prepare($query);
        $statement->bind_param('i', $eventId);
        $statement->execute();
        $result = $statement->get_result();
        
        $tickets = [];
        while ($row = $result->fetch_assoc()) {
            $tickets[] = $row;
        }
        
        return $tickets;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["event_id"])) {
    $event_id = $_POST["event_id"];
    
    $tickets = new Tickets();
    
    $ticketsData = $tickets->getTicketsByEventId($event_id);
    
    header('Content-Type: application/json');
    echo json_encode($ticketsData);
}
?>