-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2024 at 05:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tikitty`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(700) NOT NULL,
  `venue` varchar(200) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `sell_from_date` date NOT NULL,
  `sell_until_date` date NOT NULL,
  `poster_name` varchar(100) NOT NULL,
  `poster_path` varchar(100) NOT NULL,
  `thumbnail_name` varchar(100) NOT NULL,
  `thumbnail_path` varchar(100) NOT NULL,
  `video_link` varchar(300) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `approval` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `user_id`, `title`, `description`, `venue`, `start_date`, `end_date`, `sell_from_date`, `sell_until_date`, `poster_name`, `poster_path`, `thumbnail_name`, `thumbnail_path`, `video_link`, `status`, `approval`) VALUES
(1, 4, 'Anime and Cosplay Expo 2024', 'The Cosplay Colosseum awaits you at Anime & Cosplay Expo 2024: Re:Born a Chimera on July 20 to 21 in Hall 2, 3, 4 and Function Room 4 at the SMX Convention Center Manila, Pasay City.\r\n', 'SMX Convention Center Manila, Pasay City', '2024-07-20', '2021-07-21', '2024-06-06', '2024-07-20', '66265988991d1_ACX_po.jpg', './DisplayImages/6626598898e49/66265988991d1_ACX_po.jpg', '6626598899353_ACX_th.png', './DisplayImages/6626598898e49/6626598899353_ACX_th.png', 'https://youtu.be/6kzSQ3tGDvM?si=6NVyXuKAnIbi0kLp', 'upcoming', 'approved'),
(2, 4, 'FanFes2024: The Steelsmith Arc', 'Prepare to go full steam ahead with The Steelsmith Arc at FanFes 2024 on May 18-19, 2024 at Halls A, B, C, & D of Space at One Ayala, Makati City', 'One Ayala, Makati City', '2024-05-18', '2024-05-19', '2024-04-12', '2024-05-18', '66265a36a3464_fanfes_po.jpg', './DisplayImages/66265a36a3316/66265a36a3464_fanfes_po.jpg', '66265a36a359c_FanFes_th.jpg', './DisplayImages/66265a36a3316/66265a36a359c_FanFes_th.jpg', 'https://youtu.be/fpBM6-Yal1U?si=_VDxzDjFELGiTpNx', 'selling', 'approved'),
(3, 4, 'CosMeet 2024: The Intergalactic Cosplay Adventure ', 'The Intergalactic Cosplay Adventure CosMeet 2024 will blast off on October 26-27, 2024 at Cove Manila, Okada Manila, New Seaside Drive, Entertainment City, Parañaque City!', 'Cove Manila, Okada Manila, New Seaside Drive, Entertainment City, Parañaque City', '2024-10-26', '2024-10-27', '2024-10-11', '2024-10-26', '66265b22711e2_cosmeet_po.jpg', './DisplayImages/66265b2271098/66265b22711e2_cosmeet_po.jpg', '66265b2271319_cosmeet_th.jpg', './DisplayImages/66265b2271098/66265b2271319_cosmeet_th.jpg', 'https://youtu.be/K9tgxmTUYeU?si=yhc9m3n6iqSPCnUg', 'upcoming', 'approved'),
(4, 4, 'Cosplay Mania 2024: Into the Chronosphere', 'Your Isekai Adventure leads Into the Chronosphere with Cosplay Mania 2024 interfacing on October 4 to October 6, 2023 in Hall 2, 3, 4 and Function Room 4 at the SMX Convention Center Manila, Pasay City.', 'SMX Convention Center Manila, Pasay City', '2024-10-04', '2024-10-06', '2024-09-13', '2024-10-04', '66265c6b85b43_cosplaymania_po.jpg', './DisplayImages/66265c6b859f3/66265c6b85b43_cosplaymania_po.jpg', '66265c6b85c8b_cosplaymania_th.png', './DisplayImages/66265c6b859f3/66265c6b85c8b_cosplaymania_th.png', 'https://youtu.be/wA3Wv1BFO-Q?si=k3kZUsehB8G7cE9v', 'upcoming', 'approved'),
(5, 4, 'Cosplay Matsuri 2023: Re:Born an Oni', 'The Isekai Adventure Finale awaits at Cosplay Matsuri 2023: Re:Born an Oni on December 28-30, 2023 at Function Rooms 2-5 at the SMX Convention Center Manila, Pasay City!', 'SMX Convention Center Manila, Pasay City', '2023-12-28', '2023-12-30', '2023-11-10', '2023-12-28', '66265e43c1b22_cosplaymatsuri_po.jpg', './DisplayImages/66265e43c199e/66265e43c1b22_cosplaymatsuri_po.jpg', '66265e43c1c3c_cosplaymatsuri_th.jpg', './DisplayImages/66265e43c199e/66265e43c1c3c_cosplaymatsuri_th.jpg', 'https://youtu.be/MH7CbmrzArs?si=4ggIuEi9dSjEz0CK', 'ended', 'approved'),
(6, 5, 'MINI Ozine Fest 2024', 'Mini Ozine Fest will be on May 18-19, 2024 at the SMX Convention Center.\r\n	Special guests:\r\n	Ely Cosplay \r\n	Charess \r\n	小桃 Siutao \r\nTickets will be available on site/at the event. \r\nMini Ozine Fest is Sponsored by Razer Gold and Mineski Slash\r\nSee you all there! ', 'SMX Convention Center Manila, Pasay City', '2024-05-18', '2024-05-19', '2024-04-09', '2024-05-18', '662661a2d2196_miniozinefest_po.jpg', './DisplayImages/662661a2d1e50/662661a2d2196_miniozinefest_po.jpg', '662661a2d22cf_miniozineevent_th.jpg', './DisplayImages/662661a2d1e50/662661a2d22cf_miniozineevent_th.jpg', 'https://youtu.be/hJvGM3laglg?si=VJOBGHwiqGJ-Ivst', 'selling', 'approved'),
(7, 5, 'Collectors Fest Manila 2024', 'Collectors Fest Manila is happening on April 27 and 28! This exciting event will feature guest cosplayers, international and local toy artists, merchandise exhibitors, and sing and dance competitions.', 'SMX Convention Center Manila, Pasay City', '2024-04-27', '2024-04-28', '2024-03-27', '2024-04-27', '6626623b88414_collectorsfest_po.jpg', './DisplayImages/6626623b881fc/6626623b88414_collectorsfest_po.jpg', '6626623b8858b_collectorsfest_th.jpg', './DisplayImages/6626623b881fc/6626623b8858b_collectorsfest_th.jpg', 'https://youtu.be/L8VlY2exN2Y?si=1C7A5_qKWvOUeiAF', 'selling', 'approved'),
(8, 5, 'Ozine Fest Halloween Special 2024', 'Ozine Fest Halloween Special is happening on October 26 and 27! Showcasing Horror Themed Cosplay, Trick or Treat, Anime Activities and more. \r\n', 'Fairview Terraces, Ayala Malls', '2024-10-26', '2024-10-27', '2024-09-21', '2024-10-26', '662662dc8a931_ozinefesthalloween_po.jpg', './DisplayImages/662662dc8a50f/662662dc8a931_ozinefesthalloween_po.jpg', '662662dc8aae0_ozinefesthalloween_th.jpg', './DisplayImages/662662dc8a50f/662662dc8aae0_ozinefesthalloween_th.jpg', 'https://youtu.be/6N0YHasf8Bw?si=_iZ5ACsXDd95ts34', 'upcoming', 'approved'),
(9, 5, 'Ozine Fest Retro Anime Event 2024', 'Ozine Fest Retro Anime Event is happening on July 20 and 21! Showcasing Retro Themed Cosplay, Singing Competition, Anime Activities and more. ', 'Megatrade Hall, Mandaluyong City', '2024-07-20', '2024-07-21', '2024-06-07', '2024-07-20', '66266432bc136_ozinefestretro_po.jpg', './DisplayImages/66266432bbfba/66266432bc136_ozinefestretro_po.jpg', '66266432bc2c5_ozinefestretro_th.jpg', './DisplayImages/66266432bbfba/66266432bc2c5_ozinefestretro_th.jpg', 'https://youtu.be/k_8hRLyto0E?si=Zo4EKZrDyB_-NTWO', NULL, 'rejected'),
(10, 5, 'Ozine Fest SUMMER 2024', 'Ozine Fest SUMMER is happening on March 16 and 17!', 'Ayala Malls Trinoma, Quezon City', '2024-03-16', '2024-03-17', '2024-02-23', '2024-03-16', '662664bd8fadb_ozinefestsummer_po.jpg', './DisplayImages/662664bd8f8d8/662664bd8fadb_ozinefestsummer_po.jpg', '662664bd8fc3e_ozinefestsummer_th.jpg', './DisplayImages/662664bd8f8d8/662664bd8fc3e_ozinefestsummer_th.jpg', 'https://youtu.be/KPFEf6IuUw0?si=HzK8oPHQpDxAaFSB', 'ended', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rate` int(11) NOT NULL,
  `feedback` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`feedback_id`, `user_id`, `rate`, `feedback`) VALUES
(1, 2, 5, 'Hello!'),
(2, 3, 4, 'Very Nice'),
(3, 4, 5, 'It saved my life'),
(4, 5, 2, 'Hello');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `buy_quant` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `event_id`, `ticket_id`, `buy_quant`, `total_price`) VALUES
(1, 2, 2, 4, 2, 1998.00),
(2, 2, 2, 4, 2, 1998.00);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `profile_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_num` varchar(13) NOT NULL,
  `affiliation` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`profile_id`, `name`, `birthdate`, `email`, `contact_num`, `affiliation`) VALUES
(1, 'Sean Navarro', '2003-09-28', 'patrickotaku.sn@gmail.com', '+639282264535', NULL),
(2, 'Patrick Navarro', '2003-09-28', 'seanpatnavarro@gmail.com', '+630966885584', NULL),
(3, 'John Doe', '1991-02-28', 'seanpatricknavarro@yahoo.com', '+630966968373', 'Cosplay PH'),
(4, 'Felicia Nueva', '1994-08-06', 'sean.navarro@clsu2.edu.ph', '+630968264639', 'Ozine Events');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sold` int(11) NOT NULL DEFAULT 0,
  `event_id` int(11) NOT NULL,
  `earnings` decimal(10,2) GENERATED ALWAYS AS (`price` * `sold`) STORED,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `type`, `price`, `quantity`, `sold`, `event_id`, `status`) VALUES
(1, '2-Day Portal Pass', 1499.00, 500, 0, 1, 1),
(2, 'Regular - Day 1', 399.00, 600, 0, 1, 1),
(3, 'Regular - Day 2', 399.00, 600, 0, 1, 1),
(4, '2-Day Portal Pass', 999.00, 446, 4, 2, 1),
(5, 'Regular - Day 1', 299.00, 600, 0, 2, 1),
(6, 'Regular - Day 2', 299.00, 600, 0, 2, 1),
(7, '2-Day Portal Pass', 799.00, 500, 0, 3, 1),
(8, 'Regular - Day 1', 199.00, 400, 0, 3, 1),
(9, 'Regular - Day 2', 199.00, 400, 0, 3, 1),
(10, '3-Day Portal Pass', 2499.00, 400, 0, 4, 1),
(11, 'Regular - Day 1', 499.00, 750, 0, 4, 1),
(12, 'Regular - Day 2', 499.00, 750, 0, 4, 1),
(13, 'Regular - Day 3', 499.00, 750, 0, 4, 1),
(14, '3-Day Portal Pass', 2499.00, 400, 0, 5, 1),
(15, 'Regular - Day 1', 499.00, 750, 0, 5, 1),
(16, 'Regular - Day 2', 499.00, 750, 0, 5, 1),
(17, 'Regular - Day 3', 499.00, 750, 0, 5, 1),
(18, '2-Day Pass', 799.00, 450, 0, 6, 1),
(19, 'Regular - Day 1', 220.00, 600, 0, 6, 1),
(20, 'Regular - Day 2', 220.00, 600, 0, 6, 1),
(21, '2-Day Pass', 799.00, 450, 0, 7, 1),
(22, 'Regular - Day 1', 220.00, 600, 0, 7, 1),
(23, 'Regular - Day 2', 220.00, 600, 0, 7, 1),
(24, '2-Day Pass', 799.00, 450, 0, 8, 1),
(25, 'Regular - Day 1', 220.00, 600, 0, 8, 1),
(26, 'Regular - Day 2', 220.00, 600, 0, 8, 1),
(27, '2-Day Pass', 799.00, 450, 0, 9, 1),
(28, 'Regular - Day 1', 220.00, 600, 0, 9, 1),
(29, 'Regular - Day 2', 220.00, 600, 0, 9, 1),
(30, '2-Day Pass', 799.00, 450, 0, 10, 1),
(31, 'Regular - Day 1', 220.00, 600, 0, 10, 1),
(32, 'Regular - Day 2', 220.00, 600, 0, 10, 1);

--
-- Triggers `tickets`
--
DELIMITER $$
CREATE TRIGGER `update_event_status_sold_out` AFTER UPDATE ON `tickets` FOR EACH ROW BEGIN
    DECLARE total_tickets INT;
    DECLARE sold_out_tickets INT;

    -- Get the total number of tickets for the event
    SELECT COUNT(*) INTO total_tickets FROM tickets WHERE event_id = NEW.event_id;

    -- Get the number of tickets with status 0 for the event
    SELECT COUNT(*) INTO sold_out_tickets FROM tickets WHERE event_id = NEW.event_id AND status = 0;

    -- If all tickets for the event are sold out, update the event status
    IF total_tickets = sold_out_tickets THEN
        UPDATE events SET status = 'sold_out' WHERE event_id = NEW.event_id;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_status_on_quantity_change` BEFORE UPDATE ON `tickets` FOR EACH ROW BEGIN
    IF NEW.quantity = 0 THEN
        SET NEW.status = 0;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(70) NOT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `profile_id`, `role`) VALUES
(1, 'admin', '$2y$10$8b4BnPdH3FIgwdmv43pHaeocr9.VY0jX0ftzOcAjAxLP8rWzFBwg.', NULL, 1),
(2, 'Sean28', '$2y$10$S6VfCKYRuCbzmYvQYuz75uKhcd2NbVbH7Lvzu7D4YqG.Y6RCeOomC', 1, 3),
(3, 'Patrick09', '$2y$10$l3ooKUox2xem2Ixs3WQ0iOi47QExubVjMwlnX6OJCPDqNuK.exohq', 2, 3),
(4, 'CosplayPH', '$2y$10$zyz3YxykA0eg.JqEkJUIaOzJmKa2EBXEAESHonBeGSOFxYkfZIKRS', 3, 2),
(5, 'OzineEvents', '$2y$10$7/HzKdCgELAjm.0L2D3.WuXnVs7oXDWBMX7R6joRReei7Lx6XcZpC', 4, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `events_users_link` (`user_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `feedback_users_link` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_events_link` (`event_id`),
  ADD KEY `orders_ticket_link` (`ticket_id`),
  ADD KEY `orders_users_link` (`user_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `tickets_events_link` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `users_profiles_link` (`profile_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_users_link` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedback_users_link` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_events_link` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ticket_link` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_users_link` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_events_link` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_profiles_link` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`profile_id`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `update_status_event` ON SCHEDULE EVERY 5 SECOND STARTS '2024-04-12 20:10:08' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE events
    SET status = 
        CASE
            WHEN approval = 'approved' AND status != 'sold_out' AND CURDATE() < sell_from_date THEN 'upcoming'
            WHEN approval = 'approved' AND status != 'sold_out' AND CURDATE() >= sell_from_date AND CURDATE() <= sell_until_date THEN 'selling'
            WHEN approval = 'approved' AND CURDATE() > sell_until_date THEN 'ended'
            ELSE status 
        END
    WHERE approval = 'approved' AND status != 'sold_out'; 
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
