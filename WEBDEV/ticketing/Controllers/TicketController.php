<?php
    require_once('Connection.php');
    require_once('./Models/Ticket.php');

    class TicketController extends Connection {
        public function getAllTickets() {
            $ticket = new Ticket($this->conn);
            return $ticket->getAllTickets();
        }
        public function makeTicket($columnData) {
            $success = null;
            foreach ($_POST['ticket_type'] as $index => $type) {
                $data = [
                    'type' => $_POST['ticket_type'][$index],
                    'price' => $_POST['ticket_price'][$index],
                    'quantity' => $_POST['ticket_quant'][$index],
                    'event_id' => $columnData
                ];
                
                $ticket = new Ticket($this->conn);
                $inserted = $ticket->createTicket($data);
                if (!$inserted) {
                    $success = false; 
                    break; 
                } else { $success = true; }
            }
            if ($success) {
                return true;
            } else { return false; }
        }

        public function ticketList($columnData) {
            $ticketData = [];
            $ticket = new Ticket($this->conn);
            
            if (isset($columnData[0]) && is_array($columnData[0])) {
                foreach($columnData as $event) {
                    if(is_array($event) && isset($event['event_id'])) {
                        $tickets = $ticket->getTicketsById(['event_id' => $event['event_id']]);
                        if(is_array($tickets)) {
                            $ticketData = array_merge($ticketData, $tickets);
                        }
                    }
                }
            } else {
                if(isset($columnData['event_id'])) {
                    $tickets = $ticket->getTicketsById(['event_id' => $columnData['event_id']]);
                    if(is_array($tickets)) {
                        $ticketData = $tickets;
                    }
                }
            }
    
            if(!empty($ticketData)) {
                return $ticketData;
            } else {
                return false;
            }
        }

        public function buyTicket($columnData, $buy_quant) {
            $ticket = new Ticket($this->conn);
            $oldDat = $ticket->getTicketById($columnData);
            $new_quantity = $oldDat['quantity'] - $buy_quant;
            $new_sold = $oldDat['sold'] + $buy_quant;

            $data = [
                'quantity' => $new_quantity,
                'sold' => $new_sold
            ];

            $result = $ticket->updateTicket($columnData, $data);
            if($result) {
                return true;
            } else { return false; }
        }

    }
?>