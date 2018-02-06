-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2018 at 09:00 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tjdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `pos`
--

CREATE TABLE `pos` (
  `staff_id` int(11) DEFAULT NULL,
  `p_lat` double(10,8) NOT NULL DEFAULT '0.00000000',
  `p_lng` double(10,8) NOT NULL DEFAULT '0.00000000',
  `p_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `r_invoice`
--

CREATE TABLE `r_invoice` (
  `r_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_tel` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `r_date_in` date NOT NULL,
  `r_date_fin` date DEFAULT NULL,
  `r_date_out` date DEFAULT NULL,
  `r_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `r_type2` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `r_type2_desc` text COLLATE utf8_unicode_ci,
  `r_model` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r_eq` text COLLATE utf8_unicode_ci,
  `r_eq2` text COLLATE utf8_unicode_ci,
  `r_eq3` text COLLATE utf8_unicode_ci,
  `r_cost` int(11) DEFAULT '0',
  `r_status` tinyint(4) NOT NULL DEFAULT '0',
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `r_invoice`
--

INSERT INTO `r_invoice` (`r_id`, `user_id`, `user_name`, `user_tel`, `r_date_in`, `r_date_fin`, `r_date_out`, `r_type`, `r_type2`, `r_type2_desc`, `r_model`, `r_eq`, `r_eq2`, `r_eq3`, `r_cost`, `r_status`, `staff_id`) VALUES
(6, 8, 'User 01', '0862353456', '2018-02-02', '2018-02-07', NULL, 'PC', 'ซ่อม', '', 'ASUS', '-', '-', '-', 300, 1, 5),
(7, NULL, 'คุณบี', '0995541233', '2018-02-05', '2018-02-08', NULL, 'NB', 'เคลม', '', 'DELL', '', 'ค้างๆๆๆๆ', '', 300, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `staff_tel` int(15) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `staff_tel`, `user_id`) VALUES
(4, 'Staff 01', 987654321, 15),
(5, 'Staff 02', 741852963, 16);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `user_tel` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `user_status` tinyint(4) NOT NULL,
  `user_level` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_password`, `user_name`, `user_email`, `user_tel`, `user_status`, `user_level`) VALUES
(3, '1234', 'Admin', 'admin@admin', '', 1, 99),
(8, '1234', 'User 01', 'u1@user.com', '0862353456', 1, 1),
(15, '1234', 'Staff 01', 's1@staff', '0987654321', 1, 2),
(16, '1234', 'Staff 02', 's2@staff', '0741852963', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `r_invoice`
--
ALTER TABLE `r_invoice`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email_2` (`user_email`),
  ADD KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `r_invoice`
--
ALTER TABLE `r_invoice`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
