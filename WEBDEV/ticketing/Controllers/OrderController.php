<?php
    require_once('Connection.php');
    require_once('./Models/Order.php');
    require_once('TicketController.php');

    class OrderController extends Connection {
        public function makeOrder(){
            $data = [
                'user_id' => $_SESSION['user_id'],
                'event_id' => $_POST['event_id'],
                'ticket_id' => $_POST['ticket_id'],
                'buy_quant' => $_POST['buy_quant'],
                'total_price' => $_POST['total_price']
            ];

            $ticketController = new TicketController();
            $result = $ticketController->buyTicket(['ticket_id' => $_POST['ticket_id']], $_POST['buy_quant']);
            if($result) {
                $order = new Order($this->conn);
                $result1 = $order->createOrder($data);
                if($result1) {
                    return true;
                } else { return false; }
            } else {
                return false;
            }
        }

        public function getOrderById($columnData) {
            $order = new Order($this->conn);
            return $order->getOrderByColumn($columnData, null);
        }

        public function orderList() {
            $order = new Order($this->conn);
            return $order->getAllOrders();
        }
    }

?>