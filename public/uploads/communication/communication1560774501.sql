-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2019 at 05:44 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrms_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `communication`
--

CREATE TABLE `communication` (
  `id` int(10) UNSIGNED NOT NULL,
  `communication_id` int(15) DEFAULT NULL,
  `send_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(10) DEFAULT NULL,
  `send_emp_id` int(10) DEFAULT NULL,
  `recieve_emp_id` int(10) DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `communication`
--

INSERT INTO `communication` (`id`, `communication_id`, `send_by`, `company_id`, `send_emp_id`, `recieve_emp_id`, `message`, `file`, `subject`, `is_read`, `created_at`, `updated_at`) VALUES
(3, NULL, 'COMPANY', 13, NULL, 6, 'send by company', '/uploads/communication/communication1550991255.jpg', 'aaa', 0, '2019-02-23 11:01:02', '2019-02-23 11:01:02'),
(4, NULL, 'EMPLOYEE', 13, 5, 6, 'send by employee', '', 'bbb', 0, '2019-02-23 11:12:40', '2019-02-23 11:12:40'),
(22, 0, 'EMPLOYEE', 13, 6, 5, 'send by emp to emp', NULL, 'send emp to emp', 0, '2019-05-30 09:26:04', '2019-05-30 09:26:04'),
(23, 0, 'EMPLOYEE', 13, 6, 0, 'send by emp to comp', 'asas', 'send emp to comp', 0, '2019-05-30 09:28:24', '2019-05-30 09:28:24'),
(24, 0, 'EMPLOYEE', 13, 6, 7, '<p>emp to zena<br></p>', NULL, 'emp to zena', 0, '2019-05-30 11:08:06', '2019-05-30 11:08:06'),
(25, 0, 'EMPLOYEE', 13, 6, 7, '<p>emp to zena<br></p>', NULL, 'emp to zena', 0, '2019-05-30 11:12:12', '2019-05-30 11:12:12'),
(26, 4, 'EMPLOYEE', 13, 6, 0, 'emp replyyy', NULL, 'bbb', 0, '2019-05-31 10:07:29', '2019-05-31 10:07:29'),
(27, 3, 'EMPLOYEE', 13, 6, 0, '<p>reply to company</p>', NULL, 'aaa', 0, '2019-05-31 10:08:31', '2019-05-31 10:08:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `communication`
--
ALTER TABLE `communication`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `communication`
--
ALTER TABLE `communication`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
