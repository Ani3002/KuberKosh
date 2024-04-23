-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Mar 13, 2024 at 07:57 AM
-- Server version: 11.3.2-MariaDB-1:11.3.2+maria~ubu2204
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kuberkosh_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `Bank`
--

CREATE TABLE `Bank` (
  `bank_user_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `default_account` varchar(11) NOT NULL,
  `bank1_IFSC` varchar(11) DEFAULT NULL,
  `bank1_accno` int(15) DEFAULT NULL,
  `bank1_name` varchar(30) DEFAULT NULL,
  `bank1_accbal` int(15) NOT NULL DEFAULT 50000,
  `bank2_IFSC` varchar(11) DEFAULT NULL,
  `bank2_accno` int(15) DEFAULT NULL,
  `bank2_name` varchar(30) DEFAULT NULL,
  `bank2_accbal` int(15) NOT NULL DEFAULT 50000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Bank`
--

INSERT INTO `Bank` (`bank_user_id`, `user_id`, `default_account`, `bank1_IFSC`, `bank1_accno`, `bank1_name`, `bank1_accbal`, `bank2_IFSC`, `bank2_accno`, `bank2_name`, `bank2_accbal`) VALUES
(1, 7, '123456789', 'CBIN0R40012', 123456789, 'UBKGB', 50000, NULL, NULL, NULL, 50000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Bank`
--
ALTER TABLE `Bank`
  ADD PRIMARY KEY (`bank_user_id`),
  ADD KEY `addForeignKey` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Bank`
--
ALTER TABLE `Bank`
  MODIFY `bank_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Bank`
--
ALTER TABLE `Bank`
  ADD CONSTRAINT `addForeignKey` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
