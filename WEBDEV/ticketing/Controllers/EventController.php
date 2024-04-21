<?php
    require_once('Connection.php');
    require_once('./Models/Event.php');

    class EventController extends Connection {
        public function makeEvent() {
            $folder = uniqid();
            $poster_info = $this->uploadImage($_FILES['poster'], $folder);
            $thumbnail_info = $this->uploadImage($_FILES['thumbnail'], $folder);

            if($poster_info == false || $thumbnail_info == false) {
                return false;
            } else {
                $data = [
                    'user_id' => $_SESSION['user_id'],
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'venue' => $_POST['venue'],
                    'start_date' => $_POST['start_date'],
                    'end_date' => $_POST['end_date'],
                    'sell_from_date' => $_POST['sell_from'],
                    'sell_until_date' => $_POST['sell_until'],
                    'poster_name' => $poster_info['name'],
                    'poster_path' => $poster_info['path'],
                    'thumbnail_name' => $thumbnail_info['name'],
                    'thumbnail_path' => $thumbnail_info['path'],
                    'video_link' => $_POST['video_link'],
                    'approval' => 'pending'
                ];

                $event = new Event($this->conn);
                $event->createEvent($data);
                if($event){
                    return true;
                } else { return false; }
            }

        }

        public function updateEvent($columnData) {
            $event = new Event($this->conn);
            $oldDat = $event->getEventById($columnData);
            $folder = basename(dirname($oldDat['poster_path']));

            if (!empty($_FILES['poster']['name']) && !empty($_FILES['thumbnail']['name'])) {
                $poster_info = $this->uploadImage($_FILES['poster'], $folder);
                $thumbnail_info = $this->uploadImage($_FILES['thumbnail'], $folder);
                unlink($oldDat['poster_path']);
                unlink($oldDat['thumbnail_path']);
            }
            else if (!empty($_FILES['poster']['name'])) {
                $poster_info = $this->uploadImage($_FILES['poster'], $folder);
                unlink($oldDat['poster_path']);
                $thumbnail_info = [
                    'name' => $oldDat['thumbnail_name'],
                    'path' => $oldDat['thumbnail_path']
                ];
            }
            else if (!empty($_FILES['thumbnail']['name'])) {
                $thumbnail_info = $this->uploadImage($_FILES['thumbnail'], $folder);
                unlink($oldDat['thumbnail_path']);
                $poster_info = [
                    'name' => $oldDat['poster_name'],
                    'path' => $oldDat['poster_path']
                ];
            }
            else {
                $poster_info = [
                    'name' => $oldDat['poster_name'],
                    'path' => $oldDat['poster_path']
                ];
                $thumbnail_info = [
                    'name' => $oldDat['thumbnail_name'],
                    'path' => $oldDat['thumbnail_path']
                ];
            }

            $data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'venue' => $_POST['venue'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'sell_from_date' => $_POST['sell_from'],
                'sell_until_date' => $_POST['sell_until'],
                'poster_name' => $poster_info['name'],
                'poster_path' => $poster_info['path'],
                'thumbnail_name' => $thumbnail_info['name'],
                'thumbnail_path' => $thumbnail_info['path'],
                'video_link' => $_POST['video_link'],
                'approval' => 'pending'
            ];

            $result = $event->updateEvent($columnData, $data);
            if($result) {
                return true;
            } else { return false; }
        }

        public function approveEvent($columnData) {
            $event = new Event($this->conn);
            $data = [
                'status' => 'upcoming',
                'approval' => 'approved'
            ];
            $result = $event->updateEvent($columnData, $data);
            if($result) {
                return true;
            } else { return false; }
        }

        public function rejectEvent($columnData) {
            $event = new Event($this->conn);
            $data = ['approval' => 'rejected'];
            $result = $event->updateEvent($columnData, $data);
            if($result) {
                return true;
            } else { return false; }
        }

        public function eventList() {
            $event = new Event($this->conn);
            return $event->getAllEvents();
        }

        public function searchEvents($columnData) {
            $event = new Event($this->conn);
            return $event->searchEvent($columnData, null);
        }

        public function getEventById($columnData) {
            $event = new Event($this->conn);
            return $event->getEventById($columnData);
        }

        public function getAllEventById($columnData) {
            $event = new Event($this->conn);
            return $event->getEventByColumn($columnData, null);
        }

        private function uploadImage($file, $folder) {
            if ($file['error'] === UPLOAD_ERR_OK) {
                $directory = './DisplayImages/' . $folder . '/';

                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }
        
                $filename = uniqid() . '_' . $file['name'];
        
                $destination = $directory . $filename;
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    return [
                        'path' => $destination,
                        'name' => $filename
                    ];
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function getOldEvents($columnData) {
            $event = new Event($this->conn);
            return $event->getOldEvents($columnData, '7', 'event_id', 'DESC');
        }

        public function deleteEvent($columnData) {
            $event = new Event($this->conn);
            $data = $event->getEventById($columnData);
            $folder = dirname($data['poster_path']);

            $this->deleteFolder($folder);

            return $event->deleteEvent($columnData);
        }

        function deleteFolder($folderPath) {
            $files = glob($folderPath . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
        
            if (is_dir($folderPath)) {
                rmdir($folderPath);
            }
        }
    }
?>