-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: May 05, 2024 at 12:48 PM
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
  `default_bank_account_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Bank`
--

INSERT INTO `Bank` (`bank_user_id`, `user_id`, `default_bank_account_id`) VALUES
(4, 7, 20),
(8, 9, NULL),
(9, 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `bank_account_id` int(11) NOT NULL,
  `bank_user_id` int(11) NOT NULL,
  `account_number` varchar(30) NOT NULL,
  `ifsc_code` varchar(11) NOT NULL,
  `bank_name` varchar(30) NOT NULL,
  `account_balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`bank_account_id`, `bank_user_id`, `account_number`, `ifsc_code`, `bank_name`, `account_balance`) VALUES
(20, 4, '53222', 'GDB0WF42845', 'Iron Bank', 0),
(21, 4, '8768978', 'GDB0WF42845', 'Bank of Tyrell', 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `tr_id` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `wallet_address` varchar(50) NOT NULL,
  `to_wallet_id` int(11) NOT NULL,
  `from_wallet_id` int(11) NOT NULL,
  `amount` int(6) NOT NULL,
  `to_bank_account_id` int(11) NOT NULL,
  `from_bank_account_id` int(11) NOT NULL,
  `remark` varchar(60) NOT NULL,
  `purpose` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_logs`
--

CREATE TABLE `transaction_logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sender_wallet_id` int(11) NOT NULL,
  `receiver_wallet_id` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `log_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `sender_error` text DEFAULT NULL,
  `receiver_error` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_logs`
--

INSERT INTO `transaction_logs` (`log_id`, `user_id`, `sender_wallet_id`, `receiver_wallet_id`, `transaction_id`, `amount`, `status`, `ip_address`, `log_timestamp`, `sender_error`, `receiver_error`) VALUES
(1, 7, 2, 1, 'cee933c458f1721c332f000286d8bbac8e4b0969f9fa3e40427864850dc9ca03', 55.00, 'Success', '172.20.0.1', '2024-05-03 10:44:43', '', ''),
(2, 7, 2, 1, 'f2f56bab9e8f429138cd00a051ba96220c05162fab87308d8ce848e97b46e41f', 45.00, 'Success', '172.20.0.1', '2024-05-03 10:54:23', '', ''),
(3, 7, 2, 1, '90ce04a7a16d26271c70949479f42df26bf69f6e6b16b6ed8d85b87b3da7bf29', 65.00, 'Success', '172.20.0.1', '2024-05-03 15:51:32', '', ''),
(4, 7, 2, 1, 'a88995607e7183315d99cd9f78cdea38051517e833856b32b5629478cf7095e2', 121.00, 'Success', '172.20.0.1', '2024-05-03 16:03:00', '', ''),
(5, 7, 2, 1, '394a37c2f8ba71541506180728d16aace61300ee40b20735239d5fbfa217f140', 66.00, 'Success', '172.20.0.1', '2024-05-03 16:31:20', '', ''),
(6, 7, 2, 1, '59eb858ddf858ee70477f6d38451c9d05f25c1f4b7d394a939508f9a5f248c2d', 45.00, 'Success', '172.20.0.1', '2024-05-03 17:00:02', '', ''),
(7, 9, 1, 2, '6ccc6b35d35709a0db0041d5d66a8bef092a815e02a67739f7d6a458ad8c535e', 145.00, 'Success', '172.20.0.1', '2024-05-03 17:29:16', '', ''),
(8, 9, 1, 2, '5779513ca72ed7d2b96c1918a646f86961d4e33556dc276d52efa815be482a5d', 145.00, 'Success', '172.20.0.1', '2024-05-03 17:29:30', '', ''),
(9, 9, 1, 2, '3c7c4063a4067b9c639b467e8c54a838391ec30359f899d3ef2e593d843ded80', 145.00, 'Success', '172.20.0.1', '2024-05-03 17:32:38', '', ''),
(10, 7, 2, 1, 'e4c095bffd7804208d31c568ad38e5fb8adaebe612a95274dc84a1d3c679cb01', 55.00, 'Success', '172.20.0.1', '2024-05-03 17:33:11', '', ''),
(11, 7, 2, 1, '30748d9ac9eef279c3e23ac5641dc1ada5a5ac0915b4bf778f6edebd9f14513f', 55.00, 'Success', '172.20.0.1', '2024-05-03 17:33:37', '', ''),
(12, 7, 2, 1, '9aca334beb0ce2a30765c29e950c96b9e660979652146e4237985b8d325c9722', 66.00, 'Success', '172.20.0.1', '2024-05-03 17:37:59', '', ''),
(13, 7, 2, 1, 'e94a41eb41b2b366ef31a54e393dabf1022f95108d91d9210d6cd90cf8520dfc', 66.00, 'Success', '172.20.0.1', '2024-05-03 17:39:12', '', ''),
(14, 7, 2, 1, '86b75e650eec2c52fa6080a1c101686b569b90b4465e4a11cb9525099c3c7670', 66.00, 'Success', '172.20.0.1', '2024-05-03 17:47:07', '', ''),
(15, 9, 1, 1, 'b8446c1de3ca1b34bfc1c9474b9f337bca458eee959f53822abeb20a8e4efba6', 145.00, 'Success', '172.20.0.1', '2024-05-03 17:48:20', '', ''),
(16, 9, 1, 2, '4e08d167de8d4ccd89f2d8373c4186208ef7171c00d9cf828e1ec0faf53a1bc8', 145.00, 'Success', '172.20.0.1', '2024-05-03 17:51:26', '', ''),
(17, 9, 1, 2, 'd1e46e07912ca6aa1b450e70919027e1d99cf831efd5d1825f672832ce03eccc', 145.00, 'Success', '172.20.0.1', '2024-05-03 18:15:42', '', ''),
(18, 9, 1, 1, '6c6d4e60d597149966c91e8d17c7bc93b0366ba74465da88a6f0900924dfd261', 55.00, 'Success', '172.27.0.1', '2024-05-04 12:35:11', '', ''),
(19, 9, 1, 1, 'b9a7f438a1a0fd9c80bf8090e0593f40cff2f33dcea40d34ead12074d4bd00d8', 55.00, 'Success', '172.27.0.1', '2024-05-04 12:36:51', '', ''),
(20, 9, 1, 2, 'f7587579dd16bc572e3883370f943b3d181d8f0578bb99b58e141180be63f1c3', 145.00, 'Success', '172.18.0.1', '2024-05-04 14:13:56', '', ''),
(21, 9, 1, 2, '06de5b040bcbd88e1c22e3589e3894187b136bef32644f26999023cc3939d0ea', 145.00, 'Success', '172.18.0.1', '2024-05-04 14:16:21', '', ''),
(22, 9, 1, 2, 'cf4428bae05825f0f64f4f10533e30fcc277c8ddee193e8e912b16ba0f3afffc', 54.00, 'Success', '172.18.0.1', '2024-05-04 14:56:13', '', ''),
(23, 9, 1, 2, '176c8dd2698a8fc1c840ac338aea9bc2ae777ca82d435f4ba1a2d9852e6bb2d9', 221.00, 'Success', '172.18.0.1', '2024-05-04 15:27:44', '', ''),
(24, 9, 1, 2, 'dad76f9f407fa3f1ec400951fc57015bfbdf2bce9caedd49afebb4e8ca754816', 221.00, 'Success', '172.18.0.1', '2024-05-04 15:30:31', '', ''),
(25, 9, 1, 2, '7ef7000660d44f14737a5a726cdc6256261e6cec49f83994103137ed8c78e9ca', 45.00, 'Success', '172.18.0.1', '2024-05-04 16:29:02', '', ''),
(26, 9, 1, 2, '321731ea7438f96c40e1db78fa2bc7a3484652158c44d7396e50f9bb87fc886f', 145.00, 'Success', '172.18.0.1', '2024-05-04 17:13:46', '', ''),
(27, 9, 1, 2, 'f99f70c927ce93d9c0a215e657a8ef33be60373300537b5c7dc1d682c75918b5', 222.00, 'Success', '172.18.0.1', '2024-05-04 17:17:55', '', ''),
(28, 9, 1, 2, '0d24ccf8428375027549277524e9b55d24959be1a5433e93d869ecb15875a65b', 221.00, 'Success', '172.18.0.1', '2024-05-04 17:20:33', '', ''),
(29, 9, 1, 2, '78c5e0ae82ef91968558613c2b6a0b9604edc6170c55fe3e3cec78571946a7dd', 221.00, 'Success', '172.18.0.1', '2024-05-04 17:28:01', '', ''),
(30, 9, 1, 2, '3a1db80d40886651b1ad0601648519bf6606e5f5d0a9943b585d3c197e1a12c8', 5.00, 'Success', '172.18.0.1', '2024-05-04 17:30:57', '', ''),
(31, 9, 1, 2, '2babfbf6be1d069afd27f62bdfc441639b093c6b8afa66d72e19624b11790e68', 65.00, 'Success', '172.18.0.1', '2024-05-04 17:31:53', '', ''),
(32, 9, 1, 2, 'd4133d1de8b4ad4bdb867222e0d9d25df5f482915a7ea9727415b9bba3cfbce8', 145.00, 'Success', '172.18.0.1', '2024-05-04 17:34:55', '', ''),
(33, 9, 1, 2, '29e620584e7ad1b3ef7eec8c86b48e4dbc712bb485c2ebbc3a1721d997d9048f', 221.00, 'Success', '172.18.0.1', '2024-05-04 17:36:24', '', ''),
(34, 9, 1, 2, '1c421685ba75f00461e6f2b99c0cef92df3160527f2191b5ab415887791cc421', 2.00, 'Success', '172.18.0.1', '2024-05-04 17:38:50', '', ''),
(35, 9, 1, 2, '5ea79ac10c40f7b21405f77199b5aea124a708498cc2325f2de15c0f8560642b', 14.00, 'Success', '172.18.0.1', '2024-05-04 17:40:49', '', ''),
(36, 9, 1, 2, 'ff1a9a0bd2a831cf8c9d51dc1f452cc651dca77520ee55db447523bae3502117', 21.00, 'Success', '172.18.0.1', '2024-05-04 17:41:46', '', ''),
(37, 9, 1, 2, '79d7c9a42cca7a28040764926b4058d8abd26a0d801e9fbf0199a6c0ba7c63f7', 2.00, 'Success', '172.18.0.1', '2024-05-04 18:33:37', '', ''),
(38, 9, 1, 2, '998d1801b83738d7a9d83b680277b1b6737b32172580c1fcdf40f525cdbbd22a', 1.00, 'Success', '172.18.0.1', '2024-05-04 18:36:26', '', ''),
(39, 9, 1, 2, '15066819144e1e32ef105dad7a06e915ceff0e7a25707ca9ac05f4b7f7cacc1b', 1.00, 'Success', '172.18.0.1', '2024-05-04 18:38:12', '', ''),
(40, 9, 1, 2, '61a26904edede053a721e3f0859adb3dddcaa7660cb64c3791a8767e82f77474', 1.00, 'Success', '172.18.0.1', '2024-05-04 18:38:48', '', ''),
(41, 9, 1, 2, 'c95efb06cc7ceca7ed69b968a9662c48b3378bfa6bf79a9d35239be7eaac8cca', 1.00, 'Success', '172.18.0.1', '2024-05-04 18:39:27', '', ''),
(42, 9, 1, 2, 'e5686b5b099adaa68a1ecf4d3a204b693035eae4d5dbd2dd3dde4f025c073259', 1.00, 'Success', '172.18.0.1', '2024-05-04 18:40:30', '', ''),
(43, 9, 1, 2, 'ae36addc8e25327c4d355c1dc1b5e364f5787acde1cbbef0bc35d536d6e8da65', 1.00, 'Success', '172.18.0.1', '2024-05-04 18:43:04', '', ''),
(44, 9, 1, 2, '29a55a510e62c6a6494231d208a2cca18e1b86357526e3e08fe1b9df239370f5', 1.00, 'Success', '172.18.0.1', '2024-05-04 18:44:18', '', ''),
(45, 9, 1, 1, '78552bde625b33007cbda1f2700ef7820687e31ccc101abcbe4649d75df76ac7', 1.00, 'Success', '172.18.0.1', '2024-05-04 18:59:03', '', ''),
(46, 7, 2, 1, 'fae4ec55d02ab4c7ae7c3a4d2e18fc0d9dd4797619dd601ef3a7e5736cc37f25', 300.00, 'Success', '172.18.0.1', '2024-05-04 19:39:10', '', ''),
(47, 9, 1, 2, 'b5a82c12ea7c6f14696dd1457c0e04b821b2f2e44969996c9c38995ce16153a9', 1.00, 'Success', '172.18.0.1', '2024-05-04 20:47:59', '', ''),
(48, 9, 1, 2, '72d7a4ffdab6aef68c3cc6dc53f9a0a7ecd70f429ca4444b62de6fa18e114e9d', 1.00, 'Success', '172.18.0.1', '2024-05-04 20:48:23', '', ''),
(49, 7, 2, 1, '07ba68061ae9d747bb87be1bd056a4d2a726425047126739dbcca2decec3960f', 1.00, 'Success', '172.18.0.1', '2024-05-04 20:49:27', '', ''),
(50, 7, 2, 1, 'c4e0c031a68d9c57e8c5713c3139d98fb6bc028d0ba2ff5264bb6786d4003472', 1.00, 'Success', '172.18.0.1', '2024-05-04 20:50:27', '', ''),
(51, 7, 2, 1, '62c518a4aa2f754ad759fa4e8ecb042545f1daec27bfac322b02d5888d22431e', 1.00, 'Success', '172.18.0.1', '2024-05-04 20:51:26', '', ''),
(52, 7, 2, 1, 'b9e50f162581ff2e666f2ec7003319f4475147446bf6b6b82fed5eb744df39d7', 1.00, 'Success', '172.18.0.1', '2024-05-04 20:55:50', '', ''),
(53, 7, 2, 1, 'fcc135fc49c7da1cf64936fe50aa0644494bde00cdf25bab41ee4bf141713d81', 1.00, 'Success', '172.18.0.1', '2024-05-04 20:56:10', '', ''),
(54, 7, 2, 1, '001267de42ff56fee03babb8f48027136a77f4401737f9e213e96a200abfa13c', 55.00, 'Success', '172.18.0.1', '2024-05-04 20:57:04', '', ''),
(55, 7, 2, 2, '51a912b20a433b1f4d0665ee713daff385bab67b8151a32e151843c3052ab086', 55.00, 'Success', '172.18.0.1', '2024-05-04 20:57:30', '', ''),
(56, 7, 2, 1, 'fdca949e24b4fc3293273602582299d830f48d973f6ef4a99feb3183a70ab4b1', 1.00, 'Success', '172.18.0.1', '2024-05-04 20:57:52', '', ''),
(57, 7, 2, 1, '8b42abeae96d8d43e569fb69426e2553786b68076c54d5bba3803c65c6242810', 1.00, 'Success', '172.18.0.1', '2024-05-04 20:58:12', '', ''),
(58, 7, 2, 1, 'c908619cf3d76a027feb3e49e3801760ff63439046541ca7d099aad9f4c648f4', 1.00, 'Success', '172.18.0.1', '2024-05-04 21:00:24', '', ''),
(59, 7, 2, 1, '71f076b33cd0facc0f90fbde5e7276d9e9db4abf7f4b8c7e2329730b965d8bb9', 1.00, 'Success', '172.18.0.1', '2024-05-04 21:01:41', '', ''),
(60, 7, 2, 1, '2c0b49b30b4071e9f90c032ea346804874f259d4308eb309111097680ca66718', 1.00, 'Success', '172.18.0.1', '2024-05-04 21:01:59', '', ''),
(61, 7, 2, 1, '393313917bd16d55b60cfdb3bcbc2aba2e7955667e6153f14aba2dbbe856b5e3', 1.00, 'Success', '172.18.0.1', '2024-05-04 21:02:28', '', ''),
(62, 7, 2, 1, '3b3d7a21828a174ef7b6dbf8c38602cd10a171fa908218e084acaa1b03be7452', 1.00, 'Success', '172.18.0.1', '2024-05-04 21:02:40', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `oauth_provider` enum('google','github') NOT NULL DEFAULT 'google',
  `oauth_uid` varchar(50) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(11) DEFAULT NULL,
  `locale` varchar(10) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `mobile` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `email`, `gender`, `locale`, `picture`, `created`, `modified`, `mobile`) VALUES
(2, 'google', '123456789', 'John', 'Doe', 'john.doe@example.com', 'Male', 'en_US', 'https://example.com/profile_picture.jpg', '2024-03-11 11:47:32', '2024-03-11 11:47:32', NULL),
(7, 'google', '114933736750837706553', 'Anirban', 'Routh', 'routhanirban9655@gmail.com', NULL, 'en', 'https://lh3.googleusercontent.com/a/ACg8ocJAHNW-ndFXwkGVyO4VIq9ux09OfDqnXhal5q2MP4kZ=s96-c', '2024-03-12 18:27:12', '2024-03-12 18:27:12', NULL),
(9, 'google', '116176670371830887822', 'Anirban', 'Routh', 'routhanirban965@gmail.com', NULL, 'en-GB', 'https://lh3.googleusercontent.com/a/ACg8ocL9fysl8woHkpQtpSxBPmsmiNcdhZ0tUpT3N9_ySkkA=s96-c', '2024-03-16 11:52:30', '2024-03-16 11:52:30', NULL),
(10, 'google', '114081013324461782364', 'NIPU DEY', 'ROUTH', 'nipu735224@gmail.com', NULL, 'en', 'https://lh3.googleusercontent.com/a/ACg8ocIiohe65vNuE7FWld3PE-NyiPR4gHj82mnTiGWrCWidak6Lhw=s96-c', '2024-05-04 19:02:29', '2024-05-04 19:02:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `wallet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `wallet_address` varchar(50) NOT NULL,
  `wallet_pin` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`wallet_id`, `user_id`, `wallet_address`, `wallet_pin`) VALUES
(1, 9, 'routhanirban95@kkosh', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92'),
(2, 7, 'routhanirban9655@kkosh', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92'),
(3, 10, 'nipu735224@kkosh', '0e06a93f7888d926e3f96ca2d5607e220ed183f20b5332e885a0bfae947d2241');

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
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`bank_account_id`),
  ADD KEY `fk` (`bank_user_id`);

--
-- Indexes for table `bank_brunches`
--
ALTER TABLE `bank_brunches`
  ADD PRIMARY KEY (`brunch_id`),
  ADD KEY `test` (`regBank_id`);

--
-- Indexes for table `registeredBanks`
--
ALTER TABLE `registeredBanks`
  ADD PRIMARY KEY (`regBank_id`);

--
-- Indexes for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`wallet_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Bank`
--
ALTER TABLE `Bank`
  MODIFY `bank_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `bank_account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `bank_brunches`
--
ALTER TABLE `bank_brunches`
  MODIFY `brunch_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `registeredBanks`
--
ALTER TABLE `registeredBanks`
  MODIFY `regBank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `wallet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Bank`
--
ALTER TABLE `Bank`
  ADD CONSTRAINT `addForeignKey` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD CONSTRAINT `fk` FOREIGN KEY (`bank_user_id`) REFERENCES `Bank` (`bank_user_id`);

--
-- Constraints for table `bank_brunches`
--
ALTER TABLE `bank_brunches`
  ADD CONSTRAINT `test` FOREIGN KEY (`regBank_id`) REFERENCES `registeredBanks` (`regBank_id`);

--
-- Constraints for table `wallet`
--
ALTER TABLE `wallet`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
