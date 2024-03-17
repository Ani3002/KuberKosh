-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Mar 15, 2024 at 09:11 PM
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
-- Table structure for table `bank_brunches`
--

CREATE TABLE `bank_brunches` (
  `brunch_id` int(15) NOT NULL,
  `regBank_id` int(15) NOT NULL,
  `brunchLocation` varchar(30) NOT NULL,
  `ifsc` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank_brunches`
--

INSERT INTO `bank_brunches` (`brunch_id`, `regBank_id`, `brunchLocation`, `ifsc`) VALUES
(1, 1, 'Winterfell', 'GDB0WF42845'),
(2, 1, 'Kings Landing', 'GDB0KL58411'),
(3, 3, 'High Garden', 'BOT0HG54321'),
(4, 4, 'Bravos', 'IRB0BR98765'),
(5, 4, 'Kings Landing', 'IRB0KL12345'),
(6, 6, 'Winterfell', 'BON0WF56789'),
(7, 6, 'Kings Landing', 'BON0KL98765'),
(8, 6, 'High Garden', 'BON0HG23456'),
(9, 6, 'Bravos', 'BON0BR87654');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_brunches`
--
ALTER TABLE `bank_brunches`
  ADD PRIMARY KEY (`brunch_id`),
  ADD KEY `test` (`regBank_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_brunches`
--
ALTER TABLE `bank_brunches`
  MODIFY `brunch_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_brunches`
--
ALTER TABLE `bank_brunches`
  ADD CONSTRAINT `test` FOREIGN KEY (`regBank_id`) REFERENCES `registeredBanks` (`regBank_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
