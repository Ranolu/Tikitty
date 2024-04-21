<?php
    require_once('Connection.php');
    require_once('./Models/User.php');

    class UserController extends Connection {

        public function makeuser($columnData) {
            if(!empty($_POST['affiliation'])) {
                $role = '2';
            } else {
                $role = '3';
            }

            $hashpass = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $data = [
                'username' => $_POST['username'],
                'password' => $hashpass,
                'profile_id' => $columnData,
                'role' => $role
            ];

            $user = new User($this->conn);
            if($user->createUser($data)){
                return true;
            } else { return false; }
        }

        public function getAllUsers() {
            $user = new User($this->conn);
            return $user->getAllUsers();
        }

        public function getUserById($columnData) {
            $user = new User($this->conn);
            return $user->getUserById($columnData);
        }

        public function searchUsers($username) {
            $user = new User($this->conn);
            return $user->searchUser($username, null);
        }

        public function updateUsers($columnData) {
            $user = new User($this->conn);

            if(isset($_POST['updateUser'])) {
                $data = ['username' => $_POST['username']];
                $_SESSION['username'] = $_POST['username'];
            }

            if(isset($_POST['resetPass'])) {
                $newpass= password_hash($_POST['password'], PASSWORD_DEFAULT);
                $data = ['password' => $newpass];
            }

            $result = $user->updateUser($columnData, $data);

            if($result) {
                return true;
            } else { return false; }
        }

        public function login($columnData) {
            $user = new User($this->conn);
            $data = $user->getUserById($columnData);
            if(!empty($data)) {
                if(password_verify($_POST['password'], $data['password'])) {
                    $_SESSION['user_id'] = $data['user_id'];
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['profile_id'] = $data['profile_id'];
                    $_SESSION['role'] = $data['role'];
                    $_SESSION['loggedIn'] = true;
                    return 'success';
                } else {
                    return 'wrongpass';
                }
            }
            else return 'noacc';
        }

        public function logout() {
            $_SESSION = [];
            session_destroy();
            header("Location:./");
            exit();
        }

    }

?>