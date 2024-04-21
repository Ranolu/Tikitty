<?php
require_once('../Controllers/Connection.php');

class Tickets extends Connection
{
    public function getTicketData($ticketId)
    {
        $stmt = $this->conn->prepare('SELECT * FROM tickets WHERE ticket_id = ?');
        $stmt->bind_param('i', $ticketId); 
        $stmt->execute();
        $result = $stmt->get_result();
        
        $ticketData = $result->fetch_assoc();
        
        return $ticketData;
    }
    
    public function calculateTotalPrice($ticketId, $quantity)
    {
        $ticketData = $this->getTicketData($ticketId);
        
        $ticketPrice = $ticketData['price'];
        
        return $ticketPrice * $quantity;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["ticket_id"]) && isset($_GET["quantity"]) && !empty($_GET["quantity"])) {
    $ticketId = $_GET["ticket_id"];
    $quantity = $_GET["quantity"];

    $ticketCalculator = new Tickets();
    $totalPrice = $ticketCalculator->calculateTotalPrice($ticketId, $quantity);

    echo $totalPrice;
}
?>