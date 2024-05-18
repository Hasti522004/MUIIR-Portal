-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2023 at 08:06 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
-- RELATIONSHIPS FOR TABLE `affiliation_detail`:
--

--
-- Dumping data for table `affiliation_detail`
--

INSERT INTO `affiliation_detail` (`ID`, `image_url`, `caption`, `date_time`) VALUES
(3, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_affiliation/11.png', '12', '2023-05-07 06:27:03'),
(4, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_affiliation/12.png', 'nsa', '2023-05-07 06:27:16'),
(5, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_affiliation/13.png', 'jkd', '2023-05-07 06:27:26'),
(6, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_affiliation/14.png', 'bb', '2023-05-07 06:27:36'),
(7, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_affiliation/15.png', 'jkn', '2023-05-07 06:27:46'),
(8, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_affiliation/16.png', 'kl', '2023-05-07 06:27:59'),
(9, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_affiliation/17.png', 'n,m', '2023-05-07 06:28:11');

-- --------------------------------------------------------

--
-- Table structure for table `copyright`
--

CREATE TABLE `copyright` (
  `id` int(11) NOT NULL,
  `grno` int(12) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `pincode` int(6) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `language_work` varchar(255) NOT NULL DEFAULT '',
  `publish` varchar(50) NOT NULL DEFAULT '',
  `remark` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `copyright`:
--

--
-- Dumping data for table `copyright`
--

INSERT INTO `copyright` (`id`, `grno`, `name`, `address`, `pincode`, `nationality`, `description`, `title`, `language_work`, `publish`, `remark`) VALUES
(39, 232, 'ho', 'uh', 213, 'jnl', 'h', 'h', 'h', 'u', 'u'),
(40, 232, 'ho', 'uh', 213, 'jnl', 'h', 'h', 'h', 'u', 'u'),
(41, 23, 'ijk', 'uhk', 9, 'kjh', 'h', 'l', 'j', 'i', 'i'),
(42, 23, 'ijk', 'uhk', 9, 'kjh', 'hkj', 'ljk', 'jilk', 'ijlki', 'ijl'),
(43, 12, 'uhoj', 'uhio', 89, 'jl', 'iou', 'iuo', 'ouip', 'iop', 'ipo'),
(44, 323, 'uhjk', 'o;jlk', 90, 'india', 'iou', 'iuo', 'ouip', 'iop', 'ipo'),
(45, 12, 'uhoj', 'uhio', 89, 'jl', 'iou', 'iuo', 'ouip', 'iop', 'ipo'),
(46, 323, 'uhjk', 'o;jlk', 90, 'india', 'iou', 'iuo', 'ouip', 'iop', 'ipo'),
(47, 12, 'uhoj', 'uhio', 89, 'jl', 'iou', 'iuo', 'ouip', 'iop', 'ipo'),
(48, 323, 'uhjk', 'o;jlk', 90, 'india', 'iou', 'iuo', 'ouip', 'iop', 'ipo'),
(49, 12, 'uhoj', 'uhio', 89, 'jl', 'iou', 'iuo', 'ouip', 'iop', 'ipo'),
(50, 323, 'uhjk', 'o;jlk', 90, 'india', 'iou', 'iuo', 'ouip', 'iop', 'ipo'),
(51, 12, '7yiu', 'uhi', 89, 'jkh', 'j;l', 'khj', 'p[o\'', 'o[', 'OP'),
(52, 12, '7yiu', 'uhi', 89, 'jkh', 'j;l', 'khj', 'p[o\'', 'o[', 'OP'),
(53, 12, 'Hasti Vipulbhai Hajipara', 'Gondal', 888888, 'india', 'MUIIR Portal', 'Portal', 'html,css,js,php', 'publish', ''),
(54, 13, 'Hasti Vipulbhai Hajipara', 'Gondal', 888888, 'india', 'hasti', 'Hasti_Story Points Presentation', 'html,css', 'publish', 'OP'),
(55, 56, 'Hitesh Jethva', 'rajkot', 128435, 'india', 'hasti', 'Hasti_Story Points Presentation', 'html,css', 'publish', 'OP'),
(56, 12, 'Veer Hajipara', 'Gondal', 364465, 'india', 'bussiness', 'working women', 'communication,marketing', 'unpublished', 'no more details'),
(57, 123, 'Hasti Hajipara', 'khambhaliya', 360311, 'india', 'bussiness', 'working women', 'communication,marketing', 'unpublished', 'no more details'),
(58, 12, 'Veer Hajipara', 'babra', 364465, 'india', 'rashlila', 'mango', 'parrot', 'yes', 'no'),
(59, 32, 'khush jadav', 'surat', 767754, 'india', 'rashlila', 'mango', 'parrot', 'yes', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `design`
--

CREATE TABLE `design` (
  `id` int(11) NOT NULL,
  `classno` varchar(50) NOT NULL,
  `grno` int(12) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `catapp` varchar(255) NOT NULL,
  `eduins` varchar(255) NOT NULL,
  `twork` varchar(255) NOT NULL,
  `addind` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `design`:
--

--
-- Dumping data for table `design`
--

INSERT INTO `design` (`id`, `classno`, `grno`, `name`, `address`, `catapp`, `eduins`, `twork`, `addind`, `description`) VALUES
(2, '123', 123435, 'Veer', 'IT,marwadi,Gondal,Gujrat-360611', 'website', 'marwadi', 'helping', 'Marwadi University, Rajkot - Morbi Highway Road, Gauridad, Rajkot, Gujarat 360003\r\n	registrar@marwadiuniversity.ac.in \r\n	Cell: +91 9727724694', 'help'),
(3, '123', 123234, 'Hasti Vipulbhai Hajipara', 'ICT,marwadi,Gondal,Gujrat-360611', 'website', 'marwadi', 'helping', 'Marwadi University, Rajkot - Morbi Highway Road, Gauridad, Rajkot, Gujarat 360003\r\n	registrar@marwadiuniversity.ac.in \r\n	Cell: +91 9727724694', 'help');

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
-- RELATIONSHIPS FOR TABLE `event_detail`:
--

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
(42, 'http://localhost/dashboard/Portal/Project_TRY_MUIIR/admin/upload_event/img4.jpeg', 'sdh', '2023-05-08 09:23:08');

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
-- RELATIONSHIPS FOR TABLE `users`:
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`grno`, `firstname`, `lastname`, `username`, `password`, `contactnumber`, `emailid`, `program`, `department`, `title`, `profilepic`, `status`) VALUES
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
-- Indexes for table `copyright`
--
ALTER TABLE `copyright`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `design`
--
ALTER TABLE `design`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `copyright`
--
ALTER TABLE `copyright`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `design`
--
ALTER TABLE `design`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `event_detail`
--
ALTER TABLE `event_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
