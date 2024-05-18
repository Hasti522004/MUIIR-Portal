-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2024 at 01:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `muiir`
--

-- --------------------------------------------------------

--
-- Table structure for table `affiliation_detail`
--

CREATE TABLE `affiliation_detail` (
  `ID` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `affiliation_detail`
--

INSERT INTO `affiliation_detail` (`ID`, `image_url`, `caption`, `date_time`) VALUES
(3, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_affiliation/11.png', '12', '2023-05-07 06:27:03'),
(4, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_affiliation/12.png', 'nsa', '2023-05-07 06:27:16'),
(5, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_affiliation/13.png', 'jkd', '2023-05-07 06:27:26'),
(6, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_affiliation/14.png', 'bb', '2023-05-07 06:27:36'),
(7, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_affiliation/15.png', 'jkn', '2023-05-07 06:27:46'),
(8, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_affiliation/16.png', 'kl', '2023-05-07 06:27:59');

-- --------------------------------------------------------

--
-- Table structure for table `copyright1`
--

CREATE TABLE `copyright1` (
  `id` int(11) NOT NULL,
  `grno` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `author` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `copyright1`
--

INSERT INTO `copyright1` (`id`, `grno`, `name`, `pincode`, `address`, `nationality`, `author`) VALUES
(1, 21, 'we', '12', 'sd', 'weq', 1),
(1, 213, 'wer', '321', 'werwe', 'er', 2),
(1, 123, 'wer', '123', '213we', 'wr', 3),
(1, 2123, 'wq', '23', 'ds', 'qw', 4),
(2, 32, 'ewr', '32', 'ert', 'wer', 1),
(2, 342, 'ew', '23', 'errt', 'wrew', 2),
(2, 234, 'et', '34', 'ert', 'wer', 3),
(3, 12, 'we', '321', '23ewq', 'weq', 1),
(4, 2, 'esf', '231', 'dfas', 'fdas', 1),
(5, 12, 'qwe', '23', 'eqw', 'qe', 1),
(6, 232, 'ui', '23', 'ui', 'ui', 1),
(7, 23, 'fd', '321', 'wr', 'erw', 1),
(8, 23, 'df', '23', 'erer', 'fds', 1),
(9, 3, 'wer', '23', 'ewe', 'qwe', 1),
(10, 2, 'we', '32', 'qew', 'qwe', 1),
(11, 32, 'ew', '32', 'ew', 'ew', 1),
(12, 231, 'ewq', '132', 'erw', 'qwe', 1),
(13, 12, 'uh', '8', 'j', 'ui', 1),
(14, 12313, 'we', '8731', 'uhnsd', 'uiswew', 1),
(15, 232323, 'qedwh', '323231', 'wehwds', 'wqwhw', 1),
(16, 114541, 'Hasti Hajipara', '364465', 'Meta Khambhaliya', 'India ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `copyright2`
--

CREATE TABLE `copyright2` (
  `id` int(11) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `language_work` varchar(100) NOT NULL,
  `remarks` text DEFAULT NULL,
  `published` varchar(255) DEFAULT NULL,
  `use_previous_data` varchar(3) DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `copyright2`
--

INSERT INTO `copyright2` (`id`, `description`, `title`, `language_work`, `remarks`, `published`, `use_previous_data`, `timestamp`) VALUES
(8, 'we', 'er', 'sdf', 'sf', 'unpublished', '0', '2023-09-22 16:22:28'),
(9, 'we', 'qw', 'weq', 'eqw', 'unpublished', '0', '2023-09-22 16:23:33'),
(10, 'qw', 'we', 'we', 'weq', 'unpublished', '0', '2023-09-22 16:41:43'),
(11, 'as', 'sa', 'as', 'as', 'published', 'YES', '2023-09-22 16:45:35'),
(12, 'wer', 'rw', 'wer', 'we', 'unpublished', 'No', '2023-09-22 16:46:16'),
(13, 'sfd', 'fs', 'fs', 'sf', 'unpublished', 'No', '2023-09-22 16:49:43'),
(14, 'wew', 'wewq', 'ji', 'ioj', 'unpublished', 'YES', '2023-09-24 10:37:14');

-- --------------------------------------------------------

--
-- Table structure for table `copyright3`
--

CREATE TABLE `copyright3` (
  `id` int(11) DEFAULT NULL,
  `grno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `copyright3`
--

INSERT INTO `copyright3` (`id`, `grno`, `name`, `pincode`, `address`, `nationality`, `author`) VALUES
(13, 23, 'df', '321', 'df', 'sfd', '1');

-- --------------------------------------------------------

--
-- Table structure for table `design`
--

CREATE TABLE `design` (
  `d_id` int(11) DEFAULT NULL,
  `grno` int(11) DEFAULT NULL,
  `classno` varchar(5) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `designstate` enum('drawings','photographs','tracings','specimens') DEFAULT NULL,
  `titleOfWork` varchar(255) DEFAULT NULL,
  `front_view_url` varchar(255) DEFAULT NULL,
  `rear_view_url` varchar(255) DEFAULT NULL,
  `top_view_url` varchar(255) DEFAULT NULL,
  `bottom_view_url` varchar(255) DEFAULT NULL,
  `left_view_url` varchar(255) DEFAULT NULL,
  `right_view_url` varchar(255) DEFAULT NULL,
  `prospective_view_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `design`
--

INSERT INTO `design` (`d_id`, `grno`, `classno`, `author`, `name`, `address`, `designstate`, `titleOfWork`, `front_view_url`, `rear_view_url`, `top_view_url`, `bottom_view_url`, `left_view_url`, `right_view_url`, `prospective_view_url`) VALUES
(1, 1233, '12-12', '1', 'ihhi', 'ui, iwe, io, uio, uio 12908', 'tracings', '2euiqwe', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1, 23221, '12-12', '2', 'ui', 'uiy, uiy, uiy, uiyi, uiy 18223', 'tracings', '2euiqwe', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 31, '23-45', '1', 'wqe', 'qwe, we, fds, g, jg 289189', 'drawings', '2eqw', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 23131, '21-12', '1', 'sjdkfa', 'jfdksaf, JNKDSF, SDJNKF, ASKDJ, JDKSANF 12321', 'photographs', 'qweqw wswwe', 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/forms/design/design_images/1 (1).jpg', 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/forms/design/design_images/1 (2).jpg', 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/forms/design/design_images/1 (3).jpg', 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/forms/design/design_images/1 (4).jpg', 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/forms/design/design_images/1 (5).jpg', 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/forms/design/design_images/1 (6).jpg', 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/forms/design/design_images/1 (7).jpg'),
(3, 213123, '21-12', '2', 'hjkh', 'jkhkl, lhjklhj, jhljhlk, jkhkl, jklh 23232', 'photographs', 'qweqw wswwe', 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/forms/design/design_images/1 (1).jpg', 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/forms/design/design_images/1 (2).jpg', 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/forms/design/design_images/1 (3).jpg', 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/forms/design/design_images/1 (4).jpg', 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/forms/design/design_images/1 (5).jpg', 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/forms/design/design_images/1 (6).jpg', 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/forms/design/design_images/1 (7).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `event_detail`
--

CREATE TABLE `event_detail` (
  `id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `event_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_detail`
--

INSERT INTO `event_detail` (`id`, `image_url`, `caption`, `event_date_time`) VALUES
(25, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_event/140.jpg', 'result', '2023-05-07 05:24:32'),
(26, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_event/4603.jpg', 'my', '2023-05-07 05:24:32'),
(28, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_event/4660.jpg', 'ok', '2023-05-07 05:24:32'),
(29, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_event/540.jpg', 'o', '2023-05-07 05:24:32'),
(30, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_event/425.jpg', 'p', '2023-05-07 05:24:32'),
(32, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_event/135.jpg', 'sign', '2023-05-07 05:25:41'),
(33, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_event/444.jpg', 'drawing', '2023-05-07 05:47:32'),
(34, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_event/5270.jpg', 'google', '2023-05-07 06:07:37'),
(35, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_event/552.jpg', 'uo', '2023-05-07 06:08:22'),
(37, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_event/36164.jpg', 'drawing', '2023-05-08 02:32:18'),
(38, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_event/140.jpg', '12', '2023-05-08 03:46:31'),
(39, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_event/im4.jpeg', 'jlklp', '2023-05-08 08:36:59'),
(40, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_event/im5.jpeg', 'image5', '2023-05-08 08:37:49'),
(41, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_event/im1.jpeg', 'img', '2023-05-08 08:38:12'),
(42, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_event/img4.jpeg', 'sdh', '2023-05-08 09:23:08'),
(43, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_event/JPSG0875.JPG', 'girl', '2023-09-16 18:45:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `grno` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contactnumber` varchar(20) NOT NULL,
  `emailid` varchar(100) NOT NULL,
  `program` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `title` varchar(10) NOT NULL,
  `profilepic` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`grno`, `firstname`, `lastname`, `username`, `password`, `contactnumber`, `emailid`, `program`, `department`, `title`, `profilepic`, `status`) VALUES
(101010, 'Hasti', 'Hajipara', 'user', 'Hasti@522004', '9909256723', 'hasti.hajipara@gmail.com', 'B.Tech', 'ICT', 'Ms', 'ER Diagram.jpeg', 0),
(111111, 'Hitesh', 'Jethva', 'Hitesh', 'Hitesh@123', '9909256723', 'hitesh.jethva@gmail.com', 'B Tech', 'ICT', 'Mr', '449.jpg', 1),
(114541, 'Hasti', 'Hajipara', 'admin', 'admin', '9909256723', 'hasti.hajipara@gmail.com', 'B Tech', 'ICT', 'Mrs', '402.jpg', 2),
(2222222, 'Dhara', 'Hajipara', 'veer', '123', '09909256723', 'hasti.hajipara@gmail.com', 'B Tech', 'ICT', 'Mr', '87.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affiliation_detail`
--
ALTER TABLE `affiliation_detail`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `copyright2`
--
ALTER TABLE `copyright2`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `event_detail`
--
ALTER TABLE `event_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`grno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `affiliation_detail`
--
ALTER TABLE `affiliation_detail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `event_detail`
--
ALTER TABLE `event_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
