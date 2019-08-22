-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 23, 2019 at 04:19 AM
-- Server version: 5.6.43-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_roroferry`
--

-- --------------------------------------------------------

--
-- Table structure for table `passanger_details`
--

CREATE TABLE `passanger_details` (
  `id` int(11) NOT NULL,
  `ticketId` int(11) NOT NULL,
  `passangerName` varchar(255) NOT NULL,
  `passangerAge` int(11) NOT NULL,
  `passangerGender` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passanger_details`
--

INSERT INTO `passanger_details` (`id`, `ticketId`, `passangerName`, `passangerAge`, `passangerGender`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kartik Desai', 24, 'Male', '2019-05-18 12:44:52', '2019-05-18 12:44:52'),
(2, 1, 'ABC ABC', 26, 'Female', '2019-05-18 12:44:52', '2019-05-18 12:44:52'),
(3, 2, 'harshil shhah', 26, 'Male', '2019-05-21 01:54:26', '2019-05-21 01:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `route_list`
--

CREATE TABLE `route_list` (
  `id` int(11) NOT NULL,
  `route` varchar(255) NOT NULL,
  `is_active` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route_list`
--

INSERT INTO `route_list` (`id`, `route`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Surat to Bhavnagar (Noon)', 'active', '2019-05-18 12:30:23', '2019-05-20 12:43:04'),
(2, 'Surat to Bhavnagar (Evening)', 'active', '2019-05-18 12:31:41', '2019-05-21 04:59:19'),
(3, 'Bhavnagar to Surat (Morning)', 'active', '2019-05-18 12:32:09', '2019-05-21 05:19:18'),
(4, 'Bhavnagar to Surat (Evening)', 'active', '2019-05-18 12:32:48', '2019-05-21 05:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `station_list`
--

CREATE TABLE `station_list` (
  `id` int(11) NOT NULL,
  `stationName` varchar(255) NOT NULL,
  `routeId` int(11) NOT NULL,
  `stationType` enum('pickup','drop') NOT NULL,
  `forTime` varchar(25) NOT NULL,
  `time` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `station_list`
--

INSERT INTO `station_list` (`id`, `stationName`, `routeId`, `stationType`, `forTime`, `time`, `created_at`, `updated_at`) VALUES
(1, 'Hirabuag Circle', 1, 'pickup', '12:00 PM', '07:30 AM', '2019-05-18 12:36:59', '2019-05-18 12:38:57'),
(2, 'Sarthana Jakatnaka', 1, 'pickup', '12:00 PM', '08:00 AM', '2019-05-18 12:36:59', '2019-05-18 12:39:15'),
(3, 'Kamrej', 1, 'pickup', '12:00 PM', '08:15 AM', '2019-05-18 12:36:59', '2019-05-18 12:39:39'),
(4, 'Ankleshwar Ashirwad  Hotel', 1, 'pickup', '12:00 PM', '09:31 AM', '2019-05-18 12:38:21', '2019-05-20 12:49:41'),
(5, 'Bharuch ABC Chokdi', 1, 'pickup', '12:00 PM', '10:01 AM', '2019-05-18 12:38:21', '2019-05-20 12:50:58'),
(6, 'Shivaraji Circle ', 1, 'drop', '12:00 PM', '02:21 PM', '2019-05-18 12:38:21', '2019-05-20 12:52:35'),
(7, 'Gogha Circle', 1, 'drop', '12:00 PM', '02:31 PM', '2019-05-20 12:53:40', '2019-05-20 12:53:40'),
(8, 'Nilambag Circle', 1, 'drop', '12:00 PM', '02:41 PM', '2019-05-20 12:54:26', '2019-05-20 12:54:26'),
(9, 'Hirabag Circle', 2, 'pickup', '08:31 PM', '04:01 PM', '2019-05-21 05:01:10', '2019-05-21 05:01:10'),
(10, 'Sarthana Jakatnaka', 2, 'pickup', '08:31 PM', '04:31 PM', '2019-05-21 05:02:42', '2019-05-21 05:02:42'),
(11, 'Kamrej ', 2, 'pickup', '08:31 PM', '04:46 PM', '2019-05-21 05:03:48', '2019-05-21 05:03:48'),
(12, 'Kim Kosamba', 2, 'pickup', '08:31 PM', '05:16 PM', '2019-05-21 05:05:42', '2019-05-21 05:05:42'),
(13, 'Ankleshwar Ashirwad Hotel', 2, 'pickup', '08:31 PM', '06:01 PM', '2019-05-21 05:07:14', '2019-05-21 05:07:14'),
(14, 'Bharuch ABC Chokdi', 2, 'pickup', '08:31 PM', '06:31 PM', '2019-05-21 05:08:43', '2019-05-21 05:08:43'),
(15, 'Shivarji Circle', 2, 'drop', '08:31 PM', '10:51 PM', '2019-05-21 05:10:47', '2019-05-21 05:10:47'),
(16, 'Gogha Circle', 2, 'drop', '08:31 PM', '11:01 PM', '2019-05-21 05:15:31', '2019-05-21 05:15:31'),
(17, 'Nilambag', 2, 'drop', '08:31 PM', '11:11 PM', '2019-05-21 05:16:56', '2019-05-21 05:16:56'),
(18, 'Nilambag Circle', 3, 'pickup', '09:01 AM', '07:16 AM', '2019-05-21 05:20:14', '2019-05-21 05:20:14'),
(19, 'Jewels Circle', 3, 'pickup', '09:01 AM', '07:26 AM', '2019-05-21 05:21:21', '2019-05-21 05:21:21'),
(20, 'Pani Ni Tanki', 3, 'pickup', '09:01 AM', '07:31 AM', '2019-05-21 05:22:41', '2019-05-21 05:22:41'),
(21, 'Sanskar Mandal', 3, 'pickup', '09:01 AM', '07:41 AM', '2019-05-21 05:23:31', '2019-05-21 05:23:31'),
(22, 'Shivaji Circle', 3, 'pickup', '09:01 AM', '07:46 AM', '2019-05-21 05:24:45', '2019-05-21 05:24:45'),
(23, 'Bharuch ABC Chokdi ', 3, 'drop', '09:01 AM', '12:31 PM', '2019-05-21 05:25:34', '2019-05-21 05:25:34'),
(24, 'Ankleshwar Ashirwad Hotel', 3, 'drop', '09:01 AM', '01:01 PM', '2019-05-21 05:26:42', '2019-05-21 05:26:42'),
(25, 'Kim Kosamba', 3, 'drop', '09:01 AM', '01:46 PM', '2019-05-21 05:28:16', '2019-05-21 05:28:16'),
(26, 'Kamrej ', 3, 'drop', '09:01 AM', '02:16 PM', '2019-05-21 05:29:20', '2019-05-21 05:29:20'),
(27, 'Sarthana Jakat Naka', 3, 'drop', '09:01 AM', '02:31 PM', '2019-05-21 05:31:26', '2019-05-21 05:31:26'),
(28, 'Hirabag Circle ', 3, 'drop', '09:01 AM', '03:01 PM', '2019-05-21 05:32:20', '2019-05-21 05:32:20'),
(29, 'Nilambag Circle', 4, 'pickup', '05:30 PM', '03:46 PM', '2019-05-21 05:37:23', '2019-05-21 05:37:23'),
(30, 'Jewels Circle', 4, 'pickup', '05:30 PM', '03:56 PM', '2019-05-21 05:38:30', '2019-05-21 05:38:30'),
(31, 'Pani Ni Tanki', 4, 'pickup', '05:30 PM', '04:01 PM', '2019-05-21 05:39:57', '2019-05-21 05:39:57'),
(32, 'Sanskar Mandal', 4, 'pickup', '05:30 PM', '04:11 PM', '2019-05-21 05:40:56', '2019-05-21 05:40:56'),
(33, 'Shivaji Circle', 4, 'pickup', '05:30 PM', '04:16 PM', '2019-05-21 05:41:58', '2019-05-21 05:41:58'),
(34, 'Bharuch ABC Chokdi', 4, 'drop', '05:30 PM', '09:01 PM', '2019-05-21 05:42:50', '2019-05-21 05:42:50'),
(35, 'Ankleshwar Ashirwad Hotel', 4, 'drop', '05:30 PM', '09:31 PM', '2019-05-21 05:44:20', '2019-05-21 05:44:20'),
(36, 'Kim Kosamba ', 4, 'drop', '05:30 PM', '10:16 PM', '2019-05-21 05:45:08', '2019-05-21 05:45:39'),
(37, 'Kamrej', 4, 'drop', '05:30 PM', '10:46 PM', '2019-05-21 05:46:38', '2019-05-21 05:46:38'),
(38, 'Sarthana Jakat Naka', 4, 'drop', '05:30 PM', '11:01 PM', '2019-05-21 05:47:39', '2019-05-21 05:47:39'),
(39, 'Hirabag Circle', 4, 'drop', '05:30 PM', '11:31 PM', '2019-05-21 05:48:32', '2019-05-21 05:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_details`
--

CREATE TABLE `ticket_details` (
  `id` int(11) NOT NULL,
  `pnrNumber` varchar(255) NOT NULL,
  `trip` varchar(255) NOT NULL,
  `trip_type` varchar(255) NOT NULL,
  `fromstaton` int(11) NOT NULL,
  `tostation` int(11) NOT NULL,
  `depatureDate` date DEFAULT NULL,
  `returntripDate` date NOT NULL,
  `vehical` varchar(255) NOT NULL,
  `pickupservices` varchar(255) NOT NULL,
  `busRoute` int(11) NOT NULL,
  `tripTime` int(11) NOT NULL,
  `tripPickUpTime` int(11) NOT NULL,
  `tripDropTime` int(11) NOT NULL,
  `ferryTime` varchar(255) NOT NULL,
  `ferryClass` int(11) NOT NULL,
  `noPassanger` int(11) NOT NULL,
  `noPassangerlesstwo` int(11) NOT NULL,
  `noPassangerequal` int(11) NOT NULL,
  `noPassangerharter` int(11) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `phoneNumber` varchar(25) NOT NULL,
  `cityName` varchar(255) NOT NULL,
  `pinCode` int(11) NOT NULL,
  `payment` enum('suceess','fail','pendding') NOT NULL DEFAULT 'pendding',
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_detail` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_details`
--

INSERT INTO `ticket_details` (`id`, `pnrNumber`, `trip`, `trip_type`, `fromstaton`, `tostation`, `depatureDate`, `returntripDate`, `vehical`, `pickupservices`, `busRoute`, `tripTime`, `tripPickUpTime`, `tripDropTime`, `ferryTime`, `ferryClass`, `noPassanger`, `noPassangerlesstwo`, `noPassangerequal`, `noPassangerharter`, `emailAddress`, `phoneNumber`, `cityName`, `pinCode`, `payment`, `transaction_id`, `payment_detail`, `created_at`, `updated_at`) VALUES
(1, 'RORO-22007-2019', 'one-way', 'Without vehicle', 1, 2, '2019-05-18', '0000-00-00', '', 'busservices', 1, 1, 1, 4, '07:00 PM', 8, 2, 0, 0, 2, 'parthkhunt12@gmail.com', '9727466631', 'Surat', 394105, '', NULL, NULL, '2019-05-18 12:44:52', '2019-05-18 12:44:52'),
(2, 'RORO-30357-2019', 'one-way', 'Without vehicle', 1, 2, '2019-05-22', '0000-00-00', '', 'busservices', 1, 1, 3, 6, '07:00 PM', 8, 1, 0, 0, 1, 'harshilshah90@yahoo.com', '9737811326', 'Bharuch', 392001, '', NULL, NULL, '2019-05-21 01:54:26', '2019-05-21 01:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `trip_time`
--

CREATE TABLE `trip_time` (
  `id` int(11) NOT NULL,
  `time` varchar(255) NOT NULL,
  `routeId` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip_time`
--

INSERT INTO `trip_time` (`id`, `time`, `routeId`, `created_at`, `updated_at`) VALUES
(1, '12:00 PM', 1, '2019-05-20 12:43:04', '2019-05-20 12:43:04'),
(2, '08:31 PM', 2, '2019-05-21 04:59:19', '2019-05-21 04:59:19'),
(3, '09:01 AM', 3, '2019-05-21 05:19:18', '2019-05-21 05:19:18'),
(4, '05:30 PM', 4, '2019-05-21 05:34:11', '2019-05-21 05:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `userType` enum('admin','agent') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `image`, `userType`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', '', 'admin', '2019-05-14 03:56:07', '2019-05-14 03:56:07'),
(2, 'agent', 'agent', 'agent@gmail.com', '202cb962ac59075b964b07152d234b70', '', 'agent', '2019-05-14 03:56:36', '2019-05-14 03:56:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `passanger_details`
--
ALTER TABLE `passanger_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route_list`
--
ALTER TABLE `route_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `station_list`
--
ALTER TABLE `station_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_details`
--
ALTER TABLE `ticket_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip_time`
--
ALTER TABLE `trip_time`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `passanger_details`
--
ALTER TABLE `passanger_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `route_list`
--
ALTER TABLE `route_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `station_list`
--
ALTER TABLE `station_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `ticket_details`
--
ALTER TABLE `ticket_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trip_time`
--
ALTER TABLE `trip_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
