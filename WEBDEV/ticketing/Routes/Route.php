<?php
    session_start();

    require_once('./Controllers/ProfileController.php');
    require_once('./Controllers/UserController.php');
    require_once('./Controllers/EventController.php');
    require_once('./Controllers/TicketController.php');
    require_once('./Controllers/OrderController.php');
    require_once('./Controllers/FeedbackController.php');
    require('./script.php');

    $route = $_SERVER['REQUEST_URI'];
    $routeWithoutParams = strtok($route, '?');

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
        $userController = new UserController;
        $accverify = $userController->getUserById(['user_id' => $_SESSION['user_id']]);
        if(empty($accverify)) {
            $userController->logout();
            header('Location:./sessionExpired=true');
        } else {
            $accverify = [];
        }
    }

    if(isset($_GET['formSubmit']) && $_GET['formSubmit'] == 'true') {
        //send mail
        if(isset($_POST['contact-us'])) {
            $email = $_POST['email'];
            $message = "From: $email<br><br>" . nl2br($_POST['message']);
            $result = sendMail(USERNAME,$_POST['subject'],$message);
            if($result) {
                header('Location:./contact.php?sent=success');
            } else {
                header('Location:./contact.php?sent=false');
            }
        }
        //user sign up
        else if(isset($_POST['signUp-user'])){
            $profileController = new ProfileController();
            $result1 = $profileController->makeprofile();
            if($result1 == true){
                $data = $profileController->profileView(['email' => $_POST['email']]);
                $userController = new UserController();
                $result2 = $userController->makeuser($data['profile_id']);
                if($result2 == true){
                    header('Location: ./index.php?makeUser=success');
                }else{ header('Location: ./index.php?makeUser=false'); }
            }else{ header('Location: ./index.php?makeprofile=false'); }
        }
        //organizer sign up
        else if (isset($_POST['signUp-organizer'])) {
            $profileController = new ProfileController();
            $result1 = $profileController->makeprofile();
            if($result1 == true){
                $data = $profileController->profileView(['email' => $_POST['email']]);
                $userController = new UserController();
                $result2 = $userController->makeuser($data['profile_id']);
                if($result2 == true){
                    header('Location: ./index.php?makeOrganizer=success');
                }else{ header('Location: ./index.php?makeOrganizer=false'); }
            }else{ header('Location: ./index.php?makeprofile=false'); }
        }
        //login
        else if (isset($_POST['login'])) {
            $userController = new UserController();
            $result = $userController->login(['username' => $_POST['username']]);
            if ($result == 'success') {
                header('Location:./');
            } else if ($result == 'wrongpass') {
                header('Location:./index.php?loginSuccess=false');
            } else if ($result == 'noacc') {
                header('Location:./index.php?loginSuccess=false');
            }
        }
        //addEvent
        else if (isset($_POST['add-Event'])) {
            $eventController = new EventController();
            $result = $eventController->makeEvent();
            if ($result == true) {
                $data = $eventController->getEventById(['title' => $_POST['title']]);
                $ticketController = new TicketController();
                $result2 = $ticketController->makeTicket($data['event_id']);
                if($result2 == true){
                    header('Location:./organizerDashboard.php?addEvent=success');
                }else{ header('Location:./organizerDashboard.php?addEventTicket=false'); }
            } else { header('Location:./organizerDashboard.php?addEvent=false'); }
        }
        //updateEvent
        else if (isset($_POST['edit-Event'])) {
            $eventController = new EventController();
            $result = $eventController->updateEvent(['event_id' => $_POST['event_id']]);
            if(!empty(array_filter($_POST['ticket_type']))) {
                $ticketController = new TicketController();
                $result2 = $ticketController->makeTicket($_POST['event_id']);
                if($result == true && $result2 == true){
                    header('Location:./organizerDashboard.php?editEvent=success');
                }else{ header('Location:./organizerDashboard.php?editEvent=false'); }
            } else if ($result == true) {
                header('Location:./organizerDashboard.php?editEvent=success');
            } else { header('Location:./organizerDashboard.php?editEvent=false'); }
        }
        //approve or reject events
        else if (isset($_GET['eventApprove'])) {
            if($_SESSION['role'] != '1') {
                header('Location:./');
            }
            $eventController = new EventController();
            if($_GET['eventApprove'] == 'true') {
                $result = $eventController->approveEvent(['event_id' => $_GET['event_id']]);
                if ($result == true) {
                    header('Location:./adminDashboard.php?approval=success');
                } else { header('Location:./adminDashboard.php?approval=failed'); }
            } else if($_GET['eventApprove'] == 'false') {
                if(isset($_POST['rejectionLetter'])) {
                    $result = $eventController->rejectEvent(['event_id' => $_GET['event_id']]);
                    $message = "Your application for ".$_POST['event_name']." has been rejected for the following reasons: <br><br>".
                                nl2br($_POST['message'])."<br><br>You can edit your event and resubmit for approval.";
                    $result2 = sendMail($_POST['email'],$_POST['subject'],$message);
                    if ($result == true || $result2 == true) {
                        header('Location:./adminDashboard.php?rejection=success');
                    } else { header('Location:./adminDashboard.php?rejection=failed'); }
                } else { header('Location:./adminDashboard.php?rejection=failed'); }
            }
        }
        //user orders
        else if (isset($_POST['user-order'])) {
            $orderController = new OrderController();
            $result = $orderController->makeOrder();
            if ($result) {
                $subject = "Order Confirmation";
                $message = "Your order for ".$_POST['event_name']." has been confirmed.<br><br>
                            Order Details: <br>
                            Event Name: ".$_POST['event_name']."<br>
                            Ticket Type: ".$_POST['ticket_type']."<br>
                            Quantity: ".$_POST['buy_quant']."<br>
                            Total Price: ".$_POST['total_price']."<br><br>
                            You will recieve your ticket in a few days.";
                $result2 = sendMail($_POST['email'],$subject,$message);
                if ($result == true || $result2 == true) {
                    header('Location:./index.php?order=success');
                } else { header('Location:./index.php?order=failed'); }
            } else { header('Location:./index.php?order=failed'); }
        }
    }
    //logout
    if(isset($_GET['logout']) && $_GET['logout'] == true) {
        $userController = new UserController();
        $userController->logout();
    }
    //index
    if($route === '/WEBDEV/ticketing/' || strpos($routeWithoutParams, '/WEBDEV/ticketing/index.php') === 0) {
        if(isset($_SESSION['role'])) {
            if($_SESSION['role'] == '1') {
                header('Location:./adminDashboard.php');
            } else if ($_SESSION['role'] == '2') {
                header('Location:./organizerDashboard.php');
            }
        }

        $eventController = new EventController();
        $data = $eventController->eventList();
        $data2 = $eventController->getOldEvents(['status' => ['ended', 'sold_out']]);
    }
    //organizer Dashboard
    else if(strpos($routeWithoutParams, '/WEBDEV/ticketing/organizerDashboard.php') === 0) {
        if(!isset($_SESSION['role']) || $_SESSION['role'] != '2'){
            header('Location:./');
        }

        $eventController = new EventController();

        if(isset($_GET['deleteEvent']) && $_GET['deleteEvent'] == true) {
            $result = $eventController->deleteEvent(['event_id' => $_GET['event_id']]);
            if ($result == true) {
                header('Location:./organizerDashboard.php?delete=success');
            } else { header('Location:./organizerDashboard.php?delete=false'); }
        }
        
        $data = $eventController->getAllEventById(['user_id' => $_SESSION['user_id']]);
        $ticketController = new TicketController();
        $data2 = $ticketController->ticketList($data);
    }
    //admin dashboard
    else if(strpos($routeWithoutParams, '/WEBDEV/ticketing/adminDashboard.php') === 0) {
        if(!isset($_SESSION['role']) || $_SESSION['role'] != '1'){
            header('Location:./');
        }

        $eventController = new EventController();
        //delete event
        if(isset($_GET['deleteEvent']) && $_GET['deleteEvent'] == true) {
            $result = $eventController->deleteEvent(['event_id' => $_GET['event_id']]);
            if ($result == true) {
                header('Location:./adminDashboard.php?delete=success');
            } else { header('Location:./adminDashboard.php?delete=false'); }
        }
        
        $data = $eventController->eventList();
    }
    else if(strpos($routeWithoutParams, '/WEBDEV/ticketing/eventList.php') === 0) {
        $eventController = new EventController();
        if(isset($_GET['search']) && !empty($_GET['search'])) {
            $data = $eventController->searchEvents(['title' => $_GET['search']]);
        } else {
            $data = $eventController->eventList();
        }

    }
    // event view
    else if(strpos($routeWithoutParams, '/WEBDEV/ticketing/eventView.php') === 0) {
        if(isset($_GET['event_id']) && !empty($_GET['event_id'])) {
            $eventController = new EventController();
            $data = $eventController->getEventById(['event_id' => $_GET['event_id']]);
            if(empty($data)) {
                header('Location: ./');
            }
            if($data['approval'] == 'pending' && ($_SESSION['role'] == '3' || !isset($_SESSION['role']))) {
                header('Location: ./');
            }

            $ticketController = new TicketController();
            $data2 = $ticketController->ticketList($data);

            if($data['user_id'] == null) {
                $data4 = [
                    'name' => 'Organizer Deleted', 
                    'email' => USERNAME
                ];
            } else {
                $userController = new UserController();
                $data3 = $userController->getUserById(['user_id' => $data['user_id']]);

                $profileController = new ProfileController();
                $data4 = $profileController->profileView(['profile_id' => $data3['profile_id']]);
            }
            

        } else {
            header('Location: ./');
        }
    }
    // buy tickets
    else if(strpos($routeWithoutParams, '/WEBDEV/ticketing/checkout.php') === 0) {
        if(!isset($_SESSION['role']) && $_SESSION['role'] != '3'){
            header('Location:./');
        }

        $eventController = new EventController();
        $data = $eventController->getEventById(['event_id' => $_GET['event_id']]);
        if(empty($data)) {
            header('Location: ./');
        }
        if($data['approval'] == 'pending' && ($_SESSION['role'] == '3' || !isset($_SESSION['role']))) {
            header('Location: ./');
        }
        if($data['status'] == 'closed' || $data['status'] == 'sold_out') {
            header('Location: ./');
        }
        $ticketController = new TicketController();
        $data2 = $ticketController->ticketList($data);
        $userController = new UserController();
        $data3 = $userController->getUserById(['user_id' => $data['user_id']]);

        $profileController = new ProfileController();
        $data4 = $profileController->profileView(['profile_id' => $data3['profile_id']]);
        $data5 = $profileController->profileView(['profile_id' => $_SESSION['profile_id']]);
    }
    // add event
    else if($route === '/WEBDEV/ticketing/addEvent.php') {
        if(!isset($_SESSION['role']) || $_SESSION['role'] != '2'){
            header('Location:./');
        }
    }
    // edit event
    else if(strpos($routeWithoutParams, '/WEBDEV/ticketing/editEvent.php') === 0) {
        if(!isset($_SESSION['role']) || $_SESSION['role'] == '3'){
            header('Location:./');
        }
        if(isset($_GET['event_id']) && !empty($_GET['event_id'])) {
            $eventController = new EventController();
            $data = $eventController->getEventById(['event_id' => $_GET['event_id']]);
            if($data['approval'] == 'approved') {
                header('Location:./organizerDashboard.php');
            }
            if(!empty($data)) {
                $ticketController = new TicketController();
                $data2 = $ticketController->ticketList($data);
            } 
            else {
                header('Location:./organizerDashboard.php?eventNotFound=true');
            }
        }
        else {
            header('Location:./organizerDashboard.php?eventNotFound=true');
        }
    }
    // profile
    else if($route === '/WEBDEV/ticketing/profile.php' || strpos($routeWithoutParams, '/WEBDEV/ticketing/profile.php') === 0) {
        if(!isset($_SESSION['loggedIn']) ){
            header('Location:./');
        }

        if(isset($_GET['updateUser']) && $_GET['updateUser'] == true) {
            $userController = new UserController();
            $result = $result = $userController->updateUsers(['user_id' => $_SESSION['user_id']]);
            if($result) {
                $profileController = new ProfileController();
                $result2 = $profileController->updateProfile(['profile_id' => $_SESSION['profile_id']]);
                if($result2) {
                    header('Location:./profile.php?userUpdate=success');
                } else { header('Location:./profile.php?userUpdate=failed'); }
            } else {
                header('Location:./profile.php?userUpdate=false');
            }
        }

        if(isset($_POST['resetPass']) && isset($_GET['passReset']) && $_GET['passReset'] == true) {
            $userController = new UserController();
            $result = $userController->updateUsers(['user_id' => $_SESSION['user_id']]);
            if ($result == true) {
                header('Location:./profile.php?resetPass=success');
            } else { header('Location:./profile.php?resetPass=failed'); }
        }

        if(isset($_GET['deleteAcc']) && $_GET['deleteAcc'] == true) {
            $profileController = new ProfileController();
            $result = $profileController->deleteProfile(['profile_id' => $_SESSION['profile_id']]);
            if($result) {
                $userController = new UserController();
                $userController->logout();
                header('Location:./index.php?sessionExpired=true');
            } else {
                header('Location:./profile.php?accDelete=failed');
            }
        }

        $profileController = new ProfileController();
        $data = $profileController->profileView(['profile_id' => $_SESSION['profile_id']]);
    }
    // transaction History
    else if($route === '/WEBDEV/ticketing/transactionHistory.php') {
        if(!isset($_SESSION['loggedIn']) ){
            header('Location:./');
        }
        if(isset($_SESSION['role']) && $_SESSION['role'] != '3'){
            header('Location:./');
        }

        $orderController = new OrderController();
        $data = $orderController->getOrderById(['user_id' => $_SESSION['user_id']]);
        $eventController = new EventController();
        $data2 = $eventController->eventList();
        $ticketController = new TicketController();
        $data3 = $ticketController->getAllTickets();
    }
    // order list for organizer
    else if(strpos($routeWithoutParams, '/WEBDEV/ticketing/orders.php') === 0 || $route === '/WEBDEV/ticketing/orders.php') {
        if(!isset($_SESSION['loggedIn']) ){
            header('Location:./');
        }
        if(isset($_SESSION['role']) && $_SESSION['role'] != '2'){
            header('Location:./');
        }

        $eventController = new EventController();
        $data = $eventController->getAllEventById(['user_id' => $_SESSION['user_id']]);
        $orderController = new OrderController();
        if(isset($_GET['event_id'])) {
            $data2 = $orderController->getOrderById(['event_id' => $_GET['event_id']]);
        } else {
            $data2 = $orderController->orderList();
        }
        $ticketController = new TicketController();
        $data3 = $ticketController->ticketList($data);
        $userController = new UserController();
        $data4 = $userController->getAllUsers();
        $profileController = new ProfileController();
        $data5 = $profileController->getAllProfiles();
        
    }
    //account list for admin
    else if(strpos($routeWithoutParams, '/WEBDEV/ticketing/accountlist.php') === 0 || $route === '/WEBDEV/ticketing/accountlist.php') {
        if(!isset($_SESSION['loggedIn']) ){
            header('Location:./');
        }
        if(isset($_SESSION['role']) && $_SESSION['role'] != '1'){
            header('Location:./');
        }
        if(isset($_GET['delete']) && $_GET['delete'] == 'true') {
            $profileController = new ProfileController();
            $result = $profileController->deleteProfile(['profile_id' => $_GET['profile_id']]);
            if ($result == true) {
                header('Location:./accountlist.php?deleteAcc=true');
            } else { header('Location:./accountlist.php?deleteAcc=false'); }
        }
        if(isset($_GET['search']) && !empty($_GET['search'])) {
            $profileController = new ProfileController();
            $data = $profileController->searchProfiles($_GET['search']);
        } else {
            $profileController = new ProfileController();
            $data = $profileController->getAllProfiles();
            $userController = new UserController();
            $data2 = $userController->getAllUsers();
        }
        
    }
    //feedback page
    else if(strpos($routeWithoutParams, '/WEBDEV/ticketing/feedback.php') === 0 || $route === '/WEBDEV/ticketing/feedback.php') {
        if(!isset($_SESSION['loggedIn']) ){
            header('Location:./');
        }

        if( isset($_GET['formSubmit']) && $_GET['formSubmit'] == true) {
            if(isset($_POST['feedbackSubmit'])) {
                $feedBackController = new FeedbackController();
                $result = $feedBackController->makeFeedback();
                if ($result) {
                    header('Location:./feedback.php?feedBack=true');
                } else { header('Location:./feedback.php?feedBack=false'); }
            }
            if(isset($_POST['feedbackEdit'])) {
                $feedBackController = new FeedbackController();
                $result = $feedBackController->updateFeedback(['user_id' => $_SESSION['user_id']]);
                if ($result) {
                    header('Location:./feedback.php?feedBackUpdate=true');
                } else { header('Location:./feedback.php?feedBackUpdate=false'); }
            }
        }

        $feedBackController = new FeedbackController();
        $data = $feedBackController->getFeedbackById(['user_id' => $_SESSION['user_id']]);
    }
?>