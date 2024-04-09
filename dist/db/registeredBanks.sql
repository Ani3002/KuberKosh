-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Apr 08, 2024 at 02:48 AM
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
-- Table structure for table `registeredBanks`
--

CREATE TABLE `registeredBanks` (
  `bank_name` varchar(30) DEFAULT NULL,
  `regBank_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registeredBanks`
--

INSERT INTO `registeredBanks` (`bank_name`, `regBank_id`) VALUES
('Golden Dragon Bank', 1),
('Bank of Tyrell', 3),
('Iron Bank', 4),
('Bank of the North', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registeredBanks`
--
ALTER TABLE `registeredBanks`
  ADD PRIMARY KEY (`regBank_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registeredBanks`
--
ALTER TABLE `registeredBanks`
  MODIFY `regBank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
