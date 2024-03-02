-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2024 at 01:14 PM
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
-- Database: `ktj`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_title` varchar(50) NOT NULL,
  `event_price` int(11) DEFAULT NULL,
  `participents` int(100) DEFAULT 0,
  `img_link` text DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `Result` longtext NOT NULL DEFAULT 'EVENT NOT YET FINISHED'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_title`, `event_price`, `participents`, `img_link`, `type_id`, `Result`) VALUES
(2, 'Search-it', 50, 6, 'images/search_it.jpg', 1, '1.shivam\n 2.Kshitij\n3.kartik'),
(3, 'Technical-Quiz', 50, 4, 'images/quiz.png', 1, ''),
(7, 'Fashion-Show', 200, 2, 'images/onstage.jpg', 3, ''),
(8, 'Dance', 100, 0, 'images/dance.jpg', 3, ''),
(9, 'Singing', 50, 0, 'images/sing.jpg', 3, ''),
(10, 'ktj-Idol', 100, 0, 'images/idol.jpg', 3, ''),
(11, 'Cooking-Without-Fire', 50, 0, 'images/cook.jpg', 4, ''),
(13, 'SKETCHYOURTHOUGHTS', 500, 0, 'images/sketch.jpg', 4, 'EVENT NOT YET FINISHED'),
(14, 'Rangoli', 50, 0, 'images/cs03.jpg', 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `event_info`
--

CREATE TABLE `event_info` (
  `event_id` int(10) NOT NULL,
  `Date` date DEFAULT NULL,
  `time` varchar(20) NOT NULL,
  `location` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `event_info`
--

INSERT INTO `event_info` (`event_id`, `Date`, `time`, `location`) VALUES
(2, '2024-11-16', '1.00pm', 'V3,Vikramshila'),
(3, '2024-11-16', '11.00am', 'V2,Vikramshila'),
(7, '2024-10-17', '9.30pm', 'TOAT'),
(8, '2024-10-17', '7.00pm', 'Kalidas'),
(9, '2024-10-17', '5.00pm', 'TOAT'),
(10, '2024-10-17', '6.00pm', 'Kalidas'),
(11, '2024-10-16', '10.30am', 'NR-123'),
(13, '2024-11-12', '3pm', 'Gymkhana'),
(14, '2024-11-13', '2.00pm', 'v-4,Vikramshila');

-- --------------------------------------------------------

--
-- Table structure for table `event_type`
--

CREATE TABLE `event_type` (
  `type_id` int(10) NOT NULL,
  `type_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `event_type`
--

INSERT INTO `event_type` (`type_id`, `type_title`) VALUES
(1, 'Technical Events'),
(2, 'Gaming Events'),
(3, 'On Stage Events'),
(4, 'Off Stage Events');

-- --------------------------------------------------------

--
-- Table structure for table `participent`
--

CREATE TABLE `participent` (
  `usn` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `sem` int(11) NOT NULL,
  `email` varchar(300) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `college` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `participent`
--

INSERT INTO `participent` (`usn`, `password`, `name`, `branch`, `sem`, `email`, `phone`, `college`) VALUES
('convexchull', 'Bhavana', 'BHAVANA', 'cse', 5, 'BHAVANA@GMAIL.COM', '9934736623', 'iit madras'),
('dijkstra', 'Prathiksha', 'Prathiksha', 'noncircuita', 5, 'prathi@gmail.com', '7897854345', 'iit kolkata'),
('fenwicktree', 'Shivam@100', 'Shivam Sourav', 'cse', 6, 'wavesourav@gmail.com', '8789488019', 'iit bomaby'),
('maggu', 'Kavya', 'Kavya', 'cse', 5, 'Kavya@gmail.com', '7888387323', 'iit delhi'),
('ratingbadhabsdk', 'Anu', 'Anu', 'CSE', 5, 'annapoornaba@gmail.com', '8123300011', 'iit kanpur'),
('segmentree', 'Mythri', 'Mythri', 'cse', 5, 'mythri@saividya.ac.in', '8998848488', 'iit roorkee'),
('steinertree', 'Shivam@100', 'wavesourav', 'cse', 6, 'wavesourav@kgpian.iitkgp.ac.in', '8789488019', 'iit dholakpur');

-- --------------------------------------------------------

--
-- Table structure for table `registered`
--

CREATE TABLE `registered` (
  `rid` int(11) NOT NULL,
  `usn` varchar(20) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `registered`
--

INSERT INTO `registered` (`rid`, `usn`, `event_id`) VALUES
(4, 'dijkstra', 3),
(5, 'segmentree', 3);

--
-- Triggers `registered`
--
DELIMITER $$
CREATE TRIGGER `count` AFTER INSERT ON `registered` FOR EACH ROW update events
set events.participents=events.participents+1
WHERE events.event_id=new.event_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `staff_coordinator`
--

CREATE TABLE `staff_coordinator` (
  `stid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `staff_coordinator`
--

INSERT INTO `staff_coordinator` (`stid`, `name`, `phone`, `event_id`) VALUES
(2, 'Mamatha', '9956436123', 2),
(3, 'Suparna.A', '9956436456', 3),
(7, 'Deeksha.G', '9456436610', 7),
(8, 'Deeksha.Patgar', '9789436610', 8),
(9, 'Shubha Naik', '9956412310', 9),
(10, 'Sairaj Patgar', '9956445610', 10),
(11, 'Reshma Hittalmakhi', '9956473510', 11);

-- --------------------------------------------------------

--
-- Table structure for table `student_coordinator`
--

CREATE TABLE `student_coordinator` (
  `sid` int(11) NOT NULL,
  `st_name` varchar(100) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `usn` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student_coordinator`
--

INSERT INTO `student_coordinator` (`sid`, `st_name`, `phone`, `event_id`, `usn`, `password`) VALUES
(2, 'kshitij', '878767757', 2, 'hello', 'hello'),
(3, 'Arjun.A', '8956436456', 3, 'abd', 'abd'),
(7, 'Anshuman.A.N', '6456436610', 7, 'vbn', 'bnm'),
(8, 'Abhinandhan.A', '7789436610', 8, 'kjh', 'lkj'),
(9, 'Suraj Upadhya', '7956412310', 9, 'yui', 'poi'),
(10, 'Imran Khalil Khan', '7956445610', 10, 'qwe', 'ert'),
(11, 'Mythri', '6956473510', 11, 'zxc', 'sdf'),
(13, 'Kavya', '8994874384', 13, 'hdc', 'hgd'),
(14, 'Rishitha', NULL, 14, 'vfh', 'sfh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `event_info`
--
ALTER TABLE `event_info`
  ADD PRIMARY KEY (`event_id`),
  ADD UNIQUE KEY `event_id` (`event_id`);

--
-- Indexes for table `event_type`
--
ALTER TABLE `event_type`
  ADD PRIMARY KEY (`type_id`),
  ADD UNIQUE KEY `type_id` (`type_id`);

--
-- Indexes for table `participent`
--
ALTER TABLE `participent`
  ADD PRIMARY KEY (`usn`);

--
-- Indexes for table `registered`
--
ALTER TABLE `registered`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `usn` (`usn`);

--
-- Indexes for table `staff_coordinator`
--
ALTER TABLE `staff_coordinator`
  ADD PRIMARY KEY (`stid`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `student_coordinator`
--
ALTER TABLE `student_coordinator`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `usn` (`usn`),
  ADD KEY `event_id` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event_info`
--
ALTER TABLE `event_info`
  MODIFY `event_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `registered`
--
ALTER TABLE `registered`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `staff_coordinator`
--
ALTER TABLE `staff_coordinator`
  MODIFY `stid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `student_coordinator`
--
ALTER TABLE `student_coordinator`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `event_type` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_info`
--
ALTER TABLE `event_info`
  ADD CONSTRAINT `event_info_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registered`
--
ALTER TABLE `registered`
  ADD CONSTRAINT `registered_ibfk_1` FOREIGN KEY (`usn`) REFERENCES `participent` (`usn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff_coordinator`
--
ALTER TABLE `staff_coordinator`
  ADD CONSTRAINT `staff_coordinator_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_coordinator`
--
ALTER TABLE `student_coordinator`
  ADD CONSTRAINT `student_coordinator_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
