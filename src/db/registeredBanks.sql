-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Mar 15, 2024 at 07:19 PM
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
  `bank_location` varchar(30) DEFAULT NULL,
  `bank_ifsc` varchar(11) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registeredBanks`
--

INSERT INTO `registeredBanks` (`bank_name`, `bank_location`, `bank_ifsc`, `id`) VALUES
('Golden Dragon Bank', 'Winterfell', 'GDB0WF42845', 1),
('Golden Dragon Bank', 'Kings Landing', 'GDB0KL58411', 2),
('Bank of Tyrell', 'High Garden', 'BOT0HG54321', 3),
('Iron Bank', 'Bravos', 'IRB0BR98765', 4),
('Iron Bank', 'Kings Landing', 'IRB0KL12345', 5),
('Bank of the North', 'Winterfell', 'BON0WF56789', 6),
('Bank of the North', 'Kings Landing', 'BON0KL98765', 7),
('Bank of the North', 'High Garden', 'BON0HG23456', 8),
('Bank of the North', 'Bravos', 'BON0BR87654', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registeredBanks`
--
ALTER TABLE `registeredBanks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registeredBanks`
--
ALTER TABLE `registeredBanks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
