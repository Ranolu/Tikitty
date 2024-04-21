<?php
require_once('../Controllers/Connection.php');

class Tickets extends Connection {
    public function updateTicket($ticketId, $updatedData) {
        $query = "UPDATE tickets SET type = ?, price = ?, quantity = ? WHERE ticket_id = ?";
        $statement = $this->conn->prepare($query);
        $statement->bind_param('sddi', $updatedData['type'], $updatedData['price'], $updatedData['quantity'], $ticketId);
        
        if ($statement->execute()) {
            return true; 
        } else {
            return false; 
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ticket_id"]) && isset($_POST["updated_data"])) {
    $ticketId = $_POST["ticket_id"];
    $updatedData = $_POST["updated_data"]; 
    
    $tickets = new Tickets();

    if ($tickets->updateTicket($ticketId, $updatedData)) {
        echo json_encode(["success" => true, "message" => "Ticket updated successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update ticket"]);
    }
}
?>
