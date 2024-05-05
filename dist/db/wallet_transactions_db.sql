-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: May 05, 2024 at 12:49 PM
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
-- Database: `wallet_transactions_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `1`
--

CREATE TABLE `1` (
  `trnx_no` int(15) NOT NULL,
  `Date` date NOT NULL,
  `Particulars` varchar(300) NOT NULL,
  `Trnx_id` varchar(100) NOT NULL,
  `debit` int(11) DEFAULT NULL,
  `credit` int(11) DEFAULT NULL,
  `end_balance` int(11) NOT NULL,
  `trnxPurpose` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `1`
--

INSERT INTO `1` (`trnx_no`, `Date`, `Particulars`, `Trnx_id`, `debit`, `credit`, `end_balance`, `trnxPurpose`) VALUES
(9, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430143721', '9c52e0ed7253e3365382f691018ebabf4d2b3e132939eb5b1bd709c0ec531e1e', NULL, 66, 66, NULL),
(10, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430155409', '45b78bc320584455de98fff57cd9220efc18f2acd97005efd204b5e543bafbbc', NULL, 65, 131, NULL),
(11, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430155510', '7a8fe3650308d6b39f3dc6a4cb9c6f61475dbaf04130cf8bdbbbacbd4f3de086', NULL, 66, 197, NULL),
(12, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430155520', 'fbcf6d648bf9b3ba602fbd91da93c674536b33aa5f7061a834703afbc25d64de', NULL, 66, 263, NULL),
(13, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430155635', '86c782a890bc6fc9f8d8d9a8393afc2b834e63ab44ce21648e337f36f09f65fa', NULL, 66, 329, NULL),
(14, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430155639', 'b63aac85702d1d51ae287241c0be2c3397d384f7ba1204a56056e16398d5bfc6', NULL, 66, 395, NULL),
(15, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430155719', '418956ae1df6eb04845da956e34d1eb626dbba4124fe9705a64a983a6f9285b5', NULL, 45, 440, NULL),
(16, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430160101', 'a3559677a060e691f054e41933bcd954b8df2b79a47f9b4f3a3f5f0cefc60533', NULL, 45, 485, NULL),
(17, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430165453', 'f1cfdbb6e87976be9f40899d81b31705d77356da5a3de83b9db9bff5b63152c9', NULL, 55, 540, NULL),
(18, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430165504', 'ca9755df254cf8e8a6847cad55812f46d2060be612a0319edbe1f0d5eb1c938b', NULL, 55, 595, NULL),
(19, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430165853', '9245d33579122a7d712431709c1e86667b7e155144625f732aa3b35635dcee7a', NULL, 55, 650, NULL),
(20, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430165906', '5b8551857812608971c817762cf75466f84a162c1c97636fcafa20331f69ed2a', NULL, 55, 705, NULL),
(21, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430170008', 'd22a9eb50a95d587527c7e7bb16f7904cbe116f85ad8fc17c7b9183aa9166abb', NULL, 66, 771, NULL),
(22, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430170701', 'af2037d003b5edf1bae90076761f824316260a96ac4b362af85251fb63d5e47a', NULL, 66, 837, NULL),
(23, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430171319', '6263c0fb01c04ce63d886be1436e61433db8d5d124ecff9b6c204eb0d6e992b2', NULL, 45, 882, NULL),
(24, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430171733', '3a7ea2753546a84e9d214dd186d2d7616a24ca6db08826add309a2da99af17ec', NULL, 66, 948, NULL),
(25, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430171829', 'db788e43b5b071100b4ac26928b8a6b28bc1f7e9bd0109f9d1e67e3f51ba18ba', NULL, 66, 1014, NULL),
(26, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430171959', '2b02e9996079f2684f279de1f713c85fe27190e1114f6127edd04c90503e0b20', NULL, 45, 1059, NULL),
(27, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430172140', 'f33c3a31a6d733d58dd063e4896e1971b005cf6188545a92f24f9ca07732280a', NULL, 65, 1124, NULL),
(28, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430172717', '57e5132f10647e70adb5881942a753a1d239cd1d0c3740bb3e0dfb965ee78743', NULL, 66, 1190, NULL),
(29, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430172813', '54bd84edb5d2811a9fd7d3bd497ef63a3c5ee43819524536188097bdf4d75fe8', NULL, 45, 1235, NULL),
(30, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430175754', 'edf840f7b9aa1a30444c08739a2af801bd65726eb5545bab22710c0aaa577085', NULL, 45, 1280, NULL),
(31, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430180011', '2ec923cdac6ba7515d6f7faf29aead3ac074f20ffbdb24c45d25f2c4fd94e218', NULL, 65, 1345, NULL),
(32, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430180434', 'a02b6eab4a2a630588c10081464d9487f0117d4e7b38b8b8e96dcf68e2da275c', NULL, 45, 1390, NULL),
(33, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430180716', '079765c66a62153e2b487c09a10914863394381852c6fb7993b877f85ba13d5a', NULL, 45, 1435, NULL),
(34, '2024-05-01', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240501152922', 'c8644e1cbfe4ee8ea89c529f9cd0cd86460bafd04fab0e25e1a5ebd1d22c1f1b', NULL, 45, 1480, NULL),
(35, '2024-05-01', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240501154413', '2f03ec1be7b401b8a2c90a4ca6e723db02e02ef905d8654b1ddd919d916031b0', NULL, 55, 1535, NULL),
(36, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240503091545', '8162a14f4a95a8236cb59978f286dfbd879842e6aeea848db32c17fcbe9fabdd', NULL, 45, 1580, NULL),
(37, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240503093008', '68abe224c6ef79c43676253c24f97a61521325d3f3b1e203a3b3ae93d381cf83', NULL, 45, 1625, NULL),
(38, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240503093101', 'e5bc92a0c7323161fd63dd78fea9d307bf31b416f2bc4d74dab6e1bb2c1c8aba', NULL, 65, 1690, NULL),
(39, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240503093646', '2f1f5b20e8331764c5b381af8b0dee21ea65fb1e6d54b5c0107460a258e3cf7b', NULL, 45, 1735, NULL),
(40, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240503094313', '528f77ab60ed1355451320e2b0725457cc4737d26e9259015712c22fd7a83829', NULL, 45, 1780, NULL),
(41, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240503094337', 'c4858cdb9c8e1c75111830ded85ab554628d62accd07b3c7b2f28d14680914da', NULL, 45, 1825, NULL),
(42, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240503094444', 'f3d973d55977d6f064587d19b4806f557c44213018b2a9b6f3cdf07773d33fa5', NULL, 45, 1870, NULL),
(43, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240503094855', 'be8e181650b1abc4ecf8d8f3af269e8579e0a8aa8e4c598bfbe1202a9486e99f', NULL, 55, 1925, NULL),
(44, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240503104443', 'cee933c458f1721c332f000286d8bbac8e4b0969f9fa3e40427864850dc9ca03', NULL, 55, 1980, NULL),
(45, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240503105423', 'f2f56bab9e8f429138cd00a051ba96220c05162fab87308d8ce848e97b46e41f', NULL, 45, 2025, NULL),
(46, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240503155132', '90ce04a7a16d26271c70949479f42df26bf69f6e6b16b6ed8d85b87b3da7bf29', NULL, 65, 2090, NULL),
(47, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240503160300', 'a88995607e7183315d99cd9f78cdea38051517e833856b32b5629478cf7095e2', NULL, 121, 2211, NULL),
(48, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240503163120', '394a37c2f8ba71541506180728d16aace61300ee40b20735239d5fbfa217f140', NULL, 66, 2277, NULL),
(49, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240503170002', '59eb858ddf858ee70477f6d38451c9d05f25c1f4b7d394a939508f9a5f248c2d', NULL, 45, 2322, NULL),
(50, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240503172916/Travel/test remarks', '6ccc6b35d35709a0db0041d5d66a8bef092a815e02a67739f7d6a458ad8c535e', 145, NULL, 2177, 'Travel'),
(51, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240503172930/Travel/test remarks', '5779513ca72ed7d2b96c1918a646f86961d4e33556dc276d52efa815be482a5d', 145, NULL, 2032, 'Travel'),
(52, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240503173238/test/test remarks', '3c7c4063a4067b9c639b467e8c54a838391ec30359f899d3ef2e593d843ded80', 145, NULL, 1887, 'test'),
(53, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240503173311//gf', 'e4c095bffd7804208d31c568ad38e5fb8adaebe612a95274dc84a1d3c679cb01', NULL, 55, 1942, NULL),
(54, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240503173337/test/rtytr', '30748d9ac9eef279c3e23ac5641dc1ada5a5ac0915b4bf778f6edebd9f14513f', NULL, 55, 1997, 'test'),
(55, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240503173759/Travel/gdf', '9aca334beb0ce2a30765c29e950c96b9e660979652146e4237985b8d325c9722', NULL, 66, 2063, 'Travel'),
(56, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240503173912/Travel/rtytr', 'e94a41eb41b2b366ef31a54e393dabf1022f95108d91d9210d6cd90cf8520dfc', NULL, 66, 2129, 'Travel'),
(57, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240503174707/test/rtytr', '86b75e650eec2c52fa6080a1c101686b569b90b4465e4a11cb9525099c3c7670', NULL, 66, 2195, 'test'),
(58, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240503174820/test/test remarks', 'b8446c1de3ca1b34bfc1c9474b9f337bca458eee959f53822abeb20a8e4efba6', 145, NULL, 2050, 'test'),
(59, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240503174820/test/test remarks', 'b8446c1de3ca1b34bfc1c9474b9f337bca458eee959f53822abeb20a8e4efba6', NULL, 145, 2340, 'test'),
(60, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240503175126/test/test remarks', '4e08d167de8d4ccd89f2d8373c4186208ef7171c00d9cf828e1ec0faf53a1bc8', 145, NULL, 2195, 'test'),
(61, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240503181542/test/test remarks', 'd1e46e07912ca6aa1b450e70919027e1d99cf831efd5d1825f672832ce03eccc', 145, NULL, 2050, 'test'),
(62, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240504123511/Travel/gdf', '6c6d4e60d597149966c91e8d17c7bc93b0366ba74465da88a6f0900924dfd261', 55, NULL, 1995, 'Travel'),
(63, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504123511/Travel/gdf', '6c6d4e60d597149966c91e8d17c7bc93b0366ba74465da88a6f0900924dfd261', NULL, 55, 2105, 'Travel'),
(64, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240504123651/Food/gf', 'b9a7f438a1a0fd9c80bf8090e0593f40cff2f33dcea40d34ead12074d4bd00d8', 55, NULL, 2050, 'Food'),
(65, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504123651/Food/gf', 'b9a7f438a1a0fd9c80bf8090e0593f40cff2f33dcea40d34ead12074d4bd00d8', NULL, 55, 2160, 'Food'),
(66, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504141356/Travel/test remarks', 'f7587579dd16bc572e3883370f943b3d181d8f0578bb99b58e141180be63f1c3', 145, NULL, 2015, 'Travel'),
(67, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504141621/test/test remarks', '06de5b040bcbd88e1c22e3589e3894187b136bef32644f26999023cc3939d0ea', 145, NULL, 1870, 'test'),
(68, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504145613/fgh/fgh', 'cf4428bae05825f0f64f4f10533e30fcc277c8ddee193e8e912b16ba0f3afffc', 54, NULL, 1816, 'fgh'),
(69, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504152744/Travel/test remarks', '176c8dd2698a8fc1c840ac338aea9bc2ae777ca82d435f4ba1a2d9852e6bb2d9', 221, NULL, 1595, 'Travel'),
(70, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504153031/Travel/test remarks', 'dad76f9f407fa3f1ec400951fc57015bfbdf2bce9caedd49afebb4e8ca754816', 221, NULL, 1374, 'Travel'),
(71, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504162902/Travel/test remarksfgffdf', '7ef7000660d44f14737a5a726cdc6256261e6cec49f83994103137ed8c78e9ca', 45, NULL, 1329, 'Travel'),
(72, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504171346/fgh/fgh', '321731ea7438f96c40e1db78fa2bc7a3484652158c44d7396e50f9bb87fc886f', 145, NULL, 1184, 'fgh'),
(73, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504171755/Travel/Test', 'f99f70c927ce93d9c0a215e657a8ef33be60373300537b5c7dc1d682c75918b5', 222, NULL, 962, 'Travel'),
(74, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504172033/gdfg/fdg', '0d24ccf8428375027549277524e9b55d24959be1a5433e93d869ecb15875a65b', 221, NULL, 741, 'gdfg'),
(75, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504172801/fgh/test remarks', '78c5e0ae82ef91968558613c2b6a0b9604edc6170c55fe3e3cec78571946a7dd', 221, NULL, 520, 'fgh'),
(76, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504173057/fgh/test remarks', '3a1db80d40886651b1ad0601648519bf6606e5f5d0a9943b585d3c197e1a12c8', 5, NULL, 515, 'fgh'),
(77, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504173153/b/dfg', '2babfbf6be1d069afd27f62bdfc441639b093c6b8afa66d72e19624b11790e68', 65, NULL, 450, 'b'),
(78, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504173455/fgh/test remarks', 'd4133d1de8b4ad4bdb867222e0d9d25df5f482915a7ea9727415b9bba3cfbce8', 145, NULL, 305, 'fgh'),
(79, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504173624/fgh/test remarks', '29e620584e7ad1b3ef7eec8c86b48e4dbc712bb485c2ebbc3a1721d997d9048f', 221, NULL, 84, 'fgh'),
(80, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504173850/fgh/test remarks', '1c421685ba75f00461e6f2b99c0cef92df3160527f2191b5ab415887791cc421', 2, NULL, 82, 'fgh'),
(81, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504174049/fgh/test remarks', '5ea79ac10c40f7b21405f77199b5aea124a708498cc2325f2de15c0f8560642b', 14, NULL, 68, 'fgh'),
(82, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504174146/b/', 'ff1a9a0bd2a831cf8c9d51dc1f452cc651dca77520ee55db447523bae3502117', 21, NULL, 47, 'b'),
(83, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504183337/Travel/test remarks', '79d7c9a42cca7a28040764926b4058d8abd26a0d801e9fbf0199a6c0ba7c63f7', 2, NULL, 45, 'Travel'),
(84, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504183626/fgh/dfg', '998d1801b83738d7a9d83b680277b1b6737b32172580c1fcdf40f525cdbbd22a', 1, NULL, 44, 'fgh'),
(85, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504183812/test/test remarks', '15066819144e1e32ef105dad7a06e915ceff0e7a25707ca9ac05f4b7f7cacc1b', 1, NULL, 43, 'test'),
(86, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504183848//', '61a26904edede053a721e3f0859adb3dddcaa7660cb64c3791a8767e82f77474', 1, NULL, 42, ''),
(87, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504183927//', 'c95efb06cc7ceca7ed69b968a9662c48b3378bfa6bf79a9d35239be7eaac8cca', 1, NULL, 41, ''),
(88, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504184030//', 'e5686b5b099adaa68a1ecf4d3a204b693035eae4d5dbd2dd3dde4f025c073259', 1, NULL, 40, ''),
(89, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504184304//', 'ae36addc8e25327c4d355c1dc1b5e364f5787acde1cbbef0bc35d536d6e8da65', 1, NULL, 39, ''),
(90, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504184418//', '29a55a510e62c6a6494231d208a2cca18e1b86357526e3e08fe1b9df239370f5', 1, NULL, 38, ''),
(91, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240504185903/Travel/gf', '78552bde625b33007cbda1f2700ef7820687e31ccc101abcbe4649d75df76ac7', 1, NULL, 37, 'Travel'),
(92, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504185903/Travel/gf', '78552bde625b33007cbda1f2700ef7820687e31ccc101abcbe4649d75df76ac7', NULL, 1, 39, 'Travel'),
(93, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240504193910//', 'fae4ec55d02ab4c7ae7c3a4d2e18fc0d9dd4797619dd601ef3a7e5736cc37f25', NULL, 300, 339, ''),
(94, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504204759//', 'b5a82c12ea7c6f14696dd1457c0e04b821b2f2e44969996c9c38995ce16153a9', 1, NULL, 338, ''),
(95, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504204823//', '72d7a4ffdab6aef68c3cc6dc53f9a0a7ecd70f429ca4444b62de6fa18e114e9d', 1, NULL, 337, ''),
(96, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240504204927//', '07ba68061ae9d747bb87be1bd056a4d2a726425047126739dbcca2decec3960f', NULL, 1, 338, ''),
(97, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240504205027//', 'c4e0c031a68d9c57e8c5713c3139d98fb6bc028d0ba2ff5264bb6786d4003472', NULL, 1, 339, ''),
(98, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240504205126//', '62c518a4aa2f754ad759fa4e8ecb042545f1daec27bfac322b02d5888d22431e', NULL, 1, 340, ''),
(99, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240504205550//', 'b9e50f162581ff2e666f2ec7003319f4475147446bf6b6b82fed5eb744df39d7', NULL, 1, 341, ''),
(100, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240504205610//', 'fcc135fc49c7da1cf64936fe50aa0644494bde00cdf25bab41ee4bf141713d81', NULL, 1, 342, ''),
(101, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240504205704/Travel/', '001267de42ff56fee03babb8f48027136a77f4401737f9e213e96a200abfa13c', NULL, 55, 397, 'Travel'),
(102, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240504205752//', 'fdca949e24b4fc3293273602582299d830f48d973f6ef4a99feb3183a70ab4b1', NULL, 1, 398, ''),
(103, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240504205812//', '8b42abeae96d8d43e569fb69426e2553786b68076c54d5bba3803c65c6242810', NULL, 1, 399, ''),
(104, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240504210024//', 'c908619cf3d76a027feb3e49e3801760ff63439046541ca7d099aad9f4c648f4', NULL, 1, 400, ''),
(105, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240504210141//', '71f076b33cd0facc0f90fbde5e7276d9e9db4abf7f4b8c7e2329730b965d8bb9', NULL, 1, 401, ''),
(106, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240504210159//', '2c0b49b30b4071e9f90c032ea346804874f259d4308eb309111097680ca66718', NULL, 1, 402, ''),
(107, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240504210228//', '393313917bd16d55b60cfdb3bcbc2aba2e7955667e6153f14aba2dbbe856b5e3', NULL, 1, 403, ''),
(108, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240504210240//', '3b3d7a21828a174ef7b6dbf8c38602cd10a171fa908218e084acaa1b03be7452', NULL, 1, 404, '');

-- --------------------------------------------------------

--
-- Table structure for table `2`
--

CREATE TABLE `2` (
  `trnx_no` int(15) NOT NULL,
  `Date` date NOT NULL,
  `Particulars` varchar(300) NOT NULL,
  `Trnx_id` varchar(100) NOT NULL,
  `debit` int(11) DEFAULT NULL,
  `credit` int(11) DEFAULT NULL,
  `end_balance` int(11) NOT NULL,
  `trnxPurpose` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `2`
--

INSERT INTO `2` (`trnx_no`, `Date`, `Particulars`, `Trnx_id`, `debit`, `credit`, `end_balance`, `trnxPurpose`) VALUES
(1, '2024-04-27', 'Initial Deposit', 'gdfsgdf', NULL, 10000, 10000, NULL),
(25, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430143721', '9c52e0ed7253e3365382f691018ebabf4d2b3e132939eb5b1bd709c0ec531e1e', 66, NULL, 9934, NULL),
(26, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430155409', '45b78bc320584455de98fff57cd9220efc18f2acd97005efd204b5e543bafbbc', 65, NULL, 9869, NULL),
(27, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430155510', '7a8fe3650308d6b39f3dc6a4cb9c6f61475dbaf04130cf8bdbbbacbd4f3de086', 66, NULL, 9803, NULL),
(28, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430155520', 'fbcf6d648bf9b3ba602fbd91da93c674536b33aa5f7061a834703afbc25d64de', 66, NULL, 9737, NULL),
(29, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430155635', '86c782a890bc6fc9f8d8d9a8393afc2b834e63ab44ce21648e337f36f09f65fa', 66, NULL, 9671, NULL),
(30, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430155639', 'b63aac85702d1d51ae287241c0be2c3397d384f7ba1204a56056e16398d5bfc6', 66, NULL, 9605, NULL),
(31, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430155719', '418956ae1df6eb04845da956e34d1eb626dbba4124fe9705a64a983a6f9285b5', 45, NULL, 9560, NULL),
(32, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430160101', 'a3559677a060e691f054e41933bcd954b8df2b79a47f9b4f3a3f5f0cefc60533', 45, NULL, 9515, NULL),
(33, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430165453', 'f1cfdbb6e87976be9f40899d81b31705d77356da5a3de83b9db9bff5b63152c9', 55, NULL, 9460, NULL),
(34, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430165504', 'ca9755df254cf8e8a6847cad55812f46d2060be612a0319edbe1f0d5eb1c938b', 55, NULL, 9405, NULL),
(35, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430165853', '9245d33579122a7d712431709c1e86667b7e155144625f732aa3b35635dcee7a', 55, NULL, 9350, NULL),
(36, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430165906', '5b8551857812608971c817762cf75466f84a162c1c97636fcafa20331f69ed2a', 55, NULL, 9295, NULL),
(37, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430170008', 'd22a9eb50a95d587527c7e7bb16f7904cbe116f85ad8fc17c7b9183aa9166abb', 66, NULL, 9229, NULL),
(38, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430170701', 'af2037d003b5edf1bae90076761f824316260a96ac4b362af85251fb63d5e47a', 66, NULL, 9163, NULL),
(39, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240430171102', 'b8310a50dc283aa467a19117e00a8a88766e95fb96d83034e61a75c194c1aa10', 66, NULL, 9097, NULL),
(40, '2024-04-30', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240430171102', 'b8310a50dc283aa467a19117e00a8a88766e95fb96d83034e61a75c194c1aa10', NULL, 66, 9229, NULL),
(41, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430171319', '6263c0fb01c04ce63d886be1436e61433db8d5d124ecff9b6c204eb0d6e992b2', 45, NULL, 9184, NULL),
(42, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430171733', '3a7ea2753546a84e9d214dd186d2d7616a24ca6db08826add309a2da99af17ec', 66, NULL, 9118, NULL),
(43, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430171829', 'db788e43b5b071100b4ac26928b8a6b28bc1f7e9bd0109f9d1e67e3f51ba18ba', 66, NULL, 9052, NULL),
(44, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430171959', '2b02e9996079f2684f279de1f713c85fe27190e1114f6127edd04c90503e0b20', 45, NULL, 9007, NULL),
(45, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430172140', 'f33c3a31a6d733d58dd063e4896e1971b005cf6188545a92f24f9ca07732280a', 65, NULL, 8942, NULL),
(46, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430172717', '57e5132f10647e70adb5881942a753a1d239cd1d0c3740bb3e0dfb965ee78743', 66, NULL, 8876, NULL),
(47, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430172813', '54bd84edb5d2811a9fd7d3bd497ef63a3c5ee43819524536188097bdf4d75fe8', 45, NULL, 8831, NULL),
(48, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430175754', 'edf840f7b9aa1a30444c08739a2af801bd65726eb5545bab22710c0aaa577085', 45, NULL, 8786, NULL),
(49, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430180011', '2ec923cdac6ba7515d6f7faf29aead3ac074f20ffbdb24c45d25f2c4fd94e218', 65, NULL, 8721, NULL),
(50, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430180434', 'a02b6eab4a2a630588c10081464d9487f0117d4e7b38b8b8e96dcf68e2da275c', 45, NULL, 8676, NULL),
(51, '2024-04-30', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240430180716', '079765c66a62153e2b487c09a10914863394381852c6fb7993b877f85ba13d5a', 45, NULL, 8631, NULL),
(52, '2024-05-01', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240501152922', 'c8644e1cbfe4ee8ea89c529f9cd0cd86460bafd04fab0e25e1a5ebd1d22c1f1b', 45, NULL, 8586, NULL),
(53, '2024-05-01', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240501154413', '2f03ec1be7b401b8a2c90a4ca6e723db02e02ef905d8654b1ddd919d916031b0', 55, NULL, 8531, NULL),
(54, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240503091545', '8162a14f4a95a8236cb59978f286dfbd879842e6aeea848db32c17fcbe9fabdd', 45, NULL, 8486, NULL),
(55, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240503091833', '71cbfd1c997a90349db920c3f177610b0b8a45d372fa90a7d48c6939d44cb98e', 65, NULL, 8421, NULL),
(56, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240503091833', '71cbfd1c997a90349db920c3f177610b0b8a45d372fa90a7d48c6939d44cb98e', NULL, 65, 8551, NULL),
(57, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240503093008', '68abe224c6ef79c43676253c24f97a61521325d3f3b1e203a3b3ae93d381cf83', 45, NULL, 8506, NULL),
(58, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240503093101', 'e5bc92a0c7323161fd63dd78fea9d307bf31b416f2bc4d74dab6e1bb2c1c8aba', 65, NULL, 8441, NULL),
(59, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240503093213', '0204f3e8a5d41592f340e701a479c8e0ea5113502fa7b53642582a587c4d8e42', 65, NULL, 8376, NULL),
(60, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240503093213', '0204f3e8a5d41592f340e701a479c8e0ea5113502fa7b53642582a587c4d8e42', NULL, 65, 8506, NULL),
(61, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240503093646', '2f1f5b20e8331764c5b381af8b0dee21ea65fb1e6d54b5c0107460a258e3cf7b', 45, NULL, 8461, NULL),
(62, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240503094313', '528f77ab60ed1355451320e2b0725457cc4737d26e9259015712c22fd7a83829', 45, NULL, 8416, NULL),
(63, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240503094337', 'c4858cdb9c8e1c75111830ded85ab554628d62accd07b3c7b2f28d14680914da', 45, NULL, 8371, NULL),
(64, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240503094444', 'f3d973d55977d6f064587d19b4806f557c44213018b2a9b6f3cdf07773d33fa5', 45, NULL, 8326, NULL),
(65, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240503094855', 'be8e181650b1abc4ecf8d8f3af269e8579e0a8aa8e4c598bfbe1202a9486e99f', 55, NULL, 8271, NULL),
(66, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240503104443', 'cee933c458f1721c332f000286d8bbac8e4b0969f9fa3e40427864850dc9ca03', 55, NULL, 8216, NULL),
(67, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240503105423', 'f2f56bab9e8f429138cd00a051ba96220c05162fab87308d8ce848e97b46e41f', 45, NULL, 8171, NULL),
(68, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240503155132', '90ce04a7a16d26271c70949479f42df26bf69f6e6b16b6ed8d85b87b3da7bf29', 65, NULL, 8106, NULL),
(69, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240503160300', 'a88995607e7183315d99cd9f78cdea38051517e833856b32b5629478cf7095e2', 121, NULL, 7985, NULL),
(70, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240503163120', '394a37c2f8ba71541506180728d16aace61300ee40b20735239d5fbfa217f140', 66, NULL, 7919, NULL),
(71, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240503170002', '59eb858ddf858ee70477f6d38451c9d05f25c1f4b7d394a939508f9a5f248c2d', 45, NULL, 7874, NULL),
(72, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240503172916/Travel/test remarks', '6ccc6b35d35709a0db0041d5d66a8bef092a815e02a67739f7d6a458ad8c535e', NULL, 145, 8019, 'Travel'),
(73, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240503172930/Travel/test remarks', '5779513ca72ed7d2b96c1918a646f86961d4e33556dc276d52efa815be482a5d', NULL, 145, 8164, 'Travel'),
(74, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240503173238/test/test remarks', '3c7c4063a4067b9c639b467e8c54a838391ec30359f899d3ef2e593d843ded80', NULL, 145, 8309, 'test'),
(75, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240503173311//gf', 'e4c095bffd7804208d31c568ad38e5fb8adaebe612a95274dc84a1d3c679cb01', 55, NULL, 8254, NULL),
(76, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240503173337/test/rtytr', '30748d9ac9eef279c3e23ac5641dc1ada5a5ac0915b4bf778f6edebd9f14513f', 55, NULL, 8199, 'test'),
(77, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240503173759/Travel/gdf', '9aca334beb0ce2a30765c29e950c96b9e660979652146e4237985b8d325c9722', 66, NULL, 8133, 'Travel'),
(78, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240503173912/Travel/rtytr', 'e94a41eb41b2b366ef31a54e393dabf1022f95108d91d9210d6cd90cf8520dfc', 66, NULL, 8067, 'Travel'),
(79, '2024-05-03', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240503174707/test/rtytr', '86b75e650eec2c52fa6080a1c101686b569b90b4465e4a11cb9525099c3c7670', 66, NULL, 8001, 'test'),
(80, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240503175126/test/test remarks', '4e08d167de8d4ccd89f2d8373c4186208ef7171c00d9cf828e1ec0faf53a1bc8', NULL, 145, 8146, 'test'),
(81, '2024-05-03', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240503181542/test/test remarks', 'd1e46e07912ca6aa1b450e70919027e1d99cf831efd5d1825f672832ce03eccc', NULL, 145, 8291, 'test'),
(82, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504141356/Travel/test remarks', 'f7587579dd16bc572e3883370f943b3d181d8f0578bb99b58e141180be63f1c3', NULL, 145, 8436, 'Travel'),
(83, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504141621/test/test remarks', '06de5b040bcbd88e1c22e3589e3894187b136bef32644f26999023cc3939d0ea', NULL, 145, 8581, 'test'),
(84, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504145613/fgh/fgh', 'cf4428bae05825f0f64f4f10533e30fcc277c8ddee193e8e912b16ba0f3afffc', NULL, 54, 8635, 'fgh'),
(85, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504152744/Travel/test remarks', '176c8dd2698a8fc1c840ac338aea9bc2ae777ca82d435f4ba1a2d9852e6bb2d9', NULL, 221, 8856, 'Travel'),
(86, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504153031/Travel/test remarks', 'dad76f9f407fa3f1ec400951fc57015bfbdf2bce9caedd49afebb4e8ca754816', NULL, 221, 9077, 'Travel'),
(87, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504162902/Travel/test remarksfgffdf', '7ef7000660d44f14737a5a726cdc6256261e6cec49f83994103137ed8c78e9ca', NULL, 45, 9122, 'Travel'),
(88, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504171346/fgh/fgh', '321731ea7438f96c40e1db78fa2bc7a3484652158c44d7396e50f9bb87fc886f', NULL, 145, 9267, 'fgh'),
(89, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504171755/Travel/Test', 'f99f70c927ce93d9c0a215e657a8ef33be60373300537b5c7dc1d682c75918b5', NULL, 222, 9489, 'Travel'),
(90, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504172033/gdfg/fdg', '0d24ccf8428375027549277524e9b55d24959be1a5433e93d869ecb15875a65b', NULL, 221, 9710, 'gdfg'),
(91, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504172801/fgh/test remarks', '78c5e0ae82ef91968558613c2b6a0b9604edc6170c55fe3e3cec78571946a7dd', NULL, 221, 9931, 'fgh'),
(92, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504173057/fgh/test remarks', '3a1db80d40886651b1ad0601648519bf6606e5f5d0a9943b585d3c197e1a12c8', NULL, 5, 9936, 'fgh'),
(93, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504173153/b/dfg', '2babfbf6be1d069afd27f62bdfc441639b093c6b8afa66d72e19624b11790e68', NULL, 65, 10001, 'b'),
(94, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504173455/fgh/test remarks', 'd4133d1de8b4ad4bdb867222e0d9d25df5f482915a7ea9727415b9bba3cfbce8', NULL, 145, 10146, 'fgh'),
(95, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504173624/fgh/test remarks', '29e620584e7ad1b3ef7eec8c86b48e4dbc712bb485c2ebbc3a1721d997d9048f', NULL, 221, 10367, 'fgh'),
(96, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504173850/fgh/test remarks', '1c421685ba75f00461e6f2b99c0cef92df3160527f2191b5ab415887791cc421', NULL, 2, 10369, 'fgh'),
(97, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504174049/fgh/test remarks', '5ea79ac10c40f7b21405f77199b5aea124a708498cc2325f2de15c0f8560642b', NULL, 14, 10383, 'fgh'),
(98, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504174146/b/', 'ff1a9a0bd2a831cf8c9d51dc1f452cc651dca77520ee55db447523bae3502117', NULL, 21, 10404, 'b'),
(99, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504183337/Travel/test remarks', '79d7c9a42cca7a28040764926b4058d8abd26a0d801e9fbf0199a6c0ba7c63f7', NULL, 2, 10406, 'Travel'),
(100, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504183626/fgh/dfg', '998d1801b83738d7a9d83b680277b1b6737b32172580c1fcdf40f525cdbbd22a', NULL, 1, 10407, 'fgh'),
(101, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504183812/test/test remarks', '15066819144e1e32ef105dad7a06e915ceff0e7a25707ca9ac05f4b7f7cacc1b', NULL, 1, 10408, 'test'),
(102, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504183848//', '61a26904edede053a721e3f0859adb3dddcaa7660cb64c3791a8767e82f77474', NULL, 1, 10409, ''),
(103, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504183927//', 'c95efb06cc7ceca7ed69b968a9662c48b3378bfa6bf79a9d35239be7eaac8cca', NULL, 1, 10410, ''),
(104, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504184030//', 'e5686b5b099adaa68a1ecf4d3a204b693035eae4d5dbd2dd3dde4f025c073259', NULL, 1, 10411, ''),
(105, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504184304//', 'ae36addc8e25327c4d355c1dc1b5e364f5787acde1cbbef0bc35d536d6e8da65', NULL, 1, 10412, ''),
(106, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504184418//', '29a55a510e62c6a6494231d208a2cca18e1b86357526e3e08fe1b9df239370f5', NULL, 1, 10413, ''),
(107, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240504193910//', 'fae4ec55d02ab4c7ae7c3a4d2e18fc0d9dd4797619dd601ef3a7e5736cc37f25', 300, NULL, 10113, ''),
(108, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504204759//', 'b5a82c12ea7c6f14696dd1457c0e04b821b2f2e44969996c9c38995ce16153a9', NULL, 1, 10114, ''),
(109, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban95@kkosh/1/20240504204823//', '72d7a4ffdab6aef68c3cc6dc53f9a0a7ecd70f429ca4444b62de6fa18e114e9d', NULL, 1, 10115, ''),
(110, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240504204927//', '07ba68061ae9d747bb87be1bd056a4d2a726425047126739dbcca2decec3960f', 1, NULL, 10114, ''),
(111, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240504205027//', 'c4e0c031a68d9c57e8c5713c3139d98fb6bc028d0ba2ff5264bb6786d4003472', 1, NULL, 10113, ''),
(112, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240504205126//', '62c518a4aa2f754ad759fa4e8ecb042545f1daec27bfac322b02d5888d22431e', 1, NULL, 10112, ''),
(113, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240504205550//', 'b9e50f162581ff2e666f2ec7003319f4475147446bf6b6b82fed5eb744df39d7', 1, NULL, 10111, ''),
(114, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240504205610//', 'fcc135fc49c7da1cf64936fe50aa0644494bde00cdf25bab41ee4bf141713d81', 1, NULL, 10110, ''),
(115, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240504205704/Travel/', '001267de42ff56fee03babb8f48027136a77f4401737f9e213e96a200abfa13c', 55, NULL, 10055, 'Travel'),
(116, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban9655@kkosh/2/20240504205730//', '51a912b20a433b1f4d0665ee713daff385bab67b8151a32e151843c3052ab086', 55, NULL, 10000, ''),
(117, '2024-05-04', 'W2W/CR/Anirban Routh/routhanirban9655@kkosh/2/20240504205730//', '51a912b20a433b1f4d0665ee713daff385bab67b8151a32e151843c3052ab086', NULL, 55, 10110, ''),
(118, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240504205752//', 'fdca949e24b4fc3293273602582299d830f48d973f6ef4a99feb3183a70ab4b1', 1, NULL, 10109, ''),
(119, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240504205812//', '8b42abeae96d8d43e569fb69426e2553786b68076c54d5bba3803c65c6242810', 1, NULL, 10108, ''),
(120, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240504210024//', 'c908619cf3d76a027feb3e49e3801760ff63439046541ca7d099aad9f4c648f4', 1, NULL, 10107, ''),
(121, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240504210141//', '71f076b33cd0facc0f90fbde5e7276d9e9db4abf7f4b8c7e2329730b965d8bb9', 1, NULL, 10106, ''),
(122, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240504210159//', '2c0b49b30b4071e9f90c032ea346804874f259d4308eb309111097680ca66718', 1, NULL, 10105, ''),
(123, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240504210228//', '393313917bd16d55b60cfdb3bcbc2aba2e7955667e6153f14aba2dbbe856b5e3', 1, NULL, 10104, ''),
(124, '2024-05-04', 'W2W/DR/Anirban Routh/routhanirban95@kkosh/1/20240504210240//', '3b3d7a21828a174ef7b6dbf8c38602cd10a171fa908218e084acaa1b03be7452', 1, NULL, 10103, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `1`
--
ALTER TABLE `1`
  ADD PRIMARY KEY (`trnx_no`);

--
-- Indexes for table `2`
--
ALTER TABLE `2`
  ADD PRIMARY KEY (`trnx_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `1`
--
ALTER TABLE `1`
  MODIFY `trnx_no` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `2`
--
ALTER TABLE `2`
  MODIFY `trnx_no` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
