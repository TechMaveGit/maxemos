-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2022 at 12:52 PM
-- Server version: 5.7.39-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maxemo_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `apply_loan_histories`
--

CREATE TABLE `apply_loan_histories` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL DEFAULT '0',
  `bankId` int(11) NOT NULL DEFAULT '0',
  `loanAmount` varchar(200) DEFAULT NULL,
  `tenure` int(11) NOT NULL DEFAULT '0',
  `productId` int(11) NOT NULL DEFAULT '0',
  `loanCategory` int(11) NOT NULL DEFAULT '0',
  `roiType` varchar(255) DEFAULT 'reducing_roi',
  `rateOfInterest` varchar(200) DEFAULT NULL,
  `approvedAmount` varchar(255) DEFAULT NULL,
  `approvedTenure` int(11) NOT NULL DEFAULT '0',
  `netDisbursementAmount` double(10,2) NOT NULL DEFAULT '0.00',
  `monthlyEMI` double(10,2) NOT NULL DEFAULT '0.00',
  `totalInterest` double(10,2) NOT NULL DEFAULT '0.00',
  `emisDetailsStr` text,
  `principleCharges` double(10,2) NOT NULL DEFAULT '0.00',
  `principleChargesDetails` text,
  `invoiceFile` text,
  `status` varchar(200) DEFAULT NULL COMMENT 'pending, rejected, sent-for-admin-approval, sent-for-customer-approval, customer-approved, disburse-scheduled, disbursed, closed, noc-issued',
  `disbursedDate` date DEFAULT NULL,
  `validFromDate` date DEFAULT NULL,
  `validToDate` date DEFAULT NULL,
  `remark` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `apply_loan_histories`
--

INSERT INTO `apply_loan_histories` (`id`, `userId`, `bankId`, `loanAmount`, `tenure`, `productId`, `loanCategory`, `roiType`, `rateOfInterest`, `approvedAmount`, `approvedTenure`, `netDisbursementAmount`, `monthlyEMI`, `totalInterest`, `emisDetailsStr`, `principleCharges`, `principleChargesDetails`, `invoiceFile`, `status`, `disbursedDate`, `validFromDate`, `validToDate`, `remark`, `created_at`, `updated_at`) VALUES
(1, 3, 0, '200000', 3, 3, 0, 'reducing_roi', '26', '200000', 3, 0.00, 0.00, 0.00, NULL, 0.00, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, '2022-09-17 20:28:58', '2022-09-17 20:28:58'),
(2, 4, 0, '10000', 3, 3, 0, 'reducing_roi', '26', '10000', 3, 0.00, 0.00, 0.00, NULL, 0.00, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, '2022-09-19 05:54:15', '2022-09-19 05:54:15'),
(3, 9, 0, '10000', 4, 3, 0, 'reducing_roi', '26', '10000', 4, 0.00, 0.00, 0.00, NULL, 0.00, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, '2022-09-21 04:51:19', '2022-09-21 04:51:19'),
(4, 10, 0, '2000', 4, 3, 0, 'reducing_roi', '26', '2000', 4, 0.00, 0.00, 0.00, NULL, 0.00, NULL, '', 'sent-for-customer-approval', NULL, NULL, NULL, NULL, '2022-09-26 06:49:35', '2022-09-26 06:49:35'),
(5, 10, 0, '600000', 1, 3, 0, 'reducing_roi', '18', '600000', 1, 0.00, 0.00, 0.00, NULL, 0.00, NULL, '', 'sent-for-customer-approval', NULL, NULL, NULL, NULL, '2022-09-26 07:22:55', '2022-09-26 07:22:55'),
(6, 11, 0, '10000', 3, 3, 0, 'reducing_roi', '24', '10000', 3, 0.00, 0.00, 0.00, NULL, 0.00, NULL, '', 'sent-for-customer-approval', NULL, NULL, NULL, NULL, '2022-09-26 09:33:14', '2022-09-26 09:33:14'),
(7, 12, 0, '10000', 3, 3, 0, 'reducing_roi', '20', '10000', 3, 0.00, 0.00, 0.00, NULL, 0.00, NULL, '', 'sent-for-customer-approval', NULL, NULL, NULL, NULL, '2022-09-26 11:25:45', '2022-09-26 11:25:45'),
(8, 11, 0, '10000', 1, 3, 0, 'reducing_roi', '18', '10000', 1, 0.00, 0.00, 0.00, NULL, 0.00, NULL, '', 'sent-for-customer-approval', NULL, NULL, NULL, NULL, '2022-09-26 11:35:18', '2022-09-26 11:35:18'),
(9, 11, 0, '1000', 3, 3, 0, 'reducing_roi', '10', '1000', 3, 0.00, 0.00, 0.00, NULL, 0.00, NULL, '', 'sent-for-customer-approval', NULL, NULL, NULL, NULL, '2022-09-26 11:41:46', '2022-09-26 11:41:46'),
(10, 12, 0, '12444', 3, 3, 0, 'reducing_roi', '19', '12444', 3, 0.00, 0.00, 0.00, NULL, 0.00, NULL, '', 'sent-for-customer-approval', NULL, NULL, NULL, NULL, '2022-09-26 11:45:34', '2022-09-26 11:45:34'),
(11, 14, 0, '200000', 1, 3, 0, 'reducing_roi', '18', '200000', 1, 0.00, 0.00, 0.00, NULL, 0.00, NULL, '', 'sent-for-customer-approval', NULL, NULL, NULL, NULL, '2022-09-27 09:51:50', '2022-09-27 09:51:50'),
(12, 15, 0, '10000', 2, 3, 0, 'reducing_roi', '24', '10000', 2, 0.00, 0.00, 0.00, NULL, 0.00, NULL, '', 'sent-for-customer-approval', NULL, NULL, NULL, NULL, '2022-09-27 11:36:21', '2022-09-27 11:36:21'),
(13, 18, 0, '10000', 3, 3, 0, 'reducing_roi', '22', '10000', 3, 0.00, 0.00, 0.00, NULL, 0.00, NULL, '', 'customer-approved', NULL, NULL, NULL, NULL, '2022-09-28 07:20:45', '2022-09-28 07:26:56'),
(14, 19, 0, '10000', 4, 3, 0, 'reducing_roi', '20', '10000', 4, 0.00, 0.00, 0.00, NULL, 0.00, NULL, '', 'customer-approved', NULL, NULL, NULL, NULL, '2022-09-29 12:01:38', '2022-09-29 12:03:29'),
(15, 20, 0, '10000', 3, 1, 0, 'reducing_roi', '18', '10000', 3, 0.00, 0.00, 0.00, NULL, 0.00, NULL, '', 'customer-approved', NULL, NULL, NULL, NULL, '2022-09-29 13:08:07', '2022-09-29 13:10:09'),
(16, 21, 0, '10000', 3, 1, 0, 'reducing_roi', '18', '10000', 3, 0.00, 0.00, 0.00, NULL, 0.00, NULL, '', 'customer-approved', NULL, NULL, NULL, NULL, '2022-09-30 12:31:47', '2022-09-30 12:49:50'),
(17, 23, 0, '10000', 2, 3, 0, 'reducing_roi', '18', '10000', 2, 0.00, 0.00, 0.00, NULL, 0.00, NULL, '', 'customer-approved', NULL, NULL, NULL, NULL, '2022-09-30 12:58:44', '2022-10-01 01:13:41'),
(18, 24, 0, '10000', 3, 3, 0, 'reducing_roi', '12', '10000', 3, 0.00, 0.00, 0.00, NULL, 0.00, NULL, '', 'customer-approved', NULL, '2022-10-04', '2023-01-04', NULL, '2022-10-04 11:38:29', '2022-10-04 21:22:56'),
(19, 8, 0, '2000', 3, 3, 0, 'reducing_roi', '19', '2000', 3, 0.00, 0.00, 0.00, NULL, 0.00, NULL, '', 'sent-for-customer-approval', NULL, '2022-10-06', '2022-12-06', NULL, '2022-10-04 11:42:33', '2022-10-04 11:42:33'),
(20, 25, 3, '12000', 3, 1, 0, 'reducing_roi', '12', '12000', 3, 0.00, 129.00, 22768.00, '{\"totalPaybleAmount\":34768,\"totalInterest\":22768,\"emiAmount\":129,\"rateOfInterest\":\"12\",\"tenureInMonth\":\"270\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-11-12\",\"emiAmount\":129,\"interest\":120,\"principle\":9,\"balance\":11991},{\"emiSr\":2,\"payDate\":\"2022-12-12\",\"emiAmount\":129,\"interest\":120,\"principle\":9,\"balance\":11982},{\"emiSr\":3,\"payDate\":\"2023-01-12\",\"emiAmount\":129,\"interest\":120,\"principle\":9,\"balance\":11973},{\"emiSr\":4,\"payDate\":\"2023-02-12\",\"emiAmount\":129,\"interest\":120,\"principle\":9,\"balance\":11964},{\"emiSr\":5,\"payDate\":\"2023-03-12\",\"emiAmount\":129,\"interest\":120,\"principle\":9,\"balance\":11955},{\"emiSr\":6,\"payDate\":\"2023-04-12\",\"emiAmount\":129,\"interest\":120,\"principle\":9,\"balance\":11946},{\"emiSr\":7,\"payDate\":\"2023-05-12\",\"emiAmount\":129,\"interest\":119,\"principle\":9,\"balance\":11937},{\"emiSr\":8,\"payDate\":\"2023-06-12\",\"emiAmount\":129,\"interest\":119,\"principle\":9,\"balance\":11927},{\"emiSr\":9,\"payDate\":\"2023-07-12\",\"emiAmount\":129,\"interest\":119,\"principle\":9,\"balance\":11918},{\"emiSr\":10,\"payDate\":\"2023-08-12\",\"emiAmount\":129,\"interest\":119,\"principle\":10,\"balance\":11908},{\"emiSr\":11,\"payDate\":\"2023-09-12\",\"emiAmount\":129,\"interest\":119,\"principle\":10,\"balance\":11899},{\"emiSr\":12,\"payDate\":\"2023-10-12\",\"emiAmount\":129,\"interest\":119,\"principle\":10,\"balance\":11889},{\"emiSr\":13,\"payDate\":\"2023-11-12\",\"emiAmount\":129,\"interest\":119,\"principle\":10,\"balance\":11879},{\"emiSr\":14,\"payDate\":\"2023-12-12\",\"emiAmount\":129,\"interest\":119,\"principle\":10,\"balance\":11869},{\"emiSr\":15,\"payDate\":\"2024-01-12\",\"emiAmount\":129,\"interest\":119,\"principle\":10,\"balance\":11859},{\"emiSr\":16,\"payDate\":\"2024-02-12\",\"emiAmount\":129,\"interest\":119,\"principle\":10,\"balance\":11849},{\"emiSr\":17,\"payDate\":\"2024-03-12\",\"emiAmount\":129,\"interest\":118,\"principle\":10,\"balance\":11838},{\"emiSr\":18,\"payDate\":\"2024-04-12\",\"emiAmount\":129,\"interest\":118,\"principle\":10,\"balance\":11828},{\"emiSr\":19,\"payDate\":\"2024-05-12\",\"emiAmount\":129,\"interest\":118,\"principle\":10,\"balance\":11817},{\"emiSr\":20,\"payDate\":\"2024-06-12\",\"emiAmount\":129,\"interest\":118,\"principle\":11,\"balance\":11807},{\"emiSr\":21,\"payDate\":\"2024-07-12\",\"emiAmount\":129,\"interest\":118,\"principle\":11,\"balance\":11796},{\"emiSr\":22,\"payDate\":\"2024-08-12\",\"emiAmount\":129,\"interest\":118,\"principle\":11,\"balance\":11785},{\"emiSr\":23,\"payDate\":\"2024-09-12\",\"emiAmount\":129,\"interest\":118,\"principle\":11,\"balance\":11774},{\"emiSr\":24,\"payDate\":\"2024-10-12\",\"emiAmount\":129,\"interest\":118,\"principle\":11,\"balance\":11763},{\"emiSr\":25,\"payDate\":\"2024-11-12\",\"emiAmount\":129,\"interest\":118,\"principle\":11,\"balance\":11752},{\"emiSr\":26,\"payDate\":\"2024-12-12\",\"emiAmount\":129,\"interest\":118,\"principle\":11,\"balance\":11741},{\"emiSr\":27,\"payDate\":\"2025-01-12\",\"emiAmount\":129,\"interest\":117,\"principle\":11,\"balance\":11730},{\"emiSr\":28,\"payDate\":\"2025-02-12\",\"emiAmount\":129,\"interest\":117,\"principle\":11,\"balance\":11718},{\"emiSr\":29,\"payDate\":\"2025-03-12\",\"emiAmount\":129,\"interest\":117,\"principle\":12,\"balance\":11707},{\"emiSr\":30,\"payDate\":\"2025-04-12\",\"emiAmount\":129,\"interest\":117,\"principle\":12,\"balance\":11695},{\"emiSr\":31,\"payDate\":\"2025-05-12\",\"emiAmount\":129,\"interest\":117,\"principle\":12,\"balance\":11683},{\"emiSr\":32,\"payDate\":\"2025-06-12\",\"emiAmount\":129,\"interest\":117,\"principle\":12,\"balance\":11671},{\"emiSr\":33,\"payDate\":\"2025-07-12\",\"emiAmount\":129,\"interest\":117,\"principle\":12,\"balance\":11659},{\"emiSr\":34,\"payDate\":\"2025-08-12\",\"emiAmount\":129,\"interest\":117,\"principle\":12,\"balance\":11647},{\"emiSr\":35,\"payDate\":\"2025-09-12\",\"emiAmount\":129,\"interest\":116,\"principle\":12,\"balance\":11635},{\"emiSr\":36,\"payDate\":\"2025-10-12\",\"emiAmount\":129,\"interest\":116,\"principle\":12,\"balance\":11622},{\"emiSr\":37,\"payDate\":\"2025-11-12\",\"emiAmount\":129,\"interest\":116,\"principle\":13,\"balance\":11610},{\"emiSr\":38,\"payDate\":\"2025-12-12\",\"emiAmount\":129,\"interest\":116,\"principle\":13,\"balance\":11597},{\"emiSr\":39,\"payDate\":\"2026-01-12\",\"emiAmount\":129,\"interest\":116,\"principle\":13,\"balance\":11584},{\"emiSr\":40,\"payDate\":\"2026-02-12\",\"emiAmount\":129,\"interest\":116,\"principle\":13,\"balance\":11571},{\"emiSr\":41,\"payDate\":\"2026-03-12\",\"emiAmount\":129,\"interest\":116,\"principle\":13,\"balance\":11558},{\"emiSr\":42,\"payDate\":\"2026-04-12\",\"emiAmount\":129,\"interest\":116,\"principle\":13,\"balance\":11545},{\"emiSr\":43,\"payDate\":\"2026-05-12\",\"emiAmount\":129,\"interest\":115,\"principle\":13,\"balance\":11532},{\"emiSr\":44,\"payDate\":\"2026-06-12\",\"emiAmount\":129,\"interest\":115,\"principle\":13,\"balance\":11518},{\"emiSr\":45,\"payDate\":\"2026-07-12\",\"emiAmount\":129,\"interest\":115,\"principle\":14,\"balance\":11505},{\"emiSr\":46,\"payDate\":\"2026-08-12\",\"emiAmount\":129,\"interest\":115,\"principle\":14,\"balance\":11491},{\"emiSr\":47,\"payDate\":\"2026-09-12\",\"emiAmount\":129,\"interest\":115,\"principle\":14,\"balance\":11477},{\"emiSr\":48,\"payDate\":\"2026-10-12\",\"emiAmount\":129,\"interest\":115,\"principle\":14,\"balance\":11463},{\"emiSr\":49,\"payDate\":\"2026-11-12\",\"emiAmount\":129,\"interest\":115,\"principle\":14,\"balance\":11449},{\"emiSr\":50,\"payDate\":\"2026-12-12\",\"emiAmount\":129,\"interest\":114,\"principle\":14,\"balance\":11435},{\"emiSr\":51,\"payDate\":\"2027-01-12\",\"emiAmount\":129,\"interest\":114,\"principle\":14,\"balance\":11420},{\"emiSr\":52,\"payDate\":\"2027-02-12\",\"emiAmount\":129,\"interest\":114,\"principle\":15,\"balance\":11406},{\"emiSr\":53,\"payDate\":\"2027-03-12\",\"emiAmount\":129,\"interest\":114,\"principle\":15,\"balance\":11391},{\"emiSr\":54,\"payDate\":\"2027-04-12\",\"emiAmount\":129,\"interest\":114,\"principle\":15,\"balance\":11376},{\"emiSr\":55,\"payDate\":\"2027-05-12\",\"emiAmount\":129,\"interest\":114,\"principle\":15,\"balance\":11361},{\"emiSr\":56,\"payDate\":\"2027-06-12\",\"emiAmount\":129,\"interest\":114,\"principle\":15,\"balance\":11346},{\"emiSr\":57,\"payDate\":\"2027-07-12\",\"emiAmount\":129,\"interest\":113,\"principle\":15,\"balance\":11331},{\"emiSr\":58,\"payDate\":\"2027-08-12\",\"emiAmount\":129,\"interest\":113,\"principle\":15,\"balance\":11315},{\"emiSr\":59,\"payDate\":\"2027-09-12\",\"emiAmount\":129,\"interest\":113,\"principle\":16,\"balance\":11299},{\"emiSr\":60,\"payDate\":\"2027-10-12\",\"emiAmount\":129,\"interest\":113,\"principle\":16,\"balance\":11284},{\"emiSr\":61,\"payDate\":\"2027-11-12\",\"emiAmount\":129,\"interest\":113,\"principle\":16,\"balance\":11268},{\"emiSr\":62,\"payDate\":\"2027-12-12\",\"emiAmount\":129,\"interest\":113,\"principle\":16,\"balance\":11252},{\"emiSr\":63,\"payDate\":\"2028-01-12\",\"emiAmount\":129,\"interest\":113,\"principle\":16,\"balance\":11235},{\"emiSr\":64,\"payDate\":\"2028-02-12\",\"emiAmount\":129,\"interest\":112,\"principle\":16,\"balance\":11219},{\"emiSr\":65,\"payDate\":\"2028-03-12\",\"emiAmount\":129,\"interest\":112,\"principle\":17,\"balance\":11202},{\"emiSr\":66,\"payDate\":\"2028-04-12\",\"emiAmount\":129,\"interest\":112,\"principle\":17,\"balance\":11186},{\"emiSr\":67,\"payDate\":\"2028-05-12\",\"emiAmount\":129,\"interest\":112,\"principle\":17,\"balance\":11169},{\"emiSr\":68,\"payDate\":\"2028-06-12\",\"emiAmount\":129,\"interest\":112,\"principle\":17,\"balance\":11152},{\"emiSr\":69,\"payDate\":\"2028-07-12\",\"emiAmount\":129,\"interest\":112,\"principle\":17,\"balance\":11134},{\"emiSr\":70,\"payDate\":\"2028-08-12\",\"emiAmount\":129,\"interest\":111,\"principle\":17,\"balance\":11117},{\"emiSr\":71,\"payDate\":\"2028-09-12\",\"emiAmount\":129,\"interest\":111,\"principle\":18,\"balance\":11099},{\"emiSr\":72,\"payDate\":\"2028-10-12\",\"emiAmount\":129,\"interest\":111,\"principle\":18,\"balance\":11082},{\"emiSr\":73,\"payDate\":\"2028-11-12\",\"emiAmount\":129,\"interest\":111,\"principle\":18,\"balance\":11064},{\"emiSr\":74,\"payDate\":\"2028-12-12\",\"emiAmount\":129,\"interest\":111,\"principle\":18,\"balance\":11046},{\"emiSr\":75,\"payDate\":\"2029-01-12\",\"emiAmount\":129,\"interest\":110,\"principle\":18,\"balance\":11027},{\"emiSr\":76,\"payDate\":\"2029-02-12\",\"emiAmount\":129,\"interest\":110,\"principle\":18,\"balance\":11009},{\"emiSr\":77,\"payDate\":\"2029-03-12\",\"emiAmount\":129,\"interest\":110,\"principle\":19,\"balance\":10990},{\"emiSr\":78,\"payDate\":\"2029-04-12\",\"emiAmount\":129,\"interest\":110,\"principle\":19,\"balance\":10971},{\"emiSr\":79,\"payDate\":\"2029-05-12\",\"emiAmount\":129,\"interest\":110,\"principle\":19,\"balance\":10952},{\"emiSr\":80,\"payDate\":\"2029-06-12\",\"emiAmount\":129,\"interest\":110,\"principle\":19,\"balance\":10933},{\"emiSr\":81,\"payDate\":\"2029-07-12\",\"emiAmount\":129,\"interest\":109,\"principle\":19,\"balance\":10913},{\"emiSr\":82,\"payDate\":\"2029-08-12\",\"emiAmount\":129,\"interest\":109,\"principle\":20,\"balance\":10894},{\"emiSr\":83,\"payDate\":\"2029-09-12\",\"emiAmount\":129,\"interest\":109,\"principle\":20,\"balance\":10874},{\"emiSr\":84,\"payDate\":\"2029-10-12\",\"emiAmount\":129,\"interest\":109,\"principle\":20,\"balance\":10854},{\"emiSr\":85,\"payDate\":\"2029-11-12\",\"emiAmount\":129,\"interest\":109,\"principle\":20,\"balance\":10834},{\"emiSr\":86,\"payDate\":\"2029-12-12\",\"emiAmount\":129,\"interest\":108,\"principle\":20,\"balance\":10813},{\"emiSr\":87,\"payDate\":\"2030-01-12\",\"emiAmount\":129,\"interest\":108,\"principle\":21,\"balance\":10793},{\"emiSr\":88,\"payDate\":\"2030-02-12\",\"emiAmount\":129,\"interest\":108,\"principle\":21,\"balance\":10772},{\"emiSr\":89,\"payDate\":\"2030-03-12\",\"emiAmount\":129,\"interest\":108,\"principle\":21,\"balance\":10751},{\"emiSr\":90,\"payDate\":\"2030-04-12\",\"emiAmount\":129,\"interest\":108,\"principle\":21,\"balance\":10729},{\"emiSr\":91,\"payDate\":\"2030-05-12\",\"emiAmount\":129,\"interest\":107,\"principle\":21,\"balance\":10708},{\"emiSr\":92,\"payDate\":\"2030-06-12\",\"emiAmount\":129,\"interest\":107,\"principle\":22,\"balance\":10686},{\"emiSr\":93,\"payDate\":\"2030-07-12\",\"emiAmount\":129,\"interest\":107,\"principle\":22,\"balance\":10664},{\"emiSr\":94,\"payDate\":\"2030-08-12\",\"emiAmount\":129,\"interest\":107,\"principle\":22,\"balance\":10642},{\"emiSr\":95,\"payDate\":\"2030-09-12\",\"emiAmount\":129,\"interest\":106,\"principle\":22,\"balance\":10620},{\"emiSr\":96,\"payDate\":\"2030-10-12\",\"emiAmount\":129,\"interest\":106,\"principle\":23,\"balance\":10597},{\"emiSr\":97,\"payDate\":\"2030-11-12\",\"emiAmount\":129,\"interest\":106,\"principle\":23,\"balance\":10574},{\"emiSr\":98,\"payDate\":\"2030-12-12\",\"emiAmount\":129,\"interest\":106,\"principle\":23,\"balance\":10551},{\"emiSr\":99,\"payDate\":\"2031-01-12\",\"emiAmount\":129,\"interest\":106,\"principle\":23,\"balance\":10528},{\"emiSr\":100,\"payDate\":\"2031-02-12\",\"emiAmount\":129,\"interest\":105,\"principle\":23,\"balance\":10505},{\"emiSr\":101,\"payDate\":\"2031-03-12\",\"emiAmount\":129,\"interest\":105,\"principle\":24,\"balance\":10481},{\"emiSr\":102,\"payDate\":\"2031-04-12\",\"emiAmount\":129,\"interest\":105,\"principle\":24,\"balance\":10457},{\"emiSr\":103,\"payDate\":\"2031-05-12\",\"emiAmount\":129,\"interest\":105,\"principle\":24,\"balance\":10433},{\"emiSr\":104,\"payDate\":\"2031-06-12\",\"emiAmount\":129,\"interest\":104,\"principle\":24,\"balance\":10408},{\"emiSr\":105,\"payDate\":\"2031-07-12\",\"emiAmount\":129,\"interest\":104,\"principle\":25,\"balance\":10384},{\"emiSr\":106,\"payDate\":\"2031-08-12\",\"emiAmount\":129,\"interest\":104,\"principle\":25,\"balance\":10359},{\"emiSr\":107,\"payDate\":\"2031-09-12\",\"emiAmount\":129,\"interest\":104,\"principle\":25,\"balance\":10334},{\"emiSr\":108,\"payDate\":\"2031-10-12\",\"emiAmount\":129,\"interest\":103,\"principle\":25,\"balance\":10308},{\"emiSr\":109,\"payDate\":\"2031-11-12\",\"emiAmount\":129,\"interest\":103,\"principle\":26,\"balance\":10282},{\"emiSr\":110,\"payDate\":\"2031-12-12\",\"emiAmount\":129,\"interest\":103,\"principle\":26,\"balance\":10257},{\"emiSr\":111,\"payDate\":\"2032-01-12\",\"emiAmount\":129,\"interest\":103,\"principle\":26,\"balance\":10230},{\"emiSr\":112,\"payDate\":\"2032-02-12\",\"emiAmount\":129,\"interest\":102,\"principle\":26,\"balance\":10204},{\"emiSr\":113,\"payDate\":\"2032-03-12\",\"emiAmount\":129,\"interest\":102,\"principle\":27,\"balance\":10177},{\"emiSr\":114,\"payDate\":\"2032-04-12\",\"emiAmount\":129,\"interest\":102,\"principle\":27,\"balance\":10150},{\"emiSr\":115,\"payDate\":\"2032-05-12\",\"emiAmount\":129,\"interest\":102,\"principle\":27,\"balance\":10123},{\"emiSr\":116,\"payDate\":\"2032-06-12\",\"emiAmount\":129,\"interest\":101,\"principle\":28,\"balance\":10095},{\"emiSr\":117,\"payDate\":\"2032-07-12\",\"emiAmount\":129,\"interest\":101,\"principle\":28,\"balance\":10067},{\"emiSr\":118,\"payDate\":\"2032-08-12\",\"emiAmount\":129,\"interest\":101,\"principle\":28,\"balance\":10039},{\"emiSr\":119,\"payDate\":\"2032-09-12\",\"emiAmount\":129,\"interest\":100,\"principle\":28,\"balance\":10011},{\"emiSr\":120,\"payDate\":\"2032-10-12\",\"emiAmount\":129,\"interest\":100,\"principle\":29,\"balance\":9982},{\"emiSr\":121,\"payDate\":\"2032-11-12\",\"emiAmount\":129,\"interest\":100,\"principle\":29,\"balance\":9953},{\"emiSr\":122,\"payDate\":\"2032-12-12\",\"emiAmount\":129,\"interest\":100,\"principle\":29,\"balance\":9924},{\"emiSr\":123,\"payDate\":\"2033-01-12\",\"emiAmount\":129,\"interest\":99,\"principle\":30,\"balance\":9895},{\"emiSr\":124,\"payDate\":\"2033-02-12\",\"emiAmount\":129,\"interest\":99,\"principle\":30,\"balance\":9865},{\"emiSr\":125,\"payDate\":\"2033-03-12\",\"emiAmount\":129,\"interest\":99,\"principle\":30,\"balance\":9835},{\"emiSr\":126,\"payDate\":\"2033-04-12\",\"emiAmount\":129,\"interest\":98,\"principle\":30,\"balance\":9804},{\"emiSr\":127,\"payDate\":\"2033-05-12\",\"emiAmount\":129,\"interest\":98,\"principle\":31,\"balance\":9774},{\"emiSr\":128,\"payDate\":\"2033-06-12\",\"emiAmount\":129,\"interest\":98,\"principle\":31,\"balance\":9742},{\"emiSr\":129,\"payDate\":\"2033-07-12\",\"emiAmount\":129,\"interest\":97,\"principle\":31,\"balance\":9711},{\"emiSr\":130,\"payDate\":\"2033-08-12\",\"emiAmount\":129,\"interest\":97,\"principle\":32,\"balance\":9679},{\"emiSr\":131,\"payDate\":\"2033-09-12\",\"emiAmount\":129,\"interest\":97,\"principle\":32,\"balance\":9648},{\"emiSr\":132,\"payDate\":\"2033-10-12\",\"emiAmount\":129,\"interest\":96,\"principle\":32,\"balance\":9615},{\"emiSr\":133,\"payDate\":\"2033-11-12\",\"emiAmount\":129,\"interest\":96,\"principle\":33,\"balance\":9583},{\"emiSr\":134,\"payDate\":\"2033-12-12\",\"emiAmount\":129,\"interest\":96,\"principle\":33,\"balance\":9550},{\"emiSr\":135,\"payDate\":\"2034-01-12\",\"emiAmount\":129,\"interest\":95,\"principle\":33,\"balance\":9516},{\"emiSr\":136,\"payDate\":\"2034-02-12\",\"emiAmount\":129,\"interest\":95,\"principle\":34,\"balance\":9483},{\"emiSr\":137,\"payDate\":\"2034-03-12\",\"emiAmount\":129,\"interest\":95,\"principle\":34,\"balance\":9449},{\"emiSr\":138,\"payDate\":\"2034-04-12\",\"emiAmount\":129,\"interest\":94,\"principle\":34,\"balance\":9415},{\"emiSr\":139,\"payDate\":\"2034-05-12\",\"emiAmount\":129,\"interest\":94,\"principle\":35,\"balance\":9380},{\"emiSr\":140,\"payDate\":\"2034-06-12\",\"emiAmount\":129,\"interest\":94,\"principle\":35,\"balance\":9345},{\"emiSr\":141,\"payDate\":\"2034-07-12\",\"emiAmount\":129,\"interest\":93,\"principle\":35,\"balance\":9310},{\"emiSr\":142,\"payDate\":\"2034-08-12\",\"emiAmount\":129,\"interest\":93,\"principle\":36,\"balance\":9274},{\"emiSr\":143,\"payDate\":\"2034-09-12\",\"emiAmount\":129,\"interest\":93,\"principle\":36,\"balance\":9238},{\"emiSr\":144,\"payDate\":\"2034-10-12\",\"emiAmount\":129,\"interest\":92,\"principle\":36,\"balance\":9202},{\"emiSr\":145,\"payDate\":\"2034-11-12\",\"emiAmount\":129,\"interest\":92,\"principle\":37,\"balance\":9165},{\"emiSr\":146,\"payDate\":\"2034-12-12\",\"emiAmount\":129,\"interest\":92,\"principle\":37,\"balance\":9128},{\"emiSr\":147,\"payDate\":\"2035-01-12\",\"emiAmount\":129,\"interest\":91,\"principle\":37,\"balance\":9090},{\"emiSr\":148,\"payDate\":\"2035-02-12\",\"emiAmount\":129,\"interest\":91,\"principle\":38,\"balance\":9052},{\"emiSr\":149,\"payDate\":\"2035-03-12\",\"emiAmount\":129,\"interest\":91,\"principle\":38,\"balance\":9014},{\"emiSr\":150,\"payDate\":\"2035-04-12\",\"emiAmount\":129,\"interest\":90,\"principle\":39,\"balance\":8975},{\"emiSr\":151,\"payDate\":\"2035-05-12\",\"emiAmount\":129,\"interest\":90,\"principle\":39,\"balance\":8936},{\"emiSr\":152,\"payDate\":\"2035-06-12\",\"emiAmount\":129,\"interest\":89,\"principle\":39,\"balance\":8897},{\"emiSr\":153,\"payDate\":\"2035-07-12\",\"emiAmount\":129,\"interest\":89,\"principle\":40,\"balance\":8857},{\"emiSr\":154,\"payDate\":\"2035-08-12\",\"emiAmount\":129,\"interest\":89,\"principle\":40,\"balance\":8817},{\"emiSr\":155,\"payDate\":\"2035-09-12\",\"emiAmount\":129,\"interest\":88,\"principle\":41,\"balance\":8776},{\"emiSr\":156,\"payDate\":\"2035-10-12\",\"emiAmount\":129,\"interest\":88,\"principle\":41,\"balance\":8735},{\"emiSr\":157,\"payDate\":\"2035-11-12\",\"emiAmount\":129,\"interest\":87,\"principle\":41,\"balance\":8694},{\"emiSr\":158,\"payDate\":\"2035-12-12\",\"emiAmount\":129,\"interest\":87,\"principle\":42,\"balance\":8652},{\"emiSr\":159,\"payDate\":\"2036-01-12\",\"emiAmount\":129,\"interest\":87,\"principle\":42,\"balance\":8610},{\"emiSr\":160,\"payDate\":\"2036-02-12\",\"emiAmount\":129,\"interest\":86,\"principle\":43,\"balance\":8567},{\"emiSr\":161,\"payDate\":\"2036-03-12\",\"emiAmount\":129,\"interest\":86,\"principle\":43,\"balance\":8524},{\"emiSr\":162,\"payDate\":\"2036-04-12\",\"emiAmount\":129,\"interest\":85,\"principle\":44,\"balance\":8481},{\"emiSr\":163,\"payDate\":\"2036-05-12\",\"emiAmount\":129,\"interest\":85,\"principle\":44,\"balance\":8437},{\"emiSr\":164,\"payDate\":\"2036-06-12\",\"emiAmount\":129,\"interest\":84,\"principle\":44,\"balance\":8392},{\"emiSr\":165,\"payDate\":\"2036-07-12\",\"emiAmount\":129,\"interest\":84,\"principle\":45,\"balance\":8347},{\"emiSr\":166,\"payDate\":\"2036-08-12\",\"emiAmount\":129,\"interest\":83,\"principle\":45,\"balance\":8302},{\"emiSr\":167,\"payDate\":\"2036-09-12\",\"emiAmount\":129,\"interest\":83,\"principle\":46,\"balance\":8256},{\"emiSr\":168,\"payDate\":\"2036-10-12\",\"emiAmount\":129,\"interest\":83,\"principle\":46,\"balance\":8210},{\"emiSr\":169,\"payDate\":\"2036-11-12\",\"emiAmount\":129,\"interest\":82,\"principle\":47,\"balance\":8163},{\"emiSr\":170,\"payDate\":\"2036-12-12\",\"emiAmount\":129,\"interest\":82,\"principle\":47,\"balance\":8116},{\"emiSr\":171,\"payDate\":\"2037-01-12\",\"emiAmount\":129,\"interest\":81,\"principle\":48,\"balance\":8069},{\"emiSr\":172,\"payDate\":\"2037-02-12\",\"emiAmount\":129,\"interest\":81,\"principle\":48,\"balance\":8021},{\"emiSr\":173,\"payDate\":\"2037-03-12\",\"emiAmount\":129,\"interest\":80,\"principle\":49,\"balance\":7972},{\"emiSr\":174,\"payDate\":\"2037-04-12\",\"emiAmount\":129,\"interest\":80,\"principle\":49,\"balance\":7923},{\"emiSr\":175,\"payDate\":\"2037-05-12\",\"emiAmount\":129,\"interest\":79,\"principle\":50,\"balance\":7873},{\"emiSr\":176,\"payDate\":\"2037-06-12\",\"emiAmount\":129,\"interest\":79,\"principle\":50,\"balance\":7823},{\"emiSr\":177,\"payDate\":\"2037-07-12\",\"emiAmount\":129,\"interest\":78,\"principle\":51,\"balance\":7773},{\"emiSr\":178,\"payDate\":\"2037-08-12\",\"emiAmount\":129,\"interest\":78,\"principle\":51,\"balance\":7722},{\"emiSr\":179,\"payDate\":\"2037-09-12\",\"emiAmount\":129,\"interest\":77,\"principle\":52,\"balance\":7670},{\"emiSr\":180,\"payDate\":\"2037-10-12\",\"emiAmount\":129,\"interest\":77,\"principle\":52,\"balance\":7618},{\"emiSr\":181,\"payDate\":\"2037-11-12\",\"emiAmount\":129,\"interest\":76,\"principle\":53,\"balance\":7566},{\"emiSr\":182,\"payDate\":\"2037-12-12\",\"emiAmount\":129,\"interest\":76,\"principle\":53,\"balance\":7512},{\"emiSr\":183,\"payDate\":\"2038-01-12\",\"emiAmount\":129,\"interest\":75,\"principle\":54,\"balance\":7459},{\"emiSr\":184,\"payDate\":\"2038-02-12\",\"emiAmount\":129,\"interest\":75,\"principle\":54,\"balance\":7405},{\"emiSr\":185,\"payDate\":\"2038-03-12\",\"emiAmount\":129,\"interest\":74,\"principle\":55,\"balance\":7350},{\"emiSr\":186,\"payDate\":\"2038-04-12\",\"emiAmount\":129,\"interest\":73,\"principle\":55,\"balance\":7295},{\"emiSr\":187,\"payDate\":\"2038-05-12\",\"emiAmount\":129,\"interest\":73,\"principle\":56,\"balance\":7239},{\"emiSr\":188,\"payDate\":\"2038-06-12\",\"emiAmount\":129,\"interest\":72,\"principle\":56,\"balance\":7182},{\"emiSr\":189,\"payDate\":\"2038-07-12\",\"emiAmount\":129,\"interest\":72,\"principle\":57,\"balance\":7126},{\"emiSr\":190,\"payDate\":\"2038-08-12\",\"emiAmount\":129,\"interest\":71,\"principle\":58,\"balance\":7068},{\"emiSr\":191,\"payDate\":\"2038-09-12\",\"emiAmount\":129,\"interest\":71,\"principle\":58,\"balance\":7010},{\"emiSr\":192,\"payDate\":\"2038-10-12\",\"emiAmount\":129,\"interest\":70,\"principle\":59,\"balance\":6951},{\"emiSr\":193,\"payDate\":\"2038-11-12\",\"emiAmount\":129,\"interest\":70,\"principle\":59,\"balance\":6892},{\"emiSr\":194,\"payDate\":\"2038-12-12\",\"emiAmount\":129,\"interest\":69,\"principle\":60,\"balance\":6832},{\"emiSr\":195,\"payDate\":\"2039-01-12\",\"emiAmount\":129,\"interest\":68,\"principle\":60,\"balance\":6772},{\"emiSr\":196,\"payDate\":\"2039-02-12\",\"emiAmount\":129,\"interest\":68,\"principle\":61,\"balance\":6711},{\"emiSr\":197,\"payDate\":\"2039-03-12\",\"emiAmount\":129,\"interest\":67,\"principle\":62,\"balance\":6649},{\"emiSr\":198,\"payDate\":\"2039-04-12\",\"emiAmount\":129,\"interest\":66,\"principle\":62,\"balance\":6587},{\"emiSr\":199,\"payDate\":\"2039-05-12\",\"emiAmount\":129,\"interest\":66,\"principle\":63,\"balance\":6524},{\"emiSr\":200,\"payDate\":\"2039-06-12\",\"emiAmount\":129,\"interest\":65,\"principle\":64,\"balance\":6460},{\"emiSr\":201,\"payDate\":\"2039-07-12\",\"emiAmount\":129,\"interest\":65,\"principle\":64,\"balance\":6396},{\"emiSr\":202,\"payDate\":\"2039-08-12\",\"emiAmount\":129,\"interest\":64,\"principle\":65,\"balance\":6331},{\"emiSr\":203,\"payDate\":\"2039-09-12\",\"emiAmount\":129,\"interest\":63,\"principle\":65,\"balance\":6266},{\"emiSr\":204,\"payDate\":\"2039-10-12\",\"emiAmount\":129,\"interest\":63,\"principle\":66,\"balance\":6200},{\"emiSr\":205,\"payDate\":\"2039-11-12\",\"emiAmount\":129,\"interest\":62,\"principle\":67,\"balance\":6133},{\"emiSr\":206,\"payDate\":\"2039-12-12\",\"emiAmount\":129,\"interest\":61,\"principle\":67,\"balance\":6065},{\"emiSr\":207,\"payDate\":\"2040-01-12\",\"emiAmount\":129,\"interest\":61,\"principle\":68,\"balance\":5997},{\"emiSr\":208,\"payDate\":\"2040-02-12\",\"emiAmount\":129,\"interest\":60,\"principle\":69,\"balance\":5929},{\"emiSr\":209,\"payDate\":\"2040-03-12\",\"emiAmount\":129,\"interest\":59,\"principle\":69,\"balance\":5859},{\"emiSr\":210,\"payDate\":\"2040-04-12\",\"emiAmount\":129,\"interest\":59,\"principle\":70,\"balance\":5789},{\"emiSr\":211,\"payDate\":\"2040-05-12\",\"emiAmount\":129,\"interest\":58,\"principle\":71,\"balance\":5718},{\"emiSr\":212,\"payDate\":\"2040-06-12\",\"emiAmount\":129,\"interest\":57,\"principle\":72,\"balance\":5646},{\"emiSr\":213,\"payDate\":\"2040-07-12\",\"emiAmount\":129,\"interest\":56,\"principle\":72,\"balance\":5574},{\"emiSr\":214,\"payDate\":\"2040-08-12\",\"emiAmount\":129,\"interest\":56,\"principle\":73,\"balance\":5501},{\"emiSr\":215,\"payDate\":\"2040-09-12\",\"emiAmount\":129,\"interest\":55,\"principle\":74,\"balance\":5427},{\"emiSr\":216,\"payDate\":\"2040-10-12\",\"emiAmount\":129,\"interest\":54,\"principle\":74,\"balance\":5353},{\"emiSr\":217,\"payDate\":\"2040-11-12\",\"emiAmount\":129,\"interest\":54,\"principle\":75,\"balance\":5278},{\"emiSr\":218,\"payDate\":\"2040-12-12\",\"emiAmount\":129,\"interest\":53,\"principle\":76,\"balance\":5202},{\"emiSr\":219,\"payDate\":\"2041-01-12\",\"emiAmount\":129,\"interest\":52,\"principle\":77,\"balance\":5125},{\"emiSr\":220,\"payDate\":\"2041-02-12\",\"emiAmount\":129,\"interest\":51,\"principle\":78,\"balance\":5047},{\"emiSr\":221,\"payDate\":\"2041-03-12\",\"emiAmount\":129,\"interest\":50,\"principle\":78,\"balance\":4969},{\"emiSr\":222,\"payDate\":\"2041-04-12\",\"emiAmount\":129,\"interest\":50,\"principle\":79,\"balance\":4890},{\"emiSr\":223,\"payDate\":\"2041-05-12\",\"emiAmount\":129,\"interest\":49,\"principle\":80,\"balance\":4810},{\"emiSr\":224,\"payDate\":\"2041-06-12\",\"emiAmount\":129,\"interest\":48,\"principle\":81,\"balance\":4729},{\"emiSr\":225,\"payDate\":\"2041-07-12\",\"emiAmount\":129,\"interest\":47,\"principle\":81,\"balance\":4648},{\"emiSr\":226,\"payDate\":\"2041-08-12\",\"emiAmount\":129,\"interest\":46,\"principle\":82,\"balance\":4566},{\"emiSr\":227,\"payDate\":\"2041-09-12\",\"emiAmount\":129,\"interest\":46,\"principle\":83,\"balance\":4483},{\"emiSr\":228,\"payDate\":\"2041-10-12\",\"emiAmount\":129,\"interest\":45,\"principle\":84,\"balance\":4399},{\"emiSr\":229,\"payDate\":\"2041-11-12\",\"emiAmount\":129,\"interest\":44,\"principle\":85,\"balance\":4314},{\"emiSr\":230,\"payDate\":\"2041-12-12\",\"emiAmount\":129,\"interest\":43,\"principle\":86,\"balance\":4228},{\"emiSr\":231,\"payDate\":\"2042-01-12\",\"emiAmount\":129,\"interest\":42,\"principle\":86,\"balance\":4142},{\"emiSr\":232,\"payDate\":\"2042-02-12\",\"emiAmount\":129,\"interest\":41,\"principle\":87,\"balance\":4054},{\"emiSr\":233,\"payDate\":\"2042-03-12\",\"emiAmount\":129,\"interest\":41,\"principle\":88,\"balance\":3966},{\"emiSr\":234,\"payDate\":\"2042-04-12\",\"emiAmount\":129,\"interest\":40,\"principle\":89,\"balance\":3877},{\"emiSr\":235,\"payDate\":\"2042-05-12\",\"emiAmount\":129,\"interest\":39,\"principle\":90,\"balance\":3787},{\"emiSr\":236,\"payDate\":\"2042-06-12\",\"emiAmount\":129,\"interest\":38,\"principle\":91,\"balance\":3696},{\"emiSr\":237,\"payDate\":\"2042-07-12\",\"emiAmount\":129,\"interest\":37,\"principle\":92,\"balance\":3604},{\"emiSr\":238,\"payDate\":\"2042-08-12\",\"emiAmount\":129,\"interest\":36,\"principle\":93,\"balance\":3512},{\"emiSr\":239,\"payDate\":\"2042-09-12\",\"emiAmount\":129,\"interest\":35,\"principle\":94,\"balance\":3418},{\"emiSr\":240,\"payDate\":\"2042-10-12\",\"emiAmount\":129,\"interest\":34,\"principle\":95,\"balance\":3323},{\"emiSr\":241,\"payDate\":\"2042-11-12\",\"emiAmount\":129,\"interest\":33,\"principle\":96,\"balance\":3228},{\"emiSr\":242,\"payDate\":\"2042-12-12\",\"emiAmount\":129,\"interest\":32,\"principle\":96,\"balance\":3131},{\"emiSr\":243,\"payDate\":\"2043-01-12\",\"emiAmount\":129,\"interest\":31,\"principle\":97,\"balance\":3034},{\"emiSr\":244,\"payDate\":\"2043-02-12\",\"emiAmount\":129,\"interest\":30,\"principle\":98,\"balance\":2935},{\"emiSr\":245,\"payDate\":\"2043-03-12\",\"emiAmount\":129,\"interest\":29,\"principle\":99,\"balance\":2836},{\"emiSr\":246,\"payDate\":\"2043-04-12\",\"emiAmount\":129,\"interest\":28,\"principle\":100,\"balance\":2736},{\"emiSr\":247,\"payDate\":\"2043-05-12\",\"emiAmount\":129,\"interest\":27,\"principle\":101,\"balance\":2634},{\"emiSr\":248,\"payDate\":\"2043-06-12\",\"emiAmount\":129,\"interest\":26,\"principle\":102,\"balance\":2532},{\"emiSr\":249,\"payDate\":\"2043-07-12\",\"emiAmount\":129,\"interest\":25,\"principle\":103,\"balance\":2428},{\"emiSr\":250,\"payDate\":\"2043-08-12\",\"emiAmount\":129,\"interest\":24,\"principle\":104,\"balance\":2324},{\"emiSr\":251,\"payDate\":\"2043-09-12\",\"emiAmount\":129,\"interest\":23,\"principle\":106,\"balance\":2218},{\"emiSr\":252,\"payDate\":\"2043-10-12\",\"emiAmount\":129,\"interest\":22,\"principle\":107,\"balance\":2112},{\"emiSr\":253,\"payDate\":\"2043-11-12\",\"emiAmount\":129,\"interest\":21,\"principle\":108,\"balance\":2004},{\"emiSr\":254,\"payDate\":\"2043-12-12\",\"emiAmount\":129,\"interest\":20,\"principle\":109,\"balance\":1895},{\"emiSr\":255,\"payDate\":\"2044-01-12\",\"emiAmount\":129,\"interest\":19,\"principle\":110,\"balance\":1785},{\"emiSr\":256,\"payDate\":\"2044-02-12\",\"emiAmount\":129,\"interest\":18,\"principle\":111,\"balance\":1674},{\"emiSr\":257,\"payDate\":\"2044-03-12\",\"emiAmount\":129,\"interest\":17,\"principle\":112,\"balance\":1562},{\"emiSr\":258,\"payDate\":\"2044-04-12\",\"emiAmount\":129,\"interest\":16,\"principle\":113,\"balance\":1449},{\"emiSr\":259,\"payDate\":\"2044-05-12\",\"emiAmount\":129,\"interest\":14,\"principle\":114,\"balance\":1335},{\"emiSr\":260,\"payDate\":\"2044-06-12\",\"emiAmount\":129,\"interest\":13,\"principle\":115,\"balance\":1220},{\"emiSr\":261,\"payDate\":\"2044-07-12\",\"emiAmount\":129,\"interest\":12,\"principle\":117,\"balance\":1103},{\"emiSr\":262,\"payDate\":\"2044-08-12\",\"emiAmount\":129,\"interest\":11,\"principle\":118,\"balance\":985},{\"emiSr\":263,\"payDate\":\"2044-09-12\",\"emiAmount\":129,\"interest\":10,\"principle\":119,\"balance\":866},{\"emiSr\":264,\"payDate\":\"2044-10-12\",\"emiAmount\":129,\"interest\":9,\"principle\":120,\"balance\":746},{\"emiSr\":265,\"payDate\":\"2044-11-12\",\"emiAmount\":129,\"interest\":7,\"principle\":121,\"balance\":625},{\"emiSr\":266,\"payDate\":\"2044-12-12\",\"emiAmount\":129,\"interest\":6,\"principle\":123,\"balance\":502},{\"emiSr\":267,\"payDate\":\"2045-01-12\",\"emiAmount\":129,\"interest\":5,\"principle\":124,\"balance\":379},{\"emiSr\":268,\"payDate\":\"2045-02-12\",\"emiAmount\":129,\"interest\":4,\"principle\":125,\"balance\":254},{\"emiSr\":269,\"payDate\":\"2045-03-12\",\"emiAmount\":129,\"interest\":3,\"principle\":126,\"balance\":127},{\"emiSr\":270,\"payDate\":\"2045-04-12\",\"emiAmount\":129,\"interest\":1,\"principle\":127,\"balance\":0}]}', 0.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":0,\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":0,\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', '', 'customer-approved', '2022-10-06', NULL, NULL, NULL, '2022-10-06 04:54:28', '2022-10-06 17:11:09');
INSERT INTO `apply_loan_histories` (`id`, `userId`, `bankId`, `loanAmount`, `tenure`, `productId`, `loanCategory`, `roiType`, `rateOfInterest`, `approvedAmount`, `approvedTenure`, `netDisbursementAmount`, `monthlyEMI`, `totalInterest`, `emisDetailsStr`, `principleCharges`, `principleChargesDetails`, `invoiceFile`, `status`, `disbursedDate`, `validFromDate`, `validToDate`, `remark`, `created_at`, `updated_at`) VALUES
(21, 26, 3, '50000', 4, 4, 0, 'reducing_roi', '30', '50000', 4, 0.00, 1250.00, 406306.00, '{\"totalPaybleAmount\":456306,\"totalInterest\":406306,\"emiAmount\":1250,\"rateOfInterest\":\"30\",\"tenureInMonth\":\"365\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-11-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":50000},{\"emiSr\":2,\"payDate\":\"2022-12-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":50000},{\"emiSr\":3,\"payDate\":\"2023-01-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":50000},{\"emiSr\":4,\"payDate\":\"2023-02-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49999},{\"emiSr\":5,\"payDate\":\"2023-03-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49999},{\"emiSr\":6,\"payDate\":\"2023-04-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49999},{\"emiSr\":7,\"payDate\":\"2023-05-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49999},{\"emiSr\":8,\"payDate\":\"2023-06-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49999},{\"emiSr\":9,\"payDate\":\"2023-07-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49998},{\"emiSr\":10,\"payDate\":\"2023-08-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49998},{\"emiSr\":11,\"payDate\":\"2023-09-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49998},{\"emiSr\":12,\"payDate\":\"2023-10-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49998},{\"emiSr\":13,\"payDate\":\"2023-11-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49998},{\"emiSr\":14,\"payDate\":\"2023-12-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49997},{\"emiSr\":15,\"payDate\":\"2024-01-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49997},{\"emiSr\":16,\"payDate\":\"2024-02-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49997},{\"emiSr\":17,\"payDate\":\"2024-03-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49997},{\"emiSr\":18,\"payDate\":\"2024-04-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49997},{\"emiSr\":19,\"payDate\":\"2024-05-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49996},{\"emiSr\":20,\"payDate\":\"2024-06-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49996},{\"emiSr\":21,\"payDate\":\"2024-07-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49996},{\"emiSr\":22,\"payDate\":\"2024-08-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49996},{\"emiSr\":23,\"payDate\":\"2024-09-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49995},{\"emiSr\":24,\"payDate\":\"2024-10-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49995},{\"emiSr\":25,\"payDate\":\"2024-11-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49995},{\"emiSr\":26,\"payDate\":\"2024-12-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49995},{\"emiSr\":27,\"payDate\":\"2025-01-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49994},{\"emiSr\":28,\"payDate\":\"2025-02-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49994},{\"emiSr\":29,\"payDate\":\"2025-03-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49994},{\"emiSr\":30,\"payDate\":\"2025-04-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49993},{\"emiSr\":31,\"payDate\":\"2025-05-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49993},{\"emiSr\":32,\"payDate\":\"2025-06-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49993},{\"emiSr\":33,\"payDate\":\"2025-07-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49992},{\"emiSr\":34,\"payDate\":\"2025-08-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49992},{\"emiSr\":35,\"payDate\":\"2025-09-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49992},{\"emiSr\":36,\"payDate\":\"2025-10-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49991},{\"emiSr\":37,\"payDate\":\"2025-11-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49991},{\"emiSr\":38,\"payDate\":\"2025-12-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49991},{\"emiSr\":39,\"payDate\":\"2026-01-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49990},{\"emiSr\":40,\"payDate\":\"2026-02-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49990},{\"emiSr\":41,\"payDate\":\"2026-03-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49989},{\"emiSr\":42,\"payDate\":\"2026-04-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49989},{\"emiSr\":43,\"payDate\":\"2026-05-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49988},{\"emiSr\":44,\"payDate\":\"2026-06-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49988},{\"emiSr\":45,\"payDate\":\"2026-07-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49988},{\"emiSr\":46,\"payDate\":\"2026-08-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49987},{\"emiSr\":47,\"payDate\":\"2026-09-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49987},{\"emiSr\":48,\"payDate\":\"2026-10-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49986},{\"emiSr\":49,\"payDate\":\"2026-11-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":0,\"balance\":49986},{\"emiSr\":50,\"payDate\":\"2026-12-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":1,\"balance\":49985},{\"emiSr\":51,\"payDate\":\"2027-01-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":1,\"balance\":49985},{\"emiSr\":52,\"payDate\":\"2027-02-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":1,\"balance\":49984},{\"emiSr\":53,\"payDate\":\"2027-03-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":1,\"balance\":49984},{\"emiSr\":54,\"payDate\":\"2027-04-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":1,\"balance\":49983},{\"emiSr\":55,\"payDate\":\"2027-05-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":1,\"balance\":49982},{\"emiSr\":56,\"payDate\":\"2027-06-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":1,\"balance\":49982},{\"emiSr\":57,\"payDate\":\"2027-07-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":1,\"balance\":49981},{\"emiSr\":58,\"payDate\":\"2027-08-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":1,\"balance\":49981},{\"emiSr\":59,\"payDate\":\"2027-09-12\",\"emiAmount\":1250,\"interest\":1250,\"principle\":1,\"balance\":49980},{\"emiSr\":60,\"payDate\":\"2027-10-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49979},{\"emiSr\":61,\"payDate\":\"2027-11-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49979},{\"emiSr\":62,\"payDate\":\"2027-12-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49978},{\"emiSr\":63,\"payDate\":\"2028-01-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49977},{\"emiSr\":64,\"payDate\":\"2028-02-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49977},{\"emiSr\":65,\"payDate\":\"2028-03-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49976},{\"emiSr\":66,\"payDate\":\"2028-04-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49975},{\"emiSr\":67,\"payDate\":\"2028-05-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49974},{\"emiSr\":68,\"payDate\":\"2028-06-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49973},{\"emiSr\":69,\"payDate\":\"2028-07-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49973},{\"emiSr\":70,\"payDate\":\"2028-08-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49972},{\"emiSr\":71,\"payDate\":\"2028-09-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49971},{\"emiSr\":72,\"payDate\":\"2028-10-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49970},{\"emiSr\":73,\"payDate\":\"2028-11-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49969},{\"emiSr\":74,\"payDate\":\"2028-12-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49968},{\"emiSr\":75,\"payDate\":\"2029-01-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49967},{\"emiSr\":76,\"payDate\":\"2029-02-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49966},{\"emiSr\":77,\"payDate\":\"2029-03-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49965},{\"emiSr\":78,\"payDate\":\"2029-04-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49964},{\"emiSr\":79,\"payDate\":\"2029-05-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49963},{\"emiSr\":80,\"payDate\":\"2029-06-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49962},{\"emiSr\":81,\"payDate\":\"2029-07-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49961},{\"emiSr\":82,\"payDate\":\"2029-08-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49960},{\"emiSr\":83,\"payDate\":\"2029-09-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49959},{\"emiSr\":84,\"payDate\":\"2029-10-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49958},{\"emiSr\":85,\"payDate\":\"2029-11-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49956},{\"emiSr\":86,\"payDate\":\"2029-12-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49955},{\"emiSr\":87,\"payDate\":\"2030-01-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49954},{\"emiSr\":88,\"payDate\":\"2030-02-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49953},{\"emiSr\":89,\"payDate\":\"2030-03-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49951},{\"emiSr\":90,\"payDate\":\"2030-04-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49950},{\"emiSr\":91,\"payDate\":\"2030-05-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49948},{\"emiSr\":92,\"payDate\":\"2030-06-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49947},{\"emiSr\":93,\"payDate\":\"2030-07-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":1,\"balance\":49946},{\"emiSr\":94,\"payDate\":\"2030-08-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":2,\"balance\":49944},{\"emiSr\":95,\"payDate\":\"2030-09-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":2,\"balance\":49942},{\"emiSr\":96,\"payDate\":\"2030-10-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":2,\"balance\":49941},{\"emiSr\":97,\"payDate\":\"2030-11-12\",\"emiAmount\":1250,\"interest\":1249,\"principle\":2,\"balance\":49939},{\"emiSr\":98,\"payDate\":\"2030-12-12\",\"emiAmount\":1250,\"interest\":1248,\"principle\":2,\"balance\":49938},{\"emiSr\":99,\"payDate\":\"2031-01-12\",\"emiAmount\":1250,\"interest\":1248,\"principle\":2,\"balance\":49936},{\"emiSr\":100,\"payDate\":\"2031-02-12\",\"emiAmount\":1250,\"interest\":1248,\"principle\":2,\"balance\":49934},{\"emiSr\":101,\"payDate\":\"2031-03-12\",\"emiAmount\":1250,\"interest\":1248,\"principle\":2,\"balance\":49932},{\"emiSr\":102,\"payDate\":\"2031-04-12\",\"emiAmount\":1250,\"interest\":1248,\"principle\":2,\"balance\":49930},{\"emiSr\":103,\"payDate\":\"2031-05-12\",\"emiAmount\":1250,\"interest\":1248,\"principle\":2,\"balance\":49929},{\"emiSr\":104,\"payDate\":\"2031-06-12\",\"emiAmount\":1250,\"interest\":1248,\"principle\":2,\"balance\":49927},{\"emiSr\":105,\"payDate\":\"2031-07-12\",\"emiAmount\":1250,\"interest\":1248,\"principle\":2,\"balance\":49925},{\"emiSr\":106,\"payDate\":\"2031-08-12\",\"emiAmount\":1250,\"interest\":1248,\"principle\":2,\"balance\":49923},{\"emiSr\":107,\"payDate\":\"2031-09-12\",\"emiAmount\":1250,\"interest\":1248,\"principle\":2,\"balance\":49921},{\"emiSr\":108,\"payDate\":\"2031-10-12\",\"emiAmount\":1250,\"interest\":1248,\"principle\":2,\"balance\":49918},{\"emiSr\":109,\"payDate\":\"2031-11-12\",\"emiAmount\":1250,\"interest\":1248,\"principle\":2,\"balance\":49916},{\"emiSr\":110,\"payDate\":\"2031-12-12\",\"emiAmount\":1250,\"interest\":1248,\"principle\":2,\"balance\":49914},{\"emiSr\":111,\"payDate\":\"2032-01-12\",\"emiAmount\":1250,\"interest\":1248,\"principle\":2,\"balance\":49912},{\"emiSr\":112,\"payDate\":\"2032-02-12\",\"emiAmount\":1250,\"interest\":1248,\"principle\":2,\"balance\":49909},{\"emiSr\":113,\"payDate\":\"2032-03-12\",\"emiAmount\":1250,\"interest\":1248,\"principle\":2,\"balance\":49907},{\"emiSr\":114,\"payDate\":\"2032-04-12\",\"emiAmount\":1250,\"interest\":1248,\"principle\":2,\"balance\":49904},{\"emiSr\":115,\"payDate\":\"2032-05-12\",\"emiAmount\":1250,\"interest\":1248,\"principle\":3,\"balance\":49902},{\"emiSr\":116,\"payDate\":\"2032-06-12\",\"emiAmount\":1250,\"interest\":1248,\"principle\":3,\"balance\":49899},{\"emiSr\":117,\"payDate\":\"2032-07-12\",\"emiAmount\":1250,\"interest\":1247,\"principle\":3,\"balance\":49897},{\"emiSr\":118,\"payDate\":\"2032-08-12\",\"emiAmount\":1250,\"interest\":1247,\"principle\":3,\"balance\":49894},{\"emiSr\":119,\"payDate\":\"2032-09-12\",\"emiAmount\":1250,\"interest\":1247,\"principle\":3,\"balance\":49891},{\"emiSr\":120,\"payDate\":\"2032-10-12\",\"emiAmount\":1250,\"interest\":1247,\"principle\":3,\"balance\":49888},{\"emiSr\":121,\"payDate\":\"2032-11-12\",\"emiAmount\":1250,\"interest\":1247,\"principle\":3,\"balance\":49885},{\"emiSr\":122,\"payDate\":\"2032-12-12\",\"emiAmount\":1250,\"interest\":1247,\"principle\":3,\"balance\":49882},{\"emiSr\":123,\"payDate\":\"2033-01-12\",\"emiAmount\":1250,\"interest\":1247,\"principle\":3,\"balance\":49879},{\"emiSr\":124,\"payDate\":\"2033-02-12\",\"emiAmount\":1250,\"interest\":1247,\"principle\":3,\"balance\":49876},{\"emiSr\":125,\"payDate\":\"2033-03-12\",\"emiAmount\":1250,\"interest\":1247,\"principle\":3,\"balance\":49873},{\"emiSr\":126,\"payDate\":\"2033-04-12\",\"emiAmount\":1250,\"interest\":1247,\"principle\":3,\"balance\":49869},{\"emiSr\":127,\"payDate\":\"2033-05-12\",\"emiAmount\":1250,\"interest\":1247,\"principle\":3,\"balance\":49866},{\"emiSr\":128,\"payDate\":\"2033-06-12\",\"emiAmount\":1250,\"interest\":1247,\"principle\":4,\"balance\":49862},{\"emiSr\":129,\"payDate\":\"2033-07-12\",\"emiAmount\":1250,\"interest\":1247,\"principle\":4,\"balance\":49859},{\"emiSr\":130,\"payDate\":\"2033-08-12\",\"emiAmount\":1250,\"interest\":1246,\"principle\":4,\"balance\":49855},{\"emiSr\":131,\"payDate\":\"2033-09-12\",\"emiAmount\":1250,\"interest\":1246,\"principle\":4,\"balance\":49851},{\"emiSr\":132,\"payDate\":\"2033-10-12\",\"emiAmount\":1250,\"interest\":1246,\"principle\":4,\"balance\":49847},{\"emiSr\":133,\"payDate\":\"2033-11-12\",\"emiAmount\":1250,\"interest\":1246,\"principle\":4,\"balance\":49844},{\"emiSr\":134,\"payDate\":\"2033-12-12\",\"emiAmount\":1250,\"interest\":1246,\"principle\":4,\"balance\":49839},{\"emiSr\":135,\"payDate\":\"2034-01-12\",\"emiAmount\":1250,\"interest\":1246,\"principle\":4,\"balance\":49835},{\"emiSr\":136,\"payDate\":\"2034-02-12\",\"emiAmount\":1250,\"interest\":1246,\"principle\":4,\"balance\":49831},{\"emiSr\":137,\"payDate\":\"2034-03-12\",\"emiAmount\":1250,\"interest\":1246,\"principle\":4,\"balance\":49827},{\"emiSr\":138,\"payDate\":\"2034-04-12\",\"emiAmount\":1250,\"interest\":1246,\"principle\":4,\"balance\":49822},{\"emiSr\":139,\"payDate\":\"2034-05-12\",\"emiAmount\":1250,\"interest\":1246,\"principle\":5,\"balance\":49818},{\"emiSr\":140,\"payDate\":\"2034-06-12\",\"emiAmount\":1250,\"interest\":1245,\"principle\":5,\"balance\":49813},{\"emiSr\":141,\"payDate\":\"2034-07-12\",\"emiAmount\":1250,\"interest\":1245,\"principle\":5,\"balance\":49808},{\"emiSr\":142,\"payDate\":\"2034-08-12\",\"emiAmount\":1250,\"interest\":1245,\"principle\":5,\"balance\":49803},{\"emiSr\":143,\"payDate\":\"2034-09-12\",\"emiAmount\":1250,\"interest\":1245,\"principle\":5,\"balance\":49798},{\"emiSr\":144,\"payDate\":\"2034-10-12\",\"emiAmount\":1250,\"interest\":1245,\"principle\":5,\"balance\":49793},{\"emiSr\":145,\"payDate\":\"2034-11-12\",\"emiAmount\":1250,\"interest\":1245,\"principle\":5,\"balance\":49787},{\"emiSr\":146,\"payDate\":\"2034-12-12\",\"emiAmount\":1250,\"interest\":1245,\"principle\":5,\"balance\":49782},{\"emiSr\":147,\"payDate\":\"2035-01-12\",\"emiAmount\":1250,\"interest\":1245,\"principle\":6,\"balance\":49776},{\"emiSr\":148,\"payDate\":\"2035-02-12\",\"emiAmount\":1250,\"interest\":1244,\"principle\":6,\"balance\":49771},{\"emiSr\":149,\"payDate\":\"2035-03-12\",\"emiAmount\":1250,\"interest\":1244,\"principle\":6,\"balance\":49765},{\"emiSr\":150,\"payDate\":\"2035-04-12\",\"emiAmount\":1250,\"interest\":1244,\"principle\":6,\"balance\":49759},{\"emiSr\":151,\"payDate\":\"2035-05-12\",\"emiAmount\":1250,\"interest\":1244,\"principle\":6,\"balance\":49753},{\"emiSr\":152,\"payDate\":\"2035-06-12\",\"emiAmount\":1250,\"interest\":1244,\"principle\":6,\"balance\":49746},{\"emiSr\":153,\"payDate\":\"2035-07-12\",\"emiAmount\":1250,\"interest\":1244,\"principle\":6,\"balance\":49740},{\"emiSr\":154,\"payDate\":\"2035-08-12\",\"emiAmount\":1250,\"interest\":1243,\"principle\":7,\"balance\":49733},{\"emiSr\":155,\"payDate\":\"2035-09-12\",\"emiAmount\":1250,\"interest\":1243,\"principle\":7,\"balance\":49726},{\"emiSr\":156,\"payDate\":\"2035-10-12\",\"emiAmount\":1250,\"interest\":1243,\"principle\":7,\"balance\":49719},{\"emiSr\":157,\"payDate\":\"2035-11-12\",\"emiAmount\":1250,\"interest\":1243,\"principle\":7,\"balance\":49712},{\"emiSr\":158,\"payDate\":\"2035-12-12\",\"emiAmount\":1250,\"interest\":1243,\"principle\":7,\"balance\":49705},{\"emiSr\":159,\"payDate\":\"2036-01-12\",\"emiAmount\":1250,\"interest\":1243,\"principle\":8,\"balance\":49697},{\"emiSr\":160,\"payDate\":\"2036-02-12\",\"emiAmount\":1250,\"interest\":1242,\"principle\":8,\"balance\":49689},{\"emiSr\":161,\"payDate\":\"2036-03-12\",\"emiAmount\":1250,\"interest\":1242,\"principle\":8,\"balance\":49681},{\"emiSr\":162,\"payDate\":\"2036-04-12\",\"emiAmount\":1250,\"interest\":1242,\"principle\":8,\"balance\":49673},{\"emiSr\":163,\"payDate\":\"2036-05-12\",\"emiAmount\":1250,\"interest\":1242,\"principle\":8,\"balance\":49665},{\"emiSr\":164,\"payDate\":\"2036-06-12\",\"emiAmount\":1250,\"interest\":1242,\"principle\":9,\"balance\":49657},{\"emiSr\":165,\"payDate\":\"2036-07-12\",\"emiAmount\":1250,\"interest\":1241,\"principle\":9,\"balance\":49648},{\"emiSr\":166,\"payDate\":\"2036-08-12\",\"emiAmount\":1250,\"interest\":1241,\"principle\":9,\"balance\":49639},{\"emiSr\":167,\"payDate\":\"2036-09-12\",\"emiAmount\":1250,\"interest\":1241,\"principle\":9,\"balance\":49630},{\"emiSr\":168,\"payDate\":\"2036-10-12\",\"emiAmount\":1250,\"interest\":1241,\"principle\":9,\"balance\":49620},{\"emiSr\":169,\"payDate\":\"2036-11-12\",\"emiAmount\":1250,\"interest\":1241,\"principle\":10,\"balance\":49611},{\"emiSr\":170,\"payDate\":\"2036-12-12\",\"emiAmount\":1250,\"interest\":1240,\"principle\":10,\"balance\":49601},{\"emiSr\":171,\"payDate\":\"2037-01-12\",\"emiAmount\":1250,\"interest\":1240,\"principle\":10,\"balance\":49591},{\"emiSr\":172,\"payDate\":\"2037-02-12\",\"emiAmount\":1250,\"interest\":1240,\"principle\":10,\"balance\":49580},{\"emiSr\":173,\"payDate\":\"2037-03-12\",\"emiAmount\":1250,\"interest\":1240,\"principle\":11,\"balance\":49570},{\"emiSr\":174,\"payDate\":\"2037-04-12\",\"emiAmount\":1250,\"interest\":1239,\"principle\":11,\"balance\":49559},{\"emiSr\":175,\"payDate\":\"2037-05-12\",\"emiAmount\":1250,\"interest\":1239,\"principle\":11,\"balance\":49547},{\"emiSr\":176,\"payDate\":\"2037-06-12\",\"emiAmount\":1250,\"interest\":1239,\"principle\":11,\"balance\":49536},{\"emiSr\":177,\"payDate\":\"2037-07-12\",\"emiAmount\":1250,\"interest\":1238,\"principle\":12,\"balance\":49524},{\"emiSr\":178,\"payDate\":\"2037-08-12\",\"emiAmount\":1250,\"interest\":1238,\"principle\":12,\"balance\":49512},{\"emiSr\":179,\"payDate\":\"2037-09-12\",\"emiAmount\":1250,\"interest\":1238,\"principle\":12,\"balance\":49500},{\"emiSr\":180,\"payDate\":\"2037-10-12\",\"emiAmount\":1250,\"interest\":1237,\"principle\":13,\"balance\":49487},{\"emiSr\":181,\"payDate\":\"2037-11-12\",\"emiAmount\":1250,\"interest\":1237,\"principle\":13,\"balance\":49474},{\"emiSr\":182,\"payDate\":\"2037-12-12\",\"emiAmount\":1250,\"interest\":1237,\"principle\":13,\"balance\":49461},{\"emiSr\":183,\"payDate\":\"2038-01-12\",\"emiAmount\":1250,\"interest\":1237,\"principle\":14,\"balance\":49447},{\"emiSr\":184,\"payDate\":\"2038-02-12\",\"emiAmount\":1250,\"interest\":1236,\"principle\":14,\"balance\":49433},{\"emiSr\":185,\"payDate\":\"2038-03-12\",\"emiAmount\":1250,\"interest\":1236,\"principle\":14,\"balance\":49419},{\"emiSr\":186,\"payDate\":\"2038-04-12\",\"emiAmount\":1250,\"interest\":1235,\"principle\":15,\"balance\":49404},{\"emiSr\":187,\"payDate\":\"2038-05-12\",\"emiAmount\":1250,\"interest\":1235,\"principle\":15,\"balance\":49389},{\"emiSr\":188,\"payDate\":\"2038-06-12\",\"emiAmount\":1250,\"interest\":1235,\"principle\":15,\"balance\":49374},{\"emiSr\":189,\"payDate\":\"2038-07-12\",\"emiAmount\":1250,\"interest\":1234,\"principle\":16,\"balance\":49358},{\"emiSr\":190,\"payDate\":\"2038-08-12\",\"emiAmount\":1250,\"interest\":1234,\"principle\":16,\"balance\":49342},{\"emiSr\":191,\"payDate\":\"2038-09-12\",\"emiAmount\":1250,\"interest\":1234,\"principle\":17,\"balance\":49325},{\"emiSr\":192,\"payDate\":\"2038-10-12\",\"emiAmount\":1250,\"interest\":1233,\"principle\":17,\"balance\":49308},{\"emiSr\":193,\"payDate\":\"2038-11-12\",\"emiAmount\":1250,\"interest\":1233,\"principle\":17,\"balance\":49291},{\"emiSr\":194,\"payDate\":\"2038-12-12\",\"emiAmount\":1250,\"interest\":1232,\"principle\":18,\"balance\":49273},{\"emiSr\":195,\"payDate\":\"2039-01-12\",\"emiAmount\":1250,\"interest\":1232,\"principle\":18,\"balance\":49255},{\"emiSr\":196,\"payDate\":\"2039-02-12\",\"emiAmount\":1250,\"interest\":1231,\"principle\":19,\"balance\":49236},{\"emiSr\":197,\"payDate\":\"2039-03-12\",\"emiAmount\":1250,\"interest\":1231,\"principle\":19,\"balance\":49216},{\"emiSr\":198,\"payDate\":\"2039-04-12\",\"emiAmount\":1250,\"interest\":1230,\"principle\":20,\"balance\":49197},{\"emiSr\":199,\"payDate\":\"2039-05-12\",\"emiAmount\":1250,\"interest\":1230,\"principle\":20,\"balance\":49177},{\"emiSr\":200,\"payDate\":\"2039-06-12\",\"emiAmount\":1250,\"interest\":1229,\"principle\":21,\"balance\":49156},{\"emiSr\":201,\"payDate\":\"2039-07-12\",\"emiAmount\":1250,\"interest\":1229,\"principle\":21,\"balance\":49135},{\"emiSr\":202,\"payDate\":\"2039-08-12\",\"emiAmount\":1250,\"interest\":1228,\"principle\":22,\"balance\":49113},{\"emiSr\":203,\"payDate\":\"2039-09-12\",\"emiAmount\":1250,\"interest\":1228,\"principle\":22,\"balance\":49090},{\"emiSr\":204,\"payDate\":\"2039-10-12\",\"emiAmount\":1250,\"interest\":1227,\"principle\":23,\"balance\":49067},{\"emiSr\":205,\"payDate\":\"2039-11-12\",\"emiAmount\":1250,\"interest\":1227,\"principle\":23,\"balance\":49044},{\"emiSr\":206,\"payDate\":\"2039-12-12\",\"emiAmount\":1250,\"interest\":1226,\"principle\":24,\"balance\":49020},{\"emiSr\":207,\"payDate\":\"2040-01-12\",\"emiAmount\":1250,\"interest\":1225,\"principle\":25,\"balance\":48995},{\"emiSr\":208,\"payDate\":\"2040-02-12\",\"emiAmount\":1250,\"interest\":1225,\"principle\":25,\"balance\":48970},{\"emiSr\":209,\"payDate\":\"2040-03-12\",\"emiAmount\":1250,\"interest\":1224,\"principle\":26,\"balance\":48944},{\"emiSr\":210,\"payDate\":\"2040-04-12\",\"emiAmount\":1250,\"interest\":1224,\"principle\":27,\"balance\":48918},{\"emiSr\":211,\"payDate\":\"2040-05-12\",\"emiAmount\":1250,\"interest\":1223,\"principle\":27,\"balance\":48890},{\"emiSr\":212,\"payDate\":\"2040-06-12\",\"emiAmount\":1250,\"interest\":1222,\"principle\":28,\"balance\":48862},{\"emiSr\":213,\"payDate\":\"2040-07-12\",\"emiAmount\":1250,\"interest\":1222,\"principle\":29,\"balance\":48834},{\"emiSr\":214,\"payDate\":\"2040-08-12\",\"emiAmount\":1250,\"interest\":1221,\"principle\":29,\"balance\":48805},{\"emiSr\":215,\"payDate\":\"2040-09-12\",\"emiAmount\":1250,\"interest\":1220,\"principle\":30,\"balance\":48775},{\"emiSr\":216,\"payDate\":\"2040-10-12\",\"emiAmount\":1250,\"interest\":1219,\"principle\":31,\"balance\":48744},{\"emiSr\":217,\"payDate\":\"2040-11-12\",\"emiAmount\":1250,\"interest\":1219,\"principle\":32,\"balance\":48712},{\"emiSr\":218,\"payDate\":\"2040-12-12\",\"emiAmount\":1250,\"interest\":1218,\"principle\":32,\"balance\":48680},{\"emiSr\":219,\"payDate\":\"2041-01-12\",\"emiAmount\":1250,\"interest\":1217,\"principle\":33,\"balance\":48647},{\"emiSr\":220,\"payDate\":\"2041-02-12\",\"emiAmount\":1250,\"interest\":1216,\"principle\":34,\"balance\":48613},{\"emiSr\":221,\"payDate\":\"2041-03-12\",\"emiAmount\":1250,\"interest\":1215,\"principle\":35,\"balance\":48578},{\"emiSr\":222,\"payDate\":\"2041-04-12\",\"emiAmount\":1250,\"interest\":1214,\"principle\":36,\"balance\":48542},{\"emiSr\":223,\"payDate\":\"2041-05-12\",\"emiAmount\":1250,\"interest\":1214,\"principle\":37,\"balance\":48506},{\"emiSr\":224,\"payDate\":\"2041-06-12\",\"emiAmount\":1250,\"interest\":1213,\"principle\":38,\"balance\":48468},{\"emiSr\":225,\"payDate\":\"2041-07-12\",\"emiAmount\":1250,\"interest\":1212,\"principle\":38,\"balance\":48430},{\"emiSr\":226,\"payDate\":\"2041-08-12\",\"emiAmount\":1250,\"interest\":1211,\"principle\":39,\"balance\":48390},{\"emiSr\":227,\"payDate\":\"2041-09-12\",\"emiAmount\":1250,\"interest\":1210,\"principle\":40,\"balance\":48350},{\"emiSr\":228,\"payDate\":\"2041-10-12\",\"emiAmount\":1250,\"interest\":1209,\"principle\":41,\"balance\":48308},{\"emiSr\":229,\"payDate\":\"2041-11-12\",\"emiAmount\":1250,\"interest\":1208,\"principle\":42,\"balance\":48266},{\"emiSr\":230,\"payDate\":\"2041-12-12\",\"emiAmount\":1250,\"interest\":1207,\"principle\":44,\"balance\":48222},{\"emiSr\":231,\"payDate\":\"2042-01-12\",\"emiAmount\":1250,\"interest\":1206,\"principle\":45,\"balance\":48178},{\"emiSr\":232,\"payDate\":\"2042-02-12\",\"emiAmount\":1250,\"interest\":1204,\"principle\":46,\"balance\":48132},{\"emiSr\":233,\"payDate\":\"2042-03-12\",\"emiAmount\":1250,\"interest\":1203,\"principle\":47,\"balance\":48085},{\"emiSr\":234,\"payDate\":\"2042-04-12\",\"emiAmount\":1250,\"interest\":1202,\"principle\":48,\"balance\":48037},{\"emiSr\":235,\"payDate\":\"2042-05-12\",\"emiAmount\":1250,\"interest\":1201,\"principle\":49,\"balance\":47988},{\"emiSr\":236,\"payDate\":\"2042-06-12\",\"emiAmount\":1250,\"interest\":1200,\"principle\":50,\"balance\":47938},{\"emiSr\":237,\"payDate\":\"2042-07-12\",\"emiAmount\":1250,\"interest\":1198,\"principle\":52,\"balance\":47886},{\"emiSr\":238,\"payDate\":\"2042-08-12\",\"emiAmount\":1250,\"interest\":1197,\"principle\":53,\"balance\":47833},{\"emiSr\":239,\"payDate\":\"2042-09-12\",\"emiAmount\":1250,\"interest\":1196,\"principle\":54,\"balance\":47779},{\"emiSr\":240,\"payDate\":\"2042-10-12\",\"emiAmount\":1250,\"interest\":1194,\"principle\":56,\"balance\":47723},{\"emiSr\":241,\"payDate\":\"2042-11-12\",\"emiAmount\":1250,\"interest\":1193,\"principle\":57,\"balance\":47666},{\"emiSr\":242,\"payDate\":\"2042-12-12\",\"emiAmount\":1250,\"interest\":1192,\"principle\":59,\"balance\":47607},{\"emiSr\":243,\"payDate\":\"2043-01-12\",\"emiAmount\":1250,\"interest\":1190,\"principle\":60,\"balance\":47547},{\"emiSr\":244,\"payDate\":\"2043-02-12\",\"emiAmount\":1250,\"interest\":1189,\"principle\":61,\"balance\":47486},{\"emiSr\":245,\"payDate\":\"2043-03-12\",\"emiAmount\":1250,\"interest\":1187,\"principle\":63,\"balance\":47423},{\"emiSr\":246,\"payDate\":\"2043-04-12\",\"emiAmount\":1250,\"interest\":1186,\"principle\":65,\"balance\":47358},{\"emiSr\":247,\"payDate\":\"2043-05-12\",\"emiAmount\":1250,\"interest\":1184,\"principle\":66,\"balance\":47292},{\"emiSr\":248,\"payDate\":\"2043-06-12\",\"emiAmount\":1250,\"interest\":1182,\"principle\":68,\"balance\":47224},{\"emiSr\":249,\"payDate\":\"2043-07-12\",\"emiAmount\":1250,\"interest\":1181,\"principle\":70,\"balance\":47155},{\"emiSr\":250,\"payDate\":\"2043-08-12\",\"emiAmount\":1250,\"interest\":1179,\"principle\":71,\"balance\":47083},{\"emiSr\":251,\"payDate\":\"2043-09-12\",\"emiAmount\":1250,\"interest\":1177,\"principle\":73,\"balance\":47010},{\"emiSr\":252,\"payDate\":\"2043-10-12\",\"emiAmount\":1250,\"interest\":1175,\"principle\":75,\"balance\":46935},{\"emiSr\":253,\"payDate\":\"2043-11-12\",\"emiAmount\":1250,\"interest\":1173,\"principle\":77,\"balance\":46859},{\"emiSr\":254,\"payDate\":\"2043-12-12\",\"emiAmount\":1250,\"interest\":1171,\"principle\":79,\"balance\":46780},{\"emiSr\":255,\"payDate\":\"2044-01-12\",\"emiAmount\":1250,\"interest\":1170,\"principle\":81,\"balance\":46699},{\"emiSr\":256,\"payDate\":\"2044-02-12\",\"emiAmount\":1250,\"interest\":1167,\"principle\":83,\"balance\":46617},{\"emiSr\":257,\"payDate\":\"2044-03-12\",\"emiAmount\":1250,\"interest\":1165,\"principle\":85,\"balance\":46532},{\"emiSr\":258,\"payDate\":\"2044-04-12\",\"emiAmount\":1250,\"interest\":1163,\"principle\":87,\"balance\":46445},{\"emiSr\":259,\"payDate\":\"2044-05-12\",\"emiAmount\":1250,\"interest\":1161,\"principle\":89,\"balance\":46356},{\"emiSr\":260,\"payDate\":\"2044-06-12\",\"emiAmount\":1250,\"interest\":1159,\"principle\":91,\"balance\":46265},{\"emiSr\":261,\"payDate\":\"2044-07-12\",\"emiAmount\":1250,\"interest\":1157,\"principle\":94,\"balance\":46171},{\"emiSr\":262,\"payDate\":\"2044-08-12\",\"emiAmount\":1250,\"interest\":1154,\"principle\":96,\"balance\":46075},{\"emiSr\":263,\"payDate\":\"2044-09-12\",\"emiAmount\":1250,\"interest\":1152,\"principle\":98,\"balance\":45977},{\"emiSr\":264,\"payDate\":\"2044-10-12\",\"emiAmount\":1250,\"interest\":1149,\"principle\":101,\"balance\":45876},{\"emiSr\":265,\"payDate\":\"2044-11-12\",\"emiAmount\":1250,\"interest\":1147,\"principle\":103,\"balance\":45773},{\"emiSr\":266,\"payDate\":\"2044-12-12\",\"emiAmount\":1250,\"interest\":1144,\"principle\":106,\"balance\":45667},{\"emiSr\":267,\"payDate\":\"2045-01-12\",\"emiAmount\":1250,\"interest\":1142,\"principle\":108,\"balance\":45559},{\"emiSr\":268,\"payDate\":\"2045-02-12\",\"emiAmount\":1250,\"interest\":1139,\"principle\":111,\"balance\":45448},{\"emiSr\":269,\"payDate\":\"2045-03-12\",\"emiAmount\":1250,\"interest\":1136,\"principle\":114,\"balance\":45334},{\"emiSr\":270,\"payDate\":\"2045-04-12\",\"emiAmount\":1250,\"interest\":1133,\"principle\":117,\"balance\":45217},{\"emiSr\":271,\"payDate\":\"2045-05-12\",\"emiAmount\":1250,\"interest\":1130,\"principle\":120,\"balance\":45097},{\"emiSr\":272,\"payDate\":\"2045-06-12\",\"emiAmount\":1250,\"interest\":1127,\"principle\":123,\"balance\":44975},{\"emiSr\":273,\"payDate\":\"2045-07-12\",\"emiAmount\":1250,\"interest\":1124,\"principle\":126,\"balance\":44849},{\"emiSr\":274,\"payDate\":\"2045-08-12\",\"emiAmount\":1250,\"interest\":1121,\"principle\":129,\"balance\":44720},{\"emiSr\":275,\"payDate\":\"2045-09-12\",\"emiAmount\":1250,\"interest\":1118,\"principle\":132,\"balance\":44588},{\"emiSr\":276,\"payDate\":\"2045-10-12\",\"emiAmount\":1250,\"interest\":1115,\"principle\":135,\"balance\":44452},{\"emiSr\":277,\"payDate\":\"2045-11-12\",\"emiAmount\":1250,\"interest\":1111,\"principle\":139,\"balance\":44313},{\"emiSr\":278,\"payDate\":\"2045-12-12\",\"emiAmount\":1250,\"interest\":1108,\"principle\":142,\"balance\":44171},{\"emiSr\":279,\"payDate\":\"2046-01-12\",\"emiAmount\":1250,\"interest\":1104,\"principle\":146,\"balance\":44025},{\"emiSr\":280,\"payDate\":\"2046-02-12\",\"emiAmount\":1250,\"interest\":1101,\"principle\":150,\"balance\":43876},{\"emiSr\":281,\"payDate\":\"2046-03-12\",\"emiAmount\":1250,\"interest\":1097,\"principle\":153,\"balance\":43722},{\"emiSr\":282,\"payDate\":\"2046-04-12\",\"emiAmount\":1250,\"interest\":1093,\"principle\":157,\"balance\":43565},{\"emiSr\":283,\"payDate\":\"2046-05-12\",\"emiAmount\":1250,\"interest\":1089,\"principle\":161,\"balance\":43404},{\"emiSr\":284,\"payDate\":\"2046-06-12\",\"emiAmount\":1250,\"interest\":1085,\"principle\":165,\"balance\":43239},{\"emiSr\":285,\"payDate\":\"2046-07-12\",\"emiAmount\":1250,\"interest\":1081,\"principle\":169,\"balance\":43070},{\"emiSr\":286,\"payDate\":\"2046-08-12\",\"emiAmount\":1250,\"interest\":1077,\"principle\":173,\"balance\":42897},{\"emiSr\":287,\"payDate\":\"2046-09-12\",\"emiAmount\":1250,\"interest\":1072,\"principle\":178,\"balance\":42719},{\"emiSr\":288,\"payDate\":\"2046-10-12\",\"emiAmount\":1250,\"interest\":1068,\"principle\":182,\"balance\":42537},{\"emiSr\":289,\"payDate\":\"2046-11-12\",\"emiAmount\":1250,\"interest\":1063,\"principle\":187,\"balance\":42350},{\"emiSr\":290,\"payDate\":\"2046-12-12\",\"emiAmount\":1250,\"interest\":1059,\"principle\":191,\"balance\":42159},{\"emiSr\":291,\"payDate\":\"2047-01-12\",\"emiAmount\":1250,\"interest\":1054,\"principle\":196,\"balance\":41962},{\"emiSr\":292,\"payDate\":\"2047-02-12\",\"emiAmount\":1250,\"interest\":1049,\"principle\":201,\"balance\":41761},{\"emiSr\":293,\"payDate\":\"2047-03-12\",\"emiAmount\":1250,\"interest\":1044,\"principle\":206,\"balance\":41555},{\"emiSr\":294,\"payDate\":\"2047-04-12\",\"emiAmount\":1250,\"interest\":1039,\"principle\":211,\"balance\":41344},{\"emiSr\":295,\"payDate\":\"2047-05-12\",\"emiAmount\":1250,\"interest\":1034,\"principle\":217,\"balance\":41127},{\"emiSr\":296,\"payDate\":\"2047-06-12\",\"emiAmount\":1250,\"interest\":1028,\"principle\":222,\"balance\":40905},{\"emiSr\":297,\"payDate\":\"2047-07-12\",\"emiAmount\":1250,\"interest\":1023,\"principle\":228,\"balance\":40678},{\"emiSr\":298,\"payDate\":\"2047-08-12\",\"emiAmount\":1250,\"interest\":1017,\"principle\":233,\"balance\":40445},{\"emiSr\":299,\"payDate\":\"2047-09-12\",\"emiAmount\":1250,\"interest\":1011,\"principle\":239,\"balance\":40206},{\"emiSr\":300,\"payDate\":\"2047-10-12\",\"emiAmount\":1250,\"interest\":1005,\"principle\":245,\"balance\":39961},{\"emiSr\":301,\"payDate\":\"2047-11-12\",\"emiAmount\":1250,\"interest\":999,\"principle\":251,\"balance\":39709},{\"emiSr\":302,\"payDate\":\"2047-12-12\",\"emiAmount\":1250,\"interest\":993,\"principle\":257,\"balance\":39452},{\"emiSr\":303,\"payDate\":\"2048-01-12\",\"emiAmount\":1250,\"interest\":986,\"principle\":264,\"balance\":39188},{\"emiSr\":304,\"payDate\":\"2048-02-12\",\"emiAmount\":1250,\"interest\":980,\"principle\":270,\"balance\":38918},{\"emiSr\":305,\"payDate\":\"2048-03-12\",\"emiAmount\":1250,\"interest\":973,\"principle\":277,\"balance\":38641},{\"emiSr\":306,\"payDate\":\"2048-04-12\",\"emiAmount\":1250,\"interest\":966,\"principle\":284,\"balance\":38356},{\"emiSr\":307,\"payDate\":\"2048-05-12\",\"emiAmount\":1250,\"interest\":959,\"principle\":291,\"balance\":38065},{\"emiSr\":308,\"payDate\":\"2048-06-12\",\"emiAmount\":1250,\"interest\":952,\"principle\":299,\"balance\":37767},{\"emiSr\":309,\"payDate\":\"2048-07-12\",\"emiAmount\":1250,\"interest\":944,\"principle\":306,\"balance\":37461},{\"emiSr\":310,\"payDate\":\"2048-08-12\",\"emiAmount\":1250,\"interest\":937,\"principle\":314,\"balance\":37147},{\"emiSr\":311,\"payDate\":\"2048-09-12\",\"emiAmount\":1250,\"interest\":929,\"principle\":321,\"balance\":36826},{\"emiSr\":312,\"payDate\":\"2048-10-12\",\"emiAmount\":1250,\"interest\":921,\"principle\":330,\"balance\":36496},{\"emiSr\":313,\"payDate\":\"2048-11-12\",\"emiAmount\":1250,\"interest\":912,\"principle\":338,\"balance\":36158},{\"emiSr\":314,\"payDate\":\"2048-12-12\",\"emiAmount\":1250,\"interest\":904,\"principle\":346,\"balance\":35812},{\"emiSr\":315,\"payDate\":\"2049-01-12\",\"emiAmount\":1250,\"interest\":895,\"principle\":355,\"balance\":35457},{\"emiSr\":316,\"payDate\":\"2049-02-12\",\"emiAmount\":1250,\"interest\":886,\"principle\":364,\"balance\":35093},{\"emiSr\":317,\"payDate\":\"2049-03-12\",\"emiAmount\":1250,\"interest\":877,\"principle\":373,\"balance\":34721},{\"emiSr\":318,\"payDate\":\"2049-04-12\",\"emiAmount\":1250,\"interest\":868,\"principle\":382,\"balance\":34339},{\"emiSr\":319,\"payDate\":\"2049-05-12\",\"emiAmount\":1250,\"interest\":858,\"principle\":392,\"balance\":33947},{\"emiSr\":320,\"payDate\":\"2049-06-12\",\"emiAmount\":1250,\"interest\":849,\"principle\":401,\"balance\":33545},{\"emiSr\":321,\"payDate\":\"2049-07-12\",\"emiAmount\":1250,\"interest\":839,\"principle\":412,\"balance\":33134},{\"emiSr\":322,\"payDate\":\"2049-08-12\",\"emiAmount\":1250,\"interest\":828,\"principle\":422,\"balance\":32712},{\"emiSr\":323,\"payDate\":\"2049-09-12\",\"emiAmount\":1250,\"interest\":818,\"principle\":432,\"balance\":32280},{\"emiSr\":324,\"payDate\":\"2049-10-12\",\"emiAmount\":1250,\"interest\":807,\"principle\":443,\"balance\":31837},{\"emiSr\":325,\"payDate\":\"2049-11-12\",\"emiAmount\":1250,\"interest\":796,\"principle\":454,\"balance\":31382},{\"emiSr\":326,\"payDate\":\"2049-12-12\",\"emiAmount\":1250,\"interest\":785,\"principle\":466,\"balance\":30917},{\"emiSr\":327,\"payDate\":\"2050-01-12\",\"emiAmount\":1250,\"interest\":773,\"principle\":477,\"balance\":30439},{\"emiSr\":328,\"payDate\":\"2050-02-12\",\"emiAmount\":1250,\"interest\":761,\"principle\":489,\"balance\":29950},{\"emiSr\":329,\"payDate\":\"2050-03-12\",\"emiAmount\":1250,\"interest\":749,\"principle\":501,\"balance\":29449},{\"emiSr\":330,\"payDate\":\"2050-04-12\",\"emiAmount\":1250,\"interest\":736,\"principle\":514,\"balance\":28935},{\"emiSr\":331,\"payDate\":\"2050-05-12\",\"emiAmount\":1250,\"interest\":723,\"principle\":527,\"balance\":28408},{\"emiSr\":332,\"payDate\":\"2050-06-12\",\"emiAmount\":1250,\"interest\":710,\"principle\":540,\"balance\":27868},{\"emiSr\":333,\"payDate\":\"2050-07-12\",\"emiAmount\":1250,\"interest\":697,\"principle\":553,\"balance\":27315},{\"emiSr\":334,\"payDate\":\"2050-08-12\",\"emiAmount\":1250,\"interest\":683,\"principle\":567,\"balance\":26748},{\"emiSr\":335,\"payDate\":\"2050-09-12\",\"emiAmount\":1250,\"interest\":669,\"principle\":581,\"balance\":26166},{\"emiSr\":336,\"payDate\":\"2050-10-12\",\"emiAmount\":1250,\"interest\":654,\"principle\":596,\"balance\":25570},{\"emiSr\":337,\"payDate\":\"2050-11-12\",\"emiAmount\":1250,\"interest\":639,\"principle\":611,\"balance\":24959},{\"emiSr\":338,\"payDate\":\"2050-12-12\",\"emiAmount\":1250,\"interest\":624,\"principle\":626,\"balance\":24333},{\"emiSr\":339,\"payDate\":\"2051-01-12\",\"emiAmount\":1250,\"interest\":608,\"principle\":642,\"balance\":23691},{\"emiSr\":340,\"payDate\":\"2051-02-12\",\"emiAmount\":1250,\"interest\":592,\"principle\":658,\"balance\":23033},{\"emiSr\":341,\"payDate\":\"2051-03-12\",\"emiAmount\":1250,\"interest\":576,\"principle\":674,\"balance\":22359},{\"emiSr\":342,\"payDate\":\"2051-04-12\",\"emiAmount\":1250,\"interest\":559,\"principle\":691,\"balance\":21668},{\"emiSr\":343,\"payDate\":\"2051-05-12\",\"emiAmount\":1250,\"interest\":542,\"principle\":708,\"balance\":20959},{\"emiSr\":344,\"payDate\":\"2051-06-12\",\"emiAmount\":1250,\"interest\":524,\"principle\":726,\"balance\":20233},{\"emiSr\":345,\"payDate\":\"2051-07-12\",\"emiAmount\":1250,\"interest\":506,\"principle\":744,\"balance\":19489},{\"emiSr\":346,\"payDate\":\"2051-08-12\",\"emiAmount\":1250,\"interest\":487,\"principle\":763,\"balance\":18726},{\"emiSr\":347,\"payDate\":\"2051-09-12\",\"emiAmount\":1250,\"interest\":468,\"principle\":782,\"balance\":17944},{\"emiSr\":348,\"payDate\":\"2051-10-12\",\"emiAmount\":1250,\"interest\":449,\"principle\":802,\"balance\":17142},{\"emiSr\":349,\"payDate\":\"2051-11-12\",\"emiAmount\":1250,\"interest\":429,\"principle\":822,\"balance\":16321},{\"emiSr\":350,\"payDate\":\"2051-12-12\",\"emiAmount\":1250,\"interest\":408,\"principle\":842,\"balance\":15479},{\"emiSr\":351,\"payDate\":\"2052-01-12\",\"emiAmount\":1250,\"interest\":387,\"principle\":863,\"balance\":14615},{\"emiSr\":352,\"payDate\":\"2052-02-12\",\"emiAmount\":1250,\"interest\":365,\"principle\":885,\"balance\":13731},{\"emiSr\":353,\"payDate\":\"2052-03-12\",\"emiAmount\":1250,\"interest\":343,\"principle\":907,\"balance\":12824},{\"emiSr\":354,\"payDate\":\"2052-04-12\",\"emiAmount\":1250,\"interest\":321,\"principle\":930,\"balance\":11894},{\"emiSr\":355,\"payDate\":\"2052-05-12\",\"emiAmount\":1250,\"interest\":297,\"principle\":953,\"balance\":10941},{\"emiSr\":356,\"payDate\":\"2052-06-12\",\"emiAmount\":1250,\"interest\":274,\"principle\":977,\"balance\":9965},{\"emiSr\":357,\"payDate\":\"2052-07-12\",\"emiAmount\":1250,\"interest\":249,\"principle\":1001,\"balance\":8964},{\"emiSr\":358,\"payDate\":\"2052-08-12\",\"emiAmount\":1250,\"interest\":224,\"principle\":1026,\"balance\":7938},{\"emiSr\":359,\"payDate\":\"2052-09-12\",\"emiAmount\":1250,\"interest\":198,\"principle\":1052,\"balance\":6886},{\"emiSr\":360,\"payDate\":\"2052-10-12\",\"emiAmount\":1250,\"interest\":172,\"principle\":1078,\"balance\":5808},{\"emiSr\":361,\"payDate\":\"2052-11-12\",\"emiAmount\":1250,\"interest\":145,\"principle\":1105,\"balance\":4703},{\"emiSr\":362,\"payDate\":\"2052-12-12\",\"emiAmount\":1250,\"interest\":118,\"principle\":1133,\"balance\":3570},{\"emiSr\":363,\"payDate\":\"2053-01-12\",\"emiAmount\":1250,\"interest\":89,\"principle\":1161,\"balance\":2410},{\"emiSr\":364,\"payDate\":\"2053-02-12\",\"emiAmount\":1250,\"interest\":60,\"principle\":1190,\"balance\":1220},{\"emiSr\":365,\"payDate\":\"2053-03-12\",\"emiAmount\":1250,\"interest\":30,\"principle\":1220,\"balance\":0}]}', 0.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":0,\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":0,\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1665036052WhatsApp_Image_2022_10_06_at_11.24.28_AM.jpeg', 'disbursed', '2022-10-06', NULL, NULL, NULL, '2022-10-06 06:00:52', '2022-10-06 06:05:56'),
(22, 27, 0, '30000', 1, 3, 0, 'reducing_roi', '18', '30000', 1, 0.00, 0.00, 0.00, NULL, 0.00, NULL, '', 'sent-for-customer-approval', NULL, '2022-10-06', '2023-01-05', NULL, '2022-10-06 06:23:01', '2022-10-06 06:23:01'),
(23, 29, 0, '30000', 1, 3, 0, 'reducing_roi', '18', '30000', 1, 0.00, 0.00, 0.00, NULL, 0.00, NULL, '', 'customer-approved', NULL, '2022-10-06', '2022-12-06', NULL, '2022-10-06 06:56:07', '2022-10-06 15:56:17');
INSERT INTO `apply_loan_histories` (`id`, `userId`, `bankId`, `loanAmount`, `tenure`, `productId`, `loanCategory`, `roiType`, `rateOfInterest`, `approvedAmount`, `approvedTenure`, `netDisbursementAmount`, `monthlyEMI`, `totalInterest`, `emisDetailsStr`, `principleCharges`, `principleChargesDetails`, `invoiceFile`, `status`, `disbursedDate`, `validFromDate`, `validToDate`, `remark`, `created_at`, `updated_at`) VALUES
(24, 28, 1, '36000', 2, 1, 0, 'reducing_roi', '18', '36000', 2, 0.00, 580.00, 68355.00, '{\"totalPaybleAmount\":104355,\"totalInterest\":68355,\"emiAmount\":580,\"rateOfInterest\":\"18\",\"tenureInMonth\":\"180\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-11-12\",\"emiAmount\":580,\"interest\":540,\"principle\":40,\"balance\":35960},{\"emiSr\":2,\"payDate\":\"2022-12-12\",\"emiAmount\":580,\"interest\":539,\"principle\":40,\"balance\":35920},{\"emiSr\":3,\"payDate\":\"2023-01-12\",\"emiAmount\":580,\"interest\":539,\"principle\":41,\"balance\":35879},{\"emiSr\":4,\"payDate\":\"2023-02-12\",\"emiAmount\":580,\"interest\":538,\"principle\":42,\"balance\":35837},{\"emiSr\":5,\"payDate\":\"2023-03-12\",\"emiAmount\":580,\"interest\":538,\"principle\":42,\"balance\":35795},{\"emiSr\":6,\"payDate\":\"2023-04-12\",\"emiAmount\":580,\"interest\":537,\"principle\":43,\"balance\":35752},{\"emiSr\":7,\"payDate\":\"2023-05-12\",\"emiAmount\":580,\"interest\":536,\"principle\":43,\"balance\":35709},{\"emiSr\":8,\"payDate\":\"2023-06-12\",\"emiAmount\":580,\"interest\":536,\"principle\":44,\"balance\":35665},{\"emiSr\":9,\"payDate\":\"2023-07-12\",\"emiAmount\":580,\"interest\":535,\"principle\":45,\"balance\":35620},{\"emiSr\":10,\"payDate\":\"2023-08-12\",\"emiAmount\":580,\"interest\":534,\"principle\":45,\"balance\":35575},{\"emiSr\":11,\"payDate\":\"2023-09-12\",\"emiAmount\":580,\"interest\":534,\"principle\":46,\"balance\":35528},{\"emiSr\":12,\"payDate\":\"2023-10-12\",\"emiAmount\":580,\"interest\":533,\"principle\":47,\"balance\":35482},{\"emiSr\":13,\"payDate\":\"2023-11-12\",\"emiAmount\":580,\"interest\":532,\"principle\":48,\"balance\":35434},{\"emiSr\":14,\"payDate\":\"2023-12-12\",\"emiAmount\":580,\"interest\":532,\"principle\":48,\"balance\":35386},{\"emiSr\":15,\"payDate\":\"2024-01-12\",\"emiAmount\":580,\"interest\":531,\"principle\":49,\"balance\":35337},{\"emiSr\":16,\"payDate\":\"2024-02-12\",\"emiAmount\":580,\"interest\":530,\"principle\":50,\"balance\":35287},{\"emiSr\":17,\"payDate\":\"2024-03-12\",\"emiAmount\":580,\"interest\":529,\"principle\":50,\"balance\":35237},{\"emiSr\":18,\"payDate\":\"2024-04-12\",\"emiAmount\":580,\"interest\":529,\"principle\":51,\"balance\":35186},{\"emiSr\":19,\"payDate\":\"2024-05-12\",\"emiAmount\":580,\"interest\":528,\"principle\":52,\"balance\":35134},{\"emiSr\":20,\"payDate\":\"2024-06-12\",\"emiAmount\":580,\"interest\":527,\"principle\":53,\"balance\":35081},{\"emiSr\":21,\"payDate\":\"2024-07-12\",\"emiAmount\":580,\"interest\":526,\"principle\":54,\"balance\":35027},{\"emiSr\":22,\"payDate\":\"2024-08-12\",\"emiAmount\":580,\"interest\":525,\"principle\":54,\"balance\":34973},{\"emiSr\":23,\"payDate\":\"2024-09-12\",\"emiAmount\":580,\"interest\":525,\"principle\":55,\"balance\":34918},{\"emiSr\":24,\"payDate\":\"2024-10-12\",\"emiAmount\":580,\"interest\":524,\"principle\":56,\"balance\":34862},{\"emiSr\":25,\"payDate\":\"2024-11-12\",\"emiAmount\":580,\"interest\":523,\"principle\":57,\"balance\":34805},{\"emiSr\":26,\"payDate\":\"2024-12-12\",\"emiAmount\":580,\"interest\":522,\"principle\":58,\"balance\":34747},{\"emiSr\":27,\"payDate\":\"2025-01-12\",\"emiAmount\":580,\"interest\":521,\"principle\":59,\"balance\":34689},{\"emiSr\":28,\"payDate\":\"2025-02-12\",\"emiAmount\":580,\"interest\":520,\"principle\":59,\"balance\":34629},{\"emiSr\":29,\"payDate\":\"2025-03-12\",\"emiAmount\":580,\"interest\":519,\"principle\":60,\"balance\":34569},{\"emiSr\":30,\"payDate\":\"2025-04-12\",\"emiAmount\":580,\"interest\":519,\"principle\":61,\"balance\":34508},{\"emiSr\":31,\"payDate\":\"2025-05-12\",\"emiAmount\":580,\"interest\":518,\"principle\":62,\"balance\":34446},{\"emiSr\":32,\"payDate\":\"2025-06-12\",\"emiAmount\":580,\"interest\":517,\"principle\":63,\"balance\":34383},{\"emiSr\":33,\"payDate\":\"2025-07-12\",\"emiAmount\":580,\"interest\":516,\"principle\":64,\"balance\":34319},{\"emiSr\":34,\"payDate\":\"2025-08-12\",\"emiAmount\":580,\"interest\":515,\"principle\":65,\"balance\":34254},{\"emiSr\":35,\"payDate\":\"2025-09-12\",\"emiAmount\":580,\"interest\":514,\"principle\":66,\"balance\":34188},{\"emiSr\":36,\"payDate\":\"2025-10-12\",\"emiAmount\":580,\"interest\":513,\"principle\":67,\"balance\":34121},{\"emiSr\":37,\"payDate\":\"2025-11-12\",\"emiAmount\":580,\"interest\":512,\"principle\":68,\"balance\":34053},{\"emiSr\":38,\"payDate\":\"2025-12-12\",\"emiAmount\":580,\"interest\":511,\"principle\":69,\"balance\":33984},{\"emiSr\":39,\"payDate\":\"2026-01-12\",\"emiAmount\":580,\"interest\":510,\"principle\":70,\"balance\":33914},{\"emiSr\":40,\"payDate\":\"2026-02-12\",\"emiAmount\":580,\"interest\":509,\"principle\":71,\"balance\":33843},{\"emiSr\":41,\"payDate\":\"2026-03-12\",\"emiAmount\":580,\"interest\":508,\"principle\":72,\"balance\":33771},{\"emiSr\":42,\"payDate\":\"2026-04-12\",\"emiAmount\":580,\"interest\":507,\"principle\":73,\"balance\":33697},{\"emiSr\":43,\"payDate\":\"2026-05-12\",\"emiAmount\":580,\"interest\":505,\"principle\":74,\"balance\":33623},{\"emiSr\":44,\"payDate\":\"2026-06-12\",\"emiAmount\":580,\"interest\":504,\"principle\":75,\"balance\":33548},{\"emiSr\":45,\"payDate\":\"2026-07-12\",\"emiAmount\":580,\"interest\":503,\"principle\":77,\"balance\":33471},{\"emiSr\":46,\"payDate\":\"2026-08-12\",\"emiAmount\":580,\"interest\":502,\"principle\":78,\"balance\":33394},{\"emiSr\":47,\"payDate\":\"2026-09-12\",\"emiAmount\":580,\"interest\":501,\"principle\":79,\"balance\":33315},{\"emiSr\":48,\"payDate\":\"2026-10-12\",\"emiAmount\":580,\"interest\":500,\"principle\":80,\"balance\":33235},{\"emiSr\":49,\"payDate\":\"2026-11-12\",\"emiAmount\":580,\"interest\":499,\"principle\":81,\"balance\":33153},{\"emiSr\":50,\"payDate\":\"2026-12-12\",\"emiAmount\":580,\"interest\":497,\"principle\":82,\"balance\":33071},{\"emiSr\":51,\"payDate\":\"2027-01-12\",\"emiAmount\":580,\"interest\":496,\"principle\":84,\"balance\":32987},{\"emiSr\":52,\"payDate\":\"2027-02-12\",\"emiAmount\":580,\"interest\":495,\"principle\":85,\"balance\":32902},{\"emiSr\":53,\"payDate\":\"2027-03-12\",\"emiAmount\":580,\"interest\":494,\"principle\":86,\"balance\":32816},{\"emiSr\":54,\"payDate\":\"2027-04-12\",\"emiAmount\":580,\"interest\":492,\"principle\":88,\"balance\":32729},{\"emiSr\":55,\"payDate\":\"2027-05-12\",\"emiAmount\":580,\"interest\":491,\"principle\":89,\"balance\":32640},{\"emiSr\":56,\"payDate\":\"2027-06-12\",\"emiAmount\":580,\"interest\":490,\"principle\":90,\"balance\":32550},{\"emiSr\":57,\"payDate\":\"2027-07-12\",\"emiAmount\":580,\"interest\":488,\"principle\":92,\"balance\":32458},{\"emiSr\":58,\"payDate\":\"2027-08-12\",\"emiAmount\":580,\"interest\":487,\"principle\":93,\"balance\":32365},{\"emiSr\":59,\"payDate\":\"2027-09-12\",\"emiAmount\":580,\"interest\":485,\"principle\":94,\"balance\":32271},{\"emiSr\":60,\"payDate\":\"2027-10-12\",\"emiAmount\":580,\"interest\":484,\"principle\":96,\"balance\":32175},{\"emiSr\":61,\"payDate\":\"2027-11-12\",\"emiAmount\":580,\"interest\":483,\"principle\":97,\"balance\":32078},{\"emiSr\":62,\"payDate\":\"2027-12-12\",\"emiAmount\":580,\"interest\":481,\"principle\":99,\"balance\":31980},{\"emiSr\":63,\"payDate\":\"2028-01-12\",\"emiAmount\":580,\"interest\":480,\"principle\":100,\"balance\":31880},{\"emiSr\":64,\"payDate\":\"2028-02-12\",\"emiAmount\":580,\"interest\":478,\"principle\":102,\"balance\":31778},{\"emiSr\":65,\"payDate\":\"2028-03-12\",\"emiAmount\":580,\"interest\":477,\"principle\":103,\"balance\":31675},{\"emiSr\":66,\"payDate\":\"2028-04-12\",\"emiAmount\":580,\"interest\":475,\"principle\":105,\"balance\":31570},{\"emiSr\":67,\"payDate\":\"2028-05-12\",\"emiAmount\":580,\"interest\":474,\"principle\":106,\"balance\":31464},{\"emiSr\":68,\"payDate\":\"2028-06-12\",\"emiAmount\":580,\"interest\":472,\"principle\":108,\"balance\":31356},{\"emiSr\":69,\"payDate\":\"2028-07-12\",\"emiAmount\":580,\"interest\":470,\"principle\":109,\"balance\":31247},{\"emiSr\":70,\"payDate\":\"2028-08-12\",\"emiAmount\":580,\"interest\":469,\"principle\":111,\"balance\":31136},{\"emiSr\":71,\"payDate\":\"2028-09-12\",\"emiAmount\":580,\"interest\":467,\"principle\":113,\"balance\":31023},{\"emiSr\":72,\"payDate\":\"2028-10-12\",\"emiAmount\":580,\"interest\":465,\"principle\":114,\"balance\":30909},{\"emiSr\":73,\"payDate\":\"2028-11-12\",\"emiAmount\":580,\"interest\":464,\"principle\":116,\"balance\":30793},{\"emiSr\":74,\"payDate\":\"2028-12-12\",\"emiAmount\":580,\"interest\":462,\"principle\":118,\"balance\":30675},{\"emiSr\":75,\"payDate\":\"2029-01-12\",\"emiAmount\":580,\"interest\":460,\"principle\":120,\"balance\":30555},{\"emiSr\":76,\"payDate\":\"2029-02-12\",\"emiAmount\":580,\"interest\":458,\"principle\":121,\"balance\":30434},{\"emiSr\":77,\"payDate\":\"2029-03-12\",\"emiAmount\":580,\"interest\":457,\"principle\":123,\"balance\":30310},{\"emiSr\":78,\"payDate\":\"2029-04-12\",\"emiAmount\":580,\"interest\":455,\"principle\":125,\"balance\":30185},{\"emiSr\":79,\"payDate\":\"2029-05-12\",\"emiAmount\":580,\"interest\":453,\"principle\":127,\"balance\":30058},{\"emiSr\":80,\"payDate\":\"2029-06-12\",\"emiAmount\":580,\"interest\":451,\"principle\":129,\"balance\":29930},{\"emiSr\":81,\"payDate\":\"2029-07-12\",\"emiAmount\":580,\"interest\":449,\"principle\":131,\"balance\":29799},{\"emiSr\":82,\"payDate\":\"2029-08-12\",\"emiAmount\":580,\"interest\":447,\"principle\":133,\"balance\":29666},{\"emiSr\":83,\"payDate\":\"2029-09-12\",\"emiAmount\":580,\"interest\":445,\"principle\":135,\"balance\":29531},{\"emiSr\":84,\"payDate\":\"2029-10-12\",\"emiAmount\":580,\"interest\":443,\"principle\":137,\"balance\":29394},{\"emiSr\":85,\"payDate\":\"2029-11-12\",\"emiAmount\":580,\"interest\":441,\"principle\":139,\"balance\":29256},{\"emiSr\":86,\"payDate\":\"2029-12-12\",\"emiAmount\":580,\"interest\":439,\"principle\":141,\"balance\":29115},{\"emiSr\":87,\"payDate\":\"2030-01-12\",\"emiAmount\":580,\"interest\":437,\"principle\":143,\"balance\":28972},{\"emiSr\":88,\"payDate\":\"2030-02-12\",\"emiAmount\":580,\"interest\":435,\"principle\":145,\"balance\":28826},{\"emiSr\":89,\"payDate\":\"2030-03-12\",\"emiAmount\":580,\"interest\":432,\"principle\":147,\"balance\":28679},{\"emiSr\":90,\"payDate\":\"2030-04-12\",\"emiAmount\":580,\"interest\":430,\"principle\":150,\"balance\":28529},{\"emiSr\":91,\"payDate\":\"2030-05-12\",\"emiAmount\":580,\"interest\":428,\"principle\":152,\"balance\":28378},{\"emiSr\":92,\"payDate\":\"2030-06-12\",\"emiAmount\":580,\"interest\":426,\"principle\":154,\"balance\":28224},{\"emiSr\":93,\"payDate\":\"2030-07-12\",\"emiAmount\":580,\"interest\":423,\"principle\":156,\"balance\":28067},{\"emiSr\":94,\"payDate\":\"2030-08-12\",\"emiAmount\":580,\"interest\":421,\"principle\":159,\"balance\":27908},{\"emiSr\":95,\"payDate\":\"2030-09-12\",\"emiAmount\":580,\"interest\":419,\"principle\":161,\"balance\":27747},{\"emiSr\":96,\"payDate\":\"2030-10-12\",\"emiAmount\":580,\"interest\":416,\"principle\":164,\"balance\":27584},{\"emiSr\":97,\"payDate\":\"2030-11-12\",\"emiAmount\":580,\"interest\":414,\"principle\":166,\"balance\":27418},{\"emiSr\":98,\"payDate\":\"2030-12-12\",\"emiAmount\":580,\"interest\":411,\"principle\":168,\"balance\":27249},{\"emiSr\":99,\"payDate\":\"2031-01-12\",\"emiAmount\":580,\"interest\":409,\"principle\":171,\"balance\":27078},{\"emiSr\":100,\"payDate\":\"2031-02-12\",\"emiAmount\":580,\"interest\":406,\"principle\":174,\"balance\":26905},{\"emiSr\":101,\"payDate\":\"2031-03-12\",\"emiAmount\":580,\"interest\":404,\"principle\":176,\"balance\":26729},{\"emiSr\":102,\"payDate\":\"2031-04-12\",\"emiAmount\":580,\"interest\":401,\"principle\":179,\"balance\":26550},{\"emiSr\":103,\"payDate\":\"2031-05-12\",\"emiAmount\":580,\"interest\":398,\"principle\":182,\"balance\":26368},{\"emiSr\":104,\"payDate\":\"2031-06-12\",\"emiAmount\":580,\"interest\":396,\"principle\":184,\"balance\":26184},{\"emiSr\":105,\"payDate\":\"2031-07-12\",\"emiAmount\":580,\"interest\":393,\"principle\":187,\"balance\":25997},{\"emiSr\":106,\"payDate\":\"2031-08-12\",\"emiAmount\":580,\"interest\":390,\"principle\":190,\"balance\":25807},{\"emiSr\":107,\"payDate\":\"2031-09-12\",\"emiAmount\":580,\"interest\":387,\"principle\":193,\"balance\":25615},{\"emiSr\":108,\"payDate\":\"2031-10-12\",\"emiAmount\":580,\"interest\":384,\"principle\":196,\"balance\":25419},{\"emiSr\":109,\"payDate\":\"2031-11-12\",\"emiAmount\":580,\"interest\":381,\"principle\":198,\"balance\":25221},{\"emiSr\":110,\"payDate\":\"2031-12-12\",\"emiAmount\":580,\"interest\":378,\"principle\":201,\"balance\":25019},{\"emiSr\":111,\"payDate\":\"2032-01-12\",\"emiAmount\":580,\"interest\":375,\"principle\":204,\"balance\":24815},{\"emiSr\":112,\"payDate\":\"2032-02-12\",\"emiAmount\":580,\"interest\":372,\"principle\":208,\"balance\":24607},{\"emiSr\":113,\"payDate\":\"2032-03-12\",\"emiAmount\":580,\"interest\":369,\"principle\":211,\"balance\":24396},{\"emiSr\":114,\"payDate\":\"2032-04-12\",\"emiAmount\":580,\"interest\":366,\"principle\":214,\"balance\":24183},{\"emiSr\":115,\"payDate\":\"2032-05-12\",\"emiAmount\":580,\"interest\":363,\"principle\":217,\"balance\":23966},{\"emiSr\":116,\"payDate\":\"2032-06-12\",\"emiAmount\":580,\"interest\":359,\"principle\":220,\"balance\":23745},{\"emiSr\":117,\"payDate\":\"2032-07-12\",\"emiAmount\":580,\"interest\":356,\"principle\":224,\"balance\":23522},{\"emiSr\":118,\"payDate\":\"2032-08-12\",\"emiAmount\":580,\"interest\":353,\"principle\":227,\"balance\":23295},{\"emiSr\":119,\"payDate\":\"2032-09-12\",\"emiAmount\":580,\"interest\":349,\"principle\":230,\"balance\":23065},{\"emiSr\":120,\"payDate\":\"2032-10-12\",\"emiAmount\":580,\"interest\":346,\"principle\":234,\"balance\":22831},{\"emiSr\":121,\"payDate\":\"2032-11-12\",\"emiAmount\":580,\"interest\":342,\"principle\":237,\"balance\":22593},{\"emiSr\":122,\"payDate\":\"2032-12-12\",\"emiAmount\":580,\"interest\":339,\"principle\":241,\"balance\":22353},{\"emiSr\":123,\"payDate\":\"2033-01-12\",\"emiAmount\":580,\"interest\":335,\"principle\":244,\"balance\":22108},{\"emiSr\":124,\"payDate\":\"2033-02-12\",\"emiAmount\":580,\"interest\":332,\"principle\":248,\"balance\":21860},{\"emiSr\":125,\"payDate\":\"2033-03-12\",\"emiAmount\":580,\"interest\":328,\"principle\":252,\"balance\":21608},{\"emiSr\":126,\"payDate\":\"2033-04-12\",\"emiAmount\":580,\"interest\":324,\"principle\":256,\"balance\":21353},{\"emiSr\":127,\"payDate\":\"2033-05-12\",\"emiAmount\":580,\"interest\":320,\"principle\":259,\"balance\":21093},{\"emiSr\":128,\"payDate\":\"2033-06-12\",\"emiAmount\":580,\"interest\":316,\"principle\":263,\"balance\":20830},{\"emiSr\":129,\"payDate\":\"2033-07-12\",\"emiAmount\":580,\"interest\":312,\"principle\":267,\"balance\":20562},{\"emiSr\":130,\"payDate\":\"2033-08-12\",\"emiAmount\":580,\"interest\":308,\"principle\":271,\"balance\":20291},{\"emiSr\":131,\"payDate\":\"2033-09-12\",\"emiAmount\":580,\"interest\":304,\"principle\":275,\"balance\":20016},{\"emiSr\":132,\"payDate\":\"2033-10-12\",\"emiAmount\":580,\"interest\":300,\"principle\":280,\"balance\":19736},{\"emiSr\":133,\"payDate\":\"2033-11-12\",\"emiAmount\":580,\"interest\":296,\"principle\":284,\"balance\":19453},{\"emiSr\":134,\"payDate\":\"2033-12-12\",\"emiAmount\":580,\"interest\":292,\"principle\":288,\"balance\":19165},{\"emiSr\":135,\"payDate\":\"2034-01-12\",\"emiAmount\":580,\"interest\":287,\"principle\":292,\"balance\":18872},{\"emiSr\":136,\"payDate\":\"2034-02-12\",\"emiAmount\":580,\"interest\":283,\"principle\":297,\"balance\":18576},{\"emiSr\":137,\"payDate\":\"2034-03-12\",\"emiAmount\":580,\"interest\":279,\"principle\":301,\"balance\":18274},{\"emiSr\":138,\"payDate\":\"2034-04-12\",\"emiAmount\":580,\"interest\":274,\"principle\":306,\"balance\":17969},{\"emiSr\":139,\"payDate\":\"2034-05-12\",\"emiAmount\":580,\"interest\":270,\"principle\":310,\"balance\":17659},{\"emiSr\":140,\"payDate\":\"2034-06-12\",\"emiAmount\":580,\"interest\":265,\"principle\":315,\"balance\":17344},{\"emiSr\":141,\"payDate\":\"2034-07-12\",\"emiAmount\":580,\"interest\":260,\"principle\":320,\"balance\":17024},{\"emiSr\":142,\"payDate\":\"2034-08-12\",\"emiAmount\":580,\"interest\":255,\"principle\":324,\"balance\":16700},{\"emiSr\":143,\"payDate\":\"2034-09-12\",\"emiAmount\":580,\"interest\":250,\"principle\":329,\"balance\":16371},{\"emiSr\":144,\"payDate\":\"2034-10-12\",\"emiAmount\":580,\"interest\":246,\"principle\":334,\"balance\":16036},{\"emiSr\":145,\"payDate\":\"2034-11-12\",\"emiAmount\":580,\"interest\":241,\"principle\":339,\"balance\":15697},{\"emiSr\":146,\"payDate\":\"2034-12-12\",\"emiAmount\":580,\"interest\":235,\"principle\":344,\"balance\":15353},{\"emiSr\":147,\"payDate\":\"2035-01-12\",\"emiAmount\":580,\"interest\":230,\"principle\":349,\"balance\":15003},{\"emiSr\":148,\"payDate\":\"2035-02-12\",\"emiAmount\":580,\"interest\":225,\"principle\":355,\"balance\":14649},{\"emiSr\":149,\"payDate\":\"2035-03-12\",\"emiAmount\":580,\"interest\":220,\"principle\":360,\"balance\":14289},{\"emiSr\":150,\"payDate\":\"2035-04-12\",\"emiAmount\":580,\"interest\":214,\"principle\":365,\"balance\":13923},{\"emiSr\":151,\"payDate\":\"2035-05-12\",\"emiAmount\":580,\"interest\":209,\"principle\":371,\"balance\":13552},{\"emiSr\":152,\"payDate\":\"2035-06-12\",\"emiAmount\":580,\"interest\":203,\"principle\":376,\"balance\":13176},{\"emiSr\":153,\"payDate\":\"2035-07-12\",\"emiAmount\":580,\"interest\":198,\"principle\":382,\"balance\":12794},{\"emiSr\":154,\"payDate\":\"2035-08-12\",\"emiAmount\":580,\"interest\":192,\"principle\":388,\"balance\":12406},{\"emiSr\":155,\"payDate\":\"2035-09-12\",\"emiAmount\":580,\"interest\":186,\"principle\":394,\"balance\":12012},{\"emiSr\":156,\"payDate\":\"2035-10-12\",\"emiAmount\":580,\"interest\":180,\"principle\":400,\"balance\":11613},{\"emiSr\":157,\"payDate\":\"2035-11-12\",\"emiAmount\":580,\"interest\":174,\"principle\":406,\"balance\":11207},{\"emiSr\":158,\"payDate\":\"2035-12-12\",\"emiAmount\":580,\"interest\":168,\"principle\":412,\"balance\":10795},{\"emiSr\":159,\"payDate\":\"2036-01-12\",\"emiAmount\":580,\"interest\":162,\"principle\":418,\"balance\":10378},{\"emiSr\":160,\"payDate\":\"2036-02-12\",\"emiAmount\":580,\"interest\":156,\"principle\":424,\"balance\":9954},{\"emiSr\":161,\"payDate\":\"2036-03-12\",\"emiAmount\":580,\"interest\":149,\"principle\":430,\"balance\":9523},{\"emiSr\":162,\"payDate\":\"2036-04-12\",\"emiAmount\":580,\"interest\":143,\"principle\":437,\"balance\":9086},{\"emiSr\":163,\"payDate\":\"2036-05-12\",\"emiAmount\":580,\"interest\":136,\"principle\":443,\"balance\":8643},{\"emiSr\":164,\"payDate\":\"2036-06-12\",\"emiAmount\":580,\"interest\":130,\"principle\":450,\"balance\":8193},{\"emiSr\":165,\"payDate\":\"2036-07-12\",\"emiAmount\":580,\"interest\":123,\"principle\":457,\"balance\":7736},{\"emiSr\":166,\"payDate\":\"2036-08-12\",\"emiAmount\":580,\"interest\":116,\"principle\":464,\"balance\":7272},{\"emiSr\":167,\"payDate\":\"2036-09-12\",\"emiAmount\":580,\"interest\":109,\"principle\":471,\"balance\":6801},{\"emiSr\":168,\"payDate\":\"2036-10-12\",\"emiAmount\":580,\"interest\":102,\"principle\":478,\"balance\":6324},{\"emiSr\":169,\"payDate\":\"2036-11-12\",\"emiAmount\":580,\"interest\":95,\"principle\":485,\"balance\":5839},{\"emiSr\":170,\"payDate\":\"2036-12-12\",\"emiAmount\":580,\"interest\":88,\"principle\":492,\"balance\":5347},{\"emiSr\":171,\"payDate\":\"2037-01-12\",\"emiAmount\":580,\"interest\":80,\"principle\":500,\"balance\":4847},{\"emiSr\":172,\"payDate\":\"2037-02-12\",\"emiAmount\":580,\"interest\":73,\"principle\":507,\"balance\":4340},{\"emiSr\":173,\"payDate\":\"2037-03-12\",\"emiAmount\":580,\"interest\":65,\"principle\":515,\"balance\":3825},{\"emiSr\":174,\"payDate\":\"2037-04-12\",\"emiAmount\":580,\"interest\":57,\"principle\":522,\"balance\":3303},{\"emiSr\":175,\"payDate\":\"2037-05-12\",\"emiAmount\":580,\"interest\":50,\"principle\":530,\"balance\":2773},{\"emiSr\":176,\"payDate\":\"2037-06-12\",\"emiAmount\":580,\"interest\":42,\"principle\":538,\"balance\":2235},{\"emiSr\":177,\"payDate\":\"2037-07-12\",\"emiAmount\":580,\"interest\":34,\"principle\":546,\"balance\":1688},{\"emiSr\":178,\"payDate\":\"2037-08-12\",\"emiAmount\":580,\"interest\":25,\"principle\":554,\"balance\":1134},{\"emiSr\":179,\"payDate\":\"2037-09-12\",\"emiAmount\":580,\"interest\":17,\"principle\":563,\"balance\":571},{\"emiSr\":180,\"payDate\":\"2037-10-12\",\"emiAmount\":580,\"interest\":9,\"principle\":571,\"balance\":-0}]}', 0.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":0,\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":0,\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', '', 'customer-approved', '2022-10-06', NULL, NULL, NULL, '2022-10-06 07:16:26', '2022-10-06 09:13:56'),
(25, 31, 0, '7000', 4, 4, 0, 'reducing_roi', '30', '7000', 4, 0.00, 682.00, 1189.00, '{\"totalPaybleAmount\":8189,\"totalInterest\":1189,\"emiAmount\":682,\"rateOfInterest\":\"30\",\"tenureInMonth\":\"12\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-11-12\",\"emiAmount\":682,\"interest\":175,\"principle\":507,\"balance\":6493},{\"emiSr\":2,\"payDate\":\"2022-12-12\",\"emiAmount\":682,\"interest\":162,\"principle\":520,\"balance\":5972},{\"emiSr\":3,\"payDate\":\"2023-01-12\",\"emiAmount\":682,\"interest\":149,\"principle\":533,\"balance\":5439},{\"emiSr\":4,\"payDate\":\"2023-02-12\",\"emiAmount\":682,\"interest\":136,\"principle\":546,\"balance\":4893},{\"emiSr\":5,\"payDate\":\"2023-03-12\",\"emiAmount\":682,\"interest\":122,\"principle\":560,\"balance\":4333},{\"emiSr\":6,\"payDate\":\"2023-04-12\",\"emiAmount\":682,\"interest\":108,\"principle\":574,\"balance\":3759},{\"emiSr\":7,\"payDate\":\"2023-05-12\",\"emiAmount\":682,\"interest\":94,\"principle\":588,\"balance\":3170},{\"emiSr\":8,\"payDate\":\"2023-06-12\",\"emiAmount\":682,\"interest\":79,\"principle\":603,\"balance\":2567},{\"emiSr\":9,\"payDate\":\"2023-07-12\",\"emiAmount\":682,\"interest\":64,\"principle\":618,\"balance\":1949},{\"emiSr\":10,\"payDate\":\"2023-08-12\",\"emiAmount\":682,\"interest\":49,\"principle\":634,\"balance\":1315},{\"emiSr\":11,\"payDate\":\"2023-09-12\",\"emiAmount\":682,\"interest\":33,\"principle\":650,\"balance\":666},{\"emiSr\":12,\"payDate\":\"2023-10-12\",\"emiAmount\":682,\"interest\":17,\"principle\":666,\"balance\":-0}]}', 0.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":0,\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":0,\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1665118758wallpaper2you_559031.jpg', 'disbursed', '2022-10-07', NULL, NULL, NULL, '2022-10-07 04:59:18', '2022-10-07 05:15:28'),
(26, 32, 0, '10000', 2, 3, 0, 'reducing_roi', '30', '10000', 2, 0.00, 0.00, 0.00, NULL, 0.00, NULL, '', 'customer-approved', NULL, '2022-10-07', '2023-03-31', NULL, '2022-10-07 05:42:38', '2022-10-07 05:44:07'),
(27, 30, 0, '50000', 3, 3, 0, 'reducing_roi', '35', '50000', 3, 0.00, 0.00, 0.00, NULL, 0.00, NULL, '', 'customer-approved', NULL, '2022-10-08', '2023-07-31', NULL, '2022-10-07 05:50:44', '2022-10-07 05:52:10'),
(28, 33, 0, '50000', 1, 3, 0, 'reducing_roi', '18', '50000', 1, 0.00, 0.00, 0.00, NULL, 0.00, NULL, '', 'customer-approved', NULL, '2022-10-07', '2023-01-07', NULL, '2022-10-07 06:45:49', '2022-10-07 10:04:08'),
(29, 34, 0, '100000', 3, 0, 3, 'reducing_roi', '30', '100000', 3, 0.00, 0.00, 0.00, NULL, 400.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1665645653ophthalmology_intro_icon.jpg', 'disburse-scheduled', '2022-10-13', '2022-10-13', '2023-06-14', NULL, '2022-10-13 07:20:53', '2022-10-13 07:36:15'),
(30, 36, 0, '10000', 4, 0, 4, 'reducing_roi', '30', '10000', 4, 0.00, 975.00, 1698.00, '{\"totalPaybleAmount\":11698,\"totalInterest\":1698,\"emiAmount\":975,\"rateOfInterest\":\"30\",\"tenureInMonth\":\"12\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-11-12\",\"emiAmount\":975,\"interest\":250,\"principle\":725,\"balance\":9275},{\"emiSr\":2,\"payDate\":\"2022-12-12\",\"emiAmount\":975,\"interest\":232,\"principle\":743,\"balance\":8532},{\"emiSr\":3,\"payDate\":\"2023-01-12\",\"emiAmount\":975,\"interest\":213,\"principle\":762,\"balance\":7771},{\"emiSr\":4,\"payDate\":\"2023-02-12\",\"emiAmount\":975,\"interest\":194,\"principle\":781,\"balance\":6990},{\"emiSr\":5,\"payDate\":\"2023-03-12\",\"emiAmount\":975,\"interest\":175,\"principle\":800,\"balance\":6190},{\"emiSr\":6,\"payDate\":\"2023-04-12\",\"emiAmount\":975,\"interest\":155,\"principle\":820,\"balance\":5370},{\"emiSr\":7,\"payDate\":\"2023-05-12\",\"emiAmount\":975,\"interest\":134,\"principle\":841,\"balance\":4529},{\"emiSr\":8,\"payDate\":\"2023-06-12\",\"emiAmount\":975,\"interest\":113,\"principle\":862,\"balance\":3667},{\"emiSr\":9,\"payDate\":\"2023-07-12\",\"emiAmount\":975,\"interest\":92,\"principle\":883,\"balance\":2784},{\"emiSr\":10,\"payDate\":\"2023-08-12\",\"emiAmount\":975,\"interest\":70,\"principle\":905,\"balance\":1879},{\"emiSr\":11,\"payDate\":\"2023-09-12\",\"emiAmount\":975,\"interest\":47,\"principle\":928,\"balance\":951},{\"emiSr\":12,\"payDate\":\"2023-10-12\",\"emiAmount\":975,\"interest\":24,\"principle\":951,\"balance\":-0}]}', 400.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1665647315wallpaper2you_559031.jpg', 'disbursed', '2022-10-13', NULL, NULL, NULL, '2022-10-13 07:48:35', '2022-10-13 07:54:33'),
(31, 37, 0, '10000', 3, 0, 4, 'reducing_roi', '26', '10000', 3, 0.00, 1235.00, 1114.00, '{\"totalPaybleAmount\":11114,\"totalInterest\":1114,\"emiAmount\":1235,\"rateOfInterest\":\"26\",\"tenureInMonth\":\"9\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-11-12\",\"emiAmount\":1235,\"interest\":217,\"principle\":1018,\"balance\":8982},{\"emiSr\":2,\"payDate\":\"2022-12-12\",\"emiAmount\":1235,\"interest\":195,\"principle\":1040,\"balance\":7941},{\"emiSr\":3,\"payDate\":\"2023-01-12\",\"emiAmount\":1235,\"interest\":172,\"principle\":1063,\"balance\":6879},{\"emiSr\":4,\"payDate\":\"2023-02-12\",\"emiAmount\":1235,\"interest\":149,\"principle\":1086,\"balance\":5793},{\"emiSr\":5,\"payDate\":\"2023-03-12\",\"emiAmount\":1235,\"interest\":126,\"principle\":1109,\"balance\":4683},{\"emiSr\":6,\"payDate\":\"2023-04-12\",\"emiAmount\":1235,\"interest\":101,\"principle\":1133,\"balance\":3550},{\"emiSr\":7,\"payDate\":\"2023-05-12\",\"emiAmount\":1235,\"interest\":77,\"principle\":1158,\"balance\":2392},{\"emiSr\":8,\"payDate\":\"2023-06-12\",\"emiAmount\":1235,\"interest\":52,\"principle\":1183,\"balance\":1209},{\"emiSr\":9,\"payDate\":\"2023-07-12\",\"emiAmount\":1235,\"interest\":26,\"principle\":1209,\"balance\":0}]}', 400.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1665655156wallpaper2you_559031.jpg', 'disburse-scheduled', '2022-10-17', NULL, NULL, NULL, '2022-10-13 09:59:16', '2022-10-17 13:50:28'),
(32, 38, 0, '10000', 4, 0, 3, 'reducing_roi', '26', '10000', 4, 0.00, 0.00, 0.00, NULL, 400.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1665722460wallpaper2you_559031.jpg', 'disburse-scheduled', '2022-10-14', '2022-10-14', '2023-06-15', NULL, '2022-10-14 04:41:00', '2022-10-14 04:47:07'),
(33, 39, 0, '10000', 2, 1, 1, 'reducing_roi', '26', '10000', 2, 0.00, 1795.00, 772.00, '{\"totalPaybleAmount\":10772,\"totalInterest\":772,\"emiAmount\":1795,\"rateOfInterest\":\"26\",\"tenureInMonth\":\"6\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-11-12\",\"emiAmount\":1795,\"interest\":217,\"principle\":1579,\"balance\":8421},{\"emiSr\":2,\"payDate\":\"2022-12-12\",\"emiAmount\":1795,\"interest\":182,\"principle\":1613,\"balance\":6809},{\"emiSr\":3,\"payDate\":\"2023-01-12\",\"emiAmount\":1795,\"interest\":148,\"principle\":1648,\"balance\":5161},{\"emiSr\":4,\"payDate\":\"2023-02-12\",\"emiAmount\":1795,\"interest\":112,\"principle\":1683,\"balance\":3477},{\"emiSr\":5,\"payDate\":\"2023-03-12\",\"emiAmount\":1795,\"interest\":75,\"principle\":1720,\"balance\":1757},{\"emiSr\":6,\"payDate\":\"2023-04-12\",\"emiAmount\":1795,\"interest\":38,\"principle\":1757,\"balance\":0}]}', 400.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', '', 'disbursed', '2022-10-14', NULL, NULL, NULL, '2022-10-14 12:16:28', '2022-10-14 12:42:09'),
(34, 41, 0, '10000', 4, 0, 3, 'reducing_roi', '26', '10000', 4, 0.00, 0.00, 0.00, NULL, 400.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1665983286wallpaper2you_559031.jpg', 'customer-approved', NULL, '2022-10-17', '2022-10-25', NULL, '2022-10-17 05:08:06', '2022-10-17 05:10:49'),
(35, 43, 0, '10000', 2, 1, 1, 'reducing_roi', '26', '10000', 2, 0.00, 1795.00, 772.00, '{\"totalPaybleAmount\":10772,\"totalInterest\":772,\"emiAmount\":1795,\"rateOfInterest\":\"26\",\"tenureInMonth\":\"6\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-11-12\",\"emiAmount\":1795,\"interest\":217,\"principle\":1579,\"balance\":8421},{\"emiSr\":2,\"payDate\":\"2022-12-12\",\"emiAmount\":1795,\"interest\":182,\"principle\":1613,\"balance\":6809},{\"emiSr\":3,\"payDate\":\"2023-01-12\",\"emiAmount\":1795,\"interest\":148,\"principle\":1648,\"balance\":5161},{\"emiSr\":4,\"payDate\":\"2023-02-12\",\"emiAmount\":1795,\"interest\":112,\"principle\":1683,\"balance\":3477},{\"emiSr\":5,\"payDate\":\"2023-03-12\",\"emiAmount\":1795,\"interest\":75,\"principle\":1720,\"balance\":1757},{\"emiSr\":6,\"payDate\":\"2023-04-12\",\"emiAmount\":1795,\"interest\":38,\"principle\":1757,\"balance\":0}]}', 400.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', '', 'disbursed', '2022-10-17', NULL, NULL, NULL, '2022-10-17 09:01:32', '2022-10-17 09:13:57'),
(36, 44, 0, '50000', 2, 0, 3, 'reducing_roi', '26', '50000', 2, 0.00, 0.00, 0.00, NULL, 400.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1666000197wallpaper2you_559031.jpg', 'customer-approved', NULL, '2022-10-17', '2023-01-17', NULL, '2022-10-17 09:49:57', '2022-10-17 12:50:34'),
(37, 13, 0, '5000', 1, 1, 1, 'reducing_roi', '2', '5000', 1, 0.00, 1672.00, 17.00, '{\"totalPaybleAmount\":5017,\"totalInterest\":17,\"emiAmount\":1672,\"rateOfInterest\":\"2\",\"tenureInMonth\":\"3\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-11-12\",\"emiAmount\":1672,\"interest\":8,\"principle\":1664,\"balance\":3336},{\"emiSr\":2,\"payDate\":\"2022-12-12\",\"emiAmount\":1672,\"interest\":6,\"principle\":1667,\"balance\":1669},{\"emiSr\":3,\"payDate\":\"2023-01-12\",\"emiAmount\":1672,\"interest\":3,\"principle\":1669,\"balance\":0}]}', 200.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"100\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"100\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', '', 'sent-for-customer-approval', NULL, NULL, NULL, NULL, '2022-10-18 09:59:00', '2022-10-18 09:59:00'),
(38, 48, 0, '50000', 3, 0, 3, 'reducing_roi', '26', '50000', 3, 0.00, 0.00, 0.00, NULL, 400.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1666163244wallpaper2you_559031.jpg', 'customer-approved', NULL, '2022-10-19', '2023-06-09', NULL, '2022-10-19 07:07:24', '2022-10-19 07:10:20'),
(39, 49, 0, '10000', 3, 0, 4, 'reducing_roi', '26', '10000', 3, 0.00, 1235.00, 1114.00, '{\"totalPaybleAmount\":11114,\"totalInterest\":1114,\"emiAmount\":1235,\"rateOfInterest\":\"26\",\"tenureInMonth\":\"9\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-11-12\",\"emiAmount\":1235,\"interest\":217,\"principle\":1018,\"balance\":8982},{\"emiSr\":2,\"payDate\":\"2022-12-12\",\"emiAmount\":1235,\"interest\":195,\"principle\":1040,\"balance\":7941},{\"emiSr\":3,\"payDate\":\"2023-01-12\",\"emiAmount\":1235,\"interest\":172,\"principle\":1063,\"balance\":6879},{\"emiSr\":4,\"payDate\":\"2023-02-12\",\"emiAmount\":1235,\"interest\":149,\"principle\":1086,\"balance\":5793},{\"emiSr\":5,\"payDate\":\"2023-03-12\",\"emiAmount\":1235,\"interest\":126,\"principle\":1109,\"balance\":4683},{\"emiSr\":6,\"payDate\":\"2023-04-12\",\"emiAmount\":1235,\"interest\":101,\"principle\":1133,\"balance\":3550},{\"emiSr\":7,\"payDate\":\"2023-05-12\",\"emiAmount\":1235,\"interest\":77,\"principle\":1158,\"balance\":2392},{\"emiSr\":8,\"payDate\":\"2023-06-12\",\"emiAmount\":1235,\"interest\":52,\"principle\":1183,\"balance\":1209},{\"emiSr\":9,\"payDate\":\"2023-07-12\",\"emiAmount\":1235,\"interest\":26,\"principle\":1209,\"balance\":0}]}', 400.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1666165137wallpaper2you_559031.jpg', 'disbursed', '2022-10-19', NULL, NULL, NULL, '2022-10-19 07:38:57', '2022-10-19 07:41:45'),
(40, 51, 0, '10000', 0, 0, 3, 'reducing_roi', '26', '10000', 0, 0.00, 0.00, 0.00, NULL, 400.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1666337502wallpaper2you_559031.jpg', 'sent-for-customer-approval', NULL, '2022-10-21', '2023-06-21', NULL, '2022-10-21 07:31:42', '2022-10-21 07:31:42'),
(41, 50, 0, '10000', 2, 1, 1, 'reducing_roi', '26', '10000', 2, 0.00, 1795.00, 772.00, '{\"totalPaybleAmount\":10772,\"totalInterest\":772,\"emiAmount\":1795,\"rateOfInterest\":\"26\",\"tenureInMonth\":\"6\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-11-12\",\"emiAmount\":1795,\"interest\":217,\"principle\":1579,\"balance\":8421},{\"emiSr\":2,\"payDate\":\"2022-12-12\",\"emiAmount\":1795,\"interest\":182,\"principle\":1613,\"balance\":6809},{\"emiSr\":3,\"payDate\":\"2023-01-12\",\"emiAmount\":1795,\"interest\":148,\"principle\":1648,\"balance\":5161},{\"emiSr\":4,\"payDate\":\"2023-02-12\",\"emiAmount\":1795,\"interest\":112,\"principle\":1683,\"balance\":3477},{\"emiSr\":5,\"payDate\":\"2023-03-12\",\"emiAmount\":1795,\"interest\":75,\"principle\":1720,\"balance\":1757},{\"emiSr\":6,\"payDate\":\"2023-04-12\",\"emiAmount\":1795,\"interest\":38,\"principle\":1757,\"balance\":0}]}', 400.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', NULL, 'disbursed', '2022-10-23', NULL, NULL, NULL, '2022-10-23 03:37:02', '2022-10-23 03:55:52'),
(42, 52, 0, '10000', 0, 0, 3, 'reducing_roi', '26', '10000', 0, 0.00, 0.00, 0.00, NULL, 400.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1666849996wallpaper2you_559031.jpg', 'customer-approved', NULL, '2022-10-27', '2022-10-28', NULL, '2022-10-27 05:53:16', '2022-10-27 05:56:51'),
(43, 54, 0, '10000', 2, 1, 1, 'reducing_roi', '26', '10000', 2, 0.00, 0.00, 0.00, NULL, 400.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', '', 'rejected', NULL, NULL, NULL, 'Reject For Customer Consent Reason', '2022-10-28 11:22:24', '2022-11-02 04:03:52'),
(44, 55, 0, '10000', 0, 0, 3, 'reducing_roi', '26', '10000', 0, 0.00, 0.00, 0.00, NULL, 400.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1667367554wallpaper2you_559031.jpg', 'customer-approved', NULL, '2022-11-02', '2023-03-02', NULL, '2022-11-02 05:39:14', '2022-11-02 05:46:52'),
(48, 57, 0, '120000', 1, 1, 1, 'reducing_roi', '12', '120000', 1, 116800.00, 40803.00, 2408.00, '{\"totalPaybleAmount\":122408,\"totalInterest\":2408,\"emiAmount\":40803,\"rateOfInterest\":\"12\",\"tenureInMonth\":\"3\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-12-12\",\"emiAmount\":40803,\"interest\":1200,\"principle\":39603,\"balance\":80397},{\"emiSr\":2,\"payDate\":\"2023-01-12\",\"emiAmount\":40803,\"interest\":804,\"principle\":39999,\"balance\":40399},{\"emiSr\":3,\"payDate\":\"2023-02-12\",\"emiAmount\":40803,\"interest\":404,\"principle\":40399,\"balance\":0}]}', 3200.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"1200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"2000\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', NULL, 'disbursed', '2022-11-02', NULL, NULL, NULL, '2022-11-02 19:51:26', '2022-11-02 19:58:20'),
(49, 58, 0, '10000', 0, 0, 3, 'reducing_roi', '30', '10000', 0, 9600.00, 0.00, 0.00, NULL, 400.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1667452677wallpaper2you_559031.jpg', 'customer-approved', NULL, '2022-11-03', '2023-02-03', NULL, '2022-11-03 05:17:57', '2022-11-03 05:22:55'),
(50, 56, 0, '10000', 4, 1, 1, 'reducing_roi', '30', '10000', 4, 9600.00, 975.00, 1698.00, '{\"totalPaybleAmount\":11698,\"totalInterest\":1698,\"emiAmount\":975,\"rateOfInterest\":\"30\",\"tenureInMonth\":\"12\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-12-12\",\"emiAmount\":975,\"interest\":250,\"principle\":725,\"balance\":9275},{\"emiSr\":2,\"payDate\":\"2023-01-12\",\"emiAmount\":975,\"interest\":232,\"principle\":743,\"balance\":8532},{\"emiSr\":3,\"payDate\":\"2023-02-12\",\"emiAmount\":975,\"interest\":213,\"principle\":762,\"balance\":7771},{\"emiSr\":4,\"payDate\":\"2023-03-12\",\"emiAmount\":975,\"interest\":194,\"principle\":781,\"balance\":6990},{\"emiSr\":5,\"payDate\":\"2023-04-12\",\"emiAmount\":975,\"interest\":175,\"principle\":800,\"balance\":6190},{\"emiSr\":6,\"payDate\":\"2023-05-12\",\"emiAmount\":975,\"interest\":155,\"principle\":820,\"balance\":5370},{\"emiSr\":7,\"payDate\":\"2023-06-12\",\"emiAmount\":975,\"interest\":134,\"principle\":841,\"balance\":4529},{\"emiSr\":8,\"payDate\":\"2023-07-12\",\"emiAmount\":975,\"interest\":113,\"principle\":862,\"balance\":3667},{\"emiSr\":9,\"payDate\":\"2023-08-12\",\"emiAmount\":975,\"interest\":92,\"principle\":883,\"balance\":2784},{\"emiSr\":10,\"payDate\":\"2023-09-12\",\"emiAmount\":975,\"interest\":70,\"principle\":905,\"balance\":1879},{\"emiSr\":11,\"payDate\":\"2023-10-12\",\"emiAmount\":975,\"interest\":47,\"principle\":928,\"balance\":951},{\"emiSr\":12,\"payDate\":\"2023-11-12\",\"emiAmount\":975,\"interest\":24,\"principle\":951,\"balance\":-0}]}', 400.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', NULL, 'disbursed', '2022-11-03', NULL, NULL, NULL, '2022-11-03 05:45:51', '2022-11-03 06:12:41'),
(51, 61, 0, '100000', 0, 0, 3, 'reducing_roi', '30', '100000', 0, 99600.00, 0.00, 0.00, NULL, 400.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1667457499wallpaper2you_559031.jpg', 'customer-approved', NULL, '2022-11-03', '2023-02-10', NULL, '2022-11-03 06:38:19', '2022-11-03 06:41:25'),
(52, 63, 0, '10000', 3, 1, 1, 'reducing_roi', '30', '10000', 3, 9600.00, 1255.00, 1291.00, '{\"totalPaybleAmount\":11291,\"totalInterest\":1291,\"emiAmount\":1255,\"rateOfInterest\":\"30\",\"tenureInMonth\":\"9\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-12-12\",\"emiAmount\":1255,\"interest\":250,\"principle\":1005,\"balance\":8995},{\"emiSr\":2,\"payDate\":\"2023-01-12\",\"emiAmount\":1255,\"interest\":225,\"principle\":1030,\"balance\":7966},{\"emiSr\":3,\"payDate\":\"2023-02-12\",\"emiAmount\":1255,\"interest\":199,\"principle\":1055,\"balance\":6910},{\"emiSr\":4,\"payDate\":\"2023-03-12\",\"emiAmount\":1255,\"interest\":173,\"principle\":1082,\"balance\":5829},{\"emiSr\":5,\"payDate\":\"2023-04-12\",\"emiAmount\":1255,\"interest\":146,\"principle\":1109,\"balance\":4720},{\"emiSr\":6,\"payDate\":\"2023-05-12\",\"emiAmount\":1255,\"interest\":118,\"principle\":1137,\"balance\":3583},{\"emiSr\":7,\"payDate\":\"2023-06-12\",\"emiAmount\":1255,\"interest\":90,\"principle\":1165,\"balance\":2418},{\"emiSr\":8,\"payDate\":\"2023-07-12\",\"emiAmount\":1255,\"interest\":60,\"principle\":1194,\"balance\":1224},{\"emiSr\":9,\"payDate\":\"2023-08-12\",\"emiAmount\":1255,\"interest\":31,\"principle\":1224,\"balance\":-0}]}', 400.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', NULL, 'disbursed', '2022-11-03', NULL, NULL, NULL, '2022-11-03 07:24:40', '2022-11-03 07:29:42'),
(53, 60, 0, '100000', 3, 1, 1, 'reducing_roi', '30', '100000', 3, 94500.00, 12546.00, 12911.00, '{\"totalPaybleAmount\":112911,\"totalInterest\":12911,\"emiAmount\":12546,\"rateOfInterest\":\"30\",\"tenureInMonth\":\"9\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-12-12\",\"emiAmount\":12546,\"interest\":2500,\"principle\":10046,\"balance\":89954},{\"emiSr\":2,\"payDate\":\"2023-01-12\",\"emiAmount\":12546,\"interest\":2249,\"principle\":10297,\"balance\":79657},{\"emiSr\":3,\"payDate\":\"2023-02-12\",\"emiAmount\":12546,\"interest\":1991,\"principle\":10554,\"balance\":69103},{\"emiSr\":4,\"payDate\":\"2023-03-12\",\"emiAmount\":12546,\"interest\":1728,\"principle\":10818,\"balance\":58285},{\"emiSr\":5,\"payDate\":\"2023-04-12\",\"emiAmount\":12546,\"interest\":1457,\"principle\":11089,\"balance\":47197},{\"emiSr\":6,\"payDate\":\"2023-05-12\",\"emiAmount\":12546,\"interest\":1180,\"principle\":11366,\"balance\":35831},{\"emiSr\":7,\"payDate\":\"2023-06-12\",\"emiAmount\":12546,\"interest\":896,\"principle\":11650,\"balance\":24181},{\"emiSr\":8,\"payDate\":\"2023-07-12\",\"emiAmount\":12546,\"interest\":605,\"principle\":11941,\"balance\":12240},{\"emiSr\":9,\"payDate\":\"2023-08-12\",\"emiAmount\":12546,\"interest\":306,\"principle\":12240,\"balance\":-0}]}', 5500.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"5000\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"500\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', NULL, 'sent-for-customer-approval', NULL, NULL, NULL, NULL, '2022-11-03 08:03:50', '2022-11-03 08:04:20'),
(54, 64, 0, '20000', 3, 1, 1, 'reducing_roi', '31', '20000', 3, 12000.00, 2519.00, 2671.00, '{\"totalPaybleAmount\":22671,\"totalInterest\":2671,\"emiAmount\":2519,\"rateOfInterest\":\"31\",\"tenureInMonth\":\"9\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-12-12\",\"emiAmount\":2519,\"interest\":517,\"principle\":2002,\"balance\":17998},{\"emiSr\":2,\"payDate\":\"2023-01-12\",\"emiAmount\":2519,\"interest\":465,\"principle\":2054,\"balance\":15944},{\"emiSr\":3,\"payDate\":\"2023-02-12\",\"emiAmount\":2519,\"interest\":412,\"principle\":2107,\"balance\":13836},{\"emiSr\":4,\"payDate\":\"2023-03-12\",\"emiAmount\":2519,\"interest\":357,\"principle\":2162,\"balance\":11675},{\"emiSr\":5,\"payDate\":\"2023-04-12\",\"emiAmount\":2519,\"interest\":302,\"principle\":2217,\"balance\":9457},{\"emiSr\":6,\"payDate\":\"2023-05-12\",\"emiAmount\":2519,\"interest\":244,\"principle\":2275,\"balance\":7183},{\"emiSr\":7,\"payDate\":\"2023-06-12\",\"emiAmount\":2519,\"interest\":186,\"principle\":2333,\"balance\":4849},{\"emiSr\":8,\"payDate\":\"2023-07-12\",\"emiAmount\":2519,\"interest\":125,\"principle\":2394,\"balance\":2456},{\"emiSr\":9,\"payDate\":\"2023-08-12\",\"emiAmount\":2519,\"interest\":63,\"principle\":2456,\"balance\":0}]}', 8000.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"6000\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"2000\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', NULL, 'sent-for-customer-approval', NULL, NULL, NULL, NULL, '2022-11-03 09:38:50', '2022-11-03 09:39:28'),
(55, 65, 0, '20000', 1, 1, 1, 'reducing_roi', '18', '20000', 1, -20000.00, 6868.00, 603.00, '{\"totalPaybleAmount\":20603,\"totalInterest\":603,\"emiAmount\":6868,\"rateOfInterest\":\"18\",\"tenureInMonth\":\"3\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-12-12\",\"emiAmount\":6868,\"interest\":300,\"principle\":6568,\"balance\":13432},{\"emiSr\":2,\"payDate\":\"2023-01-12\",\"emiAmount\":6868,\"interest\":201,\"principle\":6666,\"balance\":6766},{\"emiSr\":3,\"payDate\":\"2023-02-12\",\"emiAmount\":6868,\"interest\":101,\"principle\":6766,\"balance\":-0}]}', 40000.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"20000\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"20000\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', NULL, 'sent-for-customer-approval', NULL, NULL, NULL, NULL, '2022-11-03 10:07:01', '2022-11-03 10:07:41'),
(56, 66, 0, '10000', 0, 0, 3, 'reducing_roi', '20', '10000', 0, 9200.00, 0.00, 0.00, NULL, 800.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"500\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"300\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1667555693wallpaper2you_559031.jpg', 'customer-approved', NULL, '2022-11-04', '2022-11-04', NULL, '2022-11-04 09:54:53', '2022-11-04 09:58:25'),
(57, 67, 0, '100000', 0, 0, 3, 'reducing_roi', '30', '100000', 0, 99100.00, 0.00, 0.00, NULL, 900.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"400\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"500\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1667886263wallpaper2you_559024.jpg', 'customer-approved', NULL, '2022-11-08', '2023-03-08', NULL, '2022-11-08 05:40:20', '2022-11-08 05:46:03'),
(58, 68, 0, '10000', 4, 1, 1, 'reducing_roi', '30', '10000', 4, 9400.00, 975.00, 1698.00, '{\"totalPaybleAmount\":11698,\"totalInterest\":1698,\"emiAmount\":975,\"rateOfInterest\":\"30\",\"tenureInMonth\":\"12\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-12-12\",\"emiAmount\":975,\"interest\":250,\"principle\":725,\"balance\":9275},{\"emiSr\":2,\"payDate\":\"2023-01-12\",\"emiAmount\":975,\"interest\":232,\"principle\":743,\"balance\":8532},{\"emiSr\":3,\"payDate\":\"2023-02-12\",\"emiAmount\":975,\"interest\":213,\"principle\":762,\"balance\":7771},{\"emiSr\":4,\"payDate\":\"2023-03-12\",\"emiAmount\":975,\"interest\":194,\"principle\":781,\"balance\":6990},{\"emiSr\":5,\"payDate\":\"2023-04-12\",\"emiAmount\":975,\"interest\":175,\"principle\":800,\"balance\":6190},{\"emiSr\":6,\"payDate\":\"2023-05-12\",\"emiAmount\":975,\"interest\":155,\"principle\":820,\"balance\":5370},{\"emiSr\":7,\"payDate\":\"2023-06-12\",\"emiAmount\":975,\"interest\":134,\"principle\":841,\"balance\":4529},{\"emiSr\":8,\"payDate\":\"2023-07-12\",\"emiAmount\":975,\"interest\":113,\"principle\":862,\"balance\":3667},{\"emiSr\":9,\"payDate\":\"2023-08-12\",\"emiAmount\":975,\"interest\":92,\"principle\":883,\"balance\":2784},{\"emiSr\":10,\"payDate\":\"2023-09-12\",\"emiAmount\":975,\"interest\":70,\"principle\":905,\"balance\":1879},{\"emiSr\":11,\"payDate\":\"2023-10-12\",\"emiAmount\":975,\"interest\":47,\"principle\":928,\"balance\":951},{\"emiSr\":12,\"payDate\":\"2023-11-12\",\"emiAmount\":975,\"interest\":24,\"principle\":951,\"balance\":-0}]}', 600.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"300\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"300\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', NULL, 'disbursed', '2022-11-08', NULL, NULL, NULL, '2022-11-08 06:21:22', '2022-11-08 06:42:06'),
(59, 69, 0, '10000', 0, 0, 3, NULL, '30', '15000', 0, 9200.00, 0.00, 0.00, NULL, 800.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"400\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"400\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1667974520wallpaper2you_559031.jpg', 'customer-approved', NULL, '2022-11-09', '2023-06-09', NULL, '2022-11-09 06:15:20', '2022-11-09 06:18:34');
INSERT INTO `apply_loan_histories` (`id`, `userId`, `bankId`, `loanAmount`, `tenure`, `productId`, `loanCategory`, `roiType`, `rateOfInterest`, `approvedAmount`, `approvedTenure`, `netDisbursementAmount`, `monthlyEMI`, `totalInterest`, `emisDetailsStr`, `principleCharges`, `principleChargesDetails`, `invoiceFile`, `status`, `disbursedDate`, `validFromDate`, `validToDate`, `remark`, `created_at`, `updated_at`) VALUES
(60, 70, 0, '10000', 4, 1, 1, 'quaterly_interest', '30', '10000', 4, 9500.00, 3250.00, 3000.00, '{\"totalPaybleAmount\":13000,\"totalInterest\":3000,\"emiAmount\":3250,\"rateOfInterest\":\"30\",\"tenureInMonth\":\"12\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2023-02-12\",\"emiAmount\":3250,\"interest\":740,\"principle\":2510,\"balance\":7490},{\"emiSr\":2,\"payDate\":\"2023-05-12\",\"emiAmount\":3250,\"interest\":740,\"principle\":2510,\"balance\":4979},{\"emiSr\":3,\"payDate\":\"2023-08-12\",\"emiAmount\":3250,\"interest\":740,\"principle\":2510,\"balance\":2469},{\"emiSr\":4,\"payDate\":\"2023-11-12\",\"emiAmount\":3250,\"interest\":781,\"principle\":2469,\"balance\":0}]}', 500.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"100\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"400\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', NULL, 'disbursed', '2022-11-09', NULL, NULL, NULL, '2022-11-09 06:29:55', '2022-11-09 06:40:20'),
(61, 71, 0, '10000', 3, 1, 1, 'reducing_roi', '30', '10000', 3, 9200.00, 1255.00, 1291.00, '{\"totalPaybleAmount\":11291,\"totalInterest\":1291,\"emiAmount\":1255,\"rateOfInterest\":\"30\",\"tenureInMonth\":\"9\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-12-12\",\"emiAmount\":1255,\"interest\":250,\"principle\":1005,\"balance\":8995},{\"emiSr\":2,\"payDate\":\"2023-01-12\",\"emiAmount\":1255,\"interest\":225,\"principle\":1030,\"balance\":7966},{\"emiSr\":3,\"payDate\":\"2023-02-12\",\"emiAmount\":1255,\"interest\":199,\"principle\":1055,\"balance\":6910},{\"emiSr\":4,\"payDate\":\"2023-03-12\",\"emiAmount\":1255,\"interest\":173,\"principle\":1082,\"balance\":5829},{\"emiSr\":5,\"payDate\":\"2023-04-12\",\"emiAmount\":1255,\"interest\":146,\"principle\":1109,\"balance\":4720},{\"emiSr\":6,\"payDate\":\"2023-05-12\",\"emiAmount\":1255,\"interest\":118,\"principle\":1137,\"balance\":3583},{\"emiSr\":7,\"payDate\":\"2023-06-12\",\"emiAmount\":1255,\"interest\":90,\"principle\":1165,\"balance\":2418},{\"emiSr\":8,\"payDate\":\"2023-07-12\",\"emiAmount\":1255,\"interest\":60,\"principle\":1194,\"balance\":1224},{\"emiSr\":9,\"payDate\":\"2023-08-12\",\"emiAmount\":1255,\"interest\":31,\"principle\":1224,\"balance\":-0}]}', 800.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"400\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"400\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', NULL, 'disbursed', '2022-11-09', NULL, NULL, NULL, '2022-11-09 06:57:28', '2022-11-09 07:02:17'),
(62, 72, 0, '10000', 3, 1, 1, 'fixed_interest_roi', '30', '10000', 3, 9100.00, 1444.00, 3000.00, '{\"totalPaybleAmount\":13000,\"totalInterest\":3000,\"emiAmount\":1444,\"rateOfInterest\":\"30\",\"tenureInMonth\":\"9\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-12-12\",\"emiAmount\":1444,\"interest\":333.3333333333333,\"principle\":1111.111111111111,\"balance\":8889},{\"emiSr\":2,\"payDate\":\"2023-01-12\",\"emiAmount\":1444,\"interest\":333.3333333333333,\"principle\":1111.111111111111,\"balance\":7778},{\"emiSr\":3,\"payDate\":\"2023-02-12\",\"emiAmount\":1444,\"interest\":333.3333333333333,\"principle\":1111.111111111111,\"balance\":6667},{\"emiSr\":4,\"payDate\":\"2023-03-12\",\"emiAmount\":1444,\"interest\":333.3333333333333,\"principle\":1111.111111111111,\"balance\":5556},{\"emiSr\":5,\"payDate\":\"2023-04-12\",\"emiAmount\":1444,\"interest\":333.3333333333333,\"principle\":1111.111111111111,\"balance\":4444},{\"emiSr\":6,\"payDate\":\"2023-05-12\",\"emiAmount\":1444,\"interest\":333.3333333333333,\"principle\":1111.111111111111,\"balance\":3333},{\"emiSr\":7,\"payDate\":\"2023-06-12\",\"emiAmount\":1444,\"interest\":333.3333333333333,\"principle\":1111.111111111111,\"balance\":2222},{\"emiSr\":8,\"payDate\":\"2023-07-12\",\"emiAmount\":1444,\"interest\":333.3333333333333,\"principle\":1111.111111111111,\"balance\":1111},{\"emiSr\":9,\"payDate\":\"2023-08-12\",\"emiAmount\":1444,\"interest\":333.3333333333333,\"principle\":1111.111111111111,\"balance\":-0}]}', 900.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"400\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"500\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', NULL, 'disbursed', '2022-11-09', NULL, NULL, NULL, '2022-11-09 08:00:44', '2022-11-09 08:50:46'),
(63, 73, 0, '10000', 0, 0, 3, NULL, '30', '10000', 0, 9200.00, 0.00, 0.00, NULL, 800.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"400\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"400\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1668056767wallpaper2you_559031.jpg', 'customer-approved', NULL, '2022-11-10', '2022-11-30', NULL, '2022-11-10 05:06:07', '2022-11-10 05:09:10'),
(64, 74, 0, '1000', 0, 0, 3, NULL, '30', '1000', 0, 300.00, 0.00, 0.00, NULL, 700.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"400\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"300\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1668057847wallpaper2you_559031.jpg', 'customer-approved', NULL, '2022-11-10', '2023-02-10', NULL, '2022-11-10 05:24:07', '2022-11-10 05:25:58'),
(65, 75, 0, '1000', 3, 1, 1, 'bullet_repayment', '30', '1000', 3, 200.00, 0.00, 0.00, '', 800.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"400\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"400\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', NULL, 'disbursed', '2022-11-10', NULL, NULL, NULL, '2022-11-10 05:32:39', '2022-11-10 05:36:04'),
(66, 76, 0, '10000', 2, 1, 1, 'fixed_interest_roi', '20', '10000', 2, 9500.00, 1833.00, 1000.00, '{\"totalPaybleAmount\":11000,\"totalInterest\":1000,\"emiAmount\":1833,\"rateOfInterest\":\"20\",\"tenureInMonth\":\"6\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-12-12\",\"emiAmount\":1833,\"interest\":166.66666666666666,\"principle\":1666.6666666666665,\"balance\":8333},{\"emiSr\":2,\"payDate\":\"2023-01-12\",\"emiAmount\":1833,\"interest\":166.66666666666666,\"principle\":1666.6666666666665,\"balance\":6667},{\"emiSr\":3,\"payDate\":\"2023-02-12\",\"emiAmount\":1833,\"interest\":166.66666666666666,\"principle\":1666.6666666666665,\"balance\":5000},{\"emiSr\":4,\"payDate\":\"2023-03-12\",\"emiAmount\":1833,\"interest\":166.66666666666666,\"principle\":1666.6666666666665,\"balance\":3333},{\"emiSr\":5,\"payDate\":\"2023-04-12\",\"emiAmount\":1833,\"interest\":166.66666666666666,\"principle\":1666.6666666666665,\"balance\":1667},{\"emiSr\":6,\"payDate\":\"2023-05-12\",\"emiAmount\":1833,\"interest\":166.66666666666666,\"principle\":1666.6666666666665,\"balance\":0}]}', 500.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"300\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', NULL, 'sent-for-customer-approval', NULL, NULL, NULL, NULL, '2022-11-10 06:20:49', '2022-11-10 06:21:53'),
(67, 77, 0, '10000', 3, 1, 1, 'fixed_interest_roi', '30', '10000', 3, 9600.00, 1361.00, 2250.00, '{\"totalPaybleAmount\":12250,\"totalInterest\":2250,\"emiAmount\":1361,\"rateOfInterest\":\"30\",\"tenureInMonth\":\"9\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-12-12\",\"emiAmount\":1361,\"interest\":250,\"principle\":1111.111111111111,\"balance\":8889},{\"emiSr\":2,\"payDate\":\"2023-01-12\",\"emiAmount\":1361,\"interest\":250,\"principle\":1111.111111111111,\"balance\":7778},{\"emiSr\":3,\"payDate\":\"2023-02-12\",\"emiAmount\":1361,\"interest\":250,\"principle\":1111.111111111111,\"balance\":6667},{\"emiSr\":4,\"payDate\":\"2023-03-12\",\"emiAmount\":1361,\"interest\":250,\"principle\":1111.111111111111,\"balance\":5556},{\"emiSr\":5,\"payDate\":\"2023-04-12\",\"emiAmount\":1361,\"interest\":250,\"principle\":1111.111111111111,\"balance\":4444},{\"emiSr\":6,\"payDate\":\"2023-05-12\",\"emiAmount\":1361,\"interest\":250,\"principle\":1111.111111111111,\"balance\":3333},{\"emiSr\":7,\"payDate\":\"2023-06-12\",\"emiAmount\":1361,\"interest\":250,\"principle\":1111.111111111111,\"balance\":2222},{\"emiSr\":8,\"payDate\":\"2023-07-12\",\"emiAmount\":1361,\"interest\":250,\"principle\":1111.111111111111,\"balance\":1111},{\"emiSr\":9,\"payDate\":\"2023-08-12\",\"emiAmount\":1361,\"interest\":250,\"principle\":1111.111111111111,\"balance\":-0}]}', 400.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', NULL, 'disbursed', '2022-11-10', NULL, NULL, NULL, '2022-11-10 06:33:04', '2022-11-10 06:41:41'),
(68, 78, 0, '10000', 3, 1, 1, 'reducing_roi', '30', '10000', 3, 9300.00, 1255.00, 1291.00, '{\"totalPaybleAmount\":11291,\"totalInterest\":1291,\"emiAmount\":1255,\"rateOfInterest\":\"30\",\"tenureInMonth\":\"9\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2022-12-12\",\"emiAmount\":1255,\"interest\":250,\"principle\":1005,\"balance\":8995},{\"emiSr\":2,\"payDate\":\"2023-01-12\",\"emiAmount\":1255,\"interest\":225,\"principle\":1030,\"balance\":7966},{\"emiSr\":3,\"payDate\":\"2023-02-12\",\"emiAmount\":1255,\"interest\":199,\"principle\":1055,\"balance\":6910},{\"emiSr\":4,\"payDate\":\"2023-03-12\",\"emiAmount\":1255,\"interest\":173,\"principle\":1082,\"balance\":5829},{\"emiSr\":5,\"payDate\":\"2023-04-12\",\"emiAmount\":1255,\"interest\":146,\"principle\":1109,\"balance\":4720},{\"emiSr\":6,\"payDate\":\"2023-05-12\",\"emiAmount\":1255,\"interest\":118,\"principle\":1137,\"balance\":3583},{\"emiSr\":7,\"payDate\":\"2023-06-12\",\"emiAmount\":1255,\"interest\":90,\"principle\":1165,\"balance\":2418},{\"emiSr\":8,\"payDate\":\"2023-07-12\",\"emiAmount\":1255,\"interest\":60,\"principle\":1194,\"balance\":1224},{\"emiSr\":9,\"payDate\":\"2023-08-12\",\"emiAmount\":1255,\"interest\":31,\"principle\":1224,\"balance\":-0}]}', 700.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"300\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"400\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', NULL, 'disbursed', '2022-11-10', NULL, NULL, NULL, '2022-11-10 09:44:29', '2022-11-10 09:48:43'),
(69, 79, 0, '10000', 0, 0, 3, NULL, '30', '10000', 0, 9500.00, 0.00, 0.00, NULL, 500.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"300\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1668097935wallpaper2you_559031.jpg', 'customer-approved', NULL, '2022-11-10', '2023-01-10', NULL, '2022-11-10 16:32:15', '2022-11-10 16:35:24'),
(70, 80, 0, '10000', 0, 0, 3, NULL, '30', '10000', 0, 9500.00, 0.00, 0.00, NULL, 500.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"300\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1668142565wallpaper2you_559031.jpg', 'customer-approved', NULL, '2022-11-11', '2022-11-11', NULL, '2022-11-11 04:56:05', '2022-11-11 04:58:50'),
(71, 81, 0, '10000', 0, 0, 3, NULL, '30', '20000', 0, 9500.00, 0.00, 0.00, NULL, 500.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"300\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', 'invoice-loan/1668401303wallpaper2you_559031.jpg', 'customer-approved', NULL, '2022-11-14', '2023-02-14', NULL, '2022-11-14 04:48:23', '2022-11-14 05:36:19'),
(72, 82, 0, '10000', 3, 1, 1, 'bullet_repayment', '30', '10000', 3, 9500.00, 0.00, 0.00, '', 500.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"300\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', NULL, 'closed', '2022-11-14', NULL, NULL, 'Closed on 14 Jan, 2023', '2022-11-14 05:41:58', '2022-11-14 05:49:47'),
(73, 85, 0, '10000', 2, 1, 1, 'quaterly_interest', '30', '10000', 2, 9600.00, 3250.00, 3000.00, '{\"totalPaybleAmount\":13000,\"totalInterest\":3000,\"emiAmount\":3250,\"rateOfInterest\":\"30\",\"tenureInMonth\":\"6\",\"emiList\":[{\"emiSr\":1,\"payDate\":\"2023-02-12\",\"emiAmount\":3250,\"interest\":740,\"principle\":2510,\"balance\":7490},{\"emiSr\":2,\"payDate\":\"2023-05-12\",\"emiAmount\":3250,\"interest\":740,\"principle\":2510,\"balance\":4979},{\"emiSr\":3,\"payDate\":\"2023-08-12\",\"emiAmount\":3250,\"interest\":740,\"principle\":2510,\"balance\":2469},{\"emiSr\":4,\"payDate\":\"2023-11-12\",\"emiAmount\":3250,\"interest\":781,\"principle\":2469,\"balance\":0}]}', 400.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"200\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', NULL, 'disbursed', '2022-11-17', NULL, NULL, NULL, '2022-11-17 12:59:46', '2022-11-17 13:02:46'),
(74, 96, 0, '10000', 3, 1, 1, 'bullet_repayment', '30', '10000', 3, 9500.00, 0.00, 0.00, '', 500.00, '{\"gst\":0,\"premium\":0,\"processingFee\":0,\"insurance\":\"200\",\"verificationCharges\":0,\"collectionFee\":0,\"plateformFee\":\"300\",\"convenienceFee\":0,\"principleAmount\":0,\"pfPercentage\":0}', NULL, 'sent-for-customer-approval', NULL, NULL, NULL, NULL, '2022-11-18 07:13:22', '2022-11-18 07:19:15');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `name` text,
  `description` text,
  `location` text,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `name`, `description`, `location`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Central Bank Of India (CBI)', 'Railway Ganj Hardoi', 'Railway Ganj Hardoi', 1, '2022-07-03 11:38:24', '2022-07-03 11:40:19'),
(3, 'CBI', NULL, NULL, 1, '2022-09-09 20:34:38', '2022-09-09 20:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `cash_flow_analysis`
--

CREATE TABLE `cash_flow_analysis` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL DEFAULT '0',
  `sourceOfIncome` text,
  `cfaSale` text,
  `cfaMargin` text,
  `cfaGrossMargin` text,
  `cfaAmountAvailable` text,
  `cfaElectricityBillOfResidence` text,
  `cfaElectricityBillOfBusiness` text,
  `cfaResidenceBusinessPermissesRent` text,
  `cfaHouseHoldExpense` text,
  `cfaSalary` varchar(255) DEFAULT NULL,
  `cfaMiscExpenses` text,
  `cfaSchoolFee` text,
  `cfaGrossAmountAvailable` text,
  `cfaRunningEmi` text,
  `cfaCreditCardEMi` text,
  `cfaProposedEmi` text,
  `cfaNetAmountAvailable` text,
  `cfaFOIR` text,
  `cfaNetMonthlyIncome` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_flow_analysis`
--

INSERT INTO `cash_flow_analysis` (`id`, `userId`, `sourceOfIncome`, `cfaSale`, `cfaMargin`, `cfaGrossMargin`, `cfaAmountAvailable`, `cfaElectricityBillOfResidence`, `cfaElectricityBillOfBusiness`, `cfaResidenceBusinessPermissesRent`, `cfaHouseHoldExpense`, `cfaSalary`, `cfaMiscExpenses`, `cfaSchoolFee`, `cfaGrossAmountAvailable`, `cfaRunningEmi`, `cfaCreditCardEMi`, `cfaProposedEmi`, `cfaNetAmountAvailable`, `cfaFOIR`, `cfaNetMonthlyIncome`, `created_at`, `updated_at`) VALUES
(1, 52, 'business', '900000', '10', '20', '800000', '50000', '140000', '50000', '3000', '15000090', '89090', '14000', '668876', '0', '0', '0', 'o', '7675', '8768688', '2022-10-27 05:50:17', '2022-10-28 06:30:47'),
(2, 53, 'business', '900000', '10', '20', '800000', '30000', '140000', '50000', '3000', '15000090', '89090', '14000', '668876', '0', '0', '0', '1112309284', '7675', '8768688', '2022-10-28 09:27:15', '2022-11-09 16:38:43'),
(3, 54, 'Business', '900000', '10', '20', '800000', '4000', '140000', '50000', '756747', '746', '544', '48384', '4884', '0', '0', '0', '0', '0', '0', '2022-10-28 11:18:05', '2022-10-28 11:18:05'),
(4, 13, 'AA', '12', '10', '120.00', '120.00', '2', '2', '3', '2', '3', '2', '3', '103.00', '1', '1', '2', '99.00', '0.04', '103.00', '2022-11-01 20:41:36', '2022-11-01 20:41:36'),
(5, 55, 'Business', '900000', '10', '9000000.00', '9000000.00', '5000', '10000', '50000', '3000', '150000', '89090', '14000', '8678910.00', '1000', '1000', '1000', '8675910.00', '0.00', '8678910.00', '2022-11-02 05:17:52', '2022-11-02 05:17:52'),
(6, 56, 'Business', '800000', '10', '8000000.00', '8000000.00', '500', '500', '500', '200', '8900', '1098', '9808', '7978494.00', '1000', '1000', '1000', '7975494.00', '0.00', '7978494.00', '2022-11-02 06:13:18', '2022-11-02 06:13:18'),
(7, 57, 'Na', '12', '12', '144.00', '144.00', '12', '12', '12', '12', '12', '12', '12', '60.00', '12', '12', '12', '24.00', '0.60000000', '60.00', '2022-11-02 19:26:22', '2022-11-02 19:33:21'),
(8, 58, 'business', '900000', '10', '9000000.00', '9000000.00', '2000', '2000', '2000', '2000', '2000', '89090', '14000', '8886910.00', '1000', '1000', '1000', '8883910.00', '0.00033758', '8886910.00', '2022-11-03 05:13:02', '2022-11-03 05:13:02'),
(9, 61, 'business', '900000', '10', '9000000.00', '9000000.00', '2000', '2000', '2000', '2000', '2000', '2000', '2000', '8986000.00', '1000', '1000', '1000', '8983000.00', '0.00033385', '8986000.00', '2022-11-03 06:35:53', '2022-11-03 06:35:53'),
(10, 63, 'Business', '900000', '10', '9000000.00', '9000000.00', '5000', '5000', '5000', '3000', '150000', '89090', '14000', '8728910.00', '1000', '1000', '1000', '8725910.00', '0.00034369', '8728910.00', '2022-11-03 07:14:36', '2022-11-03 07:14:36'),
(11, 60, 'business', '900000', '10', '9000000.00', '9000000.00', '1000', '5000', '5000', '756747', '1500', '89090', '14000', '8127663.00', '1000', '1000', '1000', '8124663.00', '0.00036911', '8127663.00', '2022-11-03 08:00:45', '2022-11-03 08:00:45'),
(12, 64, '200000', '200000', '10', '2000000.00', '2000000.00', '20000', '150000', '50000', '40000', '100000', '50000', '40000', '1550000.00', '1000000', '50000', '10000', '490000.00', '0.68387097', '1550000.00', '2022-11-03 09:25:39', '2022-11-03 09:35:43'),
(13, 65, '200000', '200000', '8', '1600000.00', '1600000.00', '20000', '20000', '30000', '50000', '100000', '20000', '20000', '1340000.00', '20000', '10000', '10000', '1300000.00', '0.02985075', '1340000.00', '2022-11-03 10:02:38', '2022-11-03 10:03:57'),
(14, 66, 'business', '900000', '10', '9000000.00', '9000000.00', '900', '2000', '50000', '2000', '150000', '89090', '14000', '8692010.00', '1000', '1000', '1000', '8689010.00', '0.00034514', '8692010.00', '2022-11-04 09:52:19', '2022-11-04 09:52:19'),
(15, 67, 'business', '900000', '10', '90000.00', '90000.00', '2000', '2000', '2000', '20000', '20000', '8990', '9000', '26010.00', '1000', '600', '0', '24410.00', '0.06', '26010.00', '2022-11-08 05:13:09', '2022-11-08 05:13:09'),
(16, 68, 'business', '900000', '10', '90000.00', '90000.00', '1000', '10000', '50000', '3000', '746', '8990', '9000', '7264.00', '1000', '1000', '1000', '4264.00', '0.41', '7264.00', '2022-11-08 06:14:46', '2022-11-08 06:16:58'),
(17, 69, 'business', '900000', '10', '90000.00', '90000.00', '1000', '1000', '1000', '1000', '1000', '1000', '1000', '83000.00', '1000', '1000', '1000', '80000.00', '0.04', '83000.00', '2022-11-09 06:10:29', '2022-11-09 06:13:18'),
(18, 70, 'business', '900000', '10', '90000.00', '90000.00', '1000', '1000', '1000', '1000', '1000', '1000', '1000', '83000.00', '1000', '1000', '1000', '80000.00', '0.04', '83000.00', '2022-11-09 06:27:14', '2022-11-09 06:27:14'),
(19, 71, 'Business', '900000', '10', '90000.00', '90000.00', '1000', '10000', '1000', '20000', '2000', '8909', '14000', '33091.00', '1000', '1000', '1000', '30091.00', '0.09', '33091.00', '2022-11-09 06:54:44', '2022-11-09 06:54:44'),
(20, 72, 'Business', '900000', '10', '90000.00', '90000.00', '5', '500', '500', '200', '8900', '8909', '9808', '61178.00', '1000', '1000', '1000', '58178.00', '0.05', '61178.00', '2022-11-09 07:58:13', '2022-11-09 07:58:13'),
(21, 73, 'Business', '900000', '10', '90000.00', '90000.00', '1000', '1000', '1000', '1000', '1000', '1000', '1000', '83000.00', '1000', '1000', '1000', '80000.00', '4', '83000.00', '2022-11-10 05:02:49', '2022-11-10 05:02:49'),
(22, 74, 'Business', '900000', '10', '90000.00', '90000.00', '122', '5000', '500', '200', '746', '544', '1000', '81888.00', '1000', '1000', '0', '79888.00', '2', '81888.00', '2022-11-10 05:21:07', '2022-11-10 05:21:07'),
(23, 75, 'business', '900000', '10', '90000.00', '90000.00', '1000', '100', '5000', '3000', '1500', '1098', '300', '78002.00', '1000', '200', '200', '76602.00', '2', '78002.00', '2022-11-10 05:29:22', '2022-11-10 05:29:22'),
(24, 76, 'Business', '900000', '10', '90000.00', '90000.00', '1000', '1000', '1000', '100', '100', '100', '100', '86600.00', '1000', '1000', '1000', '83600.00', '3', '86600.00', '2022-11-10 06:14:35', '2022-11-10 06:26:37'),
(25, 77, 'business', '900000', '10', '90000.00', '90000.00', '200', '140', '200', '212', '232', '213', '321', '88482.00', '3232', '231', '311', '84708.00', '4', '88482.00', '2022-11-10 06:31:08', '2022-11-10 06:31:08'),
(26, 78, 'Business', '900000', '10', '90000.00', '90000.00', '1000', '1000', '1000', '1000', '10000', '1000', '1000', '74000.00', '1000', '100', '1000', '71900.00', '3', '74000.00', '2022-11-10 09:37:23', '2022-11-10 09:38:50'),
(27, 47, '200000', '200000', '5', '10000.00', '10000.00', '1000', '1000', '2000', '5000', NULL, '2000', '5000', 'NaN', '5000', '2000', '5000', 'NaN', 'NaN', 'NaN', '2022-11-10 12:32:25', '2022-11-10 12:32:50'),
(28, 79, 'business', '900000', '10', '90000.00', '90000.00', '100', '1000', '1000', '1000', '1000', '1000', '1000', '83900.00', '1000', '1000', '1000', '80900.00', '4', '83900.00', '2022-11-10 16:23:34', '2022-11-10 16:27:56'),
(29, 80, 'Business', '900000', '10', '90000.00', '90000.00', '100', '100', '100', '100', '100', '1000', '1000', '87500.00', '1000', '1000', '1000', '84500.00', '3', '87500.00', '2022-11-11 04:53:02', '2022-11-11 04:53:02'),
(30, 81, 'Business', '900000', '10', '90000.00', '90000.00', '1000', '1000', '1000', '1000', '1000', '1000', '1000', '83000.00', '1000', '1000', '1000', '80000.00', '4', '83000.00', '2022-11-14 04:44:34', '2022-11-14 04:44:34'),
(31, 82, 'Business', '900000', '10', '90000.00', '90000.00', '1000', '1000', '1000', '1000', '1000', '1000', '1000', '83000.00', '1000', '1000', '1000', '80000.00', '4', '83000.00', '2022-11-14 05:39:15', '2022-11-14 05:39:15'),
(32, 83, '200000', '200000', '5', '10000.00', '10000.00', '1000', '1000', '2000', '5000', '100000', '2000', '5000', '-106000.00', '5000', '2000', '5000', '-118000.00', '-11', '-106000.00', '2022-11-16 06:26:47', '2022-11-16 09:13:45'),
(33, 84, 'sales', '13735016', '35%', '4807255.60', '4807255.60', '613796', '613796', '22500', NULL, '712839', NULL, NULL, 'NaN', NULL, NULL, NULL, 'NaN', 'NaN', 'NaN', '2022-11-16 07:41:27', '2022-11-16 07:56:57'),
(34, 85, 'business', '900000', '10', '90000.00', '90000.00', '1000', '1000', '1000', '1000', '1000', '1098', '48384', '35518.00', '1000', '100', '311', '34107.00', '4', '35518.00', '2022-11-17 05:27:04', '2022-11-17 12:58:47'),
(35, 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-17 19:47:29', '2022-11-17 19:56:32'),
(36, 96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-18 06:55:28', '2022-11-18 06:55:28'),
(37, 98, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-18 07:47:15', '2022-11-19 05:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` text,
  `description` longtext,
  `image` text,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Business Loan', 'Business Loan', 'products/1665635875wallpaper2you_559031.jpg', 1, '2022-09-17 23:26:59', '2022-10-13 04:37:55'),
(2, 'Personal loan', NULL, NULL, 0, '2022-09-17 23:26:59', '2022-09-17 23:26:59'),
(3, 'Raw Material Financing', NULL, NULL, 1, '2022-09-17 23:26:59', '2022-09-17 23:26:59'),
(4, 'Receivables Invoicing', NULL, NULL, 1, '2022-09-17 23:26:59', '2022-09-17 23:26:59'),
(5, 'Insurance', NULL, NULL, 0, '2022-09-17 23:26:59', '2022-09-17 23:26:59'),
(6, 'GFCf', 'fg', 'products/1665752331wallpaper2you_559031.jpg', 0, '2022-10-14 12:58:51', '2022-10-19 06:57:20'),
(7, 'Home loan', 'Home loan', 'products/1666001128wallpaper2you_559031.jpg', 0, '2022-10-17 10:05:28', '2022-10-17 10:05:41');

-- --------------------------------------------------------

--
-- Table structure for table `co_applicant_details`
--

CREATE TABLE `co_applicant_details` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL DEFAULT '0',
  `nameTitleCoApp` varchar(255) DEFAULT NULL,
  `customerNameCoApp` varchar(255) DEFAULT NULL,
  `genderCoApp` varchar(100) DEFAULT NULL,
  `dateOfBirthCoApp` date DEFAULT NULL,
  `religionCoApp` varchar(100) DEFAULT NULL,
  `educationStatusCoApp` varchar(255) DEFAULT NULL,
  `fatherNameCoApp` varchar(255) DEFAULT NULL,
  `motherNameCoApp` varchar(255) DEFAULT NULL,
  `maritalStatusCoApp` varchar(100) DEFAULT NULL,
  `relationWithApplicantCoApp` varchar(200) DEFAULT NULL,
  `cibilScoreCoApp` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `co_applicant_details`
--

INSERT INTO `co_applicant_details` (`id`, `userId`, `nameTitleCoApp`, `customerNameCoApp`, `genderCoApp`, `dateOfBirthCoApp`, `religionCoApp`, `educationStatusCoApp`, `fatherNameCoApp`, `motherNameCoApp`, `maritalStatusCoApp`, `relationWithApplicantCoApp`, `cibilScoreCoApp`, `status`, `created_at`, `updated_at`) VALUES
(1, 50, 'Mr.', 'kalop', 'Male', '1993-07-05', 'hindu', 'graduate', 'raja', 'rani', 'Married', 'brother', '400', 1, '2022-10-20 06:02:15', '2022-10-20 09:50:48'),
(2, 51, 'Mr.', 'Rahul', 'Male', '1985-10-11', 'Hindu', 'graduate', 'raja', 'rani', 'Married', 'brother', '300', 1, '2022-10-21 07:13:29', '2022-10-21 07:13:29'),
(3, 52, 'Mr.', 'lpo', 'Female', NULL, 'Hindu', 'Graduate', 'Raja', 'Rani', 'Unmarried', 'Brother', '400', 1, '2022-10-27 05:47:20', '2022-10-28 06:37:40'),
(4, 53, 'Mr.', 'lpo', 'Male', '1994-10-07', 'Hindu', 'graduate', 'Raja', 'Rani', 'Married', 'Brother', '400', 1, '2022-10-28 09:25:45', '2022-11-09 16:37:45'),
(5, 54, 'Mr.', 'Rahul', 'Male', '2006-10-12', 'Hindu', 'graduate', 'Raja', 'Rani', 'Married', 'Brother', '300', 1, '2022-10-28 11:10:28', '2022-10-28 11:10:28'),
(6, 13, 'Mr.', 'Test Co Applicant', 'Male', '2016-11-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-11-01 19:31:43', '2022-11-01 20:43:56'),
(7, 55, 'Mr.', 'lala', 'Male', '1993-11-12', 'Hindu', 'Graduate', 'Raja', 'Rani', 'Married', 'Brother', '400', 1, '2022-11-02 04:52:03', '2022-11-02 04:52:03'),
(8, 56, 'Mr.', 'kalop', 'Male', '1990-11-02', 'Hindu', 'Graduate', 'Raja', 'Rani', 'Married', 'Brother', '400', 1, '2022-11-02 06:09:04', '2022-11-02 19:02:48'),
(9, 57, 'Mr.', 'ME000047 Abhi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-11-02 19:25:25', '2022-11-02 19:33:15'),
(10, 58, 'Mr.', 'lpo', 'Male', '1993-11-11', 'Hindu', 'Graduate', 'Raja', 'Rani', 'Married', 'Brother', '400', 1, '2022-11-03 04:58:33', '2022-11-03 04:58:33'),
(11, 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-11-03 06:34:29', '2022-11-03 06:34:29'),
(12, 63, 'Mr.', 'ram', 'Male', '1993-11-12', 'Hindu', 'Graduate', 'Raja', 'Rani', 'Married', 'Brother', '400', 1, '2022-11-03 07:09:56', '2022-11-03 07:09:56'),
(13, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-11-03 07:59:38', '2022-11-03 07:59:38'),
(14, 59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-11-03 09:14:41', '2022-11-10 12:27:24'),
(15, 64, 'Mr.', 'ASHISH GUPTA', 'Male', '1975-11-19', 'HINDU', 'GRADUATE', 'KAILASH CHAND GUPTA', 'RANI GUPTA', 'Married', 'FRIEND', '802', 1, '2022-11-03 09:20:48', '2022-11-03 09:35:33'),
(16, 65, 'Mr.', 'ASHISH', 'Male', '1992-11-18', 'HINDU', 'GRADUATE', 'SATISH CHAND', 'SANTOSHI', 'Married', 'FRIEND', '783', 1, '2022-11-03 10:01:20', '2022-11-03 10:03:54'),
(17, 66, 'Mr.', 'lpo', 'Male', '1996-11-15', 'Hindu', 'graduate', 'Raja', 'Rani', 'Married', 'Brother', '400', 1, '2022-11-04 09:50:55', '2022-11-04 09:50:55'),
(18, 67, 'Mr.', 'lala', 'Male', '1998-11-13', 'Hindu', 'graduate', 'Raja', 'Rani', 'Married', 'Brother', '400', 1, '2022-11-08 05:04:09', '2022-11-08 05:04:09'),
(19, 68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-11-08 06:04:51', '2022-11-08 06:04:51'),
(20, 69, 'Mr.', 'Rahul', 'Male', '1994-11-11', 'Hindu', 'Graduate', 'Raja', 'Rani', 'Married', 'Brother', '400', 1, '2022-11-09 06:04:59', '2022-11-09 06:12:53'),
(21, 70, 'Mr.', 'lpo', 'Male', '2005-11-10', 'Hindu', 'graduate', 'Raja', 'Rani', 'Married', 'Brother', '400', 1, '2022-11-09 06:25:56', '2022-11-09 06:25:56'),
(22, 71, 'Mr.', 'lpo', 'Male', '1995-11-03', 'Hindu', 'graduate', 'Raja', 'Rani', 'Married', 'Brother', '400', 1, '2022-11-09 06:53:23', '2022-11-09 06:53:23'),
(23, 72, 'Mr.', 'lpo', 'Male', '1991-11-01', 'Hindu', 'Graduate', 'Raja', 'Rani', 'Married', 'Brother', '400', 1, '2022-11-09 07:57:13', '2022-11-09 07:57:13'),
(24, 73, 'Mr.', 'lpo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-11-10 04:59:22', '2022-11-10 04:59:22'),
(25, 74, 'Mr.', 'lpo', 'Male', '2003-11-13', 'Hindu', 'graduate', 'Raja', 'Rani', 'Married', 'Brother', '400', 1, '2022-11-10 05:20:01', '2022-11-10 05:20:01'),
(26, 75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-11-10 05:28:17', '2022-11-10 05:28:17'),
(27, 76, 'Mr.', 'lpo', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-11-10 06:13:50', '2022-11-10 06:26:35'),
(28, 77, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-11-10 06:30:09', '2022-11-10 06:30:09'),
(29, 78, 'Mr.', 'raka', 'Male', '1990-11-08', 'Hindu', 'graduate', 'Raja', 'Rani', 'Married', 'Brother', '300', 1, '2022-11-10 09:36:11', '2022-11-10 09:36:11'),
(30, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-11-10 12:32:21', '2022-11-10 12:32:21'),
(31, 79, 'Mr.', 'lpo', 'Male', '2012-11-09', 'Hindu', 'graduate', 'Raja', 'Rani', 'Married', 'Brother', '400', 1, '2022-11-10 16:22:25', '2022-11-10 16:27:52'),
(32, 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-11-11 04:52:16', '2022-11-11 04:52:16'),
(33, 81, 'Mr.', 'rwts', 'Male', '1995-11-10', 'Hindu', 'graduate', 'Raja', 'Rani', 'Married', 'Brother', '400', 1, '2022-11-14 04:43:39', '2022-11-14 04:43:39'),
(34, 82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-11-14 05:38:24', '2022-11-14 05:38:24'),
(35, 83, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-11-15 12:08:54', '2022-11-17 04:42:06'),
(36, 84, 'Ms.', 'Ananya sharma', 'Female', '2002-02-12', 'Hindu', '12+', 'Vijay Kumar Sharma', NULL, 'Unmarried', 'Daughter', NULL, 1, '2022-11-16 06:50:24', '2022-11-16 07:56:52'),
(37, 84, 'Ms.', 'Ananya sharma', 'Female', '2002-02-12', 'Hindu', '12+', 'Vijay Kumar Sharma', NULL, 'Unmarried', 'Daughter', NULL, 1, '2022-11-16 06:50:24', '2022-11-16 07:56:52'),
(38, 84, 'Ms.', 'Ananya sharma', 'Female', '2002-02-12', 'Hindu', '12+', 'Vijay Kumar Sharma', NULL, 'Unmarried', 'Daughter', NULL, 1, '2022-11-16 06:50:24', '2022-11-16 07:56:52'),
(39, 84, 'Ms.', 'Ananya sharma', 'Female', '2002-02-12', 'Hindu', '12+', 'Vijay Kumar Sharma', NULL, 'Unmarried', 'Daughter', NULL, 1, '2022-11-16 06:50:24', '2022-11-16 07:56:52'),
(40, 84, 'Ms.', 'Ananya sharma', 'Female', '2002-02-12', 'Hindu', '12+', 'Vijay Kumar Sharma', NULL, 'Unmarried', 'Daughter', NULL, 1, '2022-11-16 06:50:24', '2022-11-16 07:56:52'),
(41, 85, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-11-17 05:25:28', '2022-11-17 12:58:43'),
(42, 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-11-17 05:54:14', '2022-11-17 19:56:29'),
(43, 96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-11-18 06:55:14', '2022-11-18 06:55:14'),
(44, 98, 'Mr.', 'ASHISH GUPTA', 'Male', '1975-02-02', 'Hindu', '12+', 'KAILASH CHAND GUPTA', NULL, 'Married', NULL, '793', 1, '2022-11-18 07:35:01', '2022-11-19 05:36:09'),
(45, 99, 'Mr.', 'lpo', 'Male', '1991-11-08', 'Hindu', 'graduate', 'Raja', 'Rani', 'Married', 'Brother', '400', 1, '2022-11-21 04:40:49', '2022-11-21 04:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `credit_score_questions`
--

CREATE TABLE `credit_score_questions` (
  `id` int(11) NOT NULL,
  `categoryId` varchar(255) DEFAULT NULL,
  `qnsTitle` varchar(255) DEFAULT NULL,
  `correctAns` varchar(200) DEFAULT NULL,
  `inputName` varchar(255) DEFAULT NULL,
  `qnsType` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credit_score_questions`
--

INSERT INTO `credit_score_questions` (`id`, `categoryId`, `qnsTitle`, `correctAns`, `inputName`, `qnsType`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'Full name', NULL, 'full_name', 'text', 1, NULL, NULL),
(2, '1', 'Product Name', NULL, 'product_name', 'objective', 1, NULL, NULL),
(3, '1', 'Tenure', '10', 'tenure', 'objective', 1, NULL, NULL),
(4, '1', 'Nature of Loan?', '11', 'nature_of_loan', 'objective', 1, NULL, NULL),
(5, '1', 'Purpose of Loan', '17', 'purpose_of_loan', 'objective', 1, NULL, NULL),
(6, '1', 'Gender ?', '20', 'gender', 'objective', 1, NULL, NULL),
(7, '1', 'Age ?', '25', 'age', 'objective', 1, NULL, NULL),
(8, '1', 'Source of Application?', '26', 'source_of_application', 'objective', 1, NULL, NULL),
(9, '1', 'Nature of Application?', '31', 'nature_of_application', 'objective', 1, NULL, NULL),
(10, '1', 'PAN Verification?', '33', 'pan_verification', 'objective', 1, NULL, NULL),
(11, '1', 'Form 60 ?', '35', 'form_60', 'objective', 1, NULL, NULL),
(12, '1', 'Aadhar Verification ?', '38', 'aadhaar_verification', 'objective', 1, NULL, NULL),
(13, '1', 'Personal Discussion - Video KYC', '39', 'personal_discuss_video_kyc', 'objective', 1, NULL, NULL),
(14, '1', 'FCU Check ?', '41', 'fcu_check', 'objective', 1, NULL, NULL),
(15, '1', 'Other active lending mobile apps?', '44', 'other_active_lending_mobile', 'objective', 1, NULL, NULL),
(16, '1', 'Nationality Indian ?\r\n', '46', 'nationality_indian', 'objective', 1, NULL, NULL),
(17, '1', 'Residential Address (Geo location tagging optional)', '47', 'residential_address_geo_loaction', 'objective', 1, NULL, NULL),
(18, '1', 'Ownership Status?', '49', 'ownership_status', 'objective', 1, NULL, NULL),
(19, '1', 'Family Status?', '53', 'family_status', 'objective', 1, NULL, NULL),
(20, '1', 'Marital Status?\r\n', '55', 'marital_status', 'objective', 1, NULL, NULL),
(21, '1', 'No of members?', '57', 'number_of_members', 'objective', 1, NULL, NULL),
(22, '1', 'No of dependent members?', '58', 'number_of_dependent_members', 'objective', 1, NULL, NULL),
(23, '1', 'Education ?', '61', 'education', 'objective', 1, NULL, NULL),
(24, '1', 'Employer Verification ?', '63', 'employer_verification', 'objective', 1, NULL, NULL),
(25, '1', 'Income Validation ?', '66', 'income_verification', 'objective', 1, NULL, NULL),
(26, '1', 'Payroll Status (Incase of Partner Employer)?', '68', 'pay_roll_status', 'objective', 1, NULL, NULL),
(27, '1', 'Work Address (Geo location tagging mandatory)?', '70', 'work_address_geo_location', 'objective', 1, NULL, NULL),
(28, '1', 'Job Stability ', '74', 'job_stability', 'objective', 1, NULL, NULL),
(29, '1', 'Overall Experience', '77', 'overall_experience', 'objective', 1, NULL, NULL),
(30, '1', 'Nature of Job', '79', 'nature_of_job', 'objective', 1, NULL, NULL),
(31, '1', 'Skill Level', '82', 'skill_level', 'objective', 1, NULL, NULL),
(32, '1', 'Annual Income ', '83', 'annual_income', 'objective', 1, NULL, NULL),
(33, '1', 'Salary Slip for last 3 months', '87', 'salary_slip_3months', 'objective', 1, NULL, NULL),
(34, '1', 'Mode of Salary/Wages payment ', '89', 'modes_of_salary_wages', 'objective', 1, NULL, NULL),
(35, '1', 'ITR Filing Status', '90', 'itr_filing_status', 'objective', 1, NULL, NULL),
(36, '1', 'Income Validation through EPFO Check', '94', 'income_validation_through_epfo', 'objective', 1, NULL, NULL),
(37, '1', 'Eligibility: DSCR (Proposed Loan EMI + other financial commitment)', NULL, 'eligibility_dscr', 'text', 1, NULL, NULL),
(38, '1', 'One live loan', '92', 'one_live_loan', 'objective', 1, NULL, NULL),
(39, '1', 'Application Previously Rejected', '96', 'application_previously_rejected', 'objective', 1, NULL, NULL),
(40, '1', 'Current Overdue ', '100', 'current_overdue', 'objective', 1, NULL, NULL),
(41, '1', 'Score Benchmarking', '108', 'score_benchmarking', 'objective', 1, NULL, NULL),
(42, '1', 'SMS Sparsing for income verification?', '113', 'sms_sparsing_for_income_verification', 'objective', 1, NULL, NULL),
(43, '1', 'Bill details', '116', 'bill_details', 'objective', 1, NULL, NULL),
(44, '1', 'Banking & Credit History Analysis?', '117', 'banking_and_credit_history_analysis', 'objective', 1, NULL, NULL),
(45, '1', 'Bank Statement Analysis?', '120', 'bank_statement_analysis', 'objective', 1, NULL, NULL),
(46, '2', 'Name of the Corporate', NULL, 'nature_of_corporate', 'text', 1, NULL, NULL),
(47, '2', 'Nature of Constitution ?', '121', 'nature_of_contitution', 'objective', 1, NULL, NULL),
(48, '2', 'Empanelment Status with AdvanX?', '126', 'empanelment_status_with_advanx', 'objective', 1, NULL, NULL),
(49, '2', 'Nature of Industry?', '137', 'nature_of_industry', 'objective', 1, NULL, NULL),
(50, '2', 'Negative Industry Profile ?', '138', 'negative_industry_profile', 'objective', 1, NULL, NULL),
(51, '2', 'Business Activity ?', '140', ' business_activity', 'objective', 1, NULL, NULL),
(52, '2', 'Turnover Size?', '143', 'turnover_size', 'objective', 1, NULL, NULL),
(53, '2', 'Credit Rating?', '147', 'credit_rating', 'objective', 1, NULL, NULL),
(54, '2', 'Number of Employees?', '148', 'number_of_employees', 'objective', 1, NULL, NULL),
(55, '2', 'Attrition Risk', '150', 'attrition_risk', 'objective', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `credit_score_questions_categories`
--

CREATE TABLE `credit_score_questions_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credit_score_questions_categories`
--

INSERT INTO `credit_score_questions_categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Customer Profiling ', 1, '2022-07-07 17:04:06', '2022-07-07 17:04:06'),
(2, 'Corporate - Partner Employer Profiling', 1, '2022-07-07 17:04:06', '2022-07-07 17:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `credit_score_question_answers`
--

CREATE TABLE `credit_score_question_answers` (
  `id` int(11) NOT NULL,
  `questionId` int(11) NOT NULL DEFAULT '0',
  `ansTitle` varchar(255) DEFAULT NULL,
  `otherValueOrDays` varchar(100) DEFAULT NULL,
  `correctAns` int(11) NOT NULL DEFAULT '0',
  `scorePositive` int(11) NOT NULL DEFAULT '0',
  `scoreNegative` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credit_score_question_answers`
--

INSERT INTO `credit_score_question_answers` (`id`, `questionId`, `ansTitle`, `otherValueOrDays`, `correctAns`, `scorePositive`, `scoreNegative`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Salary Advance loan => 13000', NULL, 0, 0, 0, 1, NULL, NULL),
(2, 2, 'AdvanZ Zaroorat (Instant Cash) => 5000', NULL, 0, 0, 0, 1, NULL, NULL),
(3, 2, 'AdvanZ Sahayak (EMI Based) => 10000', NULL, 0, 0, 0, 1, NULL, NULL),
(4, 2, 'AdvanZ Suvidha (EMI Based) => 15000', NULL, 0, 0, 0, 1, NULL, NULL),
(5, 2, 'AdvanZ Suvidha (EMI Based) => 20000', NULL, 0, 0, 0, 1, NULL, NULL),
(6, 2, 'AdvanZ Suvidha (EMI Based) => 25000', NULL, 0, 0, 0, 1, NULL, NULL),
(7, 2, 'AdvanZ Suvidha (EMI Based) => 30000', NULL, 0, 0, 0, 1, NULL, NULL),
(8, 3, '3 Months', '3', 0, 4, 0, 1, NULL, NULL),
(9, 3, '6 Months', '6', 0, 3, 0, 1, NULL, NULL),
(10, 3, '12 Months', '12', 1, 2, 0, 1, NULL, NULL),
(11, 4, 'Unsecured', NULL, 1, 2, 0, 1, NULL, NULL),
(12, 4, 'Secured', NULL, 0, 5, 0, 1, NULL, NULL),
(13, 5, 'Medical Emergency', NULL, 0, 5, 0, 1, NULL, NULL),
(14, 5, 'Education Fees', NULL, 0, 4, 0, 1, NULL, NULL),
(15, 5, 'Wedding', NULL, 0, 3, 0, 1, NULL, NULL),
(16, 5, 'Household repair and maintenance', NULL, 0, 3, 0, 1, NULL, NULL),
(17, 5, 'Consumer Durable', NULL, 1, 2, 0, 1, NULL, NULL),
(18, 5, 'Others', NULL, 0, 2, 0, 1, NULL, NULL),
(19, 6, 'Male', NULL, 0, 5, 0, 1, NULL, NULL),
(20, 6, 'Female', NULL, 1, 5, 0, 1, NULL, NULL),
(21, 7, 'Less than 21 years', NULL, 0, 2, 0, 1, NULL, NULL),
(22, 7, '21 years to 35 years', NULL, 0, 3, 0, 1, NULL, NULL),
(23, 7, '35 years to 45 years ', NULL, 0, 4, 0, 1, NULL, NULL),
(24, 7, '45 years to 55 years', NULL, 0, 5, 0, 1, NULL, NULL),
(25, 7, 'Above 55 years', NULL, 1, 3, 0, 1, NULL, NULL),
(26, 8, 'Mobile App', NULL, 1, 5, 0, 1, NULL, NULL),
(27, 8, 'Web based Sourcing', NULL, 0, 4, 0, 1, NULL, NULL),
(28, 8, 'Telecalling', NULL, 0, 4, 0, 1, NULL, NULL),
(29, 8, 'Customer Referral', NULL, 0, 3, 0, 1, NULL, NULL),
(30, 8, 'Agent', NULL, 0, 4, 0, 1, NULL, NULL),
(31, 9, 'Employer Partner', NULL, 1, 5, 0, 1, NULL, NULL),
(32, 9, 'Retail', NULL, 0, 2, 0, 1, NULL, NULL),
(33, 10, 'Yes', NULL, 1, 5, 0, 1, NULL, NULL),
(34, 10, 'No', NULL, 0, 0, 0, 1, NULL, NULL),
(35, 11, 'Yes', NULL, 1, 5, 0, 1, NULL, NULL),
(36, 11, 'No', NULL, 0, 0, 0, 1, NULL, NULL),
(37, 12, 'No', NULL, 0, 0, 0, 1, NULL, NULL),
(38, 12, 'Yes', NULL, 1, 5, 0, 1, NULL, NULL),
(39, 13, 'Positive', NULL, 1, 5, 0, 1, NULL, NULL),
(40, 13, 'Negative', NULL, 0, 0, 0, 1, NULL, NULL),
(41, 14, 'Negative', NULL, 1, 0, 2, 1, NULL, NULL),
(42, 14, 'Positive', NULL, 0, 5, 0, 1, NULL, NULL),
(43, 15, 'Yes', NULL, 0, 2, 0, 1, NULL, NULL),
(44, 15, 'No', NULL, 1, 5, 0, 1, NULL, NULL),
(45, 16, 'No', NULL, 0, 0, 0, 1, NULL, NULL),
(46, 16, 'Yes', NULL, 1, 5, 0, 1, NULL, NULL),
(47, 17, 'Preferred Location\r\n', NULL, 1, 5, 0, 1, NULL, NULL),
(48, 17, 'Not Preferred Location', NULL, 0, 0, 0, 1, NULL, NULL),
(49, 18, 'Rent \r\n', NULL, 1, 2, 0, 1, NULL, NULL),
(50, 18, 'Owned', NULL, 0, 5, 0, 1, NULL, NULL),
(51, 19, 'Married with children\r\n', NULL, 0, 5, 0, 1, NULL, NULL),
(52, 19, 'Married without children \r\n', NULL, 0, 4, 0, 1, NULL, NULL),
(53, 19, 'Married with children+Dependent Parents \r\n', NULL, 1, 2, 0, 1, NULL, NULL),
(54, 20, 'Single \r\n', NULL, 0, 3, 0, 1, NULL, NULL),
(55, 20, 'Married\r\n', NULL, 1, 5, 0, 1, NULL, NULL),
(56, 21, '<4', NULL, 0, 5, 0, 1, NULL, NULL),
(57, 21, '>4', NULL, 1, 3, 0, 1, NULL, NULL),
(58, 22, '<2', NULL, 1, 5, 0, 1, NULL, NULL),
(59, 22, '>2', NULL, 0, 3, 0, 1, NULL, NULL),
(60, 23, 'Under Matriculate', NULL, 0, 1, 0, 1, NULL, NULL),
(61, 23, 'Matriculate\r\n', NULL, 1, 3, 0, 1, NULL, NULL),
(62, 23, 'Graduate', NULL, 0, 5, 0, 1, NULL, NULL),
(63, 24, 'Positive ', NULL, 1, 5, 0, 1, NULL, NULL),
(64, 24, 'Negative', NULL, 0, 0, 0, 1, NULL, NULL),
(65, 25, 'No', NULL, 0, 3, 0, 1, NULL, NULL),
(66, 25, 'Yes', NULL, 1, 5, 0, 1, NULL, NULL),
(67, 26, 'Active\r\n', NULL, 0, 5, 0, 1, NULL, NULL),
(68, 26, 'Resigned', NULL, 1, 2, 0, 1, NULL, NULL),
(69, 26, 'Terminated', NULL, 0, 0, 0, 1, NULL, NULL),
(70, 27, 'Preferred Location', NULL, 1, 5, 0, 1, NULL, NULL),
(71, 27, 'Not Preferred Location', NULL, 0, 0, 0, 1, NULL, NULL),
(72, 28, 'Less than 1 year\r\n', NULL, 0, 1, 0, 1, NULL, NULL),
(73, 28, '1 year to 3 years\r\n', NULL, 0, 2, 0, 1, NULL, NULL),
(74, 28, '3 year to 5 years \r\n', NULL, 1, 3, 0, 1, NULL, NULL),
(75, 28, 'Above 5 years\r\n', NULL, 0, 5, 0, 1, NULL, NULL),
(76, 29, 'Less than 5 years ', NULL, 0, 3, 0, 1, NULL, NULL),
(77, 29, 'More than 5 years', NULL, 1, 5, 0, 1, NULL, NULL),
(78, 30, 'Permanent \r\n', NULL, 0, 5, 0, 1, NULL, NULL),
(79, 30, 'Temporary', NULL, 1, 1, 0, 1, NULL, NULL),
(80, 31, 'Skilled ', NULL, 0, 5, 0, 1, NULL, NULL),
(81, 31, 'Semi Skilled ', NULL, 0, 4, 0, 1, NULL, NULL),
(82, 31, 'Unskilled', NULL, 1, 2, 0, 1, NULL, NULL),
(83, 32, '100000 to 180000\r\n', NULL, 1, 2, 0, 1, NULL, NULL),
(84, 32, '180000 to 300000', NULL, 0, 3, 0, 1, NULL, NULL),
(85, 32, 'More than 300000', NULL, 0, 5, 0, 1, NULL, NULL),
(86, 33, 'Yes', NULL, 0, 5, 0, 1, NULL, NULL),
(87, 33, 'No', NULL, 1, 2, 0, 1, NULL, NULL),
(88, 34, 'Bank credit\r\n', NULL, 0, 5, 0, 1, NULL, NULL),
(89, 34, 'Cash ', NULL, 1, 2, 0, 1, NULL, NULL),
(90, 35, 'No', NULL, 1, 3, 0, 1, NULL, NULL),
(91, 35, 'Yes', NULL, 0, 5, 0, 1, NULL, NULL),
(92, 36, 'Yes', NULL, 1, 5, 0, 1, NULL, NULL),
(93, 36, 'No', NULL, 0, 3, 0, 1, NULL, NULL),
(94, 38, 'No', NULL, 1, 2, 0, 1, NULL, NULL),
(95, 38, 'Yes', NULL, 0, 5, 0, 1, NULL, NULL),
(96, 39, 'Yes', NULL, 1, 2, 0, 1, NULL, NULL),
(97, 39, 'No', NULL, 0, 5, 0, 1, NULL, NULL),
(98, 40, 'Write-off, suit-filed settled, wilful Default, restructured in last 24 Months. ', NULL, 0, 0, 5, 1, NULL, NULL),
(99, 40, 'Doubtful/ Substandard/ LSS/SMA in last 24 Months', NULL, 0, 0, 4, 1, NULL, NULL),
(100, 40, '60+DPDs in last 12 months', NULL, 0, 0, 3, 1, NULL, NULL),
(101, 40, '30+DPD in last 6 months.', NULL, 0, 0, 2, 1, NULL, NULL),
(102, 40, '15+DPD on term loan in last 3 months with >Rs 1000 overdue.', NULL, 0, 0, 1, 1, NULL, NULL),
(103, 40, 'Current Overdue for an amount exceeding Rs. 1k.', NULL, 0, 0, 0, 1, NULL, NULL),
(104, 40, 'Lie PL>=2 to be excluded.', NULL, 0, 0, 0, 1, NULL, NULL),
(105, 40, 'If >6 enquires (all products) in last 3 months. ', NULL, 0, 0, 0, 1, NULL, NULL),
(106, 40, 'Recent PL>1 in last 3 months to be excluded', NULL, 0, 0, 0, 1, NULL, NULL),
(107, 40, 'None\r\n', NULL, 0, 5, 0, 1, NULL, NULL),
(108, 41, 'Below 600 - Poor', NULL, 1, 1, 0, 1, NULL, NULL),
(109, 41, '600-650 Average', NULL, 0, 2, 0, 1, NULL, NULL),
(110, 41, '650-700 Above average', NULL, 0, 3, 0, 1, NULL, NULL),
(111, 41, '700-750 good', NULL, 0, 4, 0, 1, NULL, NULL),
(112, 41, 'Above 750 excellent', NULL, 0, 5, 0, 1, NULL, NULL),
(113, 42, 'No', NULL, 1, 2, 0, 1, NULL, NULL),
(114, 42, 'Yes', NULL, 0, 5, 0, 1, NULL, NULL),
(115, 43, 'Yes', NULL, 0, 5, 0, 1, NULL, NULL),
(116, 43, 'No', NULL, 1, 3, 0, 1, NULL, NULL),
(117, 44, 'No', NULL, 1, 2, 0, 1, NULL, NULL),
(118, 44, 'Yes', NULL, 0, 5, 0, 1, NULL, NULL),
(119, 45, 'Yes', NULL, 0, 5, 0, 1, NULL, NULL),
(120, 45, 'No', NULL, 1, 2, 0, 1, NULL, NULL),
(121, 47, 'Proprietorship', NULL, 1, 1, 0, 1, NULL, NULL),
(122, 47, 'Partnership ', NULL, 0, 2, 0, 1, NULL, NULL),
(123, 45, 'Private Limited', NULL, 0, 4, 0, 1, NULL, NULL),
(124, 45, 'Public Limited', NULL, 0, 5, 0, 1, NULL, NULL),
(125, 45, 'Government Entity', NULL, 0, 5, 0, 1, NULL, NULL),
(126, 48, 'No', NULL, 1, 3, 0, 1, NULL, NULL),
(127, 48, 'Yes', NULL, 0, 5, 0, 1, NULL, NULL),
(128, 49, 'Chemical and Pharmaceutical Industry', NULL, 0, 5, 0, 1, NULL, NULL),
(129, 49, 'Banking Industry', NULL, 0, 5, 0, 1, NULL, NULL),
(130, 49, 'Automotive & Ancillary Sector', NULL, 0, 5, 0, 1, NULL, NULL),
(131, 49, 'Road and Construction Sector', NULL, 0, 3, 0, 1, NULL, NULL),
(132, 49, 'Logistics', NULL, 0, 3, 0, 1, NULL, NULL),
(133, 49, 'Hospitality', NULL, 0, 2, 0, 1, NULL, NULL),
(134, 49, 'Healthcare & Hospitals', NULL, 0, 3, 0, 1, NULL, NULL),
(135, 49, 'Paper ', NULL, 0, 4, 0, 1, NULL, NULL),
(136, 49, 'Electricals and Electronics', NULL, 0, 4, 0, 1, NULL, NULL),
(137, 49, 'Others', NULL, 1, 3, 0, 1, NULL, NULL),
(138, 50, 'Yes', NULL, 1, 3, 0, 1, NULL, NULL),
(139, 50, 'No', NULL, 0, 4, 0, 1, NULL, NULL),
(140, 51, 'Trader', NULL, 1, 2, 0, 1, NULL, NULL),
(141, 51, 'Manufacturer', NULL, 0, 5, 0, 1, NULL, NULL),
(142, 51, 'Services', NULL, 0, 3, 0, 1, NULL, NULL),
(143, 52, 'Less than 500 crores', NULL, 1, 3, 0, 1, NULL, NULL),
(144, 52, 'more than 500 crores', NULL, 0, 5, 0, 1, NULL, NULL),
(145, 53, 'A+and above', NULL, 0, 5, 0, 1, NULL, NULL),
(146, 53, 'A- to A', NULL, 0, 4, 0, 1, NULL, NULL),
(147, 53, 'BBB- to BBB+', NULL, 1, 2, 0, 1, NULL, NULL),
(148, 54, 'Less than 500 ', NULL, 1, 3, 0, 1, NULL, NULL),
(149, 54, 'More than 500 ', NULL, 0, 3, 0, 1, NULL, NULL),
(150, 55, 'High', NULL, 1, 2, 0, 1, NULL, NULL),
(151, 55, 'Medium', NULL, 0, 3, 0, 1, NULL, NULL),
(152, 55, 'Low', NULL, 0, 4, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `credit_score_users_answers`
--

CREATE TABLE `credit_score_users_answers` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT '0',
  `formData` longtext,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `deviation_records`
--

CREATE TABLE `deviation_records` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL DEFAULT '0',
  `deviationLoanAmount` text,
  `deviationLoanAmountR` text,
  `deviationLoanTenure` text,
  `deviationLoanTenureR` text,
  `deviationNegativePD` text,
  `deviationNegativePDR` text,
  `deviationNegativeCibil` text,
  `deviationNegativeCibilR` text,
  `deviationNegativeCpvFI` text,
  `deviationNegativeCpvFIR` text,
  `deviationNegativeEligibility` text,
  `deviationNegativeEligibilityR` text,
  `deviationNegativeProfile` text,
  `deviationNegativeProfileR` text,
  `overAllDeviationRemark` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deviation_records`
--

INSERT INTO `deviation_records` (`id`, `userId`, `deviationLoanAmount`, `deviationLoanAmountR`, `deviationLoanTenure`, `deviationLoanTenureR`, `deviationNegativePD`, `deviationNegativePDR`, `deviationNegativeCibil`, `deviationNegativeCibilR`, `deviationNegativeCpvFI`, `deviationNegativeCpvFIR`, `deviationNegativeEligibility`, `deviationNegativeEligibilityR`, `deviationNegativeProfile`, `deviationNegativeProfileR`, `overAllDeviationRemark`, `created_at`, `updated_at`) VALUES
(1, 53, NULL, 'AA', NULL, 'wef', 'wef', 'fef', 'efef', 'efef', 'erferf', 'erferf', 'erfer', 'ferf', 'efrfer', 'ferf', NULL, '2022-11-02 03:47:53', '2022-11-02 03:47:53'),
(2, 55, 'yes', NULL, NULL, NULL, 'yes', NULL, NULL, NULL, 'yes', NULL, NULL, NULL, 'yes', NULL, NULL, '2022-11-02 05:42:04', '2022-11-02 18:36:05'),
(3, 57, 'yes', NULL, NULL, NULL, 'yes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-02 19:33:44', '2022-11-02 19:46:15'),
(4, 58, NULL, NULL, NULL, NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, NULL, '2022-11-03 05:19:16', '2022-11-03 05:19:16'),
(5, 56, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, NULL, NULL, 'yes', NULL, NULL, '2022-11-03 05:44:57', '2022-11-03 05:44:57'),
(6, 61, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, NULL, '2022-11-03 06:37:44', '2022-11-03 06:37:44'),
(7, 63, NULL, NULL, NULL, NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, NULL, '2022-11-03 07:23:57', '2022-11-03 07:23:57'),
(8, 60, NULL, NULL, NULL, NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, NULL, '2022-11-03 08:04:13', '2022-11-03 08:04:13'),
(9, 64, NULL, NULL, NULL, NULL, 'yes', NULL, NULL, NULL, 'yes', NULL, NULL, NULL, 'yes', NULL, NULL, '2022-11-03 09:37:36', '2022-11-03 09:38:14'),
(10, 65, NULL, NULL, NULL, NULL, 'yes', NULL, NULL, NULL, 'yes', NULL, NULL, NULL, 'yes', NULL, NULL, '2022-11-03 10:07:16', '2022-11-03 10:07:16'),
(11, 66, NULL, NULL, NULL, NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, NULL, '2022-11-04 09:56:38', '2022-11-04 09:56:38'),
(12, 67, NULL, NULL, NULL, NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'all are done as per requirement', '2022-11-08 05:41:29', '2022-11-08 05:41:29'),
(13, 68, NULL, NULL, NULL, NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'done', '2022-11-08 06:21:56', '2022-11-08 06:21:56'),
(14, 69, NULL, NULL, NULL, NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'dONE', '2022-11-09 06:14:39', '2022-11-09 06:14:39'),
(15, 70, NULL, NULL, 'yes', NULL, NULL, NULL, NULL, NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, NULL, '2022-11-09 06:28:51', '2022-11-09 06:28:51'),
(16, 78, NULL, NULL, NULL, NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, 'yes', NULL, NULL, '2022-11-10 09:43:26', '2022-11-10 09:43:33');

-- --------------------------------------------------------

--
-- Table structure for table `employer_masters`
--

CREATE TABLE `employer_masters` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employer_masters`
--

INSERT INTO `employer_masters` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Advanx Pvt. Ltd.', 1, NULL, NULL),
(2, 'Paytm Ltd.', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employer_type_masters`
--

CREATE TABLE `employer_type_masters` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employer_type_masters`
--

INSERT INTO `employer_type_masters` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pvt. Ltd.', 1, NULL, NULL),
(2, 'Limited', 1, NULL, NULL),
(3, 'Propitership', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employment_histories`
--

CREATE TABLE `employment_histories` (
  `id` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL DEFAULT '0',
  `employerName` varchar(255) DEFAULT NULL,
  `emailId` varchar(200) DEFAULT NULL,
  `mobileNo` varchar(100) DEFAULT NULL,
  `companyTeleNo` varchar(255) DEFAULT NULL,
  `companyFaxNo` varchar(255) DEFAULT NULL,
  `companyGstin` varchar(255) DEFAULT NULL,
  `companyPan` varchar(255) DEFAULT NULL,
  `companyType` varchar(255) DEFAULT NULL,
  `address` text,
  `district` varchar(200) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `pincode` varchar(100) DEFAULT NULL,
  `fromAdmin` int(11) NOT NULL DEFAULT '0',
  `status` varchar(100) DEFAULT NULL COMMENT 'pending, approved, rejected',
  `remark` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employment_histories`
--

INSERT INTO `employment_histories` (`id`, `userId`, `employerName`, `emailId`, `mobileNo`, `companyTeleNo`, `companyFaxNo`, `companyGstin`, `companyPan`, `companyType`, `address`, `district`, `state`, `pincode`, `fromAdmin`, `status`, `remark`, `created_at`, `updated_at`) VALUES
(1, 3, 'AWS', 'aws@aws.com', '87878787', '87877878', 'FAX', 'GSTIN12', 'PAN123', NULL, 'Noida', 'Noida', 'UP', '121212', 0, 'approved', 'Approved', '2022-09-17 20:17:54', '2022-09-17 20:28:32'),
(2, 4, 'XYZ pvt ltd', 'gh@gmail.com', '999999999', '123456789', '67577', '1345333333333', 'CUAPM5713L', NULL, 'd12 sector 63', 'Noida', 'UP', '989888', 0, 'approved', 'Employment has been approved successfully.', '2022-09-19 05:50:05', '2022-09-19 06:21:36'),
(3, 5, 'XYZ pvt ltd', 'gh1@gmail.com', '99999999', '123456789', NULL, NULL, NULL, NULL, 'd12 sector 63', 'Noida', 'UP', '989888', 0, 'pending', NULL, '2022-09-19 06:08:26', '2022-09-19 06:08:26'),
(4, 7, 'XYZ pvt ltd', NULL, '7888686', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'rejected', 'hghghg', '2022-09-19 07:09:04', '2022-09-19 07:54:02'),
(5, 8, 'XYZ pvt ltd', 'jhhgj@gmail.com', '897987987', '78678', '43897988987', '786678', '787778', NULL, 'd12 sector 63', 'Noida', 'UP', '641654', 0, 'approved', 'Employment has been approved successfully.', '2022-09-20 05:54:32', '2022-09-21 07:56:17'),
(6, 9, 'PQR pvt ltd', 'r@gmail.com', '98584383', '8989322', '283478872', '87278728', '434242', NULL, 'd12 sector 63', 'Noida', 'UP', '989888', 0, 'approved', 'Employment has been approved successfully.', '2022-09-21 04:47:21', '2022-09-21 07:46:34'),
(7, 10, 'XYZ pvt ltd', 'dfjj@gmail.com', '832892439', '329920', '986878788', NULL, 'CUAPM5713p', NULL, 'd12 sector 63', 'Noida', 'UP', '989888', 0, 'approved', 'Employment has been approved successfully.', '2022-09-26 06:46:51', '2022-09-26 06:50:50'),
(8, 11, 'lpo pvt ltd', 'kl@gmail.com', '976699897', '38782', '983289479', 'jhsajg', 'sadhjy', NULL, 'hbjgh', 'sabh', 'sja', '89768', 0, 'approved', 'Employment has been approved successfully.', '2022-09-26 09:28:23', '2022-09-26 09:32:45'),
(9, 12, 'poio pvt ltd', 'lk@gmail.com', '897438286', '14245678', '724778', '87', '98', NULL, 'hjh', 'kjgjhg', 'jhhj', '7678687', 0, 'approved', 'Employment has been approved successfully.', '2022-09-26 10:39:01', '2022-09-26 11:31:39'),
(10, 13, 'hh', 'gh@gmail.com', '89678', '67', '8667', '66677', '7577', NULL, 'jhg', 'ghg', 'hjggh', '6776', 0, 'pending', 'yes checked', '2022-09-26 12:56:54', '2022-11-01 20:41:36'),
(11, 14, 'hg', 'gh@gmail.com', '67688768', '7868', '5', '6', '7667', NULL, 'ghgh', 'ghg', 'hj', '68678', 0, 'approved', 'yes', '2022-09-27 09:34:19', '2022-09-27 09:48:09'),
(12, 15, 'jhjh', 'ghnh@gmail.com', '7768', '6768', 'ytty', 'yttu', '98798', NULL, 'hgg', 'hgg', 'ghhg', '7668', 0, 'approved', 'Employment has been approved successfully.', '2022-09-27 10:58:22', '2022-09-27 11:30:51'),
(13, 18, 'XYZ pvt ltd', 'jhjh@gmail.com', '897877', '8778', '676', '76', '76778', NULL, 'hbb', 'hbhb', 'ytyug', '768688', 0, 'approved', 'Employment has been approved successfully.', '2022-09-28 07:14:28', '2022-09-28 07:18:29'),
(14, 19, 'XYZ pvt ltd', 'gh@gmail.com', '98797987', '8998789798', '78688', '879767687', 'hjhj', NULL, 'd12 sector 63', 'Noida', 'uttar pradesh', '7678687', 0, 'approved', 'Employment has been approved successfully.', '2022-09-29 11:50:10', '2022-09-29 12:01:07'),
(15, 20, 'hjghg', 'rahul@', '78776', '776', '6556', '5665', '5565', NULL, 'hggh', 'ghgh', 'ghgh', '281001', 0, 'approved', 'Employment has been approved successfully.', '2022-09-29 12:38:09', '2022-09-29 13:07:33'),
(16, 21, 'XYZ pvt ltd', 'rh@gmail.com', '877887887', '786767887', '876', '676', '767', NULL, 'd12 sector 63', 'Noida', 'uttar pradesh', '984899', 0, 'approved', 'Employment has been approved successfully.', '2022-09-30 12:18:46', '2022-09-30 12:27:43'),
(17, 23, 'yy', 'h@gmail.com', '767888', '766', '7667', '667', '6556', NULL, 'hh', 'hh', 'uttar pradesh', '7867677', 0, 'approved', 'Employment has been approved successfully.', '2022-09-30 12:55:59', '2022-09-30 12:58:16'),
(18, 24, 'XYZ pvt ltd', 'rr@gmail.com', '878787877', '98777788', '78768', '776', '7678', NULL, 'ggg', 'gg', 'ghgh', '76768786', 0, 'approved', 'Employment has been approved successfully.', '2022-10-04 11:22:50', '2022-10-04 11:37:10'),
(19, 25, 'XYZ pvt ltd', 'kl@gmail.com', '89879699', '9878989', '8978', '8987', '887', NULL, 'd12 sector 63', 'Noida', 'uttar pradesh', '895780', 0, 'approved', 'Employment has been approved successfully.', '2022-10-06 04:45:56', '2022-10-06 04:53:20'),
(20, 26, 'PQR pvt ltd', 'hj@gmail.com', '77887889', '8778678', '897687', '776', '787', NULL, 'd12 sector 63', 'Noida', 'uttar pradesh', '7678687', 0, 'approved', 'Employment has been approved successfully.', '2022-10-06 05:49:58', '2022-10-06 06:00:16'),
(21, 27, 'TechMave', 'avi@techmavesotware.com', '65314646', '5454545', '9566566', '8749664666', 'njjsd999n', NULL, 'secot 9', 'UP', 'uttar pradesh', '296951', 0, 'approved', 'yes', '2022-10-06 06:15:00', '2022-10-06 06:21:25'),
(22, 29, 'PQR pvt ltd', 'hg@gmail.com', '78676867', '89978998', '89787678', '786767', '778', NULL, 'd12 sector 63', 'Noida', 'uttar pradesh', '89768', 0, 'approved', 'fine', '2022-10-06 06:40:15', '2022-10-06 06:54:34'),
(23, 28, 'poio pvt ltd', 'kj@gmail.com', '89978787', '7879879', '43897988987', '1345333333333', '7876678', NULL, 'd12 sector 63', 'Noida', 'uttar pradesh', '7668', 0, 'approved', 'Employment has been approved successfully.', '2022-10-06 06:47:03', '2022-10-06 07:15:14'),
(24, 31, 'XYZ pvt ltd', 'gml@gmail.com', '7787877', '8877', 'jhhhhj', 'hjghghj', 'hjghjgb', NULL, 'd12 sector 63', 'Noida', 'UP', '281001', 0, 'approved', 'Employment has been approved successfully.', '2022-10-07 04:53:43', '2022-10-07 04:58:41'),
(25, 32, 'poio pvt ltd', 'hl@gmail.com', '8788778', '7778778778', 'i78', '8977', '87789', NULL, 'hjhh', 'hjhh', 'hhj', '897787', 0, 'approved', 'Employment has been approved successfully.', '2022-10-07 05:25:08', '2022-10-07 05:37:50'),
(26, 30, 'XYZ pvt ltd', 'hjh@gmail.com', '89778', '77878', '7867', '667', '887', NULL, 'u', 'u', 'u', '8778', 0, 'approved', 'Employment has been approved successfully.', '2022-10-07 05:48:28', '2022-10-07 05:49:52'),
(27, 33, 'MAXMEO', 'shoryamittal95@gmail.com', '565695959', '72638648483', '895959', 'BJDJDNDJ83395J', 'NJDDJ8999N', NULL, 'njsd', 'Delhi', 'Delhi', '256595', 0, 'approved', 'sjhdjd', '2022-10-07 06:38:53', '2022-10-07 06:44:28'),
(28, 34, 'XYZ pvt ltd', 'k@gmail.com', '87657575', '67567576', '788667', '76557', '67556', NULL, 'd12 sector 63', 'Noida', 'uttar pradesh', '766887', 0, 'approved', 'Employment has been approved successfully.', '2022-10-13 04:46:15', '2022-10-13 07:19:40'),
(29, 36, 'hgg', '67676@gmail.com', '75778', '87577', '55', '66', '565', NULL, '67', '565', '77', '66', 0, 'approved', 'Employment has been approved successfully.', '2022-10-13 05:11:47', '2022-10-13 07:48:00'),
(30, 37, 'XYZ pvt ltd', 'k@gmail.com', '67767', '565657', '6557', '6757647', '655767', NULL, 'hg', 'hgffhg', 'bhh', '218108', 0, 'approved', 'Employment has been approved successfully.', '2022-10-13 09:55:46', '2022-10-13 09:58:23'),
(31, 38, 'XYZ pvt ltd', 'hgt@gmail.com', '77678688', '976786887', '7676877', '786657677', '8767878', NULL, 'jhhj', 'Noida', 'uttar pradesh', '878983', 0, 'approved', 'Employment has been approved successfully.', '2022-10-14 04:34:23', '2022-10-14 04:39:08'),
(32, 39, 'hghg', 'ghj@gmail.com', '98778986', '66', '767667', '6555', '75576', NULL, 'hghg', 'hhgghjh', 'hgffg', '281001', 0, 'approved', 'Employment has been approved successfully.', '2022-10-14 12:01:40', '2022-10-14 12:15:00'),
(33, 41, 'XYZ pvt ltd', 'rjdsjh@gmail.com', '98453976', '897878767', '5657577778', '1345333333333', 'ytyth7657', NULL, 'dfsjh', 'hdg', 'hdg', '873289', 0, 'approved', 'Employment has been approved successfully.', '2022-10-17 04:58:48', '2022-10-17 05:06:40'),
(34, 43, 'XYZ pvt ltd', 'lp@gmail.com', '897868787', '875677678', '87676876', 'axhbs', 'dsc', NULL, 'd', 'sa', 'c', '899778', 0, 'approved', 'Employment has been approved successfully.', '2022-10-17 08:57:13', '2022-10-17 09:00:02'),
(35, 44, 'Plastwind Enterprises', 'info@maxemocapital.com', '9811417415', '9811417415', '7675', '06mzmps7409c1zv', '7675', NULL, 'Faridabad Sector -37 Haryana', 'Delhi', 'Delhi', '110037', 0, 'approved', 'Employment has been approved successfully.', '2022-10-17 09:35:52', '2022-10-17 11:21:16'),
(36, 47, 'Resilient Plastics Private Limited', 'resilientplastics@gmail.com', '9212101125', '9560848096', '0112222', '07AAFCR7675G1ZZ', 'BODPS7526H', NULL, 'GROUND FLOOR, PLOT NO. 496, KHASRA NO. 16/2 FRONT PORTION, SAMAIPUR, North West Delhi', 'North West Delhi Samaypur', 'New Delhi', '110042', 0, 'pending', NULL, '2022-10-17 12:12:50', '2022-11-10 12:32:50'),
(37, 48, 'h', '88@gmail.com', '7', '88', '7676677', 'gj67', '775ygh', NULL, 'hgghgh', 'Noida', 'uttar pradesh', '65566677', 0, 'pending', 'Employment has been approved successfully.', '2022-10-19 06:51:59', '2022-10-19 07:53:16'),
(38, 49, 'hgh', 't@gmail.com', '8787', '788778', '6', '6', '6', NULL, 'u', 'u', 'u', '877', 0, 'approved', 'Employment has been approved successfully.', '2022-10-19 07:36:34', '2022-10-19 07:38:16'),
(39, 50, 'XYZ pvt ltd', 'de@gmail.com', '767668', '86766', '56557', '765656', '65555777', NULL, 'holi gate', 'Noida', 'uttar pradesh', '281001', 0, 'approved', 'Employment has been approved successfully.', '2022-10-20 06:02:58', '2022-10-23 03:36:08'),
(40, 51, 'XYZ pvt ltd', 'rk@gmail.com', '89484783', '973277538', '762473724', '6873267', '677327', NULL, 'new delhi', 'mathura', 'uttar pradesh', '560034', 0, 'approved', 'Employment has been approved successfully.', '2022-10-21 07:18:13', '2022-10-21 07:30:37'),
(41, 52, 'XYZ pvt ltd', 'rmor@gmail.com', '98996765', '873787883', '8787868', '8668686', '886675565', NULL, 'Holi Gate', 'Mathura', 'uttar pradesh', '281001', 0, 'approved', 'Employment has been approved successfully.', '2022-10-27 05:50:17', '2022-10-28 10:10:37'),
(42, 53, 'XYZ pvt ltd', 'klwe@gmail.com', '87766567', '34252', '3254', '3255', '3432433', NULL, 'c 40', 'Mathura', 'uttar pradesh', '281001', 0, 'pending', NULL, '2022-10-28 09:27:15', '2022-11-09 16:38:43'),
(43, 54, 'XYZ pvt ltd', 'yt@gmail.com', '87546884', '8754383', '2377', 'dggds', '328782', NULL, 'mathura', 'Mathura', 'uttar pradesh', '281001', 0, 'approved', 'Employment has been approved successfully.', '2022-10-28 11:18:05', '2022-10-28 11:21:58'),
(44, 55, 'XYZ pvt ltd', 'lkdsaa@gmail.com', '87878787', '878878787', '8787868', '1345333333333', 'CUAPM5713L', NULL, 'C 4o', 'Mathura', 'Uttar pradesh', '281001', 0, 'approved', 'Employment has been approved successfully.', '2022-11-02 05:17:52', '2022-11-02 05:38:25'),
(45, 56, 'XYZ pvt ltd', 'rmorya15@gmail.com', '767688588', '68765667', '124', '1345333333333', 'CUAPM5713L', NULL, 'c 40', 'Mathura', 'Uttar pradesh', '281001', 0, 'approved', 'Employment has been approved successfully.', '2022-11-02 06:13:18', '2022-11-03 05:44:19'),
(46, 57, 'NA', NULL, '34434', NULL, NULL, 'AAA', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'approved', 'AAAAA', '2022-11-02 19:26:22', '2022-11-02 19:43:41'),
(47, 58, 'XYZ pvt ltd', 'lj@gmail.com', '78884788', '893788393', '8787868', '1345333333333', 'CUAPM5713L', NULL, 'c40', 'MATHURA', 'UP', '281001', 0, 'approved', 'Employment has been approved successfully.', '2022-11-03 05:13:02', '2022-11-03 05:17:01'),
(48, 61, 'XYZ pvt ltd', 'gffg@gmail.com', '7423787243', '2378623', '767575', '7575', '767575', NULL, 'c 40', 'Mathura', 'UP', '281001', 0, 'approved', 'Employment has been approved successfully.', '2022-11-03 06:35:53', '2022-11-03 06:37:23'),
(49, 63, 'XYZ pvt ltd', 'raw@gmail.com', '86382887', '6386887', '6772436', '767637267', 'CUAPM5713L', NULL, 'c40', 'AGra', 'UP', '278098', 0, 'approved', 'Employment has been approved successfully.', '2022-11-03 07:14:36', '2022-11-03 07:23:05'),
(50, 60, 'XYZ pvt ltd', 'jhg@gmail.com', '8738748', '34878738', '76743787', '3666864', '4376777', NULL, 'Mathura', 'Mathura', 'UP', '281001', 0, 'approved', 'Employment has been approved successfully.', '2022-11-03 08:00:45', '2022-11-03 08:03:09'),
(51, 64, 'AGGARWAL PACKAGING INDUSTRIES', 'Ashish.gupta12@gmail.com', '0114562787', '9873423411', '011222222', '07ABFFA1956K1ZB', 'ACVPG3197M', NULL, 'ROHINI SECTOR 6 DELHI', 'HARYANA', 'UP', '110085', 0, 'approved', 'Employment has been approved successfully.', '2022-11-03 09:25:39', '2022-11-03 09:37:16'),
(52, 65, 'JINDAL PLASTIC', 'Akhilesh.talwar@maxemocapital.com', '0114562782', '9643124320', '01222222', 'jfjhfjjfjkl83738', 'alkpt6574n', NULL, 'delhi', 'delhi', 'delhi', '110056', 0, 'approved', 'Employment has been approved successfully.', '2022-11-03 10:02:38', '2022-11-03 10:04:58'),
(53, 66, 'XYZ pvt ltd', 'rge@gmail.com', '878788787', '87878787', '124', '1345333333333', 'CUAPM5713L', NULL, 'fdh', 'Mathura', 'up', '281001', 0, 'approved', 'Employment has been approved successfully.', '2022-11-04 09:52:19', '2022-11-04 09:54:02'),
(54, 67, 'XYZ pvt ltd', 'hfhf@gmail.com', '873533', '8974384398', '7863478', '472372822', 'hjggfej', 'hhd', 'ndd', 'jdj', 'jdj', '281001', 0, 'approved', 'Employment has been approved successfully.', '2022-11-08 05:13:09', '2022-11-08 05:39:38'),
(55, 68, 'XYZ pvt ltd', 'jhfj@gmail.com', '84688868', '7647', '124', '1345333333333', '7647377', 'hhd', 'hghgfd', 'hghgdf', 'hghgf', '8787', 0, 'approved', 'Employment has been approved successfully.', '2022-11-08 06:14:46', '2022-11-08 06:20:20'),
(56, 69, 'XYZ pvt ltd', 'fdd@gmail.com', '878888788', '5436433', '8787868', '1345333333333', 'CUAPM5713L', 'hhd', 'VV', 'Noida', 'UP', '3553', 0, 'approved', 'Employment has been approved successfully.', '2022-11-09 06:10:29', '2022-11-09 06:13:54'),
(57, 70, 'XYZ pvt ltd', 'rees@hmail.com', '56565667', '767577676', '124', '1345333333333', 'CUAPM5713L', 'hhd', 'hgghgh', 'hdg', 'jhhg', '65566677', 0, 'approved', 'Employment has been approved successfully.', '2022-11-09 06:27:14', '2022-11-09 06:28:33'),
(58, 71, 'XYZ pvt ltd', 'fr@gmail.com', '67757677', '76756566', '124', '1345333333333', 'CUAPM5713L', 'hhd', 'hgghgh', 'ghg', 'jhhg', '65566677', 0, 'approved', 'Employment has been approved successfully.', '2022-11-09 06:54:44', '2022-11-09 06:56:33'),
(59, 72, 'XYZ pvt ltd', 'de@gmail.com', '76437777', '76437776', '655666', '652656565', '6524656', 'hhd', 'hgghgh', 'kjgjhg', 'jhhg', '65566677', 0, 'approved', 'Employment has been approved successfully.', '2022-11-09 07:58:13', '2022-11-09 07:59:50'),
(60, 73, 'XYZ pvt ltd', 'de@gmail.com', '65656464', '644664646', '76457573', '7564646', 'CUAPM5713L', 'hhd', 'hghg', 'hggh', 'tyyg', '281001', 0, 'approved', 'Employment has been approved successfully.', '2022-11-10 05:02:49', '2022-11-10 05:05:20'),
(61, 74, 'XYZ pvt ltd', 'fgf', '65646466', '644466667', 'ghfg', 'hgfg', '755', 'hhd', 'hgghgh', 'hdg', 'jhhg', '65566677', 0, 'approved', 'Employment has been approved successfully.', '2022-11-10 05:21:07', '2022-11-10 05:23:04'),
(62, 75, 'XYZ pvt ltd', 'gf@gmail.com', '7676', '767766', '124', '1345333333333', 'CUAPM5713L', 'hhd', 'hgghgh', 'ghgh', 'jhhg', '65566677', 0, 'approved', 'Employment has been approved successfully.', '2022-11-10 05:29:22', '2022-11-10 05:31:34'),
(63, 76, 'XYZ pvt ltd', NULL, '767457', '755765767', '124', '1345333333333', NULL, 'hhd', NULL, NULL, NULL, NULL, 0, 'approved', 'Employment has been approved successfully.', '2022-11-10 06:14:35', '2022-11-10 06:27:00'),
(64, 77, 'XYZ pvt ltd', NULL, '5354333', '63644', '124', '1345333333333', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, 0, 'approved', 'Employment has been approved successfully.', '2022-11-10 06:31:08', '2022-11-10 06:32:26'),
(65, 78, 'XYZ pvt ltd', 'fedd@gmail.com', '764327642', '426776274', '124', '1345333333333', 'CUAPM5713L', 'hhd', 'hgghgh', 'ghg', 'jhhg', '65566677', 0, 'approved', 'Done', '2022-11-10 09:37:23', '2022-11-10 09:42:23'),
(66, 79, 'XYZ pvt ltd', 'de@gmail.com', '76677677', '76687878', 'hgh', '1345333333333', 'CUAPM5713L', NULL, NULL, NULL, 'jhhg', '65566677', 0, 'approved', 'Employment has been approved successfully.', '2022-11-10 16:23:34', '2022-11-10 16:29:14'),
(67, 80, 'XYZ pvt ltd', 'ramlal@yopmail.com', '75575767', '7575757', '8787868', '1345333333333', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, 0, 'approved', 'Employment has been approved successfully.', '2022-11-11 04:53:02', '2022-11-11 04:54:52'),
(68, 81, 'XYZ pvt ltd', 'ramlal@yopmail.com', '7646766', '4743776', '8787868', '1345333333333', '65555777', 'hhd', NULL, NULL, 'jhhg', '65566677', 0, 'approved', 'Employment has been approved successfully.', '2022-11-14 04:44:34', '2022-11-14 04:47:42'),
(69, 82, 'XYZ pvt ltd', NULL, '767575767', '755757676', '124', '1345333333333', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, 0, 'approved', 'Employment has been approved successfully.', '2022-11-14 05:39:15', '2022-11-14 05:41:16'),
(70, 83, 'MONATO MICRO FOOTSTEPS  PRIVATE LIMITED', 'monatomicro@gmail.com', '999999999', '9999999999', '0112222', '06AALCM5384M1ZT', 'AALCM5384M', 'Private limited', 'FIRST FLOOR, PLOT NO 06, SECTOR-17, HSIIDC INDUSTRIAL ESTATE, FOOTWEAR PARK, BAHADURGARH, Jhajjar,', 'Jhajjar', 'Haryana', '124507', 0, 'pending', NULL, '2022-11-16 06:26:47', '2022-11-16 09:13:45'),
(71, 84, 'Plastwind Enterprises', 'YPP2008@gmail.com', '9810214691', NULL, NULL, '06MZMPS7409C1ZV', 'ABKPG8713D', 'PVT', '14/4, Mathura Road, Industrial Area, Faridabad', 'Faridabad', 'Haryana', '121003', 0, 'approved', 'Employment has been approved successfully.', '2022-11-16 07:41:27', '2022-11-16 09:32:36'),
(72, 85, 'XYZ pvt ltd', 'rddr@gmail.com', '6756576', '67554', '6754566', '56454566', '5645465', 'hhd', 'gffg', 'hff', 'hff', '281001', 0, 'approved', 'Employment has been approved successfully.', '2022-11-17 05:27:04', '2022-11-17 12:59:09'),
(73, 87, 'NA', NULL, '5465465415', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'pending', NULL, '2022-11-17 19:47:29', '2022-11-17 19:56:32'),
(74, 96, 'XYZ pvt ltd', NULL, '76767676', NULL, '876667', '767676', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'approved', 'Employment has been approved successfully.', '2022-11-18 06:55:28', '2022-11-18 07:02:03'),
(75, 98, 'AGGARWAL PACKAGING INDUSTRIES', 'JINDAL_VIKAS@YAHOO.CO.IN', '9971789111', NULL, NULL, '07ABFFA1956K1ZB', 'ABFFA1956K', 'Private limited', 'Aggarwal packaging industries , D-106, sector-4, DSIIDC, bhawana industrial area,', 'Delhi', 'Delhi', '110039', 0, 'pending', NULL, '2022-11-18 07:47:15', '2022-11-19 05:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `qnsTitle` text,
  `qnsAns` text,
  `qnsSort` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `qnsTitle`, `qnsAns`, `qnsSort`, `created_at`, `updated_at`) VALUES
(1, 'Q134r34', 'AAA', 2, '2022-08-16 20:59:37', '2022-08-16 20:59:57'),
(2, 'erfge', 'rgr', 1, '2022-08-16 20:59:48', '2022-09-01 19:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `loan_emi_details`
--

CREATE TABLE `loan_emi_details` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL DEFAULT '0',
  `loanId` int(11) NOT NULL DEFAULT '0',
  `emiId` varchar(255) DEFAULT NULL,
  `emiSr` int(11) NOT NULL DEFAULT '0',
  `emiAmount` double(10,2) NOT NULL DEFAULT '0.00',
  `interest` double(10,2) NOT NULL DEFAULT '0.00',
  `principle` double(10,2) NOT NULL DEFAULT '0.00',
  `balance` double(10,2) NOT NULL DEFAULT '0.00',
  `emiDate` date DEFAULT NULL,
  `emiDueDate` date DEFAULT NULL,
  `status` varchar(255) DEFAULT 'pending' COMMENT 'pending, success',
  `transactionId` text,
  `payment_mode` varchar(255) DEFAULT NULL,
  `transactionDate` datetime DEFAULT NULL,
  `lateCharges` double(10,2) NOT NULL DEFAULT '0.00',
  `remark` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_emi_details`
--

INSERT INTO `loan_emi_details` (`id`, `userId`, `loanId`, `emiId`, `emiSr`, `emiAmount`, `interest`, `principle`, `balance`, `emiDate`, `emiDueDate`, `status`, `transactionId`, `payment_mode`, `transactionDate`, `lateCharges`, `remark`, `created_at`, `updated_at`) VALUES
(1, 25, 20, 'EM2001', 0, 128.77, 0.00, 0.00, 0.00, '2022-11-05', '2022-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(2, 25, 20, 'EM2002', 0, 128.77, 0.00, 0.00, 0.00, '2022-12-05', '2022-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(3, 25, 20, 'EM2003', 0, 128.77, 0.00, 0.00, 0.00, '2023-01-05', '2023-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(4, 25, 20, 'EM2004', 0, 128.77, 0.00, 0.00, 0.00, '2023-02-05', '2023-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(5, 25, 20, 'EM2005', 0, 128.77, 0.00, 0.00, 0.00, '2023-03-05', '2023-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(6, 25, 20, 'EM2006', 0, 128.77, 0.00, 0.00, 0.00, '2023-04-05', '2023-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(7, 25, 20, 'EM2007', 0, 128.77, 0.00, 0.00, 0.00, '2023-05-05', '2023-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(8, 25, 20, 'EM2008', 0, 128.77, 0.00, 0.00, 0.00, '2023-06-05', '2023-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(9, 25, 20, 'EM2009', 0, 128.77, 0.00, 0.00, 0.00, '2023-07-05', '2023-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(10, 25, 20, 'EM20010', 0, 128.77, 0.00, 0.00, 0.00, '2023-08-05', '2023-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(11, 25, 20, 'EM20011', 0, 128.77, 0.00, 0.00, 0.00, '2023-09-05', '2023-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(12, 25, 20, 'EM20012', 0, 128.77, 0.00, 0.00, 0.00, '2023-10-05', '2023-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(13, 25, 20, 'EM20013', 0, 128.77, 0.00, 0.00, 0.00, '2023-11-05', '2023-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(14, 25, 20, 'EM20014', 0, 128.77, 0.00, 0.00, 0.00, '2023-12-05', '2023-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(15, 25, 20, 'EM20015', 0, 128.77, 0.00, 0.00, 0.00, '2024-01-05', '2024-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(16, 25, 20, 'EM20016', 0, 128.77, 0.00, 0.00, 0.00, '2024-02-05', '2024-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(17, 25, 20, 'EM20017', 0, 128.77, 0.00, 0.00, 0.00, '2024-03-05', '2024-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(18, 25, 20, 'EM20018', 0, 128.77, 0.00, 0.00, 0.00, '2024-04-05', '2024-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(19, 25, 20, 'EM20019', 0, 128.77, 0.00, 0.00, 0.00, '2024-05-05', '2024-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(20, 25, 20, 'EM20020', 0, 128.77, 0.00, 0.00, 0.00, '2024-06-05', '2024-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(21, 25, 20, 'EM20021', 0, 128.77, 0.00, 0.00, 0.00, '2024-07-05', '2024-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(22, 25, 20, 'EM20022', 0, 128.77, 0.00, 0.00, 0.00, '2024-08-05', '2024-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(23, 25, 20, 'EM20023', 0, 128.77, 0.00, 0.00, 0.00, '2024-09-05', '2024-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(24, 25, 20, 'EM20024', 0, 128.77, 0.00, 0.00, 0.00, '2024-10-05', '2024-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(25, 25, 20, 'EM20025', 0, 128.77, 0.00, 0.00, 0.00, '2024-11-05', '2024-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(26, 25, 20, 'EM20026', 0, 128.77, 0.00, 0.00, 0.00, '2024-12-05', '2024-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(27, 25, 20, 'EM20027', 0, 128.77, 0.00, 0.00, 0.00, '2025-01-05', '2025-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(28, 25, 20, 'EM20028', 0, 128.77, 0.00, 0.00, 0.00, '2025-02-05', '2025-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(29, 25, 20, 'EM20029', 0, 128.77, 0.00, 0.00, 0.00, '2025-03-05', '2025-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(30, 25, 20, 'EM20030', 0, 128.77, 0.00, 0.00, 0.00, '2025-04-05', '2025-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(31, 25, 20, 'EM20031', 0, 128.77, 0.00, 0.00, 0.00, '2025-05-05', '2025-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(32, 25, 20, 'EM20032', 0, 128.77, 0.00, 0.00, 0.00, '2025-06-05', '2025-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(33, 25, 20, 'EM20033', 0, 128.77, 0.00, 0.00, 0.00, '2025-07-05', '2025-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(34, 25, 20, 'EM20034', 0, 128.77, 0.00, 0.00, 0.00, '2025-08-05', '2025-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(35, 25, 20, 'EM20035', 0, 128.77, 0.00, 0.00, 0.00, '2025-09-05', '2025-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(36, 25, 20, 'EM20036', 0, 128.77, 0.00, 0.00, 0.00, '2025-10-05', '2025-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(37, 25, 20, 'EM20037', 0, 128.77, 0.00, 0.00, 0.00, '2025-11-05', '2025-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(38, 25, 20, 'EM20038', 0, 128.77, 0.00, 0.00, 0.00, '2025-12-05', '2025-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(39, 25, 20, 'EM20039', 0, 128.77, 0.00, 0.00, 0.00, '2026-01-05', '2026-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(40, 25, 20, 'EM20040', 0, 128.77, 0.00, 0.00, 0.00, '2026-02-05', '2026-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(41, 25, 20, 'EM20041', 0, 128.77, 0.00, 0.00, 0.00, '2026-03-05', '2026-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(42, 25, 20, 'EM20042', 0, 128.77, 0.00, 0.00, 0.00, '2026-04-05', '2026-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(43, 25, 20, 'EM20043', 0, 128.77, 0.00, 0.00, 0.00, '2026-05-05', '2026-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(44, 25, 20, 'EM20044', 0, 128.77, 0.00, 0.00, 0.00, '2026-06-05', '2026-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(45, 25, 20, 'EM20045', 0, 128.77, 0.00, 0.00, 0.00, '2026-07-05', '2026-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(46, 25, 20, 'EM20046', 0, 128.77, 0.00, 0.00, 0.00, '2026-08-05', '2026-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(47, 25, 20, 'EM20047', 0, 128.77, 0.00, 0.00, 0.00, '2026-09-05', '2026-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(48, 25, 20, 'EM20048', 0, 128.77, 0.00, 0.00, 0.00, '2026-10-05', '2026-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(49, 25, 20, 'EM20049', 0, 128.77, 0.00, 0.00, 0.00, '2026-11-05', '2026-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(50, 25, 20, 'EM20050', 0, 128.77, 0.00, 0.00, 0.00, '2026-12-05', '2026-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(51, 25, 20, 'EM20051', 0, 128.77, 0.00, 0.00, 0.00, '2027-01-05', '2027-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(52, 25, 20, 'EM20052', 0, 128.77, 0.00, 0.00, 0.00, '2027-02-05', '2027-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(53, 25, 20, 'EM20053', 0, 128.77, 0.00, 0.00, 0.00, '2027-03-05', '2027-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(54, 25, 20, 'EM20054', 0, 128.77, 0.00, 0.00, 0.00, '2027-04-05', '2027-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(55, 25, 20, 'EM20055', 0, 128.77, 0.00, 0.00, 0.00, '2027-05-05', '2027-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(56, 25, 20, 'EM20056', 0, 128.77, 0.00, 0.00, 0.00, '2027-06-05', '2027-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(57, 25, 20, 'EM20057', 0, 128.77, 0.00, 0.00, 0.00, '2027-07-05', '2027-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(58, 25, 20, 'EM20058', 0, 128.77, 0.00, 0.00, 0.00, '2027-08-05', '2027-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(59, 25, 20, 'EM20059', 0, 128.77, 0.00, 0.00, 0.00, '2027-09-05', '2027-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(60, 25, 20, 'EM20060', 0, 128.77, 0.00, 0.00, 0.00, '2027-10-05', '2027-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(61, 25, 20, 'EM20061', 0, 128.77, 0.00, 0.00, 0.00, '2027-11-05', '2027-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(62, 25, 20, 'EM20062', 0, 128.77, 0.00, 0.00, 0.00, '2027-12-05', '2027-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(63, 25, 20, 'EM20063', 0, 128.77, 0.00, 0.00, 0.00, '2028-01-05', '2028-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(64, 25, 20, 'EM20064', 0, 128.77, 0.00, 0.00, 0.00, '2028-02-05', '2028-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(65, 25, 20, 'EM20065', 0, 128.77, 0.00, 0.00, 0.00, '2028-03-05', '2028-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(66, 25, 20, 'EM20066', 0, 128.77, 0.00, 0.00, 0.00, '2028-04-05', '2028-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(67, 25, 20, 'EM20067', 0, 128.77, 0.00, 0.00, 0.00, '2028-05-05', '2028-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(68, 25, 20, 'EM20068', 0, 128.77, 0.00, 0.00, 0.00, '2028-06-05', '2028-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(69, 25, 20, 'EM20069', 0, 128.77, 0.00, 0.00, 0.00, '2028-07-05', '2028-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(70, 25, 20, 'EM20070', 0, 128.77, 0.00, 0.00, 0.00, '2028-08-05', '2028-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(71, 25, 20, 'EM20071', 0, 128.77, 0.00, 0.00, 0.00, '2028-09-05', '2028-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(72, 25, 20, 'EM20072', 0, 128.77, 0.00, 0.00, 0.00, '2028-10-05', '2028-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(73, 25, 20, 'EM20073', 0, 128.77, 0.00, 0.00, 0.00, '2028-11-05', '2028-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(74, 25, 20, 'EM20074', 0, 128.77, 0.00, 0.00, 0.00, '2028-12-05', '2028-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(75, 25, 20, 'EM20075', 0, 128.77, 0.00, 0.00, 0.00, '2029-01-05', '2029-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(76, 25, 20, 'EM20076', 0, 128.77, 0.00, 0.00, 0.00, '2029-02-05', '2029-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(77, 25, 20, 'EM20077', 0, 128.77, 0.00, 0.00, 0.00, '2029-03-05', '2029-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(78, 25, 20, 'EM20078', 0, 128.77, 0.00, 0.00, 0.00, '2029-04-05', '2029-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(79, 25, 20, 'EM20079', 0, 128.77, 0.00, 0.00, 0.00, '2029-05-05', '2029-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(80, 25, 20, 'EM20080', 0, 128.77, 0.00, 0.00, 0.00, '2029-06-05', '2029-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(81, 25, 20, 'EM20081', 0, 128.77, 0.00, 0.00, 0.00, '2029-07-05', '2029-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(82, 25, 20, 'EM20082', 0, 128.77, 0.00, 0.00, 0.00, '2029-08-05', '2029-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(83, 25, 20, 'EM20083', 0, 128.77, 0.00, 0.00, 0.00, '2029-09-05', '2029-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(84, 25, 20, 'EM20084', 0, 128.77, 0.00, 0.00, 0.00, '2029-10-05', '2029-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(85, 25, 20, 'EM20085', 0, 128.77, 0.00, 0.00, 0.00, '2029-11-05', '2029-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(86, 25, 20, 'EM20086', 0, 128.77, 0.00, 0.00, 0.00, '2029-12-05', '2029-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(87, 25, 20, 'EM20087', 0, 128.77, 0.00, 0.00, 0.00, '2030-01-05', '2030-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(88, 25, 20, 'EM20088', 0, 128.77, 0.00, 0.00, 0.00, '2030-02-05', '2030-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(89, 25, 20, 'EM20089', 0, 128.77, 0.00, 0.00, 0.00, '2030-03-05', '2030-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(90, 25, 20, 'EM20090', 0, 128.77, 0.00, 0.00, 0.00, '2030-04-05', '2030-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(91, 25, 20, 'EM20091', 0, 128.77, 0.00, 0.00, 0.00, '2030-05-05', '2030-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(92, 25, 20, 'EM20092', 0, 128.77, 0.00, 0.00, 0.00, '2030-06-05', '2030-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(93, 25, 20, 'EM20093', 0, 128.77, 0.00, 0.00, 0.00, '2030-07-05', '2030-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(94, 25, 20, 'EM20094', 0, 128.77, 0.00, 0.00, 0.00, '2030-08-05', '2030-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(95, 25, 20, 'EM20095', 0, 128.77, 0.00, 0.00, 0.00, '2030-09-05', '2030-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(96, 25, 20, 'EM20096', 0, 128.77, 0.00, 0.00, 0.00, '2030-10-05', '2030-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(97, 25, 20, 'EM20097', 0, 128.77, 0.00, 0.00, 0.00, '2030-11-05', '2030-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(98, 25, 20, 'EM20098', 0, 128.77, 0.00, 0.00, 0.00, '2030-12-05', '2030-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(99, 25, 20, 'EM20099', 0, 128.77, 0.00, 0.00, 0.00, '2031-01-05', '2031-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(100, 25, 20, 'EM200100', 0, 128.77, 0.00, 0.00, 0.00, '2031-02-05', '2031-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(101, 25, 20, 'EM200101', 0, 128.77, 0.00, 0.00, 0.00, '2031-03-05', '2031-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(102, 25, 20, 'EM200102', 0, 128.77, 0.00, 0.00, 0.00, '2031-04-05', '2031-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(103, 25, 20, 'EM200103', 0, 128.77, 0.00, 0.00, 0.00, '2031-05-05', '2031-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(104, 25, 20, 'EM200104', 0, 128.77, 0.00, 0.00, 0.00, '2031-06-05', '2031-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(105, 25, 20, 'EM200105', 0, 128.77, 0.00, 0.00, 0.00, '2031-07-05', '2031-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(106, 25, 20, 'EM200106', 0, 128.77, 0.00, 0.00, 0.00, '2031-08-05', '2031-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(107, 25, 20, 'EM200107', 0, 128.77, 0.00, 0.00, 0.00, '2031-09-05', '2031-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(108, 25, 20, 'EM200108', 0, 128.77, 0.00, 0.00, 0.00, '2031-10-05', '2031-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(109, 25, 20, 'EM200109', 0, 128.77, 0.00, 0.00, 0.00, '2031-11-05', '2031-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(110, 25, 20, 'EM200110', 0, 128.77, 0.00, 0.00, 0.00, '2031-12-05', '2031-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(111, 25, 20, 'EM200111', 0, 128.77, 0.00, 0.00, 0.00, '2032-01-05', '2032-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(112, 25, 20, 'EM200112', 0, 128.77, 0.00, 0.00, 0.00, '2032-02-05', '2032-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(113, 25, 20, 'EM200113', 0, 128.77, 0.00, 0.00, 0.00, '2032-03-05', '2032-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(114, 25, 20, 'EM200114', 0, 128.77, 0.00, 0.00, 0.00, '2032-04-05', '2032-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(115, 25, 20, 'EM200115', 0, 128.77, 0.00, 0.00, 0.00, '2032-05-05', '2032-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(116, 25, 20, 'EM200116', 0, 128.77, 0.00, 0.00, 0.00, '2032-06-05', '2032-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(117, 25, 20, 'EM200117', 0, 128.77, 0.00, 0.00, 0.00, '2032-07-05', '2032-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(118, 25, 20, 'EM200118', 0, 128.77, 0.00, 0.00, 0.00, '2032-08-05', '2032-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(119, 25, 20, 'EM200119', 0, 128.77, 0.00, 0.00, 0.00, '2032-09-05', '2032-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(120, 25, 20, 'EM200120', 0, 128.77, 0.00, 0.00, 0.00, '2032-10-05', '2032-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(121, 25, 20, 'EM200121', 0, 128.77, 0.00, 0.00, 0.00, '2032-11-05', '2032-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(122, 25, 20, 'EM200122', 0, 128.77, 0.00, 0.00, 0.00, '2032-12-05', '2032-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(123, 25, 20, 'EM200123', 0, 128.77, 0.00, 0.00, 0.00, '2033-01-05', '2033-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(124, 25, 20, 'EM200124', 0, 128.77, 0.00, 0.00, 0.00, '2033-02-05', '2033-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(125, 25, 20, 'EM200125', 0, 128.77, 0.00, 0.00, 0.00, '2033-03-05', '2033-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(126, 25, 20, 'EM200126', 0, 128.77, 0.00, 0.00, 0.00, '2033-04-05', '2033-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(127, 25, 20, 'EM200127', 0, 128.77, 0.00, 0.00, 0.00, '2033-05-05', '2033-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(128, 25, 20, 'EM200128', 0, 128.77, 0.00, 0.00, 0.00, '2033-06-05', '2033-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(129, 25, 20, 'EM200129', 0, 128.77, 0.00, 0.00, 0.00, '2033-07-05', '2033-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(130, 25, 20, 'EM200130', 0, 128.77, 0.00, 0.00, 0.00, '2033-08-05', '2033-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(131, 25, 20, 'EM200131', 0, 128.77, 0.00, 0.00, 0.00, '2033-09-05', '2033-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(132, 25, 20, 'EM200132', 0, 128.77, 0.00, 0.00, 0.00, '2033-10-05', '2033-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(133, 25, 20, 'EM200133', 0, 128.77, 0.00, 0.00, 0.00, '2033-11-05', '2033-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(134, 25, 20, 'EM200134', 0, 128.77, 0.00, 0.00, 0.00, '2033-12-05', '2033-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(135, 25, 20, 'EM200135', 0, 128.77, 0.00, 0.00, 0.00, '2034-01-05', '2034-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(136, 25, 20, 'EM200136', 0, 128.77, 0.00, 0.00, 0.00, '2034-02-05', '2034-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(137, 25, 20, 'EM200137', 0, 128.77, 0.00, 0.00, 0.00, '2034-03-05', '2034-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(138, 25, 20, 'EM200138', 0, 128.77, 0.00, 0.00, 0.00, '2034-04-05', '2034-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(139, 25, 20, 'EM200139', 0, 128.77, 0.00, 0.00, 0.00, '2034-05-05', '2034-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(140, 25, 20, 'EM200140', 0, 128.77, 0.00, 0.00, 0.00, '2034-06-05', '2034-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(141, 25, 20, 'EM200141', 0, 128.77, 0.00, 0.00, 0.00, '2034-07-05', '2034-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(142, 25, 20, 'EM200142', 0, 128.77, 0.00, 0.00, 0.00, '2034-08-05', '2034-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(143, 25, 20, 'EM200143', 0, 128.77, 0.00, 0.00, 0.00, '2034-09-05', '2034-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(144, 25, 20, 'EM200144', 0, 128.77, 0.00, 0.00, 0.00, '2034-10-05', '2034-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(145, 25, 20, 'EM200145', 0, 128.77, 0.00, 0.00, 0.00, '2034-11-05', '2034-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(146, 25, 20, 'EM200146', 0, 128.77, 0.00, 0.00, 0.00, '2034-12-05', '2034-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(147, 25, 20, 'EM200147', 0, 128.77, 0.00, 0.00, 0.00, '2035-01-05', '2035-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(148, 25, 20, 'EM200148', 0, 128.77, 0.00, 0.00, 0.00, '2035-02-05', '2035-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(149, 25, 20, 'EM200149', 0, 128.77, 0.00, 0.00, 0.00, '2035-03-05', '2035-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(150, 25, 20, 'EM200150', 0, 128.77, 0.00, 0.00, 0.00, '2035-04-05', '2035-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(151, 25, 20, 'EM200151', 0, 128.77, 0.00, 0.00, 0.00, '2035-05-05', '2035-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(152, 25, 20, 'EM200152', 0, 128.77, 0.00, 0.00, 0.00, '2035-06-05', '2035-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(153, 25, 20, 'EM200153', 0, 128.77, 0.00, 0.00, 0.00, '2035-07-05', '2035-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(154, 25, 20, 'EM200154', 0, 128.77, 0.00, 0.00, 0.00, '2035-08-05', '2035-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(155, 25, 20, 'EM200155', 0, 128.77, 0.00, 0.00, 0.00, '2035-09-05', '2035-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(156, 25, 20, 'EM200156', 0, 128.77, 0.00, 0.00, 0.00, '2035-10-05', '2035-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(157, 25, 20, 'EM200157', 0, 128.77, 0.00, 0.00, 0.00, '2035-11-05', '2035-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(158, 25, 20, 'EM200158', 0, 128.77, 0.00, 0.00, 0.00, '2035-12-05', '2035-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(159, 25, 20, 'EM200159', 0, 128.77, 0.00, 0.00, 0.00, '2036-01-05', '2036-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(160, 25, 20, 'EM200160', 0, 128.77, 0.00, 0.00, 0.00, '2036-02-05', '2036-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(161, 25, 20, 'EM200161', 0, 128.77, 0.00, 0.00, 0.00, '2036-03-05', '2036-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(162, 25, 20, 'EM200162', 0, 128.77, 0.00, 0.00, 0.00, '2036-04-05', '2036-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(163, 25, 20, 'EM200163', 0, 128.77, 0.00, 0.00, 0.00, '2036-05-05', '2036-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(164, 25, 20, 'EM200164', 0, 128.77, 0.00, 0.00, 0.00, '2036-06-05', '2036-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(165, 25, 20, 'EM200165', 0, 128.77, 0.00, 0.00, 0.00, '2036-07-05', '2036-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(166, 25, 20, 'EM200166', 0, 128.77, 0.00, 0.00, 0.00, '2036-08-05', '2036-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(167, 25, 20, 'EM200167', 0, 128.77, 0.00, 0.00, 0.00, '2036-09-05', '2036-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(168, 25, 20, 'EM200168', 0, 128.77, 0.00, 0.00, 0.00, '2036-10-05', '2036-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(169, 25, 20, 'EM200169', 0, 128.77, 0.00, 0.00, 0.00, '2036-11-05', '2036-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(170, 25, 20, 'EM200170', 0, 128.77, 0.00, 0.00, 0.00, '2036-12-05', '2036-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(171, 25, 20, 'EM200171', 0, 128.77, 0.00, 0.00, 0.00, '2037-01-05', '2037-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(172, 25, 20, 'EM200172', 0, 128.77, 0.00, 0.00, 0.00, '2037-02-05', '2037-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(173, 25, 20, 'EM200173', 0, 128.77, 0.00, 0.00, 0.00, '2037-03-05', '2037-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(174, 25, 20, 'EM200174', 0, 128.77, 0.00, 0.00, 0.00, '2037-04-05', '2037-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(175, 25, 20, 'EM200175', 0, 128.77, 0.00, 0.00, 0.00, '2037-05-05', '2037-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(176, 25, 20, 'EM200176', 0, 128.77, 0.00, 0.00, 0.00, '2037-06-05', '2037-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(177, 25, 20, 'EM200177', 0, 128.77, 0.00, 0.00, 0.00, '2037-07-05', '2037-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(178, 25, 20, 'EM200178', 0, 128.77, 0.00, 0.00, 0.00, '2037-08-05', '2037-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(179, 25, 20, 'EM200179', 0, 128.77, 0.00, 0.00, 0.00, '2037-09-05', '2037-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(180, 25, 20, 'EM200180', 0, 128.77, 0.00, 0.00, 0.00, '2037-10-05', '2037-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(181, 25, 20, 'EM200181', 0, 128.77, 0.00, 0.00, 0.00, '2037-11-05', '2037-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(182, 25, 20, 'EM200182', 0, 128.77, 0.00, 0.00, 0.00, '2037-12-05', '2037-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(183, 25, 20, 'EM200183', 0, 128.77, 0.00, 0.00, 0.00, '2038-01-05', '2038-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(184, 25, 20, 'EM200184', 0, 128.77, 0.00, 0.00, 0.00, '2038-02-05', '2038-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(185, 25, 20, 'EM200185', 0, 128.77, 0.00, 0.00, 0.00, '2038-03-05', '2038-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(186, 25, 20, 'EM200186', 0, 128.77, 0.00, 0.00, 0.00, '2038-04-05', '2038-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(187, 25, 20, 'EM200187', 0, 128.77, 0.00, 0.00, 0.00, '2038-05-05', '2038-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(188, 25, 20, 'EM200188', 0, 128.77, 0.00, 0.00, 0.00, '2038-06-05', '2038-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(189, 25, 20, 'EM200189', 0, 128.77, 0.00, 0.00, 0.00, '2038-07-05', '2038-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(190, 25, 20, 'EM200190', 0, 128.77, 0.00, 0.00, 0.00, '2038-08-05', '2038-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(191, 25, 20, 'EM200191', 0, 128.77, 0.00, 0.00, 0.00, '2038-09-05', '2038-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(192, 25, 20, 'EM200192', 0, 128.77, 0.00, 0.00, 0.00, '2038-10-05', '2038-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(193, 25, 20, 'EM200193', 0, 128.77, 0.00, 0.00, 0.00, '2038-11-05', '2038-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(194, 25, 20, 'EM200194', 0, 128.77, 0.00, 0.00, 0.00, '2038-12-05', '2038-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(195, 25, 20, 'EM200195', 0, 128.77, 0.00, 0.00, 0.00, '2039-01-05', '2039-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(196, 25, 20, 'EM200196', 0, 128.77, 0.00, 0.00, 0.00, '2039-02-05', '2039-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(197, 25, 20, 'EM200197', 0, 128.77, 0.00, 0.00, 0.00, '2039-03-05', '2039-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(198, 25, 20, 'EM200198', 0, 128.77, 0.00, 0.00, 0.00, '2039-04-05', '2039-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(199, 25, 20, 'EM200199', 0, 128.77, 0.00, 0.00, 0.00, '2039-05-05', '2039-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(200, 25, 20, 'EM200200', 0, 128.77, 0.00, 0.00, 0.00, '2039-06-05', '2039-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(201, 25, 20, 'EM200201', 0, 128.77, 0.00, 0.00, 0.00, '2039-07-05', '2039-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(202, 25, 20, 'EM200202', 0, 128.77, 0.00, 0.00, 0.00, '2039-08-05', '2039-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(203, 25, 20, 'EM200203', 0, 128.77, 0.00, 0.00, 0.00, '2039-09-05', '2039-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(204, 25, 20, 'EM200204', 0, 128.77, 0.00, 0.00, 0.00, '2039-10-05', '2039-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(205, 25, 20, 'EM200205', 0, 128.77, 0.00, 0.00, 0.00, '2039-11-05', '2039-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(206, 25, 20, 'EM200206', 0, 128.77, 0.00, 0.00, 0.00, '2039-12-05', '2039-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(207, 25, 20, 'EM200207', 0, 128.77, 0.00, 0.00, 0.00, '2040-01-05', '2040-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(208, 25, 20, 'EM200208', 0, 128.77, 0.00, 0.00, 0.00, '2040-02-05', '2040-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(209, 25, 20, 'EM200209', 0, 128.77, 0.00, 0.00, 0.00, '2040-03-05', '2040-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(210, 25, 20, 'EM200210', 0, 128.77, 0.00, 0.00, 0.00, '2040-04-05', '2040-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(211, 25, 20, 'EM200211', 0, 128.77, 0.00, 0.00, 0.00, '2040-05-05', '2040-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(212, 25, 20, 'EM200212', 0, 128.77, 0.00, 0.00, 0.00, '2040-06-05', '2040-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(213, 25, 20, 'EM200213', 0, 128.77, 0.00, 0.00, 0.00, '2040-07-05', '2040-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(214, 25, 20, 'EM200214', 0, 128.77, 0.00, 0.00, 0.00, '2040-08-05', '2040-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(215, 25, 20, 'EM200215', 0, 128.77, 0.00, 0.00, 0.00, '2040-09-05', '2040-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(216, 25, 20, 'EM200216', 0, 128.77, 0.00, 0.00, 0.00, '2040-10-05', '2040-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(217, 25, 20, 'EM200217', 0, 128.77, 0.00, 0.00, 0.00, '2040-11-05', '2040-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(218, 25, 20, 'EM200218', 0, 128.77, 0.00, 0.00, 0.00, '2040-12-05', '2040-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(219, 25, 20, 'EM200219', 0, 128.77, 0.00, 0.00, 0.00, '2041-01-05', '2041-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(220, 25, 20, 'EM200220', 0, 128.77, 0.00, 0.00, 0.00, '2041-02-05', '2041-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(221, 25, 20, 'EM200221', 0, 128.77, 0.00, 0.00, 0.00, '2041-03-05', '2041-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(222, 25, 20, 'EM200222', 0, 128.77, 0.00, 0.00, 0.00, '2041-04-05', '2041-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(223, 25, 20, 'EM200223', 0, 128.77, 0.00, 0.00, 0.00, '2041-05-05', '2041-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(224, 25, 20, 'EM200224', 0, 128.77, 0.00, 0.00, 0.00, '2041-06-05', '2041-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(225, 25, 20, 'EM200225', 0, 128.77, 0.00, 0.00, 0.00, '2041-07-05', '2041-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(226, 25, 20, 'EM200226', 0, 128.77, 0.00, 0.00, 0.00, '2041-08-05', '2041-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(227, 25, 20, 'EM200227', 0, 128.77, 0.00, 0.00, 0.00, '2041-09-05', '2041-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(228, 25, 20, 'EM200228', 0, 128.77, 0.00, 0.00, 0.00, '2041-10-05', '2041-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(229, 25, 20, 'EM200229', 0, 128.77, 0.00, 0.00, 0.00, '2041-11-05', '2041-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(230, 25, 20, 'EM200230', 0, 128.77, 0.00, 0.00, 0.00, '2041-12-05', '2041-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(231, 25, 20, 'EM200231', 0, 128.77, 0.00, 0.00, 0.00, '2042-01-05', '2042-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(232, 25, 20, 'EM200232', 0, 128.77, 0.00, 0.00, 0.00, '2042-02-05', '2042-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(233, 25, 20, 'EM200233', 0, 128.77, 0.00, 0.00, 0.00, '2042-03-05', '2042-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(234, 25, 20, 'EM200234', 0, 128.77, 0.00, 0.00, 0.00, '2042-04-05', '2042-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(235, 25, 20, 'EM200235', 0, 128.77, 0.00, 0.00, 0.00, '2042-05-05', '2042-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(236, 25, 20, 'EM200236', 0, 128.77, 0.00, 0.00, 0.00, '2042-06-05', '2042-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(237, 25, 20, 'EM200237', 0, 128.77, 0.00, 0.00, 0.00, '2042-07-05', '2042-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(238, 25, 20, 'EM200238', 0, 128.77, 0.00, 0.00, 0.00, '2042-08-05', '2042-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(239, 25, 20, 'EM200239', 0, 128.77, 0.00, 0.00, 0.00, '2042-09-05', '2042-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(240, 25, 20, 'EM200240', 0, 128.77, 0.00, 0.00, 0.00, '2042-10-05', '2042-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(241, 25, 20, 'EM200241', 0, 128.77, 0.00, 0.00, 0.00, '2042-11-05', '2042-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(242, 25, 20, 'EM200242', 0, 128.77, 0.00, 0.00, 0.00, '2042-12-05', '2042-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(243, 25, 20, 'EM200243', 0, 128.77, 0.00, 0.00, 0.00, '2043-01-05', '2043-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(244, 25, 20, 'EM200244', 0, 128.77, 0.00, 0.00, 0.00, '2043-02-05', '2043-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(245, 25, 20, 'EM200245', 0, 128.77, 0.00, 0.00, 0.00, '2043-03-05', '2043-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(246, 25, 20, 'EM200246', 0, 128.77, 0.00, 0.00, 0.00, '2043-04-05', '2043-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(247, 25, 20, 'EM200247', 0, 128.77, 0.00, 0.00, 0.00, '2043-05-05', '2043-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(248, 25, 20, 'EM200248', 0, 128.77, 0.00, 0.00, 0.00, '2043-06-05', '2043-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(249, 25, 20, 'EM200249', 0, 128.77, 0.00, 0.00, 0.00, '2043-07-05', '2043-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(250, 25, 20, 'EM200250', 0, 128.77, 0.00, 0.00, 0.00, '2043-08-05', '2043-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(251, 25, 20, 'EM200251', 0, 128.77, 0.00, 0.00, 0.00, '2043-09-05', '2043-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(252, 25, 20, 'EM200252', 0, 128.77, 0.00, 0.00, 0.00, '2043-10-05', '2043-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(253, 25, 20, 'EM200253', 0, 128.77, 0.00, 0.00, 0.00, '2043-11-05', '2043-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(254, 25, 20, 'EM200254', 0, 128.77, 0.00, 0.00, 0.00, '2043-12-05', '2043-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(255, 25, 20, 'EM200255', 0, 128.77, 0.00, 0.00, 0.00, '2044-01-05', '2044-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(256, 25, 20, 'EM200256', 0, 128.77, 0.00, 0.00, 0.00, '2044-02-05', '2044-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(257, 25, 20, 'EM200257', 0, 128.77, 0.00, 0.00, 0.00, '2044-03-05', '2044-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(258, 25, 20, 'EM200258', 0, 128.77, 0.00, 0.00, 0.00, '2044-04-05', '2044-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(259, 25, 20, 'EM200259', 0, 128.77, 0.00, 0.00, 0.00, '2044-05-05', '2044-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(260, 25, 20, 'EM200260', 0, 128.77, 0.00, 0.00, 0.00, '2044-06-05', '2044-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(261, 25, 20, 'EM200261', 0, 128.77, 0.00, 0.00, 0.00, '2044-07-05', '2044-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(262, 25, 20, 'EM200262', 0, 128.77, 0.00, 0.00, 0.00, '2044-08-05', '2044-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(263, 25, 20, 'EM200263', 0, 128.77, 0.00, 0.00, 0.00, '2044-09-05', '2044-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(264, 25, 20, 'EM200264', 0, 128.77, 0.00, 0.00, 0.00, '2044-10-05', '2044-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(265, 25, 20, 'EM200265', 0, 128.77, 0.00, 0.00, 0.00, '2044-11-05', '2044-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(266, 25, 20, 'EM200266', 0, 128.77, 0.00, 0.00, 0.00, '2044-12-05', '2044-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(267, 25, 20, 'EM200267', 0, 128.77, 0.00, 0.00, 0.00, '2045-01-05', '2045-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(268, 25, 20, 'EM200268', 0, 128.77, 0.00, 0.00, 0.00, '2045-02-05', '2045-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(269, 25, 20, 'EM200269', 0, 128.77, 0.00, 0.00, 0.00, '2045-03-05', '2045-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(270, 25, 20, 'EM200270', 0, 128.77, 0.00, 0.00, 0.00, '2045-04-05', '2045-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 05:33:32', '2022-10-06 05:33:32'),
(271, 26, 21, 'EM2101', 0, 1250.15, 0.00, 0.00, 0.00, '2022-11-05', '2022-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(272, 26, 21, 'EM2102', 0, 1250.15, 0.00, 0.00, 0.00, '2022-12-05', '2022-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(273, 26, 21, 'EM2103', 0, 1250.15, 0.00, 0.00, 0.00, '2023-01-05', '2023-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(274, 26, 21, 'EM2104', 0, 1250.15, 0.00, 0.00, 0.00, '2023-02-05', '2023-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(275, 26, 21, 'EM2105', 0, 1250.15, 0.00, 0.00, 0.00, '2023-03-05', '2023-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(276, 26, 21, 'EM2106', 0, 1250.15, 0.00, 0.00, 0.00, '2023-04-05', '2023-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(277, 26, 21, 'EM2107', 0, 1250.15, 0.00, 0.00, 0.00, '2023-05-05', '2023-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(278, 26, 21, 'EM2108', 0, 1250.15, 0.00, 0.00, 0.00, '2023-06-05', '2023-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(279, 26, 21, 'EM2109', 0, 1250.15, 0.00, 0.00, 0.00, '2023-07-05', '2023-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(280, 26, 21, 'EM21010', 0, 1250.15, 0.00, 0.00, 0.00, '2023-08-05', '2023-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(281, 26, 21, 'EM21011', 0, 1250.15, 0.00, 0.00, 0.00, '2023-09-05', '2023-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(282, 26, 21, 'EM21012', 0, 1250.15, 0.00, 0.00, 0.00, '2023-10-05', '2023-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(283, 26, 21, 'EM21013', 0, 1250.15, 0.00, 0.00, 0.00, '2023-11-05', '2023-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(284, 26, 21, 'EM21014', 0, 1250.15, 0.00, 0.00, 0.00, '2023-12-05', '2023-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(285, 26, 21, 'EM21015', 0, 1250.15, 0.00, 0.00, 0.00, '2024-01-05', '2024-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(286, 26, 21, 'EM21016', 0, 1250.15, 0.00, 0.00, 0.00, '2024-02-05', '2024-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(287, 26, 21, 'EM21017', 0, 1250.15, 0.00, 0.00, 0.00, '2024-03-05', '2024-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(288, 26, 21, 'EM21018', 0, 1250.15, 0.00, 0.00, 0.00, '2024-04-05', '2024-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(289, 26, 21, 'EM21019', 0, 1250.15, 0.00, 0.00, 0.00, '2024-05-05', '2024-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(290, 26, 21, 'EM21020', 0, 1250.15, 0.00, 0.00, 0.00, '2024-06-05', '2024-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(291, 26, 21, 'EM21021', 0, 1250.15, 0.00, 0.00, 0.00, '2024-07-05', '2024-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(292, 26, 21, 'EM21022', 0, 1250.15, 0.00, 0.00, 0.00, '2024-08-05', '2024-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(293, 26, 21, 'EM21023', 0, 1250.15, 0.00, 0.00, 0.00, '2024-09-05', '2024-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(294, 26, 21, 'EM21024', 0, 1250.15, 0.00, 0.00, 0.00, '2024-10-05', '2024-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(295, 26, 21, 'EM21025', 0, 1250.15, 0.00, 0.00, 0.00, '2024-11-05', '2024-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55');
INSERT INTO `loan_emi_details` (`id`, `userId`, `loanId`, `emiId`, `emiSr`, `emiAmount`, `interest`, `principle`, `balance`, `emiDate`, `emiDueDate`, `status`, `transactionId`, `payment_mode`, `transactionDate`, `lateCharges`, `remark`, `created_at`, `updated_at`) VALUES
(296, 26, 21, 'EM21026', 0, 1250.15, 0.00, 0.00, 0.00, '2024-12-05', '2024-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(297, 26, 21, 'EM21027', 0, 1250.15, 0.00, 0.00, 0.00, '2025-01-05', '2025-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(298, 26, 21, 'EM21028', 0, 1250.15, 0.00, 0.00, 0.00, '2025-02-05', '2025-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(299, 26, 21, 'EM21029', 0, 1250.15, 0.00, 0.00, 0.00, '2025-03-05', '2025-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(300, 26, 21, 'EM21030', 0, 1250.15, 0.00, 0.00, 0.00, '2025-04-05', '2025-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(301, 26, 21, 'EM21031', 0, 1250.15, 0.00, 0.00, 0.00, '2025-05-05', '2025-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(302, 26, 21, 'EM21032', 0, 1250.15, 0.00, 0.00, 0.00, '2025-06-05', '2025-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(303, 26, 21, 'EM21033', 0, 1250.15, 0.00, 0.00, 0.00, '2025-07-05', '2025-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(304, 26, 21, 'EM21034', 0, 1250.15, 0.00, 0.00, 0.00, '2025-08-05', '2025-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(305, 26, 21, 'EM21035', 0, 1250.15, 0.00, 0.00, 0.00, '2025-09-05', '2025-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(306, 26, 21, 'EM21036', 0, 1250.15, 0.00, 0.00, 0.00, '2025-10-05', '2025-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(307, 26, 21, 'EM21037', 0, 1250.15, 0.00, 0.00, 0.00, '2025-11-05', '2025-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(308, 26, 21, 'EM21038', 0, 1250.15, 0.00, 0.00, 0.00, '2025-12-05', '2025-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(309, 26, 21, 'EM21039', 0, 1250.15, 0.00, 0.00, 0.00, '2026-01-05', '2026-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(310, 26, 21, 'EM21040', 0, 1250.15, 0.00, 0.00, 0.00, '2026-02-05', '2026-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(311, 26, 21, 'EM21041', 0, 1250.15, 0.00, 0.00, 0.00, '2026-03-05', '2026-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(312, 26, 21, 'EM21042', 0, 1250.15, 0.00, 0.00, 0.00, '2026-04-05', '2026-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(313, 26, 21, 'EM21043', 0, 1250.15, 0.00, 0.00, 0.00, '2026-05-05', '2026-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(314, 26, 21, 'EM21044', 0, 1250.15, 0.00, 0.00, 0.00, '2026-06-05', '2026-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(315, 26, 21, 'EM21045', 0, 1250.15, 0.00, 0.00, 0.00, '2026-07-05', '2026-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(316, 26, 21, 'EM21046', 0, 1250.15, 0.00, 0.00, 0.00, '2026-08-05', '2026-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(317, 26, 21, 'EM21047', 0, 1250.15, 0.00, 0.00, 0.00, '2026-09-05', '2026-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(318, 26, 21, 'EM21048', 0, 1250.15, 0.00, 0.00, 0.00, '2026-10-05', '2026-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(319, 26, 21, 'EM21049', 0, 1250.15, 0.00, 0.00, 0.00, '2026-11-05', '2026-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(320, 26, 21, 'EM21050', 0, 1250.15, 0.00, 0.00, 0.00, '2026-12-05', '2026-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(321, 26, 21, 'EM21051', 0, 1250.15, 0.00, 0.00, 0.00, '2027-01-05', '2027-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(322, 26, 21, 'EM21052', 0, 1250.15, 0.00, 0.00, 0.00, '2027-02-05', '2027-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(323, 26, 21, 'EM21053', 0, 1250.15, 0.00, 0.00, 0.00, '2027-03-05', '2027-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(324, 26, 21, 'EM21054', 0, 1250.15, 0.00, 0.00, 0.00, '2027-04-05', '2027-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(325, 26, 21, 'EM21055', 0, 1250.15, 0.00, 0.00, 0.00, '2027-05-05', '2027-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(326, 26, 21, 'EM21056', 0, 1250.15, 0.00, 0.00, 0.00, '2027-06-05', '2027-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(327, 26, 21, 'EM21057', 0, 1250.15, 0.00, 0.00, 0.00, '2027-07-05', '2027-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(328, 26, 21, 'EM21058', 0, 1250.15, 0.00, 0.00, 0.00, '2027-08-05', '2027-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(329, 26, 21, 'EM21059', 0, 1250.15, 0.00, 0.00, 0.00, '2027-09-05', '2027-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(330, 26, 21, 'EM21060', 0, 1250.15, 0.00, 0.00, 0.00, '2027-10-05', '2027-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(331, 26, 21, 'EM21061', 0, 1250.15, 0.00, 0.00, 0.00, '2027-11-05', '2027-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(332, 26, 21, 'EM21062', 0, 1250.15, 0.00, 0.00, 0.00, '2027-12-05', '2027-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(333, 26, 21, 'EM21063', 0, 1250.15, 0.00, 0.00, 0.00, '2028-01-05', '2028-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(334, 26, 21, 'EM21064', 0, 1250.15, 0.00, 0.00, 0.00, '2028-02-05', '2028-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(335, 26, 21, 'EM21065', 0, 1250.15, 0.00, 0.00, 0.00, '2028-03-05', '2028-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(336, 26, 21, 'EM21066', 0, 1250.15, 0.00, 0.00, 0.00, '2028-04-05', '2028-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(337, 26, 21, 'EM21067', 0, 1250.15, 0.00, 0.00, 0.00, '2028-05-05', '2028-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(338, 26, 21, 'EM21068', 0, 1250.15, 0.00, 0.00, 0.00, '2028-06-05', '2028-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(339, 26, 21, 'EM21069', 0, 1250.15, 0.00, 0.00, 0.00, '2028-07-05', '2028-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(340, 26, 21, 'EM21070', 0, 1250.15, 0.00, 0.00, 0.00, '2028-08-05', '2028-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(341, 26, 21, 'EM21071', 0, 1250.15, 0.00, 0.00, 0.00, '2028-09-05', '2028-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(342, 26, 21, 'EM21072', 0, 1250.15, 0.00, 0.00, 0.00, '2028-10-05', '2028-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(343, 26, 21, 'EM21073', 0, 1250.15, 0.00, 0.00, 0.00, '2028-11-05', '2028-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(344, 26, 21, 'EM21074', 0, 1250.15, 0.00, 0.00, 0.00, '2028-12-05', '2028-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(345, 26, 21, 'EM21075', 0, 1250.15, 0.00, 0.00, 0.00, '2029-01-05', '2029-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(346, 26, 21, 'EM21076', 0, 1250.15, 0.00, 0.00, 0.00, '2029-02-05', '2029-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(347, 26, 21, 'EM21077', 0, 1250.15, 0.00, 0.00, 0.00, '2029-03-05', '2029-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(348, 26, 21, 'EM21078', 0, 1250.15, 0.00, 0.00, 0.00, '2029-04-05', '2029-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(349, 26, 21, 'EM21079', 0, 1250.15, 0.00, 0.00, 0.00, '2029-05-05', '2029-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(350, 26, 21, 'EM21080', 0, 1250.15, 0.00, 0.00, 0.00, '2029-06-05', '2029-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(351, 26, 21, 'EM21081', 0, 1250.15, 0.00, 0.00, 0.00, '2029-07-05', '2029-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(352, 26, 21, 'EM21082', 0, 1250.15, 0.00, 0.00, 0.00, '2029-08-05', '2029-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(353, 26, 21, 'EM21083', 0, 1250.15, 0.00, 0.00, 0.00, '2029-09-05', '2029-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(354, 26, 21, 'EM21084', 0, 1250.15, 0.00, 0.00, 0.00, '2029-10-05', '2029-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(355, 26, 21, 'EM21085', 0, 1250.15, 0.00, 0.00, 0.00, '2029-11-05', '2029-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(356, 26, 21, 'EM21086', 0, 1250.15, 0.00, 0.00, 0.00, '2029-12-05', '2029-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(357, 26, 21, 'EM21087', 0, 1250.15, 0.00, 0.00, 0.00, '2030-01-05', '2030-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(358, 26, 21, 'EM21088', 0, 1250.15, 0.00, 0.00, 0.00, '2030-02-05', '2030-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(359, 26, 21, 'EM21089', 0, 1250.15, 0.00, 0.00, 0.00, '2030-03-05', '2030-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(360, 26, 21, 'EM21090', 0, 1250.15, 0.00, 0.00, 0.00, '2030-04-05', '2030-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(361, 26, 21, 'EM21091', 0, 1250.15, 0.00, 0.00, 0.00, '2030-05-05', '2030-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(362, 26, 21, 'EM21092', 0, 1250.15, 0.00, 0.00, 0.00, '2030-06-05', '2030-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(363, 26, 21, 'EM21093', 0, 1250.15, 0.00, 0.00, 0.00, '2030-07-05', '2030-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(364, 26, 21, 'EM21094', 0, 1250.15, 0.00, 0.00, 0.00, '2030-08-05', '2030-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(365, 26, 21, 'EM21095', 0, 1250.15, 0.00, 0.00, 0.00, '2030-09-05', '2030-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(366, 26, 21, 'EM21096', 0, 1250.15, 0.00, 0.00, 0.00, '2030-10-05', '2030-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(367, 26, 21, 'EM21097', 0, 1250.15, 0.00, 0.00, 0.00, '2030-11-05', '2030-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(368, 26, 21, 'EM21098', 0, 1250.15, 0.00, 0.00, 0.00, '2030-12-05', '2030-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(369, 26, 21, 'EM21099', 0, 1250.15, 0.00, 0.00, 0.00, '2031-01-05', '2031-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(370, 26, 21, 'EM210100', 0, 1250.15, 0.00, 0.00, 0.00, '2031-02-05', '2031-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(371, 26, 21, 'EM210101', 0, 1250.15, 0.00, 0.00, 0.00, '2031-03-05', '2031-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(372, 26, 21, 'EM210102', 0, 1250.15, 0.00, 0.00, 0.00, '2031-04-05', '2031-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(373, 26, 21, 'EM210103', 0, 1250.15, 0.00, 0.00, 0.00, '2031-05-05', '2031-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(374, 26, 21, 'EM210104', 0, 1250.15, 0.00, 0.00, 0.00, '2031-06-05', '2031-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(375, 26, 21, 'EM210105', 0, 1250.15, 0.00, 0.00, 0.00, '2031-07-05', '2031-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(376, 26, 21, 'EM210106', 0, 1250.15, 0.00, 0.00, 0.00, '2031-08-05', '2031-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(377, 26, 21, 'EM210107', 0, 1250.15, 0.00, 0.00, 0.00, '2031-09-05', '2031-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(378, 26, 21, 'EM210108', 0, 1250.15, 0.00, 0.00, 0.00, '2031-10-05', '2031-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(379, 26, 21, 'EM210109', 0, 1250.15, 0.00, 0.00, 0.00, '2031-11-05', '2031-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(380, 26, 21, 'EM210110', 0, 1250.15, 0.00, 0.00, 0.00, '2031-12-05', '2031-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(381, 26, 21, 'EM210111', 0, 1250.15, 0.00, 0.00, 0.00, '2032-01-05', '2032-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(382, 26, 21, 'EM210112', 0, 1250.15, 0.00, 0.00, 0.00, '2032-02-05', '2032-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(383, 26, 21, 'EM210113', 0, 1250.15, 0.00, 0.00, 0.00, '2032-03-05', '2032-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(384, 26, 21, 'EM210114', 0, 1250.15, 0.00, 0.00, 0.00, '2032-04-05', '2032-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(385, 26, 21, 'EM210115', 0, 1250.15, 0.00, 0.00, 0.00, '2032-05-05', '2032-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(386, 26, 21, 'EM210116', 0, 1250.15, 0.00, 0.00, 0.00, '2032-06-05', '2032-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(387, 26, 21, 'EM210117', 0, 1250.15, 0.00, 0.00, 0.00, '2032-07-05', '2032-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(388, 26, 21, 'EM210118', 0, 1250.15, 0.00, 0.00, 0.00, '2032-08-05', '2032-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(389, 26, 21, 'EM210119', 0, 1250.15, 0.00, 0.00, 0.00, '2032-09-05', '2032-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(390, 26, 21, 'EM210120', 0, 1250.15, 0.00, 0.00, 0.00, '2032-10-05', '2032-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(391, 26, 21, 'EM210121', 0, 1250.15, 0.00, 0.00, 0.00, '2032-11-05', '2032-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(392, 26, 21, 'EM210122', 0, 1250.15, 0.00, 0.00, 0.00, '2032-12-05', '2032-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(393, 26, 21, 'EM210123', 0, 1250.15, 0.00, 0.00, 0.00, '2033-01-05', '2033-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(394, 26, 21, 'EM210124', 0, 1250.15, 0.00, 0.00, 0.00, '2033-02-05', '2033-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(395, 26, 21, 'EM210125', 0, 1250.15, 0.00, 0.00, 0.00, '2033-03-05', '2033-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(396, 26, 21, 'EM210126', 0, 1250.15, 0.00, 0.00, 0.00, '2033-04-05', '2033-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(397, 26, 21, 'EM210127', 0, 1250.15, 0.00, 0.00, 0.00, '2033-05-05', '2033-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(398, 26, 21, 'EM210128', 0, 1250.15, 0.00, 0.00, 0.00, '2033-06-05', '2033-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(399, 26, 21, 'EM210129', 0, 1250.15, 0.00, 0.00, 0.00, '2033-07-05', '2033-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(400, 26, 21, 'EM210130', 0, 1250.15, 0.00, 0.00, 0.00, '2033-08-05', '2033-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(401, 26, 21, 'EM210131', 0, 1250.15, 0.00, 0.00, 0.00, '2033-09-05', '2033-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(402, 26, 21, 'EM210132', 0, 1250.15, 0.00, 0.00, 0.00, '2033-10-05', '2033-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(403, 26, 21, 'EM210133', 0, 1250.15, 0.00, 0.00, 0.00, '2033-11-05', '2033-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(404, 26, 21, 'EM210134', 0, 1250.15, 0.00, 0.00, 0.00, '2033-12-05', '2033-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(405, 26, 21, 'EM210135', 0, 1250.15, 0.00, 0.00, 0.00, '2034-01-05', '2034-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(406, 26, 21, 'EM210136', 0, 1250.15, 0.00, 0.00, 0.00, '2034-02-05', '2034-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(407, 26, 21, 'EM210137', 0, 1250.15, 0.00, 0.00, 0.00, '2034-03-05', '2034-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(408, 26, 21, 'EM210138', 0, 1250.15, 0.00, 0.00, 0.00, '2034-04-05', '2034-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(409, 26, 21, 'EM210139', 0, 1250.15, 0.00, 0.00, 0.00, '2034-05-05', '2034-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(410, 26, 21, 'EM210140', 0, 1250.15, 0.00, 0.00, 0.00, '2034-06-05', '2034-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(411, 26, 21, 'EM210141', 0, 1250.15, 0.00, 0.00, 0.00, '2034-07-05', '2034-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(412, 26, 21, 'EM210142', 0, 1250.15, 0.00, 0.00, 0.00, '2034-08-05', '2034-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(413, 26, 21, 'EM210143', 0, 1250.15, 0.00, 0.00, 0.00, '2034-09-05', '2034-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(414, 26, 21, 'EM210144', 0, 1250.15, 0.00, 0.00, 0.00, '2034-10-05', '2034-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(415, 26, 21, 'EM210145', 0, 1250.15, 0.00, 0.00, 0.00, '2034-11-05', '2034-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(416, 26, 21, 'EM210146', 0, 1250.15, 0.00, 0.00, 0.00, '2034-12-05', '2034-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(417, 26, 21, 'EM210147', 0, 1250.15, 0.00, 0.00, 0.00, '2035-01-05', '2035-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(418, 26, 21, 'EM210148', 0, 1250.15, 0.00, 0.00, 0.00, '2035-02-05', '2035-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(419, 26, 21, 'EM210149', 0, 1250.15, 0.00, 0.00, 0.00, '2035-03-05', '2035-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(420, 26, 21, 'EM210150', 0, 1250.15, 0.00, 0.00, 0.00, '2035-04-05', '2035-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(421, 26, 21, 'EM210151', 0, 1250.15, 0.00, 0.00, 0.00, '2035-05-05', '2035-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(422, 26, 21, 'EM210152', 0, 1250.15, 0.00, 0.00, 0.00, '2035-06-05', '2035-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(423, 26, 21, 'EM210153', 0, 1250.15, 0.00, 0.00, 0.00, '2035-07-05', '2035-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(424, 26, 21, 'EM210154', 0, 1250.15, 0.00, 0.00, 0.00, '2035-08-05', '2035-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(425, 26, 21, 'EM210155', 0, 1250.15, 0.00, 0.00, 0.00, '2035-09-05', '2035-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(426, 26, 21, 'EM210156', 0, 1250.15, 0.00, 0.00, 0.00, '2035-10-05', '2035-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(427, 26, 21, 'EM210157', 0, 1250.15, 0.00, 0.00, 0.00, '2035-11-05', '2035-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(428, 26, 21, 'EM210158', 0, 1250.15, 0.00, 0.00, 0.00, '2035-12-05', '2035-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(429, 26, 21, 'EM210159', 0, 1250.15, 0.00, 0.00, 0.00, '2036-01-05', '2036-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(430, 26, 21, 'EM210160', 0, 1250.15, 0.00, 0.00, 0.00, '2036-02-05', '2036-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(431, 26, 21, 'EM210161', 0, 1250.15, 0.00, 0.00, 0.00, '2036-03-05', '2036-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(432, 26, 21, 'EM210162', 0, 1250.15, 0.00, 0.00, 0.00, '2036-04-05', '2036-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(433, 26, 21, 'EM210163', 0, 1250.15, 0.00, 0.00, 0.00, '2036-05-05', '2036-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(434, 26, 21, 'EM210164', 0, 1250.15, 0.00, 0.00, 0.00, '2036-06-05', '2036-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(435, 26, 21, 'EM210165', 0, 1250.15, 0.00, 0.00, 0.00, '2036-07-05', '2036-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(436, 26, 21, 'EM210166', 0, 1250.15, 0.00, 0.00, 0.00, '2036-08-05', '2036-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(437, 26, 21, 'EM210167', 0, 1250.15, 0.00, 0.00, 0.00, '2036-09-05', '2036-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(438, 26, 21, 'EM210168', 0, 1250.15, 0.00, 0.00, 0.00, '2036-10-05', '2036-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(439, 26, 21, 'EM210169', 0, 1250.15, 0.00, 0.00, 0.00, '2036-11-05', '2036-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(440, 26, 21, 'EM210170', 0, 1250.15, 0.00, 0.00, 0.00, '2036-12-05', '2036-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(441, 26, 21, 'EM210171', 0, 1250.15, 0.00, 0.00, 0.00, '2037-01-05', '2037-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(442, 26, 21, 'EM210172', 0, 1250.15, 0.00, 0.00, 0.00, '2037-02-05', '2037-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(443, 26, 21, 'EM210173', 0, 1250.15, 0.00, 0.00, 0.00, '2037-03-05', '2037-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(444, 26, 21, 'EM210174', 0, 1250.15, 0.00, 0.00, 0.00, '2037-04-05', '2037-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(445, 26, 21, 'EM210175', 0, 1250.15, 0.00, 0.00, 0.00, '2037-05-05', '2037-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(446, 26, 21, 'EM210176', 0, 1250.15, 0.00, 0.00, 0.00, '2037-06-05', '2037-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(447, 26, 21, 'EM210177', 0, 1250.15, 0.00, 0.00, 0.00, '2037-07-05', '2037-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(448, 26, 21, 'EM210178', 0, 1250.15, 0.00, 0.00, 0.00, '2037-08-05', '2037-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(449, 26, 21, 'EM210179', 0, 1250.15, 0.00, 0.00, 0.00, '2037-09-05', '2037-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(450, 26, 21, 'EM210180', 0, 1250.15, 0.00, 0.00, 0.00, '2037-10-05', '2037-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(451, 26, 21, 'EM210181', 0, 1250.15, 0.00, 0.00, 0.00, '2037-11-05', '2037-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(452, 26, 21, 'EM210182', 0, 1250.15, 0.00, 0.00, 0.00, '2037-12-05', '2037-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(453, 26, 21, 'EM210183', 0, 1250.15, 0.00, 0.00, 0.00, '2038-01-05', '2038-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(454, 26, 21, 'EM210184', 0, 1250.15, 0.00, 0.00, 0.00, '2038-02-05', '2038-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(455, 26, 21, 'EM210185', 0, 1250.15, 0.00, 0.00, 0.00, '2038-03-05', '2038-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(456, 26, 21, 'EM210186', 0, 1250.15, 0.00, 0.00, 0.00, '2038-04-05', '2038-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(457, 26, 21, 'EM210187', 0, 1250.15, 0.00, 0.00, 0.00, '2038-05-05', '2038-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(458, 26, 21, 'EM210188', 0, 1250.15, 0.00, 0.00, 0.00, '2038-06-05', '2038-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(459, 26, 21, 'EM210189', 0, 1250.15, 0.00, 0.00, 0.00, '2038-07-05', '2038-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(460, 26, 21, 'EM210190', 0, 1250.15, 0.00, 0.00, 0.00, '2038-08-05', '2038-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(461, 26, 21, 'EM210191', 0, 1250.15, 0.00, 0.00, 0.00, '2038-09-05', '2038-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(462, 26, 21, 'EM210192', 0, 1250.15, 0.00, 0.00, 0.00, '2038-10-05', '2038-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(463, 26, 21, 'EM210193', 0, 1250.15, 0.00, 0.00, 0.00, '2038-11-05', '2038-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(464, 26, 21, 'EM210194', 0, 1250.15, 0.00, 0.00, 0.00, '2038-12-05', '2038-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(465, 26, 21, 'EM210195', 0, 1250.15, 0.00, 0.00, 0.00, '2039-01-05', '2039-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(466, 26, 21, 'EM210196', 0, 1250.15, 0.00, 0.00, 0.00, '2039-02-05', '2039-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(467, 26, 21, 'EM210197', 0, 1250.15, 0.00, 0.00, 0.00, '2039-03-05', '2039-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(468, 26, 21, 'EM210198', 0, 1250.15, 0.00, 0.00, 0.00, '2039-04-05', '2039-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(469, 26, 21, 'EM210199', 0, 1250.15, 0.00, 0.00, 0.00, '2039-05-05', '2039-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(470, 26, 21, 'EM210200', 0, 1250.15, 0.00, 0.00, 0.00, '2039-06-05', '2039-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(471, 26, 21, 'EM210201', 0, 1250.15, 0.00, 0.00, 0.00, '2039-07-05', '2039-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(472, 26, 21, 'EM210202', 0, 1250.15, 0.00, 0.00, 0.00, '2039-08-05', '2039-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(473, 26, 21, 'EM210203', 0, 1250.15, 0.00, 0.00, 0.00, '2039-09-05', '2039-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(474, 26, 21, 'EM210204', 0, 1250.15, 0.00, 0.00, 0.00, '2039-10-05', '2039-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(475, 26, 21, 'EM210205', 0, 1250.15, 0.00, 0.00, 0.00, '2039-11-05', '2039-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(476, 26, 21, 'EM210206', 0, 1250.15, 0.00, 0.00, 0.00, '2039-12-05', '2039-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(477, 26, 21, 'EM210207', 0, 1250.15, 0.00, 0.00, 0.00, '2040-01-05', '2040-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:55', '2022-10-06 06:05:55'),
(478, 26, 21, 'EM210208', 0, 1250.15, 0.00, 0.00, 0.00, '2040-02-05', '2040-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(479, 26, 21, 'EM210209', 0, 1250.15, 0.00, 0.00, 0.00, '2040-03-05', '2040-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(480, 26, 21, 'EM210210', 0, 1250.15, 0.00, 0.00, 0.00, '2040-04-05', '2040-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(481, 26, 21, 'EM210211', 0, 1250.15, 0.00, 0.00, 0.00, '2040-05-05', '2040-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(482, 26, 21, 'EM210212', 0, 1250.15, 0.00, 0.00, 0.00, '2040-06-05', '2040-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(483, 26, 21, 'EM210213', 0, 1250.15, 0.00, 0.00, 0.00, '2040-07-05', '2040-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(484, 26, 21, 'EM210214', 0, 1250.15, 0.00, 0.00, 0.00, '2040-08-05', '2040-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(485, 26, 21, 'EM210215', 0, 1250.15, 0.00, 0.00, 0.00, '2040-09-05', '2040-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(486, 26, 21, 'EM210216', 0, 1250.15, 0.00, 0.00, 0.00, '2040-10-05', '2040-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(487, 26, 21, 'EM210217', 0, 1250.15, 0.00, 0.00, 0.00, '2040-11-05', '2040-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(488, 26, 21, 'EM210218', 0, 1250.15, 0.00, 0.00, 0.00, '2040-12-05', '2040-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(489, 26, 21, 'EM210219', 0, 1250.15, 0.00, 0.00, 0.00, '2041-01-05', '2041-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(490, 26, 21, 'EM210220', 0, 1250.15, 0.00, 0.00, 0.00, '2041-02-05', '2041-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(491, 26, 21, 'EM210221', 0, 1250.15, 0.00, 0.00, 0.00, '2041-03-05', '2041-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(492, 26, 21, 'EM210222', 0, 1250.15, 0.00, 0.00, 0.00, '2041-04-05', '2041-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(493, 26, 21, 'EM210223', 0, 1250.15, 0.00, 0.00, 0.00, '2041-05-05', '2041-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(494, 26, 21, 'EM210224', 0, 1250.15, 0.00, 0.00, 0.00, '2041-06-05', '2041-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(495, 26, 21, 'EM210225', 0, 1250.15, 0.00, 0.00, 0.00, '2041-07-05', '2041-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(496, 26, 21, 'EM210226', 0, 1250.15, 0.00, 0.00, 0.00, '2041-08-05', '2041-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(497, 26, 21, 'EM210227', 0, 1250.15, 0.00, 0.00, 0.00, '2041-09-05', '2041-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(498, 26, 21, 'EM210228', 0, 1250.15, 0.00, 0.00, 0.00, '2041-10-05', '2041-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(499, 26, 21, 'EM210229', 0, 1250.15, 0.00, 0.00, 0.00, '2041-11-05', '2041-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(500, 26, 21, 'EM210230', 0, 1250.15, 0.00, 0.00, 0.00, '2041-12-05', '2041-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(501, 26, 21, 'EM210231', 0, 1250.15, 0.00, 0.00, 0.00, '2042-01-05', '2042-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(502, 26, 21, 'EM210232', 0, 1250.15, 0.00, 0.00, 0.00, '2042-02-05', '2042-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(503, 26, 21, 'EM210233', 0, 1250.15, 0.00, 0.00, 0.00, '2042-03-05', '2042-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(504, 26, 21, 'EM210234', 0, 1250.15, 0.00, 0.00, 0.00, '2042-04-05', '2042-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(505, 26, 21, 'EM210235', 0, 1250.15, 0.00, 0.00, 0.00, '2042-05-05', '2042-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(506, 26, 21, 'EM210236', 0, 1250.15, 0.00, 0.00, 0.00, '2042-06-05', '2042-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(507, 26, 21, 'EM210237', 0, 1250.15, 0.00, 0.00, 0.00, '2042-07-05', '2042-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(508, 26, 21, 'EM210238', 0, 1250.15, 0.00, 0.00, 0.00, '2042-08-05', '2042-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(509, 26, 21, 'EM210239', 0, 1250.15, 0.00, 0.00, 0.00, '2042-09-05', '2042-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(510, 26, 21, 'EM210240', 0, 1250.15, 0.00, 0.00, 0.00, '2042-10-05', '2042-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(511, 26, 21, 'EM210241', 0, 1250.15, 0.00, 0.00, 0.00, '2042-11-05', '2042-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(512, 26, 21, 'EM210242', 0, 1250.15, 0.00, 0.00, 0.00, '2042-12-05', '2042-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(513, 26, 21, 'EM210243', 0, 1250.15, 0.00, 0.00, 0.00, '2043-01-05', '2043-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(514, 26, 21, 'EM210244', 0, 1250.15, 0.00, 0.00, 0.00, '2043-02-05', '2043-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(515, 26, 21, 'EM210245', 0, 1250.15, 0.00, 0.00, 0.00, '2043-03-05', '2043-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(516, 26, 21, 'EM210246', 0, 1250.15, 0.00, 0.00, 0.00, '2043-04-05', '2043-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(517, 26, 21, 'EM210247', 0, 1250.15, 0.00, 0.00, 0.00, '2043-05-05', '2043-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(518, 26, 21, 'EM210248', 0, 1250.15, 0.00, 0.00, 0.00, '2043-06-05', '2043-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(519, 26, 21, 'EM210249', 0, 1250.15, 0.00, 0.00, 0.00, '2043-07-05', '2043-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(520, 26, 21, 'EM210250', 0, 1250.15, 0.00, 0.00, 0.00, '2043-08-05', '2043-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(521, 26, 21, 'EM210251', 0, 1250.15, 0.00, 0.00, 0.00, '2043-09-05', '2043-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(522, 26, 21, 'EM210252', 0, 1250.15, 0.00, 0.00, 0.00, '2043-10-05', '2043-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(523, 26, 21, 'EM210253', 0, 1250.15, 0.00, 0.00, 0.00, '2043-11-05', '2043-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(524, 26, 21, 'EM210254', 0, 1250.15, 0.00, 0.00, 0.00, '2043-12-05', '2043-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(525, 26, 21, 'EM210255', 0, 1250.15, 0.00, 0.00, 0.00, '2044-01-05', '2044-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(526, 26, 21, 'EM210256', 0, 1250.15, 0.00, 0.00, 0.00, '2044-02-05', '2044-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(527, 26, 21, 'EM210257', 0, 1250.15, 0.00, 0.00, 0.00, '2044-03-05', '2044-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(528, 26, 21, 'EM210258', 0, 1250.15, 0.00, 0.00, 0.00, '2044-04-05', '2044-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(529, 26, 21, 'EM210259', 0, 1250.15, 0.00, 0.00, 0.00, '2044-05-05', '2044-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(530, 26, 21, 'EM210260', 0, 1250.15, 0.00, 0.00, 0.00, '2044-06-05', '2044-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(531, 26, 21, 'EM210261', 0, 1250.15, 0.00, 0.00, 0.00, '2044-07-05', '2044-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(532, 26, 21, 'EM210262', 0, 1250.15, 0.00, 0.00, 0.00, '2044-08-05', '2044-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(533, 26, 21, 'EM210263', 0, 1250.15, 0.00, 0.00, 0.00, '2044-09-05', '2044-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(534, 26, 21, 'EM210264', 0, 1250.15, 0.00, 0.00, 0.00, '2044-10-05', '2044-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(535, 26, 21, 'EM210265', 0, 1250.15, 0.00, 0.00, 0.00, '2044-11-05', '2044-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(536, 26, 21, 'EM210266', 0, 1250.15, 0.00, 0.00, 0.00, '2044-12-05', '2044-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(537, 26, 21, 'EM210267', 0, 1250.15, 0.00, 0.00, 0.00, '2045-01-05', '2045-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(538, 26, 21, 'EM210268', 0, 1250.15, 0.00, 0.00, 0.00, '2045-02-05', '2045-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(539, 26, 21, 'EM210269', 0, 1250.15, 0.00, 0.00, 0.00, '2045-03-05', '2045-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(540, 26, 21, 'EM210270', 0, 1250.15, 0.00, 0.00, 0.00, '2045-04-05', '2045-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(541, 26, 21, 'EM210271', 0, 1250.15, 0.00, 0.00, 0.00, '2045-05-05', '2045-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(542, 26, 21, 'EM210272', 0, 1250.15, 0.00, 0.00, 0.00, '2045-06-05', '2045-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(543, 26, 21, 'EM210273', 0, 1250.15, 0.00, 0.00, 0.00, '2045-07-05', '2045-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(544, 26, 21, 'EM210274', 0, 1250.15, 0.00, 0.00, 0.00, '2045-08-05', '2045-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(545, 26, 21, 'EM210275', 0, 1250.15, 0.00, 0.00, 0.00, '2045-09-05', '2045-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(546, 26, 21, 'EM210276', 0, 1250.15, 0.00, 0.00, 0.00, '2045-10-05', '2045-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(547, 26, 21, 'EM210277', 0, 1250.15, 0.00, 0.00, 0.00, '2045-11-05', '2045-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(548, 26, 21, 'EM210278', 0, 1250.15, 0.00, 0.00, 0.00, '2045-12-05', '2045-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(549, 26, 21, 'EM210279', 0, 1250.15, 0.00, 0.00, 0.00, '2046-01-05', '2046-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(550, 26, 21, 'EM210280', 0, 1250.15, 0.00, 0.00, 0.00, '2046-02-05', '2046-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(551, 26, 21, 'EM210281', 0, 1250.15, 0.00, 0.00, 0.00, '2046-03-05', '2046-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(552, 26, 21, 'EM210282', 0, 1250.15, 0.00, 0.00, 0.00, '2046-04-05', '2046-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(553, 26, 21, 'EM210283', 0, 1250.15, 0.00, 0.00, 0.00, '2046-05-05', '2046-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(554, 26, 21, 'EM210284', 0, 1250.15, 0.00, 0.00, 0.00, '2046-06-05', '2046-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(555, 26, 21, 'EM210285', 0, 1250.15, 0.00, 0.00, 0.00, '2046-07-05', '2046-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(556, 26, 21, 'EM210286', 0, 1250.15, 0.00, 0.00, 0.00, '2046-08-05', '2046-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(557, 26, 21, 'EM210287', 0, 1250.15, 0.00, 0.00, 0.00, '2046-09-05', '2046-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(558, 26, 21, 'EM210288', 0, 1250.15, 0.00, 0.00, 0.00, '2046-10-05', '2046-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(559, 26, 21, 'EM210289', 0, 1250.15, 0.00, 0.00, 0.00, '2046-11-05', '2046-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(560, 26, 21, 'EM210290', 0, 1250.15, 0.00, 0.00, 0.00, '2046-12-05', '2046-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(561, 26, 21, 'EM210291', 0, 1250.15, 0.00, 0.00, 0.00, '2047-01-05', '2047-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(562, 26, 21, 'EM210292', 0, 1250.15, 0.00, 0.00, 0.00, '2047-02-05', '2047-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(563, 26, 21, 'EM210293', 0, 1250.15, 0.00, 0.00, 0.00, '2047-03-05', '2047-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(564, 26, 21, 'EM210294', 0, 1250.15, 0.00, 0.00, 0.00, '2047-04-05', '2047-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(565, 26, 21, 'EM210295', 0, 1250.15, 0.00, 0.00, 0.00, '2047-05-05', '2047-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(566, 26, 21, 'EM210296', 0, 1250.15, 0.00, 0.00, 0.00, '2047-06-05', '2047-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(567, 26, 21, 'EM210297', 0, 1250.15, 0.00, 0.00, 0.00, '2047-07-05', '2047-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(568, 26, 21, 'EM210298', 0, 1250.15, 0.00, 0.00, 0.00, '2047-08-05', '2047-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(569, 26, 21, 'EM210299', 0, 1250.15, 0.00, 0.00, 0.00, '2047-09-05', '2047-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(570, 26, 21, 'EM210300', 0, 1250.15, 0.00, 0.00, 0.00, '2047-10-05', '2047-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(571, 26, 21, 'EM210301', 0, 1250.15, 0.00, 0.00, 0.00, '2047-11-05', '2047-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(572, 26, 21, 'EM210302', 0, 1250.15, 0.00, 0.00, 0.00, '2047-12-05', '2047-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(573, 26, 21, 'EM210303', 0, 1250.15, 0.00, 0.00, 0.00, '2048-01-05', '2048-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(574, 26, 21, 'EM210304', 0, 1250.15, 0.00, 0.00, 0.00, '2048-02-05', '2048-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(575, 26, 21, 'EM210305', 0, 1250.15, 0.00, 0.00, 0.00, '2048-03-05', '2048-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(576, 26, 21, 'EM210306', 0, 1250.15, 0.00, 0.00, 0.00, '2048-04-05', '2048-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(577, 26, 21, 'EM210307', 0, 1250.15, 0.00, 0.00, 0.00, '2048-05-05', '2048-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(578, 26, 21, 'EM210308', 0, 1250.15, 0.00, 0.00, 0.00, '2048-06-05', '2048-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(579, 26, 21, 'EM210309', 0, 1250.15, 0.00, 0.00, 0.00, '2048-07-05', '2048-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(580, 26, 21, 'EM210310', 0, 1250.15, 0.00, 0.00, 0.00, '2048-08-05', '2048-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(581, 26, 21, 'EM210311', 0, 1250.15, 0.00, 0.00, 0.00, '2048-09-05', '2048-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(582, 26, 21, 'EM210312', 0, 1250.15, 0.00, 0.00, 0.00, '2048-10-05', '2048-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(583, 26, 21, 'EM210313', 0, 1250.15, 0.00, 0.00, 0.00, '2048-11-05', '2048-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(584, 26, 21, 'EM210314', 0, 1250.15, 0.00, 0.00, 0.00, '2048-12-05', '2048-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(585, 26, 21, 'EM210315', 0, 1250.15, 0.00, 0.00, 0.00, '2049-01-05', '2049-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(586, 26, 21, 'EM210316', 0, 1250.15, 0.00, 0.00, 0.00, '2049-02-05', '2049-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(587, 26, 21, 'EM210317', 0, 1250.15, 0.00, 0.00, 0.00, '2049-03-05', '2049-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56');
INSERT INTO `loan_emi_details` (`id`, `userId`, `loanId`, `emiId`, `emiSr`, `emiAmount`, `interest`, `principle`, `balance`, `emiDate`, `emiDueDate`, `status`, `transactionId`, `payment_mode`, `transactionDate`, `lateCharges`, `remark`, `created_at`, `updated_at`) VALUES
(588, 26, 21, 'EM210318', 0, 1250.15, 0.00, 0.00, 0.00, '2049-04-05', '2049-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(589, 26, 21, 'EM210319', 0, 1250.15, 0.00, 0.00, 0.00, '2049-05-05', '2049-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(590, 26, 21, 'EM210320', 0, 1250.15, 0.00, 0.00, 0.00, '2049-06-05', '2049-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(591, 26, 21, 'EM210321', 0, 1250.15, 0.00, 0.00, 0.00, '2049-07-05', '2049-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(592, 26, 21, 'EM210322', 0, 1250.15, 0.00, 0.00, 0.00, '2049-08-05', '2049-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(593, 26, 21, 'EM210323', 0, 1250.15, 0.00, 0.00, 0.00, '2049-09-05', '2049-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(594, 26, 21, 'EM210324', 0, 1250.15, 0.00, 0.00, 0.00, '2049-10-05', '2049-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(595, 26, 21, 'EM210325', 0, 1250.15, 0.00, 0.00, 0.00, '2049-11-05', '2049-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(596, 26, 21, 'EM210326', 0, 1250.15, 0.00, 0.00, 0.00, '2049-12-05', '2049-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(597, 26, 21, 'EM210327', 0, 1250.15, 0.00, 0.00, 0.00, '2050-01-05', '2050-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(598, 26, 21, 'EM210328', 0, 1250.15, 0.00, 0.00, 0.00, '2050-02-05', '2050-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(599, 26, 21, 'EM210329', 0, 1250.15, 0.00, 0.00, 0.00, '2050-03-05', '2050-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(600, 26, 21, 'EM210330', 0, 1250.15, 0.00, 0.00, 0.00, '2050-04-05', '2050-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(601, 26, 21, 'EM210331', 0, 1250.15, 0.00, 0.00, 0.00, '2050-05-05', '2050-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(602, 26, 21, 'EM210332', 0, 1250.15, 0.00, 0.00, 0.00, '2050-06-05', '2050-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(603, 26, 21, 'EM210333', 0, 1250.15, 0.00, 0.00, 0.00, '2050-07-05', '2050-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(604, 26, 21, 'EM210334', 0, 1250.15, 0.00, 0.00, 0.00, '2050-08-05', '2050-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(605, 26, 21, 'EM210335', 0, 1250.15, 0.00, 0.00, 0.00, '2050-09-05', '2050-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(606, 26, 21, 'EM210336', 0, 1250.15, 0.00, 0.00, 0.00, '2050-10-05', '2050-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(607, 26, 21, 'EM210337', 0, 1250.15, 0.00, 0.00, 0.00, '2050-11-05', '2050-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(608, 26, 21, 'EM210338', 0, 1250.15, 0.00, 0.00, 0.00, '2050-12-05', '2050-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(609, 26, 21, 'EM210339', 0, 1250.15, 0.00, 0.00, 0.00, '2051-01-05', '2051-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(610, 26, 21, 'EM210340', 0, 1250.15, 0.00, 0.00, 0.00, '2051-02-05', '2051-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(611, 26, 21, 'EM210341', 0, 1250.15, 0.00, 0.00, 0.00, '2051-03-05', '2051-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(612, 26, 21, 'EM210342', 0, 1250.15, 0.00, 0.00, 0.00, '2051-04-05', '2051-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(613, 26, 21, 'EM210343', 0, 1250.15, 0.00, 0.00, 0.00, '2051-05-05', '2051-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(614, 26, 21, 'EM210344', 0, 1250.15, 0.00, 0.00, 0.00, '2051-06-05', '2051-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(615, 26, 21, 'EM210345', 0, 1250.15, 0.00, 0.00, 0.00, '2051-07-05', '2051-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(616, 26, 21, 'EM210346', 0, 1250.15, 0.00, 0.00, 0.00, '2051-08-05', '2051-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(617, 26, 21, 'EM210347', 0, 1250.15, 0.00, 0.00, 0.00, '2051-09-05', '2051-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(618, 26, 21, 'EM210348', 0, 1250.15, 0.00, 0.00, 0.00, '2051-10-05', '2051-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(619, 26, 21, 'EM210349', 0, 1250.15, 0.00, 0.00, 0.00, '2051-11-05', '2051-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(620, 26, 21, 'EM210350', 0, 1250.15, 0.00, 0.00, 0.00, '2051-12-05', '2051-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(621, 26, 21, 'EM210351', 0, 1250.15, 0.00, 0.00, 0.00, '2052-01-05', '2052-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(622, 26, 21, 'EM210352', 0, 1250.15, 0.00, 0.00, 0.00, '2052-02-05', '2052-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(623, 26, 21, 'EM210353', 0, 1250.15, 0.00, 0.00, 0.00, '2052-03-05', '2052-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(624, 26, 21, 'EM210354', 0, 1250.15, 0.00, 0.00, 0.00, '2052-04-05', '2052-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(625, 26, 21, 'EM210355', 0, 1250.15, 0.00, 0.00, 0.00, '2052-05-05', '2052-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(626, 26, 21, 'EM210356', 0, 1250.15, 0.00, 0.00, 0.00, '2052-06-05', '2052-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(627, 26, 21, 'EM210357', 0, 1250.15, 0.00, 0.00, 0.00, '2052-07-05', '2052-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(628, 26, 21, 'EM210358', 0, 1250.15, 0.00, 0.00, 0.00, '2052-08-05', '2052-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(629, 26, 21, 'EM210359', 0, 1250.15, 0.00, 0.00, 0.00, '2052-09-05', '2052-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(630, 26, 21, 'EM210360', 0, 1250.15, 0.00, 0.00, 0.00, '2052-10-05', '2052-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(631, 26, 21, 'EM210361', 0, 1250.15, 0.00, 0.00, 0.00, '2052-11-05', '2052-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(632, 26, 21, 'EM210362', 0, 1250.15, 0.00, 0.00, 0.00, '2052-12-05', '2052-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(633, 26, 21, 'EM210363', 0, 1250.15, 0.00, 0.00, 0.00, '2053-01-05', '2053-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(634, 26, 21, 'EM210364', 0, 1250.15, 0.00, 0.00, 0.00, '2053-02-05', '2053-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(635, 26, 21, 'EM210365', 0, 1250.15, 0.00, 0.00, 0.00, '2053-03-05', '2053-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 06:05:56', '2022-10-06 06:05:56'),
(636, 28, 24, 'EM2401', 0, 579.75, 0.00, 0.00, 0.00, '2022-11-05', '2022-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(637, 28, 24, 'EM2402', 0, 579.75, 0.00, 0.00, 0.00, '2022-12-05', '2022-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(638, 28, 24, 'EM2403', 0, 579.75, 0.00, 0.00, 0.00, '2023-01-05', '2023-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(639, 28, 24, 'EM2404', 0, 579.75, 0.00, 0.00, 0.00, '2023-02-05', '2023-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(640, 28, 24, 'EM2405', 0, 579.75, 0.00, 0.00, 0.00, '2023-03-05', '2023-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(641, 28, 24, 'EM2406', 0, 579.75, 0.00, 0.00, 0.00, '2023-04-05', '2023-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(642, 28, 24, 'EM2407', 0, 579.75, 0.00, 0.00, 0.00, '2023-05-05', '2023-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(643, 28, 24, 'EM2408', 0, 579.75, 0.00, 0.00, 0.00, '2023-06-05', '2023-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(644, 28, 24, 'EM2409', 0, 579.75, 0.00, 0.00, 0.00, '2023-07-05', '2023-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(645, 28, 24, 'EM24010', 0, 579.75, 0.00, 0.00, 0.00, '2023-08-05', '2023-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(646, 28, 24, 'EM24011', 0, 579.75, 0.00, 0.00, 0.00, '2023-09-05', '2023-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(647, 28, 24, 'EM24012', 0, 579.75, 0.00, 0.00, 0.00, '2023-10-05', '2023-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(648, 28, 24, 'EM24013', 0, 579.75, 0.00, 0.00, 0.00, '2023-11-05', '2023-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(649, 28, 24, 'EM24014', 0, 579.75, 0.00, 0.00, 0.00, '2023-12-05', '2023-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(650, 28, 24, 'EM24015', 0, 579.75, 0.00, 0.00, 0.00, '2024-01-05', '2024-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(651, 28, 24, 'EM24016', 0, 579.75, 0.00, 0.00, 0.00, '2024-02-05', '2024-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(652, 28, 24, 'EM24017', 0, 579.75, 0.00, 0.00, 0.00, '2024-03-05', '2024-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(653, 28, 24, 'EM24018', 0, 579.75, 0.00, 0.00, 0.00, '2024-04-05', '2024-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(654, 28, 24, 'EM24019', 0, 579.75, 0.00, 0.00, 0.00, '2024-05-05', '2024-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(655, 28, 24, 'EM24020', 0, 579.75, 0.00, 0.00, 0.00, '2024-06-05', '2024-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(656, 28, 24, 'EM24021', 0, 579.75, 0.00, 0.00, 0.00, '2024-07-05', '2024-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(657, 28, 24, 'EM24022', 0, 579.75, 0.00, 0.00, 0.00, '2024-08-05', '2024-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(658, 28, 24, 'EM24023', 0, 579.75, 0.00, 0.00, 0.00, '2024-09-05', '2024-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(659, 28, 24, 'EM24024', 0, 579.75, 0.00, 0.00, 0.00, '2024-10-05', '2024-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(660, 28, 24, 'EM24025', 0, 579.75, 0.00, 0.00, 0.00, '2024-11-05', '2024-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(661, 28, 24, 'EM24026', 0, 579.75, 0.00, 0.00, 0.00, '2024-12-05', '2024-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(662, 28, 24, 'EM24027', 0, 579.75, 0.00, 0.00, 0.00, '2025-01-05', '2025-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(663, 28, 24, 'EM24028', 0, 579.75, 0.00, 0.00, 0.00, '2025-02-05', '2025-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(664, 28, 24, 'EM24029', 0, 579.75, 0.00, 0.00, 0.00, '2025-03-05', '2025-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(665, 28, 24, 'EM24030', 0, 579.75, 0.00, 0.00, 0.00, '2025-04-05', '2025-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(666, 28, 24, 'EM24031', 0, 579.75, 0.00, 0.00, 0.00, '2025-05-05', '2025-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(667, 28, 24, 'EM24032', 0, 579.75, 0.00, 0.00, 0.00, '2025-06-05', '2025-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(668, 28, 24, 'EM24033', 0, 579.75, 0.00, 0.00, 0.00, '2025-07-05', '2025-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(669, 28, 24, 'EM24034', 0, 579.75, 0.00, 0.00, 0.00, '2025-08-05', '2025-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(670, 28, 24, 'EM24035', 0, 579.75, 0.00, 0.00, 0.00, '2025-09-05', '2025-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(671, 28, 24, 'EM24036', 0, 579.75, 0.00, 0.00, 0.00, '2025-10-05', '2025-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(672, 28, 24, 'EM24037', 0, 579.75, 0.00, 0.00, 0.00, '2025-11-05', '2025-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(673, 28, 24, 'EM24038', 0, 579.75, 0.00, 0.00, 0.00, '2025-12-05', '2025-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(674, 28, 24, 'EM24039', 0, 579.75, 0.00, 0.00, 0.00, '2026-01-05', '2026-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(675, 28, 24, 'EM24040', 0, 579.75, 0.00, 0.00, 0.00, '2026-02-05', '2026-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(676, 28, 24, 'EM24041', 0, 579.75, 0.00, 0.00, 0.00, '2026-03-05', '2026-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(677, 28, 24, 'EM24042', 0, 579.75, 0.00, 0.00, 0.00, '2026-04-05', '2026-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(678, 28, 24, 'EM24043', 0, 579.75, 0.00, 0.00, 0.00, '2026-05-05', '2026-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(679, 28, 24, 'EM24044', 0, 579.75, 0.00, 0.00, 0.00, '2026-06-05', '2026-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(680, 28, 24, 'EM24045', 0, 579.75, 0.00, 0.00, 0.00, '2026-07-05', '2026-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(681, 28, 24, 'EM24046', 0, 579.75, 0.00, 0.00, 0.00, '2026-08-05', '2026-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(682, 28, 24, 'EM24047', 0, 579.75, 0.00, 0.00, 0.00, '2026-09-05', '2026-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(683, 28, 24, 'EM24048', 0, 579.75, 0.00, 0.00, 0.00, '2026-10-05', '2026-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(684, 28, 24, 'EM24049', 0, 579.75, 0.00, 0.00, 0.00, '2026-11-05', '2026-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(685, 28, 24, 'EM24050', 0, 579.75, 0.00, 0.00, 0.00, '2026-12-05', '2026-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(686, 28, 24, 'EM24051', 0, 579.75, 0.00, 0.00, 0.00, '2027-01-05', '2027-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(687, 28, 24, 'EM24052', 0, 579.75, 0.00, 0.00, 0.00, '2027-02-05', '2027-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(688, 28, 24, 'EM24053', 0, 579.75, 0.00, 0.00, 0.00, '2027-03-05', '2027-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(689, 28, 24, 'EM24054', 0, 579.75, 0.00, 0.00, 0.00, '2027-04-05', '2027-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(690, 28, 24, 'EM24055', 0, 579.75, 0.00, 0.00, 0.00, '2027-05-05', '2027-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(691, 28, 24, 'EM24056', 0, 579.75, 0.00, 0.00, 0.00, '2027-06-05', '2027-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(692, 28, 24, 'EM24057', 0, 579.75, 0.00, 0.00, 0.00, '2027-07-05', '2027-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(693, 28, 24, 'EM24058', 0, 579.75, 0.00, 0.00, 0.00, '2027-08-05', '2027-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(694, 28, 24, 'EM24059', 0, 579.75, 0.00, 0.00, 0.00, '2027-09-05', '2027-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(695, 28, 24, 'EM24060', 0, 579.75, 0.00, 0.00, 0.00, '2027-10-05', '2027-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(696, 28, 24, 'EM24061', 0, 579.75, 0.00, 0.00, 0.00, '2027-11-05', '2027-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(697, 28, 24, 'EM24062', 0, 579.75, 0.00, 0.00, 0.00, '2027-12-05', '2027-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(698, 28, 24, 'EM24063', 0, 579.75, 0.00, 0.00, 0.00, '2028-01-05', '2028-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(699, 28, 24, 'EM24064', 0, 579.75, 0.00, 0.00, 0.00, '2028-02-05', '2028-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(700, 28, 24, 'EM24065', 0, 579.75, 0.00, 0.00, 0.00, '2028-03-05', '2028-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(701, 28, 24, 'EM24066', 0, 579.75, 0.00, 0.00, 0.00, '2028-04-05', '2028-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(702, 28, 24, 'EM24067', 0, 579.75, 0.00, 0.00, 0.00, '2028-05-05', '2028-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(703, 28, 24, 'EM24068', 0, 579.75, 0.00, 0.00, 0.00, '2028-06-05', '2028-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(704, 28, 24, 'EM24069', 0, 579.75, 0.00, 0.00, 0.00, '2028-07-05', '2028-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(705, 28, 24, 'EM24070', 0, 579.75, 0.00, 0.00, 0.00, '2028-08-05', '2028-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(706, 28, 24, 'EM24071', 0, 579.75, 0.00, 0.00, 0.00, '2028-09-05', '2028-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(707, 28, 24, 'EM24072', 0, 579.75, 0.00, 0.00, 0.00, '2028-10-05', '2028-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(708, 28, 24, 'EM24073', 0, 579.75, 0.00, 0.00, 0.00, '2028-11-05', '2028-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(709, 28, 24, 'EM24074', 0, 579.75, 0.00, 0.00, 0.00, '2028-12-05', '2028-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(710, 28, 24, 'EM24075', 0, 579.75, 0.00, 0.00, 0.00, '2029-01-05', '2029-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(711, 28, 24, 'EM24076', 0, 579.75, 0.00, 0.00, 0.00, '2029-02-05', '2029-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(712, 28, 24, 'EM24077', 0, 579.75, 0.00, 0.00, 0.00, '2029-03-05', '2029-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(713, 28, 24, 'EM24078', 0, 579.75, 0.00, 0.00, 0.00, '2029-04-05', '2029-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(714, 28, 24, 'EM24079', 0, 579.75, 0.00, 0.00, 0.00, '2029-05-05', '2029-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(715, 28, 24, 'EM24080', 0, 579.75, 0.00, 0.00, 0.00, '2029-06-05', '2029-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(716, 28, 24, 'EM24081', 0, 579.75, 0.00, 0.00, 0.00, '2029-07-05', '2029-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(717, 28, 24, 'EM24082', 0, 579.75, 0.00, 0.00, 0.00, '2029-08-05', '2029-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(718, 28, 24, 'EM24083', 0, 579.75, 0.00, 0.00, 0.00, '2029-09-05', '2029-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(719, 28, 24, 'EM24084', 0, 579.75, 0.00, 0.00, 0.00, '2029-10-05', '2029-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(720, 28, 24, 'EM24085', 0, 579.75, 0.00, 0.00, 0.00, '2029-11-05', '2029-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(721, 28, 24, 'EM24086', 0, 579.75, 0.00, 0.00, 0.00, '2029-12-05', '2029-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(722, 28, 24, 'EM24087', 0, 579.75, 0.00, 0.00, 0.00, '2030-01-05', '2030-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(723, 28, 24, 'EM24088', 0, 579.75, 0.00, 0.00, 0.00, '2030-02-05', '2030-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(724, 28, 24, 'EM24089', 0, 579.75, 0.00, 0.00, 0.00, '2030-03-05', '2030-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(725, 28, 24, 'EM24090', 0, 579.75, 0.00, 0.00, 0.00, '2030-04-05', '2030-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(726, 28, 24, 'EM24091', 0, 579.75, 0.00, 0.00, 0.00, '2030-05-05', '2030-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(727, 28, 24, 'EM24092', 0, 579.75, 0.00, 0.00, 0.00, '2030-06-05', '2030-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(728, 28, 24, 'EM24093', 0, 579.75, 0.00, 0.00, 0.00, '2030-07-05', '2030-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(729, 28, 24, 'EM24094', 0, 579.75, 0.00, 0.00, 0.00, '2030-08-05', '2030-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(730, 28, 24, 'EM24095', 0, 579.75, 0.00, 0.00, 0.00, '2030-09-05', '2030-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(731, 28, 24, 'EM24096', 0, 579.75, 0.00, 0.00, 0.00, '2030-10-05', '2030-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(732, 28, 24, 'EM24097', 0, 579.75, 0.00, 0.00, 0.00, '2030-11-05', '2030-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(733, 28, 24, 'EM24098', 0, 579.75, 0.00, 0.00, 0.00, '2030-12-05', '2030-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(734, 28, 24, 'EM24099', 0, 579.75, 0.00, 0.00, 0.00, '2031-01-05', '2031-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(735, 28, 24, 'EM240100', 0, 579.75, 0.00, 0.00, 0.00, '2031-02-05', '2031-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(736, 28, 24, 'EM240101', 0, 579.75, 0.00, 0.00, 0.00, '2031-03-05', '2031-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(737, 28, 24, 'EM240102', 0, 579.75, 0.00, 0.00, 0.00, '2031-04-05', '2031-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(738, 28, 24, 'EM240103', 0, 579.75, 0.00, 0.00, 0.00, '2031-05-05', '2031-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(739, 28, 24, 'EM240104', 0, 579.75, 0.00, 0.00, 0.00, '2031-06-05', '2031-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(740, 28, 24, 'EM240105', 0, 579.75, 0.00, 0.00, 0.00, '2031-07-05', '2031-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(741, 28, 24, 'EM240106', 0, 579.75, 0.00, 0.00, 0.00, '2031-08-05', '2031-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(742, 28, 24, 'EM240107', 0, 579.75, 0.00, 0.00, 0.00, '2031-09-05', '2031-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(743, 28, 24, 'EM240108', 0, 579.75, 0.00, 0.00, 0.00, '2031-10-05', '2031-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(744, 28, 24, 'EM240109', 0, 579.75, 0.00, 0.00, 0.00, '2031-11-05', '2031-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(745, 28, 24, 'EM240110', 0, 579.75, 0.00, 0.00, 0.00, '2031-12-05', '2031-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(746, 28, 24, 'EM240111', 0, 579.75, 0.00, 0.00, 0.00, '2032-01-05', '2032-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(747, 28, 24, 'EM240112', 0, 579.75, 0.00, 0.00, 0.00, '2032-02-05', '2032-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(748, 28, 24, 'EM240113', 0, 579.75, 0.00, 0.00, 0.00, '2032-03-05', '2032-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(749, 28, 24, 'EM240114', 0, 579.75, 0.00, 0.00, 0.00, '2032-04-05', '2032-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(750, 28, 24, 'EM240115', 0, 579.75, 0.00, 0.00, 0.00, '2032-05-05', '2032-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(751, 28, 24, 'EM240116', 0, 579.75, 0.00, 0.00, 0.00, '2032-06-05', '2032-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(752, 28, 24, 'EM240117', 0, 579.75, 0.00, 0.00, 0.00, '2032-07-05', '2032-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(753, 28, 24, 'EM240118', 0, 579.75, 0.00, 0.00, 0.00, '2032-08-05', '2032-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(754, 28, 24, 'EM240119', 0, 579.75, 0.00, 0.00, 0.00, '2032-09-05', '2032-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(755, 28, 24, 'EM240120', 0, 579.75, 0.00, 0.00, 0.00, '2032-10-05', '2032-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(756, 28, 24, 'EM240121', 0, 579.75, 0.00, 0.00, 0.00, '2032-11-05', '2032-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(757, 28, 24, 'EM240122', 0, 579.75, 0.00, 0.00, 0.00, '2032-12-05', '2032-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(758, 28, 24, 'EM240123', 0, 579.75, 0.00, 0.00, 0.00, '2033-01-05', '2033-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(759, 28, 24, 'EM240124', 0, 579.75, 0.00, 0.00, 0.00, '2033-02-05', '2033-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(760, 28, 24, 'EM240125', 0, 579.75, 0.00, 0.00, 0.00, '2033-03-05', '2033-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(761, 28, 24, 'EM240126', 0, 579.75, 0.00, 0.00, 0.00, '2033-04-05', '2033-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(762, 28, 24, 'EM240127', 0, 579.75, 0.00, 0.00, 0.00, '2033-05-05', '2033-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(763, 28, 24, 'EM240128', 0, 579.75, 0.00, 0.00, 0.00, '2033-06-05', '2033-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(764, 28, 24, 'EM240129', 0, 579.75, 0.00, 0.00, 0.00, '2033-07-05', '2033-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(765, 28, 24, 'EM240130', 0, 579.75, 0.00, 0.00, 0.00, '2033-08-05', '2033-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(766, 28, 24, 'EM240131', 0, 579.75, 0.00, 0.00, 0.00, '2033-09-05', '2033-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(767, 28, 24, 'EM240132', 0, 579.75, 0.00, 0.00, 0.00, '2033-10-05', '2033-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(768, 28, 24, 'EM240133', 0, 579.75, 0.00, 0.00, 0.00, '2033-11-05', '2033-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(769, 28, 24, 'EM240134', 0, 579.75, 0.00, 0.00, 0.00, '2033-12-05', '2033-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(770, 28, 24, 'EM240135', 0, 579.75, 0.00, 0.00, 0.00, '2034-01-05', '2034-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(771, 28, 24, 'EM240136', 0, 579.75, 0.00, 0.00, 0.00, '2034-02-05', '2034-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(772, 28, 24, 'EM240137', 0, 579.75, 0.00, 0.00, 0.00, '2034-03-05', '2034-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(773, 28, 24, 'EM240138', 0, 579.75, 0.00, 0.00, 0.00, '2034-04-05', '2034-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(774, 28, 24, 'EM240139', 0, 579.75, 0.00, 0.00, 0.00, '2034-05-05', '2034-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(775, 28, 24, 'EM240140', 0, 579.75, 0.00, 0.00, 0.00, '2034-06-05', '2034-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(776, 28, 24, 'EM240141', 0, 579.75, 0.00, 0.00, 0.00, '2034-07-05', '2034-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(777, 28, 24, 'EM240142', 0, 579.75, 0.00, 0.00, 0.00, '2034-08-05', '2034-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(778, 28, 24, 'EM240143', 0, 579.75, 0.00, 0.00, 0.00, '2034-09-05', '2034-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(779, 28, 24, 'EM240144', 0, 579.75, 0.00, 0.00, 0.00, '2034-10-05', '2034-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(780, 28, 24, 'EM240145', 0, 579.75, 0.00, 0.00, 0.00, '2034-11-05', '2034-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(781, 28, 24, 'EM240146', 0, 579.75, 0.00, 0.00, 0.00, '2034-12-05', '2034-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(782, 28, 24, 'EM240147', 0, 579.75, 0.00, 0.00, 0.00, '2035-01-05', '2035-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(783, 28, 24, 'EM240148', 0, 579.75, 0.00, 0.00, 0.00, '2035-02-05', '2035-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(784, 28, 24, 'EM240149', 0, 579.75, 0.00, 0.00, 0.00, '2035-03-05', '2035-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(785, 28, 24, 'EM240150', 0, 579.75, 0.00, 0.00, 0.00, '2035-04-05', '2035-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(786, 28, 24, 'EM240151', 0, 579.75, 0.00, 0.00, 0.00, '2035-05-05', '2035-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(787, 28, 24, 'EM240152', 0, 579.75, 0.00, 0.00, 0.00, '2035-06-05', '2035-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(788, 28, 24, 'EM240153', 0, 579.75, 0.00, 0.00, 0.00, '2035-07-05', '2035-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(789, 28, 24, 'EM240154', 0, 579.75, 0.00, 0.00, 0.00, '2035-08-05', '2035-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(790, 28, 24, 'EM240155', 0, 579.75, 0.00, 0.00, 0.00, '2035-09-05', '2035-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(791, 28, 24, 'EM240156', 0, 579.75, 0.00, 0.00, 0.00, '2035-10-05', '2035-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(792, 28, 24, 'EM240157', 0, 579.75, 0.00, 0.00, 0.00, '2035-11-05', '2035-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(793, 28, 24, 'EM240158', 0, 579.75, 0.00, 0.00, 0.00, '2035-12-05', '2035-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(794, 28, 24, 'EM240159', 0, 579.75, 0.00, 0.00, 0.00, '2036-01-05', '2036-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(795, 28, 24, 'EM240160', 0, 579.75, 0.00, 0.00, 0.00, '2036-02-05', '2036-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(796, 28, 24, 'EM240161', 0, 579.75, 0.00, 0.00, 0.00, '2036-03-05', '2036-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(797, 28, 24, 'EM240162', 0, 579.75, 0.00, 0.00, 0.00, '2036-04-05', '2036-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(798, 28, 24, 'EM240163', 0, 579.75, 0.00, 0.00, 0.00, '2036-05-05', '2036-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(799, 28, 24, 'EM240164', 0, 579.75, 0.00, 0.00, 0.00, '2036-06-05', '2036-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(800, 28, 24, 'EM240165', 0, 579.75, 0.00, 0.00, 0.00, '2036-07-05', '2036-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(801, 28, 24, 'EM240166', 0, 579.75, 0.00, 0.00, 0.00, '2036-08-05', '2036-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(802, 28, 24, 'EM240167', 0, 579.75, 0.00, 0.00, 0.00, '2036-09-05', '2036-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(803, 28, 24, 'EM240168', 0, 579.75, 0.00, 0.00, 0.00, '2036-10-05', '2036-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(804, 28, 24, 'EM240169', 0, 579.75, 0.00, 0.00, 0.00, '2036-11-05', '2036-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(805, 28, 24, 'EM240170', 0, 579.75, 0.00, 0.00, 0.00, '2036-12-05', '2036-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(806, 28, 24, 'EM240171', 0, 579.75, 0.00, 0.00, 0.00, '2037-01-05', '2037-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(807, 28, 24, 'EM240172', 0, 579.75, 0.00, 0.00, 0.00, '2037-02-05', '2037-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(808, 28, 24, 'EM240173', 0, 579.75, 0.00, 0.00, 0.00, '2037-03-05', '2037-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(809, 28, 24, 'EM240174', 0, 579.75, 0.00, 0.00, 0.00, '2037-04-05', '2037-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(810, 28, 24, 'EM240175', 0, 579.75, 0.00, 0.00, 0.00, '2037-05-05', '2037-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(811, 28, 24, 'EM240176', 0, 579.75, 0.00, 0.00, 0.00, '2037-06-05', '2037-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(812, 28, 24, 'EM240177', 0, 579.75, 0.00, 0.00, 0.00, '2037-07-05', '2037-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(813, 28, 24, 'EM240178', 0, 579.75, 0.00, 0.00, 0.00, '2037-08-05', '2037-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(814, 28, 24, 'EM240179', 0, 579.75, 0.00, 0.00, 0.00, '2037-09-05', '2037-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(815, 28, 24, 'EM240180', 0, 579.75, 0.00, 0.00, 0.00, '2037-10-05', '2037-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-06 07:20:26', '2022-10-06 07:20:26'),
(816, 31, 25, 'EM2501', 1, 682.00, 175.00, 507.00, 6493.00, '2022-10-05', '2022-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-07 05:15:28', '2022-10-07 05:15:28'),
(817, 31, 25, 'EM2502', 2, 682.00, 162.00, 520.00, 5972.00, '2022-10-05', '2022-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-07 05:15:28', '2022-10-07 05:15:28'),
(818, 31, 25, 'EM2503', 3, 682.00, 149.00, 533.00, 5439.00, '2022-10-05', '2023-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-07 05:15:28', '2022-10-07 05:15:28'),
(819, 31, 25, 'EM2504', 4, 682.00, 136.00, 546.00, 4893.00, '2022-10-05', '2023-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-07 05:15:28', '2022-10-07 05:15:28'),
(820, 31, 25, 'EM2505', 5, 682.00, 122.00, 560.00, 4333.00, '2022-10-05', '2023-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-07 05:15:28', '2022-10-07 05:15:28'),
(821, 31, 25, 'EM2506', 6, 682.00, 108.00, 574.00, 3759.00, '2022-10-05', '2023-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-07 05:15:28', '2022-10-07 05:15:28'),
(822, 31, 25, 'EM2507', 7, 682.00, 94.00, 588.00, 3170.00, '2022-10-05', '2023-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-07 05:15:28', '2022-10-07 05:15:28'),
(823, 31, 25, 'EM2508', 8, 682.00, 79.00, 603.00, 2567.00, '2022-10-05', '2023-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-07 05:15:28', '2022-10-07 05:15:28'),
(824, 31, 25, 'EM2509', 9, 682.00, 64.00, 618.00, 1949.00, '2022-10-05', '2023-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-07 05:15:28', '2022-10-07 05:15:28'),
(825, 31, 25, 'EM25010', 10, 682.00, 49.00, 634.00, 1315.00, '2022-10-05', '2023-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-07 05:15:28', '2022-10-07 05:15:28'),
(826, 31, 25, 'EM25011', 11, 682.00, 33.00, 650.00, 666.00, '2022-10-05', '2023-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-07 05:15:28', '2022-10-07 05:15:28'),
(827, 31, 25, 'EM25012', 12, 682.00, 17.00, 666.00, 0.00, '2022-10-05', '2023-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-07 05:15:28', '2022-10-07 05:15:28'),
(828, 36, 30, 'EM3001', 1, 975.00, 250.00, 725.00, 9275.00, '2022-10-05', '2022-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-13 07:54:33', '2022-10-13 07:54:33'),
(829, 36, 30, 'EM3002', 2, 975.00, 232.00, 743.00, 8532.00, '2022-10-05', '2022-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-13 07:54:33', '2022-10-13 07:54:33'),
(830, 36, 30, 'EM3003', 3, 975.00, 213.00, 762.00, 7771.00, '2022-10-05', '2023-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-13 07:54:33', '2022-10-13 07:54:33'),
(831, 36, 30, 'EM3004', 4, 975.00, 194.00, 781.00, 6990.00, '2022-10-05', '2023-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-13 07:54:33', '2022-10-13 07:54:33'),
(832, 36, 30, 'EM3005', 5, 975.00, 175.00, 800.00, 6190.00, '2022-10-05', '2023-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-13 07:54:33', '2022-10-13 07:54:33'),
(833, 36, 30, 'EM3006', 6, 975.00, 155.00, 820.00, 5370.00, '2022-10-05', '2023-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-13 07:54:33', '2022-10-13 07:54:33'),
(834, 36, 30, 'EM3007', 7, 975.00, 134.00, 841.00, 4529.00, '2022-10-05', '2023-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-13 07:54:33', '2022-10-13 07:54:33'),
(835, 36, 30, 'EM3008', 8, 975.00, 113.00, 862.00, 3667.00, '2022-10-05', '2023-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-13 07:54:33', '2022-10-13 07:54:33'),
(836, 36, 30, 'EM3009', 9, 975.00, 92.00, 883.00, 2784.00, '2022-10-05', '2023-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-13 07:54:33', '2022-10-13 07:54:33'),
(837, 36, 30, 'EM30010', 10, 975.00, 70.00, 905.00, 1879.00, '2022-10-05', '2023-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-13 07:54:33', '2022-10-13 07:54:33'),
(838, 36, 30, 'EM30011', 11, 975.00, 47.00, 928.00, 951.00, '2022-10-05', '2023-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-13 07:54:33', '2022-10-13 07:54:33'),
(839, 36, 30, 'EM30012', 12, 975.00, 24.00, 951.00, 0.00, '2022-10-05', '2023-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-13 07:54:33', '2022-10-13 07:54:33'),
(840, 39, 33, 'EM3301', 1, 1795.00, 217.00, 1579.00, 8421.00, '2022-10-05', '2022-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-14 12:42:09', '2022-10-14 12:42:09'),
(841, 39, 33, 'EM3302', 2, 1795.00, 182.00, 1613.00, 6809.00, '2022-10-05', '2022-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-14 12:42:09', '2022-10-14 12:42:09'),
(842, 39, 33, 'EM3303', 3, 1795.00, 148.00, 1648.00, 5161.00, '2022-10-05', '2023-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-14 12:42:09', '2022-10-14 12:42:09'),
(843, 39, 33, 'EM3304', 4, 1795.00, 112.00, 1683.00, 3477.00, '2022-10-05', '2023-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-14 12:42:09', '2022-10-14 12:42:09'),
(844, 39, 33, 'EM3305', 5, 1795.00, 75.00, 1720.00, 1757.00, '2022-10-05', '2023-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-14 12:42:09', '2022-10-14 12:42:09'),
(845, 39, 33, 'EM3306', 6, 1795.00, 38.00, 1757.00, 0.00, '2022-10-05', '2023-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-14 12:42:09', '2022-10-14 12:42:09'),
(846, 43, 35, 'EM3501', 1, 1795.00, 217.00, 1579.00, 8421.00, '2022-10-05', '2022-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-17 09:13:57', '2022-10-17 09:13:57'),
(847, 43, 35, 'EM3502', 2, 1795.00, 182.00, 1613.00, 6809.00, '2022-10-05', '2022-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-17 09:13:57', '2022-10-17 09:13:57'),
(848, 43, 35, 'EM3503', 3, 1795.00, 148.00, 1648.00, 5161.00, '2022-10-05', '2023-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-17 09:13:57', '2022-10-17 09:13:57'),
(849, 43, 35, 'EM3504', 4, 1795.00, 112.00, 1683.00, 3477.00, '2022-10-05', '2023-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-17 09:13:57', '2022-10-17 09:13:57'),
(850, 43, 35, 'EM3505', 5, 1795.00, 75.00, 1720.00, 1757.00, '2022-10-05', '2023-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-17 09:13:57', '2022-10-17 09:13:57'),
(851, 43, 35, 'EM3506', 6, 1795.00, 38.00, 1757.00, 0.00, '2022-10-05', '2023-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-17 09:13:57', '2022-10-17 09:13:57'),
(852, 49, 39, 'EM3901', 1, 1235.00, 217.00, 1018.00, 8982.00, '2022-10-05', '2022-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-19 07:41:45', '2022-10-19 07:41:45'),
(853, 49, 39, 'EM3902', 2, 1235.00, 195.00, 1040.00, 7941.00, '2022-10-05', '2022-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-19 07:41:45', '2022-10-19 07:41:45'),
(854, 49, 39, 'EM3903', 3, 1235.00, 172.00, 1063.00, 6879.00, '2022-10-05', '2023-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-19 07:41:45', '2022-10-19 07:41:45'),
(855, 49, 39, 'EM3904', 4, 1235.00, 149.00, 1086.00, 5793.00, '2022-10-05', '2023-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-19 07:41:45', '2022-10-19 07:41:45'),
(856, 49, 39, 'EM3905', 5, 1235.00, 126.00, 1109.00, 4683.00, '2022-10-05', '2023-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-19 07:41:45', '2022-10-19 07:41:45'),
(857, 49, 39, 'EM3906', 6, 1235.00, 101.00, 1133.00, 3550.00, '2022-10-05', '2023-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-19 07:41:45', '2022-10-19 07:41:45'),
(858, 49, 39, 'EM3907', 7, 1235.00, 77.00, 1158.00, 2392.00, '2022-10-05', '2023-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-19 07:41:45', '2022-10-19 07:41:45'),
(859, 49, 39, 'EM3908', 8, 1235.00, 52.00, 1183.00, 1209.00, '2022-10-05', '2023-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-19 07:41:45', '2022-10-19 07:41:45'),
(860, 49, 39, 'EM3909', 9, 1235.00, 26.00, 1209.00, 0.00, '2022-10-05', '2023-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-19 07:41:45', '2022-10-19 07:41:45'),
(861, 50, 41, 'EM4101', 1, 1795.00, 217.00, 1579.00, 8421.00, '2022-10-05', '2022-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-23 03:55:52', '2022-10-23 03:55:52'),
(862, 50, 41, 'EM4102', 2, 1795.00, 182.00, 1613.00, 6809.00, '2022-10-05', '2022-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-23 03:55:52', '2022-10-23 03:55:52'),
(863, 50, 41, 'EM4103', 3, 1795.00, 148.00, 1648.00, 5161.00, '2022-10-05', '2023-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-23 03:55:52', '2022-10-23 03:55:52'),
(864, 50, 41, 'EM4104', 4, 1795.00, 112.00, 1683.00, 3477.00, '2022-10-05', '2023-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-23 03:55:52', '2022-10-23 03:55:52'),
(865, 50, 41, 'EM4105', 5, 1795.00, 75.00, 1720.00, 1757.00, '2022-10-05', '2023-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-23 03:55:52', '2022-10-23 03:55:52'),
(866, 50, 41, 'EM4106', 6, 1795.00, 38.00, 1757.00, 0.00, '2022-10-05', '2023-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-10-23 03:55:52', '2022-10-23 03:55:52'),
(867, 57, 48, 'EM4801', 1, 40803.00, 1200.00, 39603.00, 80397.00, '2022-11-05', '2022-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-02 19:58:20', '2022-11-02 19:58:20'),
(868, 57, 48, 'EM4802', 2, 40803.00, 804.00, 39999.00, 40399.00, '2022-11-05', '2023-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-02 19:58:20', '2022-11-02 19:58:20'),
(869, 57, 48, 'EM4803', 3, 40803.00, 404.00, 40399.00, 0.00, '2022-11-05', '2023-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-02 19:58:20', '2022-11-02 19:58:20'),
(870, 56, 50, 'EM5001', 1, 975.00, 250.00, 725.00, 9275.00, '2022-11-05', '2022-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-03 06:12:41', '2022-11-03 06:12:41'),
(871, 56, 50, 'EM5002', 2, 975.00, 232.00, 743.00, 8532.00, '2022-11-05', '2023-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-03 06:12:41', '2022-11-03 06:12:41'),
(872, 56, 50, 'EM5003', 3, 975.00, 213.00, 762.00, 7771.00, '2022-11-05', '2023-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-03 06:12:41', '2022-11-03 06:12:41'),
(873, 56, 50, 'EM5004', 4, 975.00, 194.00, 781.00, 6990.00, '2022-11-05', '2023-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-03 06:12:41', '2022-11-03 06:12:41'),
(874, 56, 50, 'EM5005', 5, 975.00, 175.00, 800.00, 6190.00, '2022-11-05', '2023-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-03 06:12:41', '2022-11-03 06:12:41'),
(875, 56, 50, 'EM5006', 6, 975.00, 155.00, 820.00, 5370.00, '2022-11-05', '2023-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-03 06:12:41', '2022-11-03 06:12:41'),
(876, 56, 50, 'EM5007', 7, 975.00, 134.00, 841.00, 4529.00, '2022-11-05', '2023-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-03 06:12:41', '2022-11-03 06:12:41'),
(877, 56, 50, 'EM5008', 8, 975.00, 113.00, 862.00, 3667.00, '2022-11-05', '2023-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-03 06:12:41', '2022-11-03 06:12:41'),
(878, 56, 50, 'EM5009', 9, 975.00, 92.00, 883.00, 2784.00, '2022-11-05', '2023-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-03 06:12:41', '2022-11-03 06:12:41'),
(879, 56, 50, 'EM50010', 10, 975.00, 70.00, 905.00, 1879.00, '2022-11-05', '2023-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-03 06:12:41', '2022-11-03 06:12:41');
INSERT INTO `loan_emi_details` (`id`, `userId`, `loanId`, `emiId`, `emiSr`, `emiAmount`, `interest`, `principle`, `balance`, `emiDate`, `emiDueDate`, `status`, `transactionId`, `payment_mode`, `transactionDate`, `lateCharges`, `remark`, `created_at`, `updated_at`) VALUES
(880, 56, 50, 'EM50011', 11, 975.00, 47.00, 928.00, 951.00, '2022-11-05', '2023-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-03 06:12:41', '2022-11-03 06:12:41'),
(881, 56, 50, 'EM50012', 12, 975.00, 24.00, 951.00, 0.00, '2022-11-05', '2023-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-03 06:12:41', '2022-11-03 06:12:41'),
(882, 63, 52, 'EM5201', 1, 1255.00, 250.00, 1005.00, 8995.00, '2022-11-05', '2022-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-03 07:29:42', '2022-11-03 07:29:42'),
(883, 63, 52, 'EM5202', 2, 1255.00, 225.00, 1030.00, 7966.00, '2022-11-05', '2023-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-03 07:29:42', '2022-11-03 07:29:42'),
(884, 63, 52, 'EM5203', 3, 1255.00, 199.00, 1055.00, 6910.00, '2022-11-05', '2023-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-03 07:29:42', '2022-11-03 07:29:42'),
(885, 63, 52, 'EM5204', 4, 1255.00, 173.00, 1082.00, 5829.00, '2022-11-05', '2023-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-03 07:29:42', '2022-11-03 07:29:42'),
(886, 63, 52, 'EM5205', 5, 1255.00, 146.00, 1109.00, 4720.00, '2022-11-05', '2023-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-03 07:29:42', '2022-11-03 07:29:42'),
(887, 63, 52, 'EM5206', 6, 1255.00, 118.00, 1137.00, 3583.00, '2022-11-05', '2023-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-03 07:29:42', '2022-11-03 07:29:42'),
(888, 63, 52, 'EM5207', 7, 1255.00, 90.00, 1165.00, 2418.00, '2022-11-05', '2023-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-03 07:29:42', '2022-11-03 07:29:42'),
(889, 63, 52, 'EM5208', 8, 1255.00, 60.00, 1194.00, 1224.00, '2022-11-05', '2023-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-03 07:29:42', '2022-11-03 07:29:42'),
(890, 63, 52, 'EM5209', 9, 1255.00, 31.00, 1224.00, 0.00, '2022-11-05', '2023-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-03 07:29:42', '2022-11-03 07:29:42'),
(891, 68, 58, 'EM5801', 1, 975.00, 250.00, 725.00, 9275.00, '2022-11-05', '2022-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-08 06:42:06', '2022-11-08 06:42:06'),
(892, 68, 58, 'EM5802', 2, 975.00, 232.00, 743.00, 8532.00, '2022-11-05', '2023-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-08 06:42:06', '2022-11-08 06:42:06'),
(893, 68, 58, 'EM5803', 3, 975.00, 213.00, 762.00, 7771.00, '2022-11-05', '2023-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-08 06:42:06', '2022-11-08 06:42:06'),
(894, 68, 58, 'EM5804', 4, 975.00, 194.00, 781.00, 6990.00, '2022-11-05', '2023-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-08 06:42:06', '2022-11-08 06:42:06'),
(895, 68, 58, 'EM5805', 5, 975.00, 175.00, 800.00, 6190.00, '2022-11-05', '2023-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-08 06:42:06', '2022-11-08 06:42:06'),
(896, 68, 58, 'EM5806', 6, 975.00, 155.00, 820.00, 5370.00, '2022-11-05', '2023-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-08 06:42:06', '2022-11-08 06:42:06'),
(897, 68, 58, 'EM5807', 7, 975.00, 134.00, 841.00, 4529.00, '2022-11-05', '2023-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-08 06:42:06', '2022-11-08 06:42:06'),
(898, 68, 58, 'EM5808', 8, 975.00, 113.00, 862.00, 3667.00, '2022-11-05', '2023-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-08 06:42:06', '2022-11-08 06:42:06'),
(899, 68, 58, 'EM5809', 9, 975.00, 92.00, 883.00, 2784.00, '2022-11-05', '2023-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-08 06:42:06', '2022-11-08 06:42:06'),
(900, 68, 58, 'EM58010', 10, 975.00, 70.00, 905.00, 1879.00, '2022-11-05', '2023-09-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-08 06:42:06', '2022-11-08 06:42:06'),
(901, 68, 58, 'EM58011', 11, 975.00, 47.00, 928.00, 951.00, '2022-11-05', '2023-10-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-08 06:42:06', '2022-11-08 06:42:06'),
(902, 68, 58, 'EM58012', 12, 975.00, 24.00, 951.00, 0.00, '2022-11-05', '2023-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-08 06:42:06', '2022-11-08 06:42:06'),
(903, 70, 60, 'EM6001', 1, 3250.00, 740.00, 2510.00, 7490.00, '2022-11-05', '2023-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 06:40:20', '2022-11-09 06:40:20'),
(904, 70, 60, 'EM6002', 2, 3250.00, 740.00, 2510.00, 4979.00, '2022-11-05', '2023-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 06:40:20', '2022-11-09 06:40:20'),
(905, 70, 60, 'EM6003', 3, 3250.00, 740.00, 2510.00, 2469.00, '2022-11-05', '2023-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 06:40:20', '2022-11-09 06:40:20'),
(906, 70, 60, 'EM6004', 4, 3250.00, 781.00, 2469.00, 0.00, '2022-11-05', '2023-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 06:40:20', '2022-11-09 06:40:20'),
(907, 71, 61, 'EM6101', 1, 1255.00, 250.00, 1005.00, 8995.00, '2022-11-05', '2022-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 07:02:17', '2022-11-09 07:02:17'),
(908, 71, 61, 'EM6102', 2, 1255.00, 225.00, 1030.00, 7966.00, '2022-11-05', '2023-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 07:02:17', '2022-11-09 07:02:17'),
(909, 71, 61, 'EM6103', 3, 1255.00, 199.00, 1055.00, 6910.00, '2022-11-05', '2023-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 07:02:17', '2022-11-09 07:02:17'),
(910, 71, 61, 'EM6104', 4, 1255.00, 173.00, 1082.00, 5829.00, '2022-11-05', '2023-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 07:02:17', '2022-11-09 07:02:17'),
(911, 71, 61, 'EM6105', 5, 1255.00, 146.00, 1109.00, 4720.00, '2022-11-05', '2023-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 07:02:17', '2022-11-09 07:02:17'),
(912, 71, 61, 'EM6106', 6, 1255.00, 118.00, 1137.00, 3583.00, '2022-11-05', '2023-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 07:02:17', '2022-11-09 07:02:17'),
(913, 71, 61, 'EM6107', 7, 1255.00, 90.00, 1165.00, 2418.00, '2022-11-05', '2023-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 07:02:17', '2022-11-09 07:02:17'),
(914, 71, 61, 'EM6108', 8, 1255.00, 60.00, 1194.00, 1224.00, '2022-11-05', '2023-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 07:02:17', '2022-11-09 07:02:17'),
(915, 71, 61, 'EM6109', 9, 1255.00, 31.00, 1224.00, 0.00, '2022-11-05', '2023-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 07:02:17', '2022-11-09 07:02:17'),
(916, 72, 62, 'EM6201', 1, 1444.00, 333.33, 1111.11, 8889.00, '2022-11-05', '2022-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 08:50:46', '2022-11-09 08:50:46'),
(917, 72, 62, 'EM6202', 2, 1444.00, 333.33, 1111.11, 7778.00, '2022-11-05', '2023-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 08:50:46', '2022-11-09 08:50:46'),
(918, 72, 62, 'EM6203', 3, 1444.00, 333.33, 1111.11, 6667.00, '2022-11-05', '2023-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 08:50:46', '2022-11-09 08:50:46'),
(919, 72, 62, 'EM6204', 4, 1444.00, 333.33, 1111.11, 5556.00, '2022-11-05', '2023-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 08:50:46', '2022-11-09 08:50:46'),
(920, 72, 62, 'EM6205', 5, 1444.00, 333.33, 1111.11, 4444.00, '2022-11-05', '2023-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 08:50:46', '2022-11-09 08:50:46'),
(921, 72, 62, 'EM6206', 6, 1444.00, 333.33, 1111.11, 3333.00, '2022-11-05', '2023-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 08:50:46', '2022-11-09 08:50:46'),
(922, 72, 62, 'EM6207', 7, 1444.00, 333.33, 1111.11, 2222.00, '2022-11-05', '2023-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 08:50:46', '2022-11-09 08:50:46'),
(923, 72, 62, 'EM6208', 8, 1444.00, 333.33, 1111.11, 1111.00, '2022-11-05', '2023-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 08:50:46', '2022-11-09 08:50:46'),
(924, 72, 62, 'EM6209', 9, 1444.00, 333.33, 1111.11, 0.00, '2022-11-05', '2023-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-09 08:50:46', '2022-11-09 08:50:46'),
(925, 77, 67, 'EM6701', 1, 1361.00, 250.00, 1111.11, 8889.00, '2022-11-05', '2022-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-10 06:41:41', '2022-11-10 06:41:41'),
(926, 77, 67, 'EM6702', 2, 1361.00, 250.00, 1111.11, 7778.00, '2022-11-05', '2023-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-10 06:41:41', '2022-11-10 06:41:41'),
(927, 77, 67, 'EM6703', 3, 1361.00, 250.00, 1111.11, 6667.00, '2022-11-05', '2023-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-10 06:41:41', '2022-11-10 06:41:41'),
(928, 77, 67, 'EM6704', 4, 1361.00, 250.00, 1111.11, 5556.00, '2022-11-05', '2023-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-10 06:41:41', '2022-11-10 06:41:41'),
(929, 77, 67, 'EM6705', 5, 1361.00, 250.00, 1111.11, 4444.00, '2022-11-05', '2023-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-10 06:41:41', '2022-11-10 06:41:41'),
(930, 77, 67, 'EM6706', 6, 1361.00, 250.00, 1111.11, 3333.00, '2022-11-05', '2023-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-10 06:41:41', '2022-11-10 06:41:41'),
(931, 77, 67, 'EM6707', 7, 1361.00, 250.00, 1111.11, 2222.00, '2022-11-05', '2023-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-10 06:41:41', '2022-11-10 06:41:41'),
(932, 77, 67, 'EM6708', 8, 1361.00, 250.00, 1111.11, 1111.00, '2022-11-05', '2023-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-10 06:41:41', '2022-11-10 06:41:41'),
(933, 77, 67, 'EM6709', 9, 1361.00, 250.00, 1111.11, 0.00, '2022-11-05', '2023-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-10 06:41:41', '2022-11-10 06:41:41'),
(934, 78, 68, 'EM6801', 1, 1255.00, 250.00, 1005.00, 8995.00, '2022-11-05', '2022-12-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-10 09:48:43', '2022-11-10 09:48:43'),
(935, 78, 68, 'EM6802', 2, 1255.00, 225.00, 1030.00, 7966.00, '2022-11-05', '2023-01-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-10 09:48:43', '2022-11-10 09:48:43'),
(936, 78, 68, 'EM6803', 3, 1255.00, 199.00, 1055.00, 6910.00, '2022-11-05', '2023-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-10 09:48:43', '2022-11-10 09:48:43'),
(937, 78, 68, 'EM6804', 4, 1255.00, 173.00, 1082.00, 5829.00, '2022-11-05', '2023-03-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-10 09:48:43', '2022-11-10 09:48:43'),
(938, 78, 68, 'EM6805', 5, 1255.00, 146.00, 1109.00, 4720.00, '2022-11-05', '2023-04-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-10 09:48:43', '2022-11-10 09:48:43'),
(939, 78, 68, 'EM6806', 6, 1255.00, 118.00, 1137.00, 3583.00, '2022-11-05', '2023-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-10 09:48:43', '2022-11-10 09:48:43'),
(940, 78, 68, 'EM6807', 7, 1255.00, 90.00, 1165.00, 2418.00, '2022-11-05', '2023-06-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-10 09:48:43', '2022-11-10 09:48:43'),
(941, 78, 68, 'EM6808', 8, 1255.00, 60.00, 1194.00, 1224.00, '2022-11-05', '2023-07-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-10 09:48:43', '2022-11-10 09:48:43'),
(942, 78, 68, 'EM6809', 9, 1255.00, 31.00, 1224.00, 0.00, '2022-11-05', '2023-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-10 09:48:43', '2022-11-10 09:48:43'),
(943, 82, 72, 'EM7201', 1, 10501.00, 501.00, 10000.00, 0.00, '2023-01-14', '2023-01-14', 'success', '223', '124', '2023-01-14 00:00:00', 0.00, NULL, '2022-11-14 05:49:47', '2022-11-14 05:49:47'),
(944, 85, 73, 'EM7301', 1, 3250.00, 740.00, 2510.00, 7490.00, '2022-11-05', '2023-02-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-17 13:02:46', '2022-11-17 13:02:46'),
(945, 85, 73, 'EM7302', 2, 3250.00, 740.00, 2510.00, 4979.00, '2022-11-05', '2023-05-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-17 13:02:46', '2022-11-17 13:02:46'),
(946, 85, 73, 'EM7303', 3, 3250.00, 740.00, 2510.00, 2469.00, '2022-11-05', '2023-08-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-17 13:02:46', '2022-11-17 13:02:46'),
(947, 85, 73, 'EM7304', 4, 3250.00, 781.00, 2469.00, 0.00, '2022-11-05', '2023-11-12', 'pending', NULL, NULL, NULL, 0.00, NULL, '2022-11-17 13:02:46', '2022-11-17 13:02:46');

-- --------------------------------------------------------

--
-- Table structure for table `personal_discussion_on_calls`
--

CREATE TABLE `personal_discussion_on_calls` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL DEFAULT '0',
  `residentialAddressFromHowTimeLiving` text,
  `presentAddressISParmanentAdd` text,
  `businessVintageProof` text,
  `businessDesctiotion` text,
  `hasABoardingOrOnboarding` text,
  `businessDetails` text,
  `businessPics` text,
  `kmBusinessHowLongFromBranch` text,
  `existingCustomer` text,
  `pdDoneBy` text,
  `pdDoneDate` text,
  `avgBankBalance` text,
  `creditSummation` text,
  `creditTransaction` text,
  `overAllStatus` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `personal_discussion_on_calls`
--

INSERT INTO `personal_discussion_on_calls` (`id`, `userId`, `residentialAddressFromHowTimeLiving`, `presentAddressISParmanentAdd`, `businessVintageProof`, `businessDesctiotion`, `hasABoardingOrOnboarding`, `businessDetails`, `businessPics`, `kmBusinessHowLongFromBranch`, `existingCustomer`, `pdDoneBy`, `pdDoneDate`, `avgBankBalance`, `creditSummation`, `creditTransaction`, `overAllStatus`, `created_at`, `updated_at`) VALUES
(1, 50, '25', 'yes', NULL, 'clothe store', 'yes', 'clothes', NULL, '200 km', 'no', 'raka', '2022-10-20', '600000', 'credit', 'creditt', 'satisfactory', '2022-10-20 06:20:56', '2022-10-23 03:34:03'),
(2, 52, '1993', 'yes', 'h', 'dsj', 'yes', 'clothes', 'f', '200 km', 'no', 'raka', '2022-10-28', '600000', 'credit', 'creditt', 'satisfactory', '2022-10-28 06:44:04', '2022-10-28 06:44:04'),
(3, 53, 'w', 'yes', 'h', 'clothe store', 'yes', 'clothes', 'f', '200 km', 'yes', 'raka', '2022-10-28', '600000', 'credit', 'creditt', 'satisfactory', '2022-10-28 09:32:42', '2022-10-28 09:32:42'),
(4, 56, 'ddw', 'fef', 'personal-discussion-docs/166741663037_373764_javascript_adding_a_custom_map_marker_icon_to.png', 'wef', 'fw', 'efwf', 'personal-discussion-docs/1667416630rooms.jpg', NULL, 'fwef', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-02 19:10:52', '2022-11-02 19:18:19'),
(5, 58, '10 year', 'yes', 'personal-discussion-docs/1667452511wallpaper2you_559031.jpg', 'clothe store', 'yes', 'clothes', 'personal-discussion-docs/1667452511wallpaper2you_559024.jpg', '200 km', 'no', 'raka', '2022-11-03', '600000', 'credit', 'creditt', 'satisfactory', '2022-11-03 05:15:11', '2022-11-03 05:15:11'),
(6, 63, '10', 'y', 'personal-discussion-docs/1667459876wallpaper2you_559073.jpg', 'clothe store', 'yes', 'clothes', 'personal-discussion-docs/1667459876wallpaper2you_559024.jpg', '200 km', 'no', 'raka', NULL, NULL, NULL, NULL, NULL, '2022-11-03 07:17:56', '2022-11-03 07:17:56'),
(7, 67, 'hhf', 'y', 'personal-discussion-docs/1667884560wallpaper2you_559031.jpg', 'clothe store', 'yes', 'clothes', 'personal-discussion-docs/1667884560wallpaper2you_559024___Copy.jpg', 'hg', 'y', 'raka', '2003-11-07', '600000', 'credit', 'creditt', 'satisfactory', '2022-11-08 05:16:00', '2022-11-08 05:16:00'),
(8, 69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'credit', NULL, NULL, '2022-11-09 06:11:03', '2022-11-09 06:11:03'),
(9, 78, '10', 'y', NULL, 'clothe store', 'yes', 'clothes', 'personal-discussion-docs/1668073286wallpaper2you_559031.jpg', '200 km', 'no', 'Paul', '2022-11-10', '600000', 'credit', 'creditt', 'satisfactory', '2022-11-10 09:41:26', '2022-11-10 09:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL DEFAULT '0',
  `subCategoryId` int(11) NOT NULL DEFAULT '0',
  `productCode` varchar(255) DEFAULT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `tenure` varchar(200) DEFAULT NULL,
  `amount` varchar(200) DEFAULT NULL,
  `amountTo` varchar(200) DEFAULT NULL,
  `numOfEmi` varchar(200) DEFAULT NULL,
  `description` text,
  `image` text,
  `rateOfInterest` varchar(255) DEFAULT NULL,
  `pfPercentage` double(10,2) NOT NULL DEFAULT '0.00',
  `gst` varchar(255) DEFAULT NULL,
  `premium` varchar(255) DEFAULT NULL,
  `processingFee` varchar(255) DEFAULT NULL,
  `insurance` varchar(255) DEFAULT NULL,
  `verificationCharges` varchar(255) DEFAULT NULL,
  `collectionFee` varchar(255) DEFAULT NULL,
  `plateformFee` varchar(255) DEFAULT NULL,
  `convenienceFee` varchar(255) DEFAULT NULL,
  `principleAmount` varchar(255) DEFAULT NULL,
  `productType` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `categoryId`, `subCategoryId`, `productCode`, `productName`, `tenure`, `amount`, `amountTo`, `numOfEmi`, `description`, `image`, `rateOfInterest`, `pfPercentage`, `gst`, `premium`, `processingFee`, `insurance`, `verificationCharges`, `collectionFee`, `plateformFee`, `convenienceFee`, `principleAmount`, `productType`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'PRO00001', 'Business Loan', '3', NULL, NULL, NULL, 'XYZ', 'products/1665636017wallpaper2you_559031.jpg', '20', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '2022-10-13 04:40:17', '2022-10-17 09:01:00'),
(2, 1, 0, 'PRO00002', 'j', '2', NULL, NULL, NULL, 'h', 'products/1665752544wallpaper2you_559031.jpg', '26', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2022-10-14 13:02:24', '2022-10-19 06:57:32');

-- --------------------------------------------------------

--
-- Table structure for table `raw_materials_txn_details`
--

CREATE TABLE `raw_materials_txn_details` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL DEFAULT '0',
  `loanId` int(11) NOT NULL DEFAULT '0',
  `debitRecordId` int(11) NOT NULL DEFAULT '0',
  `txnGroupId` text,
  `amount` double(10,2) NOT NULL DEFAULT '0.00',
  `openingDate` date DEFAULT NULL,
  `openingBalance` double(10,2) NOT NULL DEFAULT '0.00',
  `interestAmount` double(10,2) NOT NULL DEFAULT '0.00',
  `interestAmountPayble` double(10,2) NOT NULL DEFAULT '0.00',
  `tdsPercent` double(10,2) NOT NULL DEFAULT '0.00',
  `tdsAmount` double(10,2) NOT NULL DEFAULT '0.00',
  `totalAmount` double(10,2) NOT NULL DEFAULT '0.00',
  `extraForwardedAmount` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'pending' COMMENT 'pending, success',
  `transactionId` text,
  `payment_mode` varchar(255) DEFAULT NULL,
  `transactionDate` datetime DEFAULT NULL,
  `numOfDays` int(11) NOT NULL DEFAULT '0',
  `txnType` varchar(10) DEFAULT NULL COMMENT 'in, out',
  `outstandingBalance` varchar(255) DEFAULT NULL,
  `interestStartDate` date DEFAULT NULL,
  `isFullSettled` int(11) NOT NULL DEFAULT '0',
  `lateCharges` double(10,2) NOT NULL DEFAULT '0.00',
  `remark` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `raw_materials_txn_details`
--

INSERT INTO `raw_materials_txn_details` (`id`, `userId`, `loanId`, `debitRecordId`, `txnGroupId`, `amount`, `openingDate`, `openingBalance`, `interestAmount`, `interestAmountPayble`, `tdsPercent`, `tdsAmount`, `totalAmount`, `extraForwardedAmount`, `status`, `transactionId`, `payment_mode`, `transactionDate`, `numOfDays`, `txnType`, `outstandingBalance`, `interestStartDate`, `isFullSettled`, `lateCharges`, `remark`, `created_at`, `updated_at`) VALUES
(1, 52, 42, 0, NULL, 5000.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '15898', 'success', 'NA', 'NA', '2022-10-01 00:00:00', 0, 'out', '0', NULL, 1, 0.00, NULL, '2022-11-02 19:21:32', '2022-11-03 05:24:47'),
(2, 52, 42, 1, '1667416928|42|1', 901.00, NULL, 0.00, 110.00, 99.00, 10.00, 11.00, 1000.00, NULL, 'success', 'NA', 'NA', '2022-11-01 00:00:00', 31, 'in', '4099', '2022-11-02', 0, 0.00, NULL, '2022-11-02 19:22:08', '2022-11-02 19:22:08'),
(3, 58, 49, 0, NULL, 5000.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '10898', 'success', '1234', 'online', '2022-11-03 00:00:00', 0, 'out', '0', NULL, 1, 0.00, NULL, '2022-11-03 05:24:00', '2022-11-03 05:24:47'),
(4, 58, 49, 1, '1667453087|49|1', 4099.00, NULL, 0.00, 3.00, 3.00, 10.00, 0.00, 4102.00, NULL, 'success', '1231', 'online', '2022-11-03 00:00:00', 1, 'in', '0', NULL, 1, 0.00, NULL, '2022-11-03 05:24:47', '2022-11-03 05:24:47'),
(5, 58, 49, 3, '1667453087|49|1', 5000.00, NULL, 0.00, 0.00, 0.00, 10.00, 0.00, 5000.00, NULL, 'success', '1231', 'online', '2022-11-03 00:00:00', 0, 'in', '0', NULL, 1, 0.00, NULL, '2022-11-03 05:24:47', '2022-11-03 05:24:47'),
(6, 61, 51, 0, NULL, 5000.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0', 'success', '1234', 'online', '2022-11-03 00:00:00', 0, 'out', '0', NULL, 1, 0.00, NULL, '2022-11-03 06:42:05', '2022-11-03 06:45:48'),
(7, 61, 51, 6, '1667457747|51|1', 1000.00, NULL, 0.00, 0.00, 0.00, 10.00, 0.00, 1000.00, NULL, 'success', '1231', 'online', '2022-11-03 00:00:00', 0, 'in', '4000', '2022-11-04', 0, 0.00, NULL, '2022-11-03 06:42:27', '2022-11-03 06:42:27'),
(8, 61, 51, 6, '1667457793|51|1', 3997.00, NULL, 0.00, 3.00, 3.00, 10.00, 0.00, 4000.00, NULL, 'success', '1231', 'online', '2022-11-03 00:00:00', 1, 'in', '3', '2022-11-04', 0, 0.00, NULL, '2022-11-03 06:43:13', '2022-11-03 06:43:13'),
(9, 61, 51, 6, '1667457948|51|1', 3.00, NULL, 0.00, 0.00, 0.00, 10.00, 0.00, 3.00, NULL, 'success', '1231', 'online', '2022-11-03 00:00:00', 1, 'in', '0', NULL, 1, 0.00, NULL, '2022-11-03 06:45:48', '2022-11-03 06:45:48'),
(10, 61, 51, 0, NULL, 5000.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '942', 'success', '1234', 'online', '2022-11-03 00:00:00', 0, 'out', '0', NULL, 1, 0.00, NULL, '2022-11-03 06:50:56', '2022-11-09 06:19:17'),
(11, 61, 51, 10, '1667458280|51|1', 1000.00, NULL, 0.00, 0.00, 0.00, 10.00, 0.00, 1000.00, NULL, 'success', '1231', 'online', '2022-11-03 00:00:00', 0, 'in', '4000', '2022-11-04', 0, 0.00, NULL, '2022-11-03 06:51:20', '2022-11-03 06:51:20'),
(12, 55, 44, 0, NULL, 5000.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '-173', 'success', '1234', 'online', '2022-11-04 00:00:00', 0, 'out', '173', '2022-11-26', 0, 0.00, NULL, '2022-11-04 09:41:21', '2022-11-10 16:57:09'),
(13, 55, 44, 10, '1667554905|44|1', 1000.00, NULL, 0.00, 0.00, 0.00, 10.00, 0.00, 1000.00, NULL, 'success', '1231', 'online', '2022-11-04 00:00:00', 0, 'in', '3000', '2022-11-05', 0, 0.00, NULL, '2022-11-04 09:41:45', '2022-11-04 09:41:45'),
(14, 66, 56, 0, NULL, 5000.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 'success', '1234', 'online', '2022-11-04 00:00:00', 0, 'out', '5000', '2022-11-04', 0, 0.00, NULL, '2022-11-04 09:59:27', '2022-11-04 09:59:27'),
(15, 66, 56, 10, '1667555999|56|1', 978.00, NULL, 0.00, 25.00, 22.00, 10.00, 2.00, 1000.00, NULL, 'success', '1231', 'online', '2022-11-20 00:00:00', 15, 'in', '2022', '2022-11-21', 0, 0.00, NULL, '2022-11-04 09:59:59', '2022-11-04 09:59:59'),
(16, 66, 56, 10, '1667559474|56|1', 983.00, NULL, 0.00, 19.00, 17.00, 10.00, 2.00, 1000.00, NULL, 'success', '1231', 'online', '2022-11-04 00:00:00', 17, 'in', '1039', '2022-11-05', 0, 0.00, NULL, '2022-11-04 10:57:54', '2022-11-04 10:57:54'),
(17, 67, 57, 0, NULL, 5000.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 'success', '1234', 'online', '2022-11-08 00:00:00', 0, 'out', '5000', '2022-11-08', 0, 0.00, NULL, '2022-11-08 05:47:10', '2022-11-08 05:47:10'),
(18, 67, 57, 10, '1667886488|57|1', 981.00, NULL, 0.00, 21.00, 19.00, 10.00, 2.00, 1000.00, NULL, 'success', '1231', 'online', '2022-11-30 00:00:00', 25, 'in', '58', '2022-12-01', 0, 0.00, NULL, '2022-11-08 05:48:08', '2022-11-08 05:48:08'),
(19, 69, 59, 0, NULL, 5000.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 'success', '1234', 'online', '2022-11-09 00:00:00', 0, 'out', '5000', '2022-11-09', 0, 0.00, NULL, '2022-11-09 06:18:55', '2022-11-09 06:18:55'),
(20, 69, 59, 10, '1667974757|59|1', 58.00, NULL, 0.00, 0.00, 0.00, 10.00, 0.00, 58.00, NULL, 'success', '1231', 'online', '2022-11-30 00:00:00', 1, 'in', '0', NULL, 1, 0.00, NULL, '2022-11-09 06:19:17', '2022-11-09 06:19:17'),
(21, 69, 59, 12, '1667974757|59|1', 846.00, NULL, 0.00, 107.00, 96.00, 10.00, 11.00, 942.00, NULL, 'success', '1231', 'online', '2022-11-30 00:00:00', 26, 'in', '4154', '2022-12-01', 0, 0.00, NULL, '2022-11-09 06:19:17', '2022-11-09 06:19:17'),
(22, 73, 63, 0, NULL, 5000.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 'success', '1234', 'online', '2022-11-10 00:00:00', 0, 'out', '5000', '2022-11-10', 0, 0.00, NULL, '2022-11-10 05:10:54', '2022-11-10 05:10:54'),
(23, 73, 63, 12, '1668057072|63|1', 935.00, NULL, 4154.00, 72.00, 65.00, 10.00, 7.00, 1000.00, NULL, 'success', '1231', 'online', '2022-11-10 00:00:00', 21, 'in', '3219', '2022-11-11', 0, 0.00, NULL, '2022-11-10 05:11:12', '2022-11-10 05:11:12'),
(24, 73, 63, 12, '1668057287|63|1', 955.00, NULL, 3219.00, 50.00, 45.00, 10.00, 5.00, 1000.00, NULL, 'success', '1231', 'online', '2022-11-30 00:00:00', 19, 'in', '2264', '2022-12-01', 0, 0.00, NULL, '2022-11-10 05:14:47', '2022-11-10 05:14:47'),
(25, 74, 64, 0, NULL, 500.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 'success', '1234', 'online', '2022-11-10 00:00:00', 0, 'out', '500', '2022-11-10', 0, 0.00, NULL, '2022-11-10 05:48:07', '2022-11-10 05:48:07'),
(26, 74, 64, 12, '1668059963|64|1', 98.00, NULL, 2264.00, 2.00, 2.00, 10.00, 0.00, 100.00, NULL, 'success', '1231', 'online', '2022-11-30 00:00:00', 1, 'in', '2166', '2022-12-01', 0, 0.00, NULL, '2022-11-10 05:59:23', '2022-11-10 05:59:23'),
(31, 80, 70, 0, NULL, 4000.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 'success', '1234', 'online', '2022-11-11 00:00:00', 0, 'out', '4000', '2022-11-11', 0, 0.00, NULL, '2022-11-11 04:59:52', '2022-11-11 04:59:52'),
(32, 81, 71, 0, NULL, 5000.00, '2022-11-14', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2924', 'success', '1234', 'online', '2022-11-14 00:00:00', 0, 'out', '0', NULL, 1, 0.00, NULL, '2022-11-14 04:55:34', '2022-11-21 09:24:27'),
(33, 81, 71, 32, '1668401759|71|1', 941.00, '2022-11-14', 5000.00, 66.00, 59.00, 10.00, 7.00, 1000.00, NULL, 'success', '87888', 'online', '2022-11-30 00:00:00', 16, 'in', '4059', '2022-12-01', 0, 0.00, NULL, '2022-11-14 04:55:59', '2022-11-14 04:55:59'),
(34, 81, 71, 32, '1668402181|71|1', 2000.00, '2022-11-30', 4059.00, 0.00, 0.00, 10.00, 0.00, 2000.00, NULL, 'success', '1231', 'online', '2022-12-01 00:00:00', 0, 'in', '2059', '2022-12-02', 0, 0.00, NULL, '2022-11-14 05:03:01', '2022-11-14 05:03:01'),
(35, 81, 71, 32, '1669022667|71|1', 2059.00, '2022-12-01', 2059.00, 19.00, 17.00, 10.00, 2.00, 2076.00, NULL, 'success', 'gtyyhj', 'fino', '2022-11-21 00:00:00', 11, 'in', '0', NULL, 1, 0.00, NULL, '2022-11-21 09:24:27', '2022-11-21 09:24:27');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `minCibilScoreForApply` int(11) NOT NULL DEFAULT '0' COMMENT '0 => Anyone Can Apply',
  `termsAndConditions` longtext,
  `privacyPolicy` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `minCibilScoreForApply`, `termsAndConditions`, `privacyPolicy`, `created_at`, `updated_at`) VALUES
(1, 50, '<p><big><strong>Terms and Conditions</strong></big></p>\r\n\r\n<p>Use of this site is provided by Demos subject to the following Terms and Conditions:<br />\r\n1. Your use constitutes acceptance of these Terms and Conditions as at the date of your first use of the site.<br />\r\n2. Demos reserves the rights to change these Terms and Conditions at any time by posting changes online. Your continued use of this site after changes are posted constitutes your acceptance of this agreement as modified.<br />\r\n3. You agree to use this site only for lawful purposes, and in a manner which does not infringe the rights, or restrict, or inhibit the use and enjoyment of the site by any third party.<br />\r\n4. This site and the information, names, images, pictures, logos regarding or relating to Demos are provided &ldquo;as is&rdquo; without any representation or endorsement made and without warranty of any kind whether express or implied. In no event will Demos be liable for any damages including, without limitation, indirect or consequential damages, or any damages whatsoever arising from the use or in connection with such use or loss of use of the site, whether in contract or in negligence.<br />\r\n5. Demos does not warrant that the functions contained in the material contained in this site will be uninterrupted or error free, that defects will be corrected, or that this site or the server that makes it available are free of viruses or bugs or represents the full functionality, accuracy and reliability of the materials.<br />\r\n6. Copyright restrictions: please refer to our Creative Commons license terms governing the use of material on this site.<br />\r\n7. Demos takes no responsibility for the content of external Internet Sites.<br />\r\n8. Any communication or material that you transmit to, or post on, any public area of the site including any data, questions, comments, suggestions, or the like, is, and will be treated as, non-confidential and non-proprietary information.<br />\r\n9. If there is any conflict between these Terms and Conditions and rules and/or specific terms of use appearing on this site relating to specific material then the latter shall prevail.<br />\r\n10. These terms and conditions shall be governed and construed in accordance with the laws of England and Wales. Any disputes shall be subject to the exclusive jurisdiction of the Courts of England and Wales.<br />\r\n11. If these Terms and Conditions are not accepted in full, the use of this site must be terminated immediately.</p>', '<p><strong>Privacy Policy</strong>&nbsp;</p>\r\n\r\n<p><strong>INFORMATION PROVIDED DIRECTLY BY YOU</strong></p>\r\n\r\n<ol>\r\n	<li>We collect information you provide directly to us, such as when you request information, create or modify your personal account, request Services, subscribe to our Services, complete a Lorem Ipsum form, survey, quiz or application, contact customer support, join or enroll for an event or otherwise communicate with us in any manner. This information may include, without limitation: name, date of birth, e-mail address, physical address, business address, phone number, or any other personal information you choose to provide.</li>\r\n	<li>\r\n	<h2>INFORMATION COLLECTED THROUGH YOUR USE OF OUR SERVICES</h2>\r\n	</li>\r\n	<li>The following are situations in which you may provide Your Information to us:</li>\r\n	<li>We also automatically collect information via the Website through the use of various technologies, including, but not limited to Cookies and Web Beacons (explained below). We may collect your IP address, browsing behavior and device IDs. This information is used by us in order to enable us to better understand how our Services are being used by visitors and allows us to administer and customize the Services to improve your overall experience.</li>\r\n	<li>When you fill out forms or fields through our Services;</li>\r\n	<li>When you register for an account with our Service;</li>\r\n	<li>When you create a subscription for our newsletter or Services;</li>\r\n	<li>When you provide responses to a survey;</li>\r\n	<li>When you answer questions on a quiz;</li>\r\n	<li>When you join or enroll in an event through our Services;</li>\r\n	<li>When you order services or products from, or through our Service;</li>\r\n	<li>When you provide information to us through a third-party application, service or Website;</li>\r\n	<li>When you communicate with us or request information about us or our products or Services, whether via email or other means; and</li>\r\n	<li>When you participate in any of our marketing initiatives, including, contests, events, or promotions.</li>\r\n</ol>\r\n\r\n<p>We also automatically collect information via the Website through the use of various technologies, including, but not limited to Cookies and Web Beacons (explained below). We may collect your IP address, browsing behavior and device IDs. This information is used by us in order to enable us to better understand how our Services are being used by visitors and allows us to administer and customize the Services to improve your overall experien</p>', '2022-07-31 02:22:33', '2022-09-01 19:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL DEFAULT '0',
  `name` text,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `system_access_logs`
--

CREATE TABLE `system_access_logs` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL DEFAULT '0',
  `ipAddress` text,
  `loginDateTime` datetime DEFAULT NULL,
  `logoutDateTime` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_access_logs`
--

INSERT INTO `system_access_logs` (`id`, `userId`, `ipAddress`, `loginDateTime`, `logoutDateTime`, `created_at`, `updated_at`) VALUES
(1, 1, '127.0.0.1', '2022-09-17 19:54:53', NULL, '2022-09-17 19:54:53', '2022-09-17 19:54:53'),
(2, 1, '43.230.197.63', '2022-09-17 21:13:00', NULL, '2022-09-17 21:13:00', '2022-09-17 21:13:00'),
(3, 1, '223.233.67.23', '2022-09-19 05:46:07', NULL, '2022-09-19 05:46:07', '2022-09-19 05:46:07'),
(4, 1, '106.210.37.4', '2022-09-19 10:53:24', NULL, '2022-09-19 10:53:24', '2022-09-19 10:53:24'),
(5, 1, '47.31.160.14', '2022-09-19 17:35:02', '2022-09-19 17:36:14', '2022-09-19 17:35:02', '2022-09-19 17:36:14'),
(6, 1, '223.233.71.121', '2022-09-20 04:58:17', NULL, '2022-09-20 04:58:17', '2022-09-20 04:58:17'),
(7, 1, '203.92.45.222', '2022-09-20 05:58:04', NULL, '2022-09-20 05:58:04', '2022-09-20 05:58:04'),
(8, 1, '223.233.64.229', '2022-09-21 07:43:44', NULL, '2022-09-21 07:43:44', '2022-09-21 07:43:44'),
(9, 1, '223.233.64.229', '2022-09-21 10:35:46', NULL, '2022-09-21 10:35:46', '2022-09-21 10:35:46'),
(10, 1, '223.233.64.199', '2022-09-26 06:37:36', NULL, '2022-09-26 06:37:36', '2022-09-26 06:37:36'),
(11, 1, '180.151.238.56', '2022-09-27 08:56:04', NULL, '2022-09-27 08:56:04', '2022-09-27 08:56:04'),
(12, 1, '223.233.64.199', '2022-09-27 09:36:21', NULL, '2022-09-27 09:36:21', '2022-09-27 09:36:21'),
(13, 16, '119.82.87.198', '2022-09-27 12:33:41', '2022-09-27 12:36:09', '2022-09-27 12:33:41', '2022-09-27 12:36:09'),
(14, 16, '119.82.87.198', '2022-09-27 12:36:17', NULL, '2022-09-27 12:36:17', '2022-09-27 12:36:17'),
(15, 1, '223.233.64.199', '2022-09-28 07:01:55', NULL, '2022-09-28 07:01:55', '2022-09-28 07:01:55'),
(16, 1, '223.233.67.188', '2022-09-29 12:00:11', NULL, '2022-09-29 12:00:11', '2022-09-29 12:00:11'),
(17, 1, '223.233.67.188', '2022-09-30 12:23:20', NULL, '2022-09-30 12:23:20', '2022-09-30 12:23:20'),
(18, 22, '223.233.67.188', '2022-09-30 12:51:16', NULL, '2022-09-30 12:51:16', '2022-09-30 12:51:16'),
(19, 22, '125.63.123.71', '2022-10-03 04:52:42', NULL, '2022-10-03 04:52:42', '2022-10-03 04:52:42'),
(20, 1, '180.151.19.169', '2022-10-04 10:09:49', NULL, '2022-10-04 10:09:49', '2022-10-04 10:09:49'),
(21, 1, '223.233.71.173', '2022-10-04 11:35:53', NULL, '2022-10-04 11:35:53', '2022-10-04 11:35:53'),
(22, 1, '119.82.92.245', '2022-10-06 04:50:08', NULL, '2022-10-06 04:50:08', '2022-10-06 04:50:08'),
(23, 1, '223.233.71.173', '2022-10-06 06:09:02', NULL, '2022-10-06 06:09:02', '2022-10-06 06:09:02'),
(24, 1, '119.82.92.245', '2022-10-07 04:48:13', NULL, '2022-10-07 04:48:13', '2022-10-07 04:48:13'),
(25, 1, '223.233.71.173', '2022-10-07 06:29:18', '2022-10-07 06:32:59', '2022-10-07 06:29:18', '2022-10-07 06:32:59'),
(26, 1, '223.233.71.173', '2022-10-07 06:33:06', NULL, '2022-10-07 06:33:06', '2022-10-07 06:33:06'),
(27, 1, '223.233.76.2', '2022-10-08 11:01:34', NULL, '2022-10-08 11:01:34', '2022-10-08 11:01:34'),
(28, 1, '180.151.16.177', '2022-10-10 05:05:21', NULL, '2022-10-10 05:05:21', '2022-10-10 05:05:21'),
(29, 1, '180.151.16.177', '2022-10-10 05:26:10', '2022-10-10 05:26:34', '2022-10-10 05:26:10', '2022-10-10 05:26:34'),
(30, 22, '180.151.16.177', '2022-10-10 05:27:04', '2022-10-10 05:30:33', '2022-10-10 05:27:04', '2022-10-10 05:30:33'),
(31, 22, '180.151.16.177', '2022-10-10 05:31:22', '2022-10-10 05:31:48', '2022-10-10 05:31:22', '2022-10-10 05:31:48'),
(32, 1, '180.151.77.238', '2022-10-12 04:45:26', '2022-10-12 04:45:42', '2022-10-12 04:45:26', '2022-10-12 04:45:42'),
(33, 1, '180.151.77.238', '2022-10-12 04:45:51', NULL, '2022-10-12 04:45:51', '2022-10-12 04:45:51'),
(34, 1, '43.230.197.63', '2022-10-12 20:39:21', NULL, '2022-10-12 20:39:21', '2022-10-12 20:39:21'),
(35, 1, '43.230.197.63', '2022-10-12 22:44:22', NULL, '2022-10-12 22:44:22', '2022-10-12 22:44:22'),
(36, 1, '180.151.77.238', '2022-10-13 04:24:14', '2022-10-13 04:51:27', '2022-10-13 04:24:14', '2022-10-13 04:51:27'),
(37, 1, '180.151.77.238', '2022-10-13 04:51:33', NULL, '2022-10-13 04:51:33', '2022-10-13 04:51:33'),
(38, 35, '180.151.77.238', '2022-10-13 05:06:39', '2022-10-13 05:09:17', '2022-10-13 05:06:39', '2022-10-13 05:09:17'),
(39, 35, '180.151.77.238', '2022-10-13 05:09:24', '2022-10-13 05:16:22', '2022-10-13 05:09:24', '2022-10-13 05:16:22'),
(40, 35, '180.151.77.238', '2022-10-13 05:16:54', NULL, '2022-10-13 05:16:54', '2022-10-13 05:16:54'),
(41, 1, '180.151.77.238', '2022-10-13 09:38:57', NULL, '2022-10-13 09:38:57', '2022-10-13 09:38:57'),
(42, 1, '223.233.72.252', '2022-10-13 16:47:25', NULL, '2022-10-13 16:47:25', '2022-10-13 16:47:25'),
(43, 35, '223.233.72.252', '2022-10-13 16:49:07', '2022-10-13 16:51:09', '2022-10-13 16:49:07', '2022-10-13 16:51:09'),
(44, 35, '223.233.72.252', '2022-10-13 16:51:35', NULL, '2022-10-13 16:51:35', '2022-10-13 16:51:35'),
(45, 1, '43.230.197.63', '2022-10-13 18:36:23', '2022-10-13 18:36:37', '2022-10-13 18:36:23', '2022-10-13 18:36:37'),
(46, 1, '43.230.197.63', '2022-10-13 18:37:14', NULL, '2022-10-13 18:37:14', '2022-10-13 18:37:14'),
(47, 1, '180.151.77.238', '2022-10-14 04:31:54', NULL, '2022-10-14 04:31:54', '2022-10-14 04:31:54'),
(48, 1, '223.233.72.112', '2022-10-14 11:55:58', NULL, '2022-10-14 11:55:58', '2022-10-14 11:55:58'),
(49, 35, '223.233.72.112', '2022-10-14 11:58:41', '2022-10-14 12:09:13', '2022-10-14 11:58:41', '2022-10-14 12:09:13'),
(50, 35, '223.233.72.112', '2022-10-14 12:09:21', '2022-10-14 12:14:36', '2022-10-14 12:09:21', '2022-10-14 12:14:36'),
(51, 35, '223.233.72.112', '2022-10-14 12:14:43', '2022-10-14 12:32:42', '2022-10-14 12:14:43', '2022-10-14 12:32:42'),
(52, 35, '223.233.72.112', '2022-10-14 12:32:49', '2022-10-14 12:34:48', '2022-10-14 12:32:49', '2022-10-14 12:34:48'),
(53, 35, '223.233.72.112', '2022-10-14 12:34:54', '2022-10-14 12:35:32', '2022-10-14 12:34:54', '2022-10-14 12:35:32'),
(54, 35, '223.233.72.112', '2022-10-14 12:35:38', '2022-10-14 12:41:16', '2022-10-14 12:35:38', '2022-10-14 12:41:16'),
(55, 35, '223.233.72.112', '2022-10-14 12:41:23', '2022-10-14 12:45:56', '2022-10-14 12:41:23', '2022-10-14 12:45:56'),
(56, 35, '223.233.72.112', '2022-10-14 12:46:03', '2022-10-14 12:56:14', '2022-10-14 12:46:03', '2022-10-14 12:56:14'),
(57, 35, '223.233.72.112', '2022-10-14 12:56:21', '2022-10-14 12:58:01', '2022-10-14 12:56:21', '2022-10-14 12:58:01'),
(58, 35, '223.233.72.112', '2022-10-14 12:58:07', '2022-10-14 12:59:15', '2022-10-14 12:58:07', '2022-10-14 12:59:15'),
(59, 35, '223.233.72.112', '2022-10-14 12:59:22', '2022-10-14 13:01:36', '2022-10-14 12:59:22', '2022-10-14 13:01:36'),
(60, 35, '223.233.72.112', '2022-10-14 13:01:44', '2022-10-14 13:04:15', '2022-10-14 13:01:44', '2022-10-14 13:04:15'),
(61, 35, '223.233.72.112', '2022-10-14 13:04:47', '2022-10-14 13:07:17', '2022-10-14 13:04:47', '2022-10-14 13:07:17'),
(62, 35, '223.233.72.112', '2022-10-14 13:07:30', NULL, '2022-10-14 13:07:30', '2022-10-14 13:07:30'),
(63, 1, '223.233.72.112', '2022-10-17 04:55:02', '2022-10-17 06:54:14', '2022-10-17 04:55:02', '2022-10-17 06:54:14'),
(64, 1, '223.233.72.112', '2022-10-17 06:54:23', NULL, '2022-10-17 06:54:23', '2022-10-17 06:54:23'),
(65, 1, '122.162.146.63', '2022-10-17 07:54:49', NULL, '2022-10-17 07:54:49', '2022-10-17 07:54:49'),
(66, 1, '223.233.72.112', '2022-10-17 08:52:59', NULL, '2022-10-17 08:52:59', '2022-10-17 08:52:59'),
(67, 1, '223.233.72.112', '2022-10-17 09:35:20', NULL, '2022-10-17 09:35:20', '2022-10-17 09:35:20'),
(68, 45, '122.162.147.215', '2022-10-17 09:40:06', '2022-10-17 09:41:24', '2022-10-17 09:40:06', '2022-10-17 09:41:24'),
(69, 45, '223.233.72.112', '2022-10-17 09:40:27', '2022-10-17 09:42:05', '2022-10-17 09:40:27', '2022-10-17 09:42:05'),
(70, 45, '122.162.147.215', '2022-10-17 09:41:57', '2022-10-17 11:15:14', '2022-10-17 09:41:57', '2022-10-17 11:15:14'),
(71, 45, '223.233.72.112', '2022-10-17 09:42:12', '2022-10-17 10:03:59', '2022-10-17 09:42:12', '2022-10-17 10:03:59'),
(72, 45, '223.233.72.112', '2022-10-17 10:04:08', NULL, '2022-10-17 10:04:08', '2022-10-17 10:04:08'),
(73, 1, '122.162.147.215', '2022-10-17 11:15:17', NULL, '2022-10-17 11:15:17', '2022-10-17 11:15:17'),
(74, 46, '119.82.90.66', '2022-10-17 11:41:11', '2022-10-17 12:36:44', '2022-10-17 11:41:11', '2022-10-17 12:36:44'),
(75, 35, '223.233.72.112', '2022-10-17 13:54:01', '2022-10-17 13:54:31', '2022-10-17 13:54:01', '2022-10-17 13:54:31'),
(76, 35, '223.233.72.112', '2022-10-17 13:54:39', NULL, '2022-10-17 13:54:39', '2022-10-17 13:54:39'),
(77, 46, '119.82.90.66', '2022-10-18 04:48:03', NULL, '2022-10-18 04:48:03', '2022-10-18 04:48:03'),
(78, 1, '122.162.147.110', '2022-10-18 06:01:26', NULL, '2022-10-18 06:01:26', '2022-10-18 06:01:26'),
(79, 46, '119.82.90.66', '2022-10-18 08:59:42', '2022-10-18 11:19:38', '2022-10-18 08:59:42', '2022-10-18 11:19:38'),
(80, 1, '223.233.73.146', '2022-10-18 09:34:48', NULL, '2022-10-18 09:34:48', '2022-10-18 09:34:48'),
(81, 1, '223.233.73.146', '2022-10-18 09:54:19', NULL, '2022-10-18 09:54:19', '2022-10-18 09:54:19'),
(82, 1, '180.151.224.183', '2022-10-18 10:42:41', NULL, '2022-10-18 10:42:41', '2022-10-18 10:42:41'),
(83, 46, '119.82.90.66', '2022-10-18 11:19:56', NULL, '2022-10-18 11:19:56', '2022-10-18 11:19:56'),
(84, 1, '223.233.73.146', '2022-10-18 12:00:18', NULL, '2022-10-18 12:00:18', '2022-10-18 12:00:18'),
(85, 1, '223.233.64.162', '2022-10-19 06:19:11', NULL, '2022-10-19 06:19:11', '2022-10-19 06:19:11'),
(86, 35, '223.233.64.162', '2022-10-19 06:40:38', '2022-10-19 06:44:19', '2022-10-19 06:40:38', '2022-10-19 06:44:19'),
(87, 35, '223.233.64.162', '2022-10-19 06:44:26', '2022-10-19 06:47:59', '2022-10-19 06:44:26', '2022-10-19 06:47:59'),
(88, 35, '223.233.64.162', '2022-10-19 06:48:05', '2022-10-19 06:50:13', '2022-10-19 06:48:05', '2022-10-19 06:50:13'),
(89, 35, '223.233.64.162', '2022-10-19 06:50:20', '2022-10-19 06:56:46', '2022-10-19 06:50:20', '2022-10-19 06:56:46'),
(90, 35, '223.233.64.162', '2022-10-19 06:56:53', '2022-10-19 06:58:45', '2022-10-19 06:56:53', '2022-10-19 06:58:45'),
(91, 35, '223.233.64.162', '2022-10-19 06:58:50', '2022-10-19 07:02:33', '2022-10-19 06:58:50', '2022-10-19 07:02:33'),
(92, 35, '223.233.64.162', '2022-10-19 07:02:39', '2022-10-19 07:32:59', '2022-10-19 07:02:39', '2022-10-19 07:32:59'),
(93, 35, '223.233.64.162', '2022-10-19 07:33:06', NULL, '2022-10-19 07:33:06', '2022-10-19 07:33:06'),
(94, 1, '223.233.64.162', '2022-10-20 05:03:49', NULL, '2022-10-20 05:03:49', '2022-10-20 05:03:49'),
(95, 46, '203.92.45.222', '2022-10-20 05:37:40', NULL, '2022-10-20 05:37:40', '2022-10-20 05:37:40'),
(96, 1, '223.233.64.162', '2022-10-20 09:45:48', NULL, '2022-10-20 09:45:48', '2022-10-20 09:45:48'),
(97, 1, '223.233.64.162', '2022-10-21 06:53:07', NULL, '2022-10-21 06:53:07', '2022-10-21 06:53:07'),
(98, 1, '223.233.75.84', '2022-10-23 03:32:05', NULL, '2022-10-23 03:32:05', '2022-10-23 03:32:05'),
(99, 1, '180.151.224.183', '2022-10-27 05:43:02', NULL, '2022-10-27 05:43:02', '2022-10-27 05:43:02'),
(100, 1, '223.233.64.162', '2022-10-27 06:36:15', '2022-10-27 06:38:39', '2022-10-27 06:36:15', '2022-10-27 06:38:39'),
(101, 1, '180.151.224.183', '2022-10-27 12:10:17', NULL, '2022-10-27 12:10:17', '2022-10-27 12:10:17'),
(102, 1, '180.151.77.76', '2022-10-28 04:56:03', NULL, '2022-10-28 04:56:03', '2022-10-28 04:56:03'),
(103, 1, '223.233.64.162', '2022-10-28 07:53:14', NULL, '2022-10-28 07:53:14', '2022-10-28 07:53:14'),
(104, 1, '223.233.64.162', '2022-10-28 07:55:47', NULL, '2022-10-28 07:55:47', '2022-10-28 07:55:47'),
(105, 1, '223.233.64.162', '2022-10-28 10:17:46', NULL, '2022-10-28 10:17:46', '2022-10-28 10:17:46'),
(106, 1, '180.151.245.133', '2022-10-29 07:35:14', NULL, '2022-10-29 07:35:14', '2022-10-29 07:35:14'),
(107, 1, '180.151.245.133', '2022-10-29 09:43:34', NULL, '2022-10-29 09:43:34', '2022-10-29 09:43:34'),
(108, 1, '122.162.145.70', '2022-10-31 11:21:32', NULL, '2022-10-31 11:21:32', '2022-10-31 11:21:32'),
(109, 46, '119.82.90.66', '2022-11-01 12:19:25', '2022-11-01 12:25:39', '2022-11-01 12:19:25', '2022-11-01 12:25:39'),
(110, 1, '43.230.197.63', '2022-11-01 19:19:35', NULL, '2022-11-01 19:19:35', '2022-11-01 19:19:35'),
(111, 1, '43.230.197.63', '2022-11-02 03:10:53', NULL, '2022-11-02 03:10:53', '2022-11-02 03:10:53'),
(112, 1, '180.151.245.4', '2022-11-02 04:43:57', NULL, '2022-11-02 04:43:57', '2022-11-02 04:43:57'),
(113, 1, '43.230.197.63', '2022-11-02 16:40:49', NULL, '2022-11-02 16:40:49', '2022-11-02 16:40:49'),
(114, 1, '180.151.23.215', '2022-11-03 04:53:58', NULL, '2022-11-03 04:53:58', '2022-11-03 04:53:58'),
(115, 1, '122.162.146.160', '2022-11-03 06:10:16', NULL, '2022-11-03 06:10:16', '2022-11-03 06:10:16'),
(116, 1, '119.82.90.66', '2022-11-03 09:12:16', NULL, '2022-11-03 09:12:16', '2022-11-03 09:12:16'),
(117, 1, '119.82.90.66', '2022-11-03 09:12:52', '2022-11-03 11:59:25', '2022-11-03 09:12:52', '2022-11-03 11:59:25'),
(118, 1, '223.233.73.86', '2022-11-03 17:51:22', NULL, '2022-11-03 17:51:22', '2022-11-03 17:51:22'),
(119, 1, '43.230.197.63', '2022-11-03 17:53:43', NULL, '2022-11-03 17:53:43', '2022-11-03 17:53:43'),
(120, 1, '180.151.19.248', '2022-11-04 04:50:10', NULL, '2022-11-04 04:50:10', '2022-11-04 04:50:10'),
(121, 1, '47.31.141.234', '2022-11-04 07:18:01', NULL, '2022-11-04 07:18:01', '2022-11-04 07:18:01'),
(122, 1, '223.233.76.37', '2022-11-04 09:37:26', NULL, '2022-11-04 09:37:26', '2022-11-04 09:37:26'),
(123, 1, '47.31.162.61', '2022-11-05 07:04:11', NULL, '2022-11-05 07:04:11', '2022-11-05 07:04:11'),
(124, 1, '43.230.197.63', '2022-11-07 18:53:03', NULL, '2022-11-07 18:53:03', '2022-11-07 18:53:03'),
(125, 1, '43.230.197.63', '2022-11-07 21:15:55', '2022-11-07 21:20:46', '2022-11-07 21:15:55', '2022-11-07 21:20:46'),
(126, 1, '180.151.19.94', '2022-11-08 04:52:07', NULL, '2022-11-08 04:52:07', '2022-11-08 04:52:07'),
(127, 1, '119.82.82.247', '2022-11-09 04:42:33', NULL, '2022-11-09 04:42:33', '2022-11-09 04:42:33'),
(128, 1, '223.233.77.168', '2022-11-09 16:37:04', NULL, '2022-11-09 16:37:04', '2022-11-09 16:37:04'),
(129, 1, '43.230.197.63', '2022-11-09 16:37:08', NULL, '2022-11-09 16:37:08', '2022-11-09 16:37:08'),
(130, 1, '43.230.197.63', '2022-11-09 20:56:39', NULL, '2022-11-09 20:56:39', '2022-11-09 20:56:39'),
(131, 1, '119.82.82.247', '2022-11-10 04:55:17', NULL, '2022-11-10 04:55:17', '2022-11-10 04:55:17'),
(132, 1, '223.233.72.223', '2022-11-10 09:33:09', NULL, '2022-11-10 09:33:09', '2022-11-10 09:33:09'),
(133, 1, '122.162.145.126', '2022-11-10 12:25:16', NULL, '2022-11-10 12:25:16', '2022-11-10 12:25:16'),
(134, 1, '180.151.90.196', '2022-11-10 12:26:04', NULL, '2022-11-10 12:26:04', '2022-11-10 12:26:04'),
(135, 1, '223.233.69.16', '2022-11-10 16:19:54', NULL, '2022-11-10 16:19:54', '2022-11-10 16:19:54'),
(136, 1, '43.230.197.63', '2022-11-10 16:46:41', NULL, '2022-11-10 16:46:41', '2022-11-10 16:46:41'),
(137, 1, '43.230.197.63', '2022-11-10 16:52:16', NULL, '2022-11-10 16:52:16', '2022-11-10 16:52:16'),
(138, 1, '119.82.82.247', '2022-11-11 04:48:28', NULL, '2022-11-11 04:48:28', '2022-11-11 04:48:28'),
(139, 1, '223.233.72.223', '2022-11-14 04:41:18', NULL, '2022-11-14 04:41:18', '2022-11-14 04:41:18'),
(140, 1, '106.198.181.247', '2022-11-14 06:18:38', NULL, '2022-11-14 06:18:38', '2022-11-14 06:18:38'),
(141, 1, '223.233.72.223', '2022-11-14 10:10:22', NULL, '2022-11-14 10:10:22', '2022-11-14 10:10:22'),
(142, 1, '119.82.82.247', '2022-11-14 10:12:02', NULL, '2022-11-14 10:12:02', '2022-11-14 10:12:02'),
(143, 1, '223.233.72.223', '2022-11-15 04:37:01', NULL, '2022-11-15 04:37:01', '2022-11-15 04:37:01'),
(144, 1, '106.198.128.161', '2022-11-15 04:40:05', NULL, '2022-11-15 04:40:05', '2022-11-15 04:40:05'),
(145, 1, '223.233.72.223', '2022-11-15 04:56:23', NULL, '2022-11-15 04:56:23', '2022-11-15 04:56:23'),
(146, 1, '180.151.238.110', '2022-11-15 10:50:48', NULL, '2022-11-15 10:50:48', '2022-11-15 10:50:48'),
(147, 1, '223.233.72.223', '2022-11-15 11:21:32', NULL, '2022-11-15 11:21:32', '2022-11-15 11:21:32'),
(148, 1, '122.161.51.130', '2022-11-15 11:51:47', NULL, '2022-11-15 11:51:47', '2022-11-15 11:51:47'),
(149, 1, '180.151.23.223', '2022-11-15 11:54:00', NULL, '2022-11-15 11:54:00', '2022-11-15 11:54:00'),
(150, 1, '43.230.197.63', '2022-11-15 20:10:57', '2022-11-15 20:46:57', '2022-11-15 20:10:57', '2022-11-15 20:46:57'),
(151, 1, '43.230.197.63', '2022-11-15 21:24:01', '2022-11-15 21:24:11', '2022-11-15 21:24:01', '2022-11-15 21:24:11'),
(152, 1, '157.37.158.162', '2022-11-16 03:37:35', NULL, '2022-11-16 03:37:35', '2022-11-16 03:37:35'),
(153, 1, '223.233.72.223', '2022-11-16 05:01:08', NULL, '2022-11-16 05:01:08', '2022-11-16 05:01:08'),
(154, 1, '180.151.23.223', '2022-11-16 05:24:07', NULL, '2022-11-16 05:24:07', '2022-11-16 05:24:07'),
(155, 1, '122.162.148.132', '2022-11-16 06:09:10', NULL, '2022-11-16 06:09:10', '2022-11-16 06:09:10'),
(156, 1, '223.233.72.223', '2022-11-16 10:43:45', NULL, '2022-11-16 10:43:45', '2022-11-16 10:43:45'),
(157, 1, '157.37.187.101', '2022-11-17 03:41:13', NULL, '2022-11-17 03:41:13', '2022-11-17 03:41:13'),
(158, 1, '157.37.187.101', '2022-11-17 04:58:54', NULL, '2022-11-17 04:58:54', '2022-11-17 04:58:54'),
(159, 1, '223.233.72.223', '2022-11-17 05:23:51', NULL, '2022-11-17 05:23:51', '2022-11-17 05:23:51'),
(160, 1, '122.162.148.190', '2022-11-17 07:00:12', NULL, '2022-11-17 07:00:12', '2022-11-17 07:00:12'),
(161, 1, '223.233.72.223', '2022-11-17 12:13:06', NULL, '2022-11-17 12:13:06', '2022-11-17 12:13:06'),
(162, 1, '223.233.72.223', '2022-11-17 12:18:37', '2022-11-17 12:18:45', '2022-11-17 12:18:37', '2022-11-17 12:18:45'),
(163, 35, '223.233.72.223', '2022-11-17 12:21:01', '2022-11-17 12:21:09', '2022-11-17 12:21:01', '2022-11-17 12:21:09'),
(164, 35, '223.233.72.223', '2022-11-17 12:55:15', NULL, '2022-11-17 12:55:15', '2022-11-17 12:55:15'),
(165, 1, '43.230.197.63', '2022-11-17 19:42:27', NULL, '2022-11-17 19:42:27', '2022-11-17 19:42:27'),
(166, 1, '106.198.145.224', '2022-11-18 03:39:36', NULL, '2022-11-18 03:39:36', '2022-11-18 03:39:36'),
(167, 1, '223.233.77.115', '2022-11-18 06:51:14', NULL, '2022-11-18 06:51:14', '2022-11-18 06:51:14'),
(168, 1, '106.198.163.164', '2022-11-18 07:02:26', NULL, '2022-11-18 07:02:26', '2022-11-18 07:02:26'),
(169, 97, '223.233.77.115', '2022-11-18 07:09:59', '2022-11-18 07:10:42', '2022-11-18 07:09:59', '2022-11-18 07:10:42'),
(170, 97, '223.233.77.115', '2022-11-18 07:10:56', '2022-11-18 07:12:48', '2022-11-18 07:10:56', '2022-11-18 07:12:48'),
(171, 97, '223.233.77.115', '2022-11-18 07:12:55', '2022-11-18 07:16:30', '2022-11-18 07:12:55', '2022-11-18 07:16:30'),
(172, 97, '223.233.77.115', '2022-11-18 07:16:36', '2022-11-18 07:18:04', '2022-11-18 07:16:36', '2022-11-18 07:18:04'),
(173, 97, '223.233.77.115', '2022-11-18 07:18:11', NULL, '2022-11-18 07:18:11', '2022-11-18 07:18:11'),
(174, 1, '47.31.156.114', '2022-11-19 03:39:15', NULL, '2022-11-19 03:39:15', '2022-11-19 03:39:15'),
(175, 1, '223.233.69.38', '2022-11-21 04:35:33', NULL, '2022-11-21 04:35:33', '2022-11-21 04:35:33'),
(176, 1, '103.211.52.202', '2022-11-21 06:40:00', NULL, '2022-11-21 06:40:00', '2022-11-21 06:40:00'),
(177, 1, '106.215.237.155', '2022-11-21 07:25:31', NULL, '2022-11-21 07:25:31', '2022-11-21 07:25:31'),
(178, 1, '103.211.52.202', '2022-11-21 07:31:13', NULL, '2022-11-21 07:31:13', '2022-11-21 07:31:13'),
(179, 1, '103.211.52.202', '2022-11-21 08:55:23', NULL, '2022-11-21 08:55:23', '2022-11-21 08:55:23');

-- --------------------------------------------------------

--
-- Table structure for table `tech_supports`
--

CREATE TABLE `tech_supports` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext,
  `images` text,
  `priority` varchar(200) DEFAULT NULL COMMENT 'High, Low, Medium',
  `status` varchar(200) DEFAULT NULL COMMENT 'New, Working, Closed',
  `solvedDate` date DEFAULT NULL,
  `ticketDate` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tenures`
--

CREATE TABLE `tenures` (
  `id` int(11) NOT NULL,
  `name` text,
  `numOfMonths` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tenures`
--

INSERT INTO `tenures` (`id`, `name`, `numOfMonths`, `status`, `created_at`, `updated_at`) VALUES
(1, '3 Months', 3, 1, '2022-07-03 13:06:35', '2022-07-03 13:06:35'),
(2, '6 Months', 6, 1, '2022-07-03 13:06:35', '2022-07-03 13:06:35'),
(3, '9 Months', 9, 1, '2022-07-03 13:06:35', '2022-07-03 13:06:35'),
(4, '12 Months', 12, 1, '2022-07-03 13:06:35', '2022-07-03 13:06:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `customerCode` varchar(255) DEFAULT NULL,
  `nameTitle` varchar(100) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` text,
  `gender` varchar(255) DEFAULT NULL,
  `profilePic` text,
  `dateOfBirth` date DEFAULT NULL,
  `maritalStatus` varchar(200) DEFAULT NULL,
  `addressLine1` text,
  `addressLine2` text,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `pincode` varchar(200) DEFAULT NULL,
  `deviceToken` text,
  `userMpin` varchar(10) DEFAULT NULL,
  `aadhaar_no` varchar(255) DEFAULT NULL,
  `pancard_no` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `educationStatus` varchar(255) DEFAULT NULL,
  `fatherName` varchar(255) DEFAULT NULL,
  `motherName` varchar(255) DEFAULT NULL,
  `sourcePerson` varchar(255) DEFAULT NULL,
  `branchName` varchar(255) DEFAULT NULL,
  `cibilScore` varchar(200) DEFAULT NULL,
  `deviceType` varchar(200) DEFAULT NULL,
  `deviceId` text,
  `userType` varchar(100) DEFAULT NULL COMMENT 'user OR interger roles id',
  `remember_token` text,
  `status` int(11) NOT NULL DEFAULT '0',
  `kycStatus` varchar(100) DEFAULT 'pending',
  `viewKycDetails` int(11) NOT NULL DEFAULT '0',
  `viewPersonalDetails` int(11) NOT NULL DEFAULT '0',
  `viewProfessionalDetails` int(11) NOT NULL DEFAULT '0',
  `viewBankDetails` int(11) NOT NULL DEFAULT '0',
  `userPermissions` longtext,
  `lattitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `customerCode`, `nameTitle`, `name`, `mobile`, `email`, `password`, `gender`, `profilePic`, `dateOfBirth`, `maritalStatus`, `addressLine1`, `addressLine2`, `city`, `state`, `district`, `pincode`, `deviceToken`, `userMpin`, `aadhaar_no`, `pancard_no`, `religion`, `educationStatus`, `fatherName`, `motherName`, `sourcePerson`, `branchName`, `cibilScore`, `deviceType`, `deviceId`, `userType`, `remember_token`, `status`, `kycStatus`, `viewKycDetails`, `viewPersonalDetails`, `viewProfessionalDetails`, `viewBankDetails`, `userPermissions`, `lattitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN01', NULL, 'Superadmin', '8787878787', 'superadmin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'VYirGyatrzB4DWSoRSPNx68Y33LgbmhBsP6ne3HZcxGRQFYNJBjobAhnDLCA', 1, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL),
(2, 'ADMIN02', NULL, 'Admin', '8877887788', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 0, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL),
(3, 'ME000001', NULL, 'Abhi Shukla', '878778787', 'abhi@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Male', NULL, '2007-08-30', '=Unmarried', 'Noida', NULL, 'Noida', 'UP', 'Noida', '121212', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 0, 1, 0, 0, NULL, NULL, NULL, NULL, '2022-09-17 20:21:08'),
(4, 'ME000002', NULL, 'Raj', '8920638723', 'rmorya15@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', NULL, '1993-09-16', '=Unmarried', 'c 40', NULL, 'Mathura', 'uttar pradesh', 'Mathura', '281001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, NULL, '2022-09-19 05:58:29'),
(5, 'ME000003', NULL, 'raman', '8920638722', 'rmorya151@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Female', NULL, '1991-09-19', '=Unmarried', 'c 40', NULL, 'Mathura', 'uttar pradesh', 'Mathura', '281001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'rejected', 0, 0, 0, 0, NULL, NULL, NULL, NULL, '2022-09-19 07:15:58'),
(6, 'ME000004', NULL, 'vikas', '8920638729', 'suresh@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', NULL, '2013-09-13', '=Unmarried', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'rejected', 0, 0, 0, 0, NULL, NULL, NULL, NULL, '2022-09-19 07:16:58'),
(7, 'ME000005', NULL, 'kalam', '1234567890', 'kalam@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Female', NULL, '1994-09-09', NULL, 'c 40', NULL, 'Mathura', 'uttar pradesh', 'Mathura', '281001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 0, 0, 0, 0, NULL, NULL, NULL, NULL, '2022-10-18 12:02:56'),
(8, 'ME000006', NULL, 'rohan', '8920638700', 'rohan326@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Female', 'users/1663652694wallpaper2you_559031.jpg', '1991-09-13', '=Unmarried', 'c 40', NULL, 'Mathura', 'uttar pradesh', 'Mathura', '281001', NULL, NULL, '589666021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 0, 0, 0, 0, NULL, NULL, NULL, NULL, '2022-09-21 07:51:40'),
(9, 'ME000007', NULL, 'rama', '8920638709', 'rmorya15kjs@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1663735534wallpaper2you_294520.gif', '1989-09-08', 'Unmarried', 'c 40', 'baraban', 'Mathura', 'uttar pradesh', 'Mathura', '281001', NULL, NULL, '589666021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 0, 0, 0, 0, NULL, NULL, NULL, '2022-09-21 04:45:34', '2022-09-21 07:44:03'),
(10, 'ME000008', NULL, 'anshul', '892063000', 'nknavneetkumar494@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Female', NULL, '1993-09-10', 'Unmarried', 'c 40', NULL, 'Mathura', 'uttar pradesh', 'Mathura', '281001', NULL, NULL, '589666021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-09-26 06:41:39', '2022-09-26 07:02:50'),
(11, 'ME000009', NULL, 'karan', '00909453753', 'viratkohliworld183@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Female', 'users/1664184371wallpaper2you_248424.jpg', '1993-09-17', 'Unmarried', 'D123, near anand vihar metro station,california', NULL, 'Mathura', 'uttar pradesh', 'Mathura', '281001', NULL, NULL, '589666021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-09-26 09:26:11', '2022-09-26 09:32:22'),
(12, 'ME0000010', NULL, 'nav', '8920638908', 'rahul@yomail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Female', NULL, '1993-09-24', 'Unmarried', 'hggh', NULL, 'hghg', 'bhhg', 'nbb', '77677', NULL, NULL, '988798', '9878998', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-09-26 10:37:36', '2022-09-26 11:31:01'),
(13, 'ME000011', 'Mr.', 'bhh', '237', 'hghg@gmail.com', '202cb962ac59075b964b07152d234b70', 'Male', NULL, '1992-09-18', 'Married', 'jhg', NULL, 'nb', 'hg', 'bj', 'gh', NULL, NULL, '7657', '7575', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-09-26 12:56:15', '2022-11-01 20:43:16'),
(14, 'ME000012', 'Mr.', 'Jayed', '9595995655', 'ravi@techmavesoftware.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1664271217wallpaper2you_559031.jpg', '1994-09-14', 'Married', 'hb', 'Basund Bihar', 'Noida', 'UP', 'Noida', '280110', NULL, NULL, 'g', 'JSHS666A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 0, 1, 1, 1, NULL, NULL, NULL, '2022-09-27 09:33:37', '2022-11-01 19:30:45'),
(15, 'ME000013', NULL, 'camal', '87788778', 'rmorya15@yopmail.com', '202cb962ac59075b964b07152d234b70', 'Male', 'users/1664276231wallpaper2you_559031.jpg', '1999-09-17', 'Married', 'hbh', 'gg', 'gg', 'bn', 'gh', 'hjb', NULL, NULL, '76', '6767', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-09-27 10:57:11', '2022-09-27 11:19:15'),
(18, 'ME000014', NULL, 'kalam sharma', '89737888', 'kalam@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1664348857wallpaper2you_559031.jpg', '1992-09-04', 'Married', 'c 40', NULL, 'Mathura', 'Uttar pradesh', 'Mathura', '281001', NULL, NULL, '589666021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-09-28 07:07:37', '2022-09-28 07:17:58'),
(19, 'ME000015', NULL, 'ralam', '89328974', 'navneet@techmavesoftware.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Female', 'users/1664452123wallpaper2you_559031.jpg', '1992-09-18', 'Unmarried', 'jhdf', 'jh', 'Mathura', 'uttar pradesh', 'Mathura', '281001', NULL, NULL, '589666021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-09-29 11:48:43', '2022-09-29 12:00:33'),
(20, 'ME000016', NULL, 'hgsahg', '7767887', 'rahul@techmavesoftware.com', '202cb962ac59075b964b07152d234b70', 'Male', 'users/1664454971wallpaper2you_559073.jpg', '2003-09-11', 'Married', 'gfgf', 'gfgf', 'fgf', 'fggf', 'fggf', '8687', NULL, NULL, '55657', '7575', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-09-29 12:36:11', '2022-09-29 13:07:09'),
(21, 'ME000017', NULL, 'rahul kumar', '89206387099', 'ttara9943@gmail.com', '202cb962ac59075b964b07152d234b70', 'Male', 'users/1664540226wallpaper2you_559031.jpg', '1992-09-22', 'Married', 'C 40 mahavidya colony', NULL, 'Mathura', 'Uttar pradesh', 'Mathura', '281001', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-09-30 12:17:06', '2022-09-30 12:24:45'),
(23, 'ME000018', NULL, 'ramak', '89206387877', 'pratibha@techmavesoftware.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1664542511wallpaper2you_559031.jpg', '2007-09-07', 'Married', 'hf', 'hjh', 'hggh', 'hhg', 'hgg', '787667', NULL, NULL, 'hjh', 'jhhg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-09-30 12:55:11', '2022-09-30 12:57:56'),
(24, 'ME000019', NULL, 'lala', '8987879', 'vinnytom088@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Male', 'users/1664882525wallpaper2you_559024.jpg', '1995-10-13', 'Married', 'jhhj', 'hjh', 'hjjh', 'hjhj', 'hjhj', '988998', NULL, NULL, '76767788767', 'hhh7887667', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-04 11:22:05', '2022-10-04 11:36:28'),
(25, 'ME000020', NULL, 'ashish', '89878789', 'harrypeterh123@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1665031492wallpaper2you_559031.jpg', '1990-10-19', 'Married', 'hgff', 'jhgg', 'hhh', 'hghg', 'hghg', '281001', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-06 04:44:52', '2022-10-06 04:52:48'),
(26, 'ME000021', NULL, 'palam', '892063809', 'vvistara8@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1665035281wallpaper2you_559073.jpg', '1996-10-18', 'Married', 'jhhjHJHGhghg', 'hj', 'Mathura', 'uttar pradesh', 'Mathura', '281001', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-06 05:48:01', '2022-10-06 05:56:59'),
(27, 'ME000022', NULL, 'Avi Singh', '858585858', 'avi@techmavesoftware.com', 'e10adc3949ba59abbe56e057f20f883e', 'Male', 'users/1665036743NATURE.jfif', '1995-10-05', 'Married', 'Sector 4', NULL, 'Noida', 'Uttar Pradesh', 'Noida', '201301', NULL, NULL, '879929849489', 'JSDUW8999H', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-06 06:12:23', '2022-10-06 06:25:40'),
(28, 'ME000023', NULL, 'ravi', '8977878786', 'hr@techmavesoftware.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1665038146wallpaper2you_559073.jpg', '1993-10-21', 'Married', 'c 40', NULL, 'Mathura', 'Uttar pradesh', 'Mathura', '281001', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-06 06:35:46', '2022-10-06 07:14:32'),
(29, 'ME000024', NULL, 'san', '89787879', 'info@techmavesoftware.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1665038276wallpaper2you_559073.jpg', '2002-10-17', 'Married', 'jhghGHGH', 'GHG', 'HJGH', 'BHH', 'GH', '878', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-06 06:37:56', '2022-10-06 06:53:16'),
(30, 'ME000025', NULL, 'hggh', '7676768', 'raj@yopmail.com', 'c20ad4d76fe97759aa27a0c99bff6710', 'Male', 'users/1665047206WhatsApp_Image_2022_10_06_at_12.28.39_PM.jpeg', '1995-10-13', 'Married', 'j', 'b', 'b', 'b', 'b', '889787', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-06 09:06:46', '2022-10-07 05:49:37'),
(31, 'ME000026', NULL, 'rahul', '878787899', 'rahul@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1665118358wallpaper2you_559024.jpg', '1989-10-13', 'Married', 'D123, near anand vihar metro station,california', NULL, 'hgg', 'yugyug', 'yugy', '786876', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-07 04:52:38', '2022-10-07 04:58:16'),
(32, 'ME000027', NULL, 'navneet', '8920638778', 'neet@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1665120271wallpaper2you_559031.jpg', '1995-10-13', 'Married', 'hggh', 'ghhg', 'ghgh', 'ghhg', 'hggh', '8787887', NULL, NULL, '8978898987', 'bjh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-07 05:24:31', '2022-10-07 05:37:33'),
(33, 'ME000028', NULL, 'Suresh', '95929261259', 'shoryamittal95@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Male', 'users/1665124608NATURE.jfif', '1994-10-06', 'Married', 'Noida sector 3', NULL, 'Noida', 'UP', 'Noida', '201301', NULL, NULL, '834738484784', 'JGJHJ8888H', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-07 06:36:48', '2022-10-07 06:43:41'),
(34, 'ME000029', NULL, 'rajan', '786756566', 'rajan@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1665636314wallpaper2you_559031.jpg', '1997-10-16', 'Married', 'C 40 mahavidya colony', NULL, 'Mathura', 'Uttar pradesh', 'Mathura', '281001', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-13 04:45:14', '2022-10-13 07:17:48'),
(35, 'AES0035', NULL, 'Rahul', '66677676', 'kalank@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 'user-profile/1665637501wallpaper2you_559031.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6', 'kvNsGlaFtk6POgORChmFVPaaBZxiNAVX8keixvDp1xdK3NrTg0Ge4fj5yXFz', 1, 'pending', 0, 0, 0, 0, NULL, NULL, NULL, '2022-10-13 05:05:01', '2022-10-13 05:05:01'),
(36, 'ME000030', NULL, 'chaman', '8920872788', 'chaman@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1665637811wallpaper2you_559031.jpg', '2022-10-12', 'Married', 'hgg', 'ghg', 'ghg', 'ghghg', 'gg', '78667', NULL, NULL, '676', 'vhgf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-13 05:10:11', '2022-10-13 07:47:43'),
(37, 'ME000031', NULL, 'ashneer', '67676876', 'ashneer@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1665654879wallpaper2you_559031.jpg', '2004-10-08', 'Married', 'C 40 mahavidya colony', 'bh', 'ghghf', 'hbh', 'vh', '78576', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-13 09:54:39', '2022-10-13 09:58:07'),
(38, 'ME000032', NULL, 'ramlal', '767677779', 'ramlal@yopmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Male', 'users/1665679836b72083451e1a7c9bb21ad528bb9fadf7.jpg', '2007-10-19', 'Married', 'hgghgh', 'hvvg', 'hgg', 'jhhg', 'hghg', '65566677', NULL, NULL, '7656556', '56656566', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-13 16:50:36', '2022-10-14 04:38:28'),
(39, 'ME000033', NULL, 'hghf', '87678687', 'charam@yopmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Male', 'users/16657488521489734350_5336_1617902890.jpg', '1993-10-08', 'Married', 'hghf', 'hghg', 'hghg', 'hghg', 'gh', '8787', NULL, NULL, '8776', '7676', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-14 12:00:52', '2022-10-14 12:12:25'),
(41, 'ME000034', NULL, 'para', '98997878', 'para@yopmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Male', 'users/16659826521489734350_5336_1617902890.jpg', '1984-10-12', 'Married', 'C 40 mahavidya colony', 'hvvg', 'hgg', 'jhhg', NULL, '65566677', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-17 04:57:32', '2022-10-17 05:03:39'),
(43, 'ME000035', NULL, 'raja', '897767667', 'kolp@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/16659969271489734350_5336_1617902890.jpg', '1990-10-25', 'Married', 'hgghgh', 'hvvg', 'hgg', 'jhhg', 'j', '65566677', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-17 08:55:27', '2022-10-17 08:59:40'),
(44, 'ME000036', NULL, 'Ananya Sharma', '9811417415', 'info@maxemocapital.com', '21232f297a57a5a743894a0e4a801fc3', 'Female', 'users/1665999801wallpaper2you_559031.jpg', '2002-02-25', 'Married', 'Mathura Road Faridabad Haryana', 'Faridabad Sector -37 Haryana', 'Delhi', 'Delhi', 'Delhi', '110037', NULL, NULL, '581873149923', 'mzmps7409c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-17 09:29:26', '2022-10-17 10:15:08'),
(45, 'AES0045', NULL, 'rajeev', '8783824898', 'shorya.mittal@maxemocapital.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 'user-profile/1665999495wallpaper2you_559031.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', 'mQS5GhwU2XRLFJ0N05qpUbegjU9j6jhlSVrHqHbaWYxMe8LQdypiCFTwL8kI', 1, 'pending', 0, 0, 0, 0, NULL, NULL, NULL, '2022-10-17 09:38:15', '2022-10-17 09:40:06'),
(46, 'AES0046', NULL, 'Akhilesh', '7289928266', 'Akhilesh.talwar@maxemocapital.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 'user-profile/1666005492IMG_14CC9AE0FA23_1.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', 'tFaqbOzaLfPgX1Z2kj7WptaVxPagVdLedpCGO5S80qc0vZpkixmUfKicoTx9', 1, 'pending', 0, 0, 0, 0, NULL, NULL, NULL, '2022-10-17 11:18:12', '2022-10-17 11:18:12'),
(47, 'ME000037', NULL, 'RAVINDER SINGH', '9212101125', 'resilientplastics@gmail.com', '0f1ba603c1a843a3d02d6c5038d8e959', 'Male', NULL, '1982-01-06', 'Married', 'House no B-1/1217', 'New Fortis Hospital Vasant Kunj', 'delhi', 'New Delhi', 'South west Delhi', '110070', NULL, NULL, '330520706409', 'BODPS7526H', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'rejected', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-17 12:05:27', '2022-10-18 09:55:54'),
(48, 'ME000038', NULL, 'hgdfh', '767788', 'hghfhf@yopmail.com', 'c20ad4d76fe97759aa27a0c99bff6710', 'Male', 'users/1666162136WhatsApp_Image_2022_10_06_at_12.28.39_PM.jpeg', '2013-10-11', 'Married', 'f', NULL, 'H', 'h', 'h', '77', NULL, NULL, '78', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-19 06:48:56', '2022-10-19 07:53:10'),
(49, 'ME000039', NULL, 'hdfh', '7667577', 'jhjh@yopmail.com', '202cb962ac59075b964b07152d234b70', 'Male', 'users/16661630331489734350_5336_1617902890.jpg', '1995-10-13', 'Married', 'hghf', 'hggh', 'mathura', 'uttar pradesh', 'mathura', '281001', NULL, NULL, '123', '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-19 07:03:53', '2022-10-19 07:37:54'),
(50, 'ME000040', 'Mr.', 'rakul', '76777755777', 'rakul@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1666245457wallpaper2you_559031.jpg', '2002-10-18', 'Married', 'c 40', NULL, 'Mathura', 'Uttar pradesh', 'mathura', '281001', NULL, NULL, '589066021078', 'CUAPM5713L', 'Hindu', 'Graduted', 'raja', 'rani', NULL, NULL, '500', NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-20 05:57:37', '2022-10-23 03:35:48'),
(51, 'ME000041', 'Mr.', 'navneet', '8920638080', 'namop@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Female', 'users/1666335954b72083451e1a7c9bb21ad528bb9fadf7.jpg', '1991-10-09', 'Unmarried', 'C 40 mahavidya colony', NULL, 'Mathura', 'Uttar Pradesh', 'Mathura', '281001', NULL, NULL, '589066021078', 'CUAPM5713L', 'Hindu', 'Graduted', 'raja', 'rani', NULL, NULL, '500', NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-21 07:05:54', '2022-10-21 07:29:28'),
(52, 'ME000042', 'Mr.', 'radha', '878866765', 'rtye@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Female', 'users/1666849513wallpaper2you_559031.jpg', '1996-10-10', 'Unmarried', 'c 40', NULL, 'Mathura', 'Uttar pradesh', 'Mathura', '281001', NULL, NULL, '589066021078', 'CUAPM5713L', 'Hindu', 'Graduted', 'Raja', 'Rani', 'Navneet', 'Delhi', '400', NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-27 05:45:13', '2022-10-28 06:37:33'),
(53, 'ME000043', 'Mr.', 'rohit', '6732651763', 'lopkr@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1666949072wallpaper2you_559031.jpg', NULL, 'Married', 'c 40', NULL, 'mathura', 'Uttar Pradesh', 'Mathura', '281001', NULL, NULL, '589066021078', 'CUAPM5713L', 'Hindu', 'Graduted', 'Raja', 'Rani', 'Navneet', 'Delhi', '500', NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-28 09:24:32', '2022-11-09 16:37:41'),
(54, 'ME000044', 'Mr.', 'Raj', '897348798', 'lopty@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1666955184wallpaper2you_559031.jpg', '1990-10-12', 'Married', 'c 40', NULL, 'Mathura', 'Uttar pradesh', 'mathura', '281001', NULL, NULL, '589066021078', 'CUAPM5713L', 'Hindu', 'graduation', 'Raja', 'Rani', 'Navneet', 'Delhi', '400', NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-28 11:06:24', '2022-10-28 11:21:42'),
(55, 'ME000045', 'Mr.', 'man', '8787387868', 'man@yopmail.com', 'f5d985bf18f0db2322ab209902926756', 'Male', 'users/1667364655covid_testing.jpg', '1989-11-10', 'Married', 'c 40', NULL, 'Mathura', 'Uttar Pradesh', 'Mathura', '281001', NULL, NULL, '589066021078', 'CUAPM5713L', 'Hindu', 'Graduted', 'Raja', 'Rani', 'Navneet', 'Delhi', '500', NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-02 04:50:55', '2022-11-02 05:38:04'),
(56, 'ME000046', 'Mr.', 'deepak', '873472786', 'deepa@yopmail.com', 'f5d985bf18f0db2322ab209902926756', 'Male', 'users/1667369260wallpaper2you_559031.jpg', '1991-11-08', 'Married', 'c 40', NULL, 'Mathura', 'UP', 'Mathura', '281001', NULL, NULL, '589066021078', 'CUAPM5713L', 'Hindu', 'graduation', 'Raja', 'Rani', 'Navneet', 'Delhi', '500', NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-02 06:07:40', '2022-11-03 05:43:47'),
(57, 'ME000047', 'Mr.', 'Abhi Test', '234345345', 'abhi111@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Male', NULL, '2015-11-06', 'Married', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-02 19:24:58', '2022-11-02 19:33:12'),
(58, 'ME000048', 'Mr.', 'deepa', '89745939', 'deep@yopmail.com', 'f5d985bf18f0db2322ab209902926756', 'Male', 'users/1667451438wallpaper2you_559031.jpg', '1992-11-25', 'Married', 'c 40', NULL, 'Mathura', 'UP', 'Mathura', '281001', NULL, NULL, '589066021078', 'CUAPM5713L', 'Hindu', 'graduation', 'Raja', 'Rani', 'Navneet', 'Delhi', '500', NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-03 04:57:18', '2022-11-03 05:16:28'),
(59, 'ME000049', 'Mr.', 'navneet', '873489387', 'rmorya15909@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1667457076wallpaper2you_559031.jpg', '1996-11-08', 'Married', 'c 40', NULL, 'MATHURA', 'UP', 'Mathura', '281001', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'rejected', 0, 0, 0, 0, NULL, NULL, NULL, '2022-11-03 06:31:16', '2022-11-10 12:27:17'),
(60, 'ME000050', 'Mr.', 'vinita', '72348922', 'rohit@techmavesoftware.com', 'f5d985bf18f0db2322ab209902926756', 'Male', 'users/1667457160wallpaper2you_559031.jpg', '1993-11-19', 'Married', 'c 40', NULL, 'Mathura', 'UP', 'Mathura', '281001', NULL, NULL, '281001', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-03 06:32:40', '2022-11-03 08:02:48'),
(61, 'ME000051', 'Mr.', 'msklp', '87324892', 'hgfde@yopmail.com', 'f5d985bf18f0db2322ab209902926756', 'Male', 'users/1667457254wallpaper2you_559031.jpg', '1994-11-11', 'Married', 'c 40', NULL, 'Mathura', 'Uttar pradesh', 'Mathura', '281001', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-03 06:34:14', '2022-11-03 06:37:04'),
(63, 'ME000052', 'Mr.', 'Vikas', '763868683', 'vikas@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1667459345wallpaper2you_559031.jpg', '1999-11-18', 'Married', 'c 40', NULL, 'Delhi', 'Uttar pradseh', 'Delhi', '281001', NULL, NULL, '589066021078', 'CUAPM5713L', 'Hindu', 'graduation', 'Raja', 'Rani', 'Navneet', 'Delhi', '500', NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-03 07:07:47', '2022-11-03 07:19:53'),
(64, 'ME000053', 'Mr.', 'VIKAS JINDAL', '9873623384', 'Vikas.jindal12@gmail.com', '0f1ba603c1a843a3d02d6c5038d8e959', 'Male', NULL, '1985-01-22', 'Married', 'House no 70/34 Janta colony', 'Rohtak', 'Haryana', 'UP', 'Haryana', '124001', NULL, NULL, NULL, 'AIWPJ6466F', 'HINDU', 'GRADUATE', 'SHRI BHAGWAN JINDAL', 'POOJA JINDAL', 'DEVESH', 'NSP PITAMPURA', '702', NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-03 09:18:00', '2022-11-03 09:36:43'),
(65, 'ME000054', 'Mr.', 'Anuj', '9643124320', 'anuj.kumar34@gmailcom', '202cb962ac59075b964b07152d234b70', 'Male', NULL, '1984-11-21', 'Married', 'B-4/522, EKTA GARDEN PLOT NO-08 IP EXTN  SHAKARPUR', 'DELHI', 'DELHI', 'DELHI', 'DELHI', '110092', NULL, NULL, '241072668712', 'BDWPK6576N', 'HINDU', 'GRADUATE', 'TARLOK CHAND', 'PRABHA', 'DEVESH', 'NETAJI SUBHASH PLACE PITAMPURA', '780', NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-03 09:59:55', '2022-11-03 10:04:41'),
(66, 'ME000055', 'Mr.', 'rama', '8920638989', 'rama@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1667555202wallpaper2you_248424.jpg', '1998-11-13', 'Married', 'sd', 'sf', 'fsa', 'sf', 'sf', '281001', NULL, NULL, '589066021078', 'CUAPM5713L', 'Hindu', 'Graduted', 'Raja', 'Rani', 'Navneet', 'Delhi', '400', NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-04 09:46:42', '2022-11-07 21:20:27'),
(67, 'ME000056', 'Mr.', 'Abhi', '786376787', 'abhi@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1667883351wallpaper2you_559024___Copy.jpg', '1987-11-13', 'Married', 'c 40', NULL, 'Mathura', 'UP', 'Mathura', '281001', NULL, NULL, '589066021078', 'CUAPM5713L', 'Hindu', 'graduation', 'Raja', 'Rani', 'Navneet', 'Delhi', '500', NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-08 04:55:18', '2022-11-08 05:36:55'),
(68, 'ME000057', 'Mr.', 'rahu', '764372787', 'rahu@yopmail.com', 'f5d985bf18f0db2322ab209902926756', 'Male', 'users/1667887463wallpaper2you_559024.jpg', '1995-11-10', 'Married', 'c 40', NULL, 'mathura', 'UP', 'Mathura', '281001', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-08 06:04:23', '2022-11-08 06:19:27'),
(69, 'ME000058', 'Mr.', 'deepak', '554566663', 'deepak@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1667973779wallpaper2you_559031.jpg', NULL, 'Married', 'c 40', NULL, 'Mathura', 'UP', 'Mathura', '281001', NULL, NULL, '589066021078', 'CUAPM5713L', 'Hindu', 'Graduted', 'Raja', 'Rani', 'Navneet', 'Delhi', '500', NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-09 06:02:59', '2022-11-09 06:13:36'),
(70, 'ME000059', 'Mr.', 'sara', '755656565', 'sara@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1667975106wallpaper2you_559024.jpg', NULL, 'Married', 'hgghgh', 'hvvg', 'hgg', 'jhhg', 'h', '65566677', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-09 06:25:06', '2022-11-09 06:28:17'),
(71, 'ME000060', 'Mr.', 'aasha', '76767766', 'aasha@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1667976717wallpaper2you_559031.jpg', NULL, 'Married', 'hgghgh', 'hvvg', 'hgg', 'jhhg', 'bj', '65566677', NULL, NULL, '589066021078', 'jhhg', 'Hindu', 'Graduted', 'Raja', 'Rani', 'Navneet', 'Delhi', '500', NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-09 06:51:57', '2022-11-09 06:56:16'),
(72, 'ME000061', 'Mr.', 'maya', '76437762', 'maya@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1667980556wallpaper2you_559031.jpg', NULL, 'Married', 'hgghgh', 'hvvg', 'hgg', 'jhhg', 'Mathura', '65566677', NULL, NULL, 'g', 'h', 'Hindu', 'Graduted', 'Raja', 'Rani', 'Navneet', 'Delhi', '500', NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-09 07:55:56', '2022-11-09 07:59:35'),
(73, 'ME000062', 'Mr.', 'hghgf', '65436666', 'dare@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1668056259wallpaper2you_559031.jpg', '1997-11-07', 'Married', 'c 40', NULL, 'Mathura', 'UP', 'Mathura', '281001', NULL, NULL, '589066021078', 'CUAPM5713L', 'hindu', 'graduation', 'Raja', 'Rani', 'Navneet', 'Delhi', '500', NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-10 04:57:39', '2022-11-10 05:05:03'),
(74, 'ME000063', 'Mr.', 'Kama', '5425454554', 'kama@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1668057538wallpaper2you_559031.jpg', '2000-11-23', 'Married', 'hgghgh', 'hvvg', 'hgg', 'jhhg', 'fggf', '65566677', NULL, NULL, '76', '6767', 'Hindu', 'Graduted', 'Raja', 'Rani', 'Navneet', 'Delhi', '500', NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-10 05:18:58', '2022-11-10 05:22:44'),
(75, 'ME000064', 'Mr.', 'kaka', '76355757', 'kaka@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1668058073wallpaper2you_559031.jpg', '1997-11-07', 'Married', 'hgghgh', 'hvvg', 'hgg', 'jhhg', 'nbb', '65566677', NULL, NULL, '589066021078', 'jhhg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-10 05:27:53', '2022-11-10 05:30:42'),
(76, 'ME000065', 'Mr.', 'uva', '76456778', 'hfggf@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1668060807wallpaper2you_559031.jpg', '1997-11-21', 'Married', 'hgghgh', 'hvvg', 'hgg', 'jhhg', 'bj', '65566677', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-10 06:13:27', '2022-11-10 06:26:27'),
(77, 'ME000066', 'Mr.', 'ramlal', '892063', 'raw@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1668061781wallpaper2you_559031.jpg', '1994-11-11', 'Married', 'hgghgh', 'hvvg', 'hgg', 'jhhg', 'Mathura', '65566677', NULL, NULL, '7657', '9878998', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-10 06:29:41', '2022-11-10 06:32:00'),
(78, 'ME000067', 'Mr.', 'Raj', '786486844', 'raj123@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1668072915wallpaper2you_559031.jpg', '1998-11-13', 'Married', 'hgghgh', 'hvvg', 'hgg', 'jhhg', 'Mathura', '65566677', NULL, NULL, '589066021078', 'CUAPM5713L', 'Hindu', 'Graduted', 'Raja', 'Rani', 'Navneet', 'Delhi', '500', NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-10 09:35:15', '2022-11-10 09:42:01'),
(79, 'ME000068', 'Mr.', 'gfg', '66887778', 'hfgfgf@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1668097297wallpaper2you_559031.jpg', '1994-11-11', 'Married', 'hgghgh', 'hvvg', 'hgg', 'jhhg', 'ghf', '65566677', NULL, NULL, '589066021078', 'jhhg', 'Hindu', 'Graduted', 'Raja', 'Rani', 'Navneet', 'Delhi', '500', NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-10 16:21:37', '2022-11-10 16:28:55'),
(80, 'ME000069', 'Mr.', 'ral', '76467676', 'eweqq@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1668142321wallpaper2you_559031.jpg', '1998-11-20', 'Married', 'hgghgh', 'hvvg', 'hgg', 'jhhg', 'Mathura', '65566677', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-11 04:52:01', '2022-11-11 04:54:26'),
(81, 'ME000070', 'Mr.', 'laqw', '6774676766', 'trted@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Female', NULL, '1996-11-21', 'Married', 'hgghgh', 'hvvg', 'hgg', 'jhhg', 'Mathura', '65566677', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-14 04:42:55', '2022-11-14 04:47:14'),
(82, 'ME000071', 'Mr.', 'cxfr', '545335452', 'cxfdad@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1668404272wallpaper2you_559031.jpg', '1986-11-14', 'Married', 'hgghgh', 'hvvg', 'hgg', 'jhhg', 'Mathura', '65566677', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-14 05:37:52', '2022-11-14 05:40:39'),
(83, 'ME000072', 'Mr.', 'Navneet Agrawal', '9810777277', 'monatomicro@gmail.com', '32694a9cfbb89ca520a0d084f5a86897', 'Male', NULL, '1985-09-18', 'Married', 'S/O Naresh Kumar Agrawal  30-B RORAD NO 78', 'West Punjabi bagh', 'New Delhi', 'Delhi', 'Delhi', '110026', NULL, NULL, '891960277174', 'AFZPA7314P', 'HINDU', NULL, 'Naresh Kumar Agrawal', NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'pending', 0, 0, 0, 0, NULL, NULL, NULL, '2022-11-15 12:05:54', '2022-11-17 04:43:04'),
(84, 'ME000073', 'Mr.', 'Sumeet Naarayan Gupta', '9810214691', 'YPP2008@gmail.com', '230d3e9bcf8e90e7525a74a9606ed481', 'Male', 'users/1668582131194648_full_hd_1080p_autumn_wallpapers_hd_desktop_backgrounds_1920x1080_1920x1080_h.jpg', '1973-12-24', 'Married', '173, Sector 21 A, Faridabad, Haryana-121003', NULL, 'Faridabad', 'Haryana', 'Haryana', '121001', NULL, NULL, '523159869842', 'ABKPG8713D', 'Hindu', '12+', 'Shr. Satya Narain Gupta', NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-16 06:28:40', '2022-11-16 08:49:43'),
(85, 'ME000074', 'Mr.', 'frt', '655332343', 'deedd@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1668662705wallpaper2you_559031.jpg', NULL, 'Married', 'hgghgh', 'hvvg', 'hgg', 'jhhg', 'fggf', '65566677', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-17 05:25:05', '2022-11-17 12:58:38'),
(86, 'ME000075', 'Mr.', 'SATISH MOHAN THAPLIYAL', '8130134185', 'sathishmohan55@gmail.com', '89668d97bc2281951a871d2170f5149d', 'Male', NULL, '1971-09-22', 'Married', 'PLOT NO 197, FLAT NO F-1, FIRST FLOOR, , , SECTOR 6, VAISHALI, GHAZIABAD, UTTAR PRADESH, 201010', 'GHAZIABAD', 'GHAZIABAD', 'UTTAR PRADESH', 'GHAZIABAD', '201010', NULL, NULL, '614212985626', 'ADEPT3760B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'pending', 0, 0, 0, 0, NULL, NULL, NULL, '2022-11-17 05:42:06', '2022-11-17 05:42:06'),
(87, 'ME000076', 'Mr.', 'PRADEEP NEGI', '9990399930', 'negis4u@gmail.com', '640aa1f7ae8c59546d1e4c7a90120c41', 'Male', NULL, '1979-11-13', 'Married', 'C-912,PRINCESS PARK SOCIETY, AHINSA KHAND-II,INDIRAPURA, GHAZIABAD', 'GHAZIABAD', 'GHAZIABAD', 'UTTAR PRADESH', 'GHAZIABAD', '201014', NULL, NULL, '679674002877', 'ADTPN9283E', 'HINDU', '12+', 'ATAR SINGH NEGI', NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'pending', 0, 0, 0, 0, NULL, NULL, NULL, '2022-11-17 05:52:32', '2022-11-17 19:56:27'),
(95, 'AES0095', NULL, 'AAA', '4334545', 'anujshuklaallen789@gmail.com', 'c482d299e8c92d0bbf993b22383b16d5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', NULL, 1, 'pending', 0, 0, 0, 0, NULL, NULL, NULL, '2022-11-17 20:16:37', '2022-11-17 20:16:37'),
(96, 'ME000077', 'Mr.', 'nav', '434666566', 'fdfd@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1668754408wallpaper2you_559031.jpg', '1993-11-24', 'Married', 'hgghgh', 'hvvg', 'hgg', 'jhhg', 'mathura', '65566677', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'approved', 1, 1, 1, 1, NULL, NULL, NULL, '2022-11-18 06:53:28', '2022-11-18 07:18:25'),
(97, 'AES0097', NULL, 'nav1', '545545454', 'daerd@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 'user-profile/1668755198wallpaper2you_366210.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6', 'RFERlKBvTv84skNYEZvXnixCnDk6Z3WnckdjFRHXT1MFg8ABSSQYZGxSpuoD', 1, 'pending', 0, 0, 0, 0, NULL, NULL, NULL, '2022-11-18 07:06:38', '2022-11-18 07:06:38'),
(98, 'ME000078', 'Mr.', 'VIKAS JINDAL', '9971789111', 'JINDAL_VIKAS@YAHOO.CO.IN', '8b761961d84c96c89f41cf68b22d3d81', 'Male', 'users/1668755538Business_pics_Aggawal_packaging.pdf', '1985-01-22', 'Married', 'H.NO 70/34, JANTA COLONY ROHTAK,', 'ROHTAK', 'ROHTAK', 'HARYANA', 'ROHTAK', '124001', NULL, NULL, '763913956970', 'AIWPJ6466F', 'HINDU', '12+', 'SHR. BHAGWAN JINDAL', NULL, NULL, NULL, '808', NULL, NULL, 'user', NULL, 1, 'pending', 0, 0, 0, 0, NULL, NULL, NULL, '2022-11-18 07:12:18', '2022-11-19 05:31:18'),
(99, 'ME000079', 'Mr.', 'hgfgd', '564545667', 'rar@yopmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', 'users/1669005585wallpaper2you_559031.jpg', '1989-11-17', 'Married', 'hgghgh', 'hvvg', 'hgg', 'jhhg', 'nbb', '65566677', NULL, NULL, '589066021078', 'CUAPM5713L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, 1, 'pending', 0, 0, 0, 0, NULL, NULL, NULL, '2022-11-21 04:39:45', '2022-11-21 04:39:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity_histories`
--

CREATE TABLE `user_activity_histories` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL DEFAULT '0',
  `type` varchar(200) DEFAULT NULL COMMENT 'kyc, disbursement',
  `remark` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_activity_histories`
--

INSERT INTO `user_activity_histories` (`id`, `userId`, `type`, `remark`, `created_at`, `updated_at`) VALUES
(1, 3, 'kyc', 'Approved', '2022-09-17 20:14:51', '2022-09-17 20:14:51'),
(2, 3, 'kyc', 'Approved', '2022-09-17 20:21:08', '2022-09-17 20:21:08'),
(3, 4, 'kyc', 'Kyc has been approved successfully.', '2022-09-19 05:57:56', '2022-09-19 05:57:56'),
(4, 5, 'kyc', 'ffg', '2022-09-19 07:15:58', '2022-09-19 07:15:58'),
(5, 7, 'kyc', 'Kyc has been approved successfully.', '2022-09-19 07:16:38', '2022-09-19 07:16:38'),
(6, 6, 'kyc', 'hsahg', '2022-09-19 07:16:58', '2022-09-19 07:16:58'),
(7, 9, 'kyc', 'Kyc has been approved successfully.', '2022-09-21 07:44:03', '2022-09-21 07:44:03'),
(8, 8, 'kyc', 'Kyc has been approved successfully.', '2022-09-21 07:51:40', '2022-09-21 07:51:40'),
(9, 10, 'kyc', 'Kyc has been approved successfully.', '2022-09-26 06:50:16', '2022-09-26 06:50:16'),
(10, 11, 'kyc', 'Kyc has been approved successfully.', '2022-09-26 09:32:00', '2022-09-26 09:32:00'),
(11, 12, 'kyc', 'Kyc has been approved successfully.', '2022-09-26 10:41:14', '2022-09-26 10:41:14'),
(12, 13, 'kyc', 'Kyc has been approved successfully.', '2022-09-26 13:00:41', '2022-09-26 13:00:41'),
(13, 14, 'kyc', 'ofcourse', '2022-09-27 09:43:29', '2022-09-27 09:43:29'),
(14, 15, 'kyc', 'Kyc has been approved successfully.', '2022-09-27 11:19:15', '2022-09-27 11:19:15'),
(15, 18, 'kyc', 'Kyc has been approved successfully.', '2022-09-28 07:17:37', '2022-09-28 07:17:37'),
(16, 19, 'kyc', 'Kyc has been approved successfully.', '2022-09-29 12:00:33', '2022-09-29 12:00:33'),
(17, 20, 'kyc', 'Kyc has been approved successfully.', '2022-09-29 13:07:09', '2022-09-29 13:07:09'),
(18, 21, 'kyc', 'Kyc has been approved successfully.', '2022-09-30 12:24:45', '2022-09-30 12:24:45'),
(19, 23, 'kyc', 'Kyc has been approved successfully.', '2022-09-30 12:57:56', '2022-09-30 12:57:56'),
(20, 24, 'kyc', 'Kyc has been approved successfully.', '2022-10-04 11:36:28', '2022-10-04 11:36:28'),
(21, 25, 'kyc', 'Kyc has been approved successfully.', '2022-10-06 04:52:48', '2022-10-06 04:52:48'),
(22, 26, 'kyc', 'Kyc has been approved successfully.', '2022-10-06 05:56:59', '2022-10-06 05:56:59'),
(23, 27, 'kyc', 'sending file for business', '2022-10-06 06:19:25', '2022-10-06 06:19:25'),
(24, 29, 'kyc', 'asssaj', '2022-10-06 06:53:16', '2022-10-06 06:53:16'),
(25, 28, 'kyc', 'Kyc has been approved successfully.', '2022-10-06 07:14:32', '2022-10-06 07:14:32'),
(26, 31, 'kyc', 'Kyc has been approved successfully.', '2022-10-07 04:58:16', '2022-10-07 04:58:16'),
(27, 32, 'kyc', 'Kyc has been approved successfully.', '2022-10-07 05:37:33', '2022-10-07 05:37:33'),
(28, 30, 'kyc', 'Kyc has been approved successfully.', '2022-10-07 05:49:37', '2022-10-07 05:49:37'),
(29, 33, 'kyc', 'appr isd', '2022-10-07 06:43:41', '2022-10-07 06:43:41'),
(30, 34, 'kyc', 'Kyc has been approved successfully.', '2022-10-13 07:17:48', '2022-10-13 07:17:48'),
(31, 36, 'kyc', 'Kyc has been approved successfully.', '2022-10-13 07:47:43', '2022-10-13 07:47:43'),
(32, 37, 'kyc', 'Kyc has been approved successfully.', '2022-10-13 09:58:07', '2022-10-13 09:58:07'),
(33, 38, 'kyc', 'Kyc has been approved successfully.', '2022-10-14 04:38:28', '2022-10-14 04:38:28'),
(34, 39, 'kyc', 'Kyc has been approved successfully.', '2022-10-14 12:09:50', '2022-10-14 12:09:50'),
(35, 41, 'kyc', 'Kyc has been approved successfully.', '2022-10-17 05:03:39', '2022-10-17 05:03:39'),
(36, 43, 'kyc', 'Kyc has been approved successfully.', '2022-10-17 08:59:03', '2022-10-17 08:59:03'),
(37, 44, 'kyc', 'Kyc has been approved successfully.', '2022-10-17 09:45:48', '2022-10-17 09:45:48'),
(38, 47, 'kyc', 'All kyc Adhar card and address proof which are password protected is not able to view', '2022-10-17 12:30:27', '2022-10-17 12:30:27'),
(39, 48, 'kyc', 'Kyc has been approved successfully.', '2022-10-19 06:52:59', '2022-10-19 06:52:59'),
(40, 49, 'kyc', 'Kyc has been approved successfully.', '2022-10-19 07:37:54', '2022-10-19 07:37:54'),
(41, 51, 'kyc', 'Kyc has been approved successfully.', '2022-10-21 07:29:28', '2022-10-21 07:29:28'),
(42, 50, 'kyc', 'Kyc has been approved successfully.', '2022-10-23 03:35:48', '2022-10-23 03:35:48'),
(43, 52, 'kyc', 'Kyc has been approved successfully.', '2022-10-27 05:52:08', '2022-10-27 05:52:08'),
(44, 53, 'kyc', 'Kyc has been approved successfully.', '2022-10-28 09:57:05', '2022-10-28 09:57:05'),
(45, 54, 'kyc', 'Kyc has been approved successfully.', '2022-10-28 11:21:42', '2022-10-28 11:21:42'),
(46, 55, 'kyc', 'Kyc has been approved successfully.', '2022-11-02 05:38:04', '2022-11-02 05:38:04'),
(47, 57, 'kyc', 'Kyc has been approved successfully.', '2022-11-02 19:27:26', '2022-11-02 19:27:26'),
(48, 58, 'kyc', 'Kyc has been approved successfully.', '2022-11-03 05:16:28', '2022-11-03 05:16:28'),
(49, 56, 'kyc', 'Kyc has been approved successfully.', '2022-11-03 05:43:47', '2022-11-03 05:43:47'),
(50, 61, 'kyc', 'Kyc has been approved successfully.', '2022-11-03 06:37:04', '2022-11-03 06:37:04'),
(51, 63, 'kyc', 'Kyc has been approved successfully.', '2022-11-03 07:19:53', '2022-11-03 07:19:53'),
(52, 60, 'kyc', 'Kyc has been approved successfully.', '2022-11-03 08:02:48', '2022-11-03 08:02:48'),
(53, 64, 'kyc', 'Kyc has been approved successfully.', '2022-11-03 09:36:43', '2022-11-03 09:36:43'),
(54, 65, 'kyc', 'Kyc has been approved successfully.', '2022-11-03 10:04:41', '2022-11-03 10:04:41'),
(55, 59, 'kyc', 'jdjdj', '2022-11-03 11:54:34', '2022-11-03 11:54:34'),
(56, 66, 'kyc', 'Kyc has been approved successfully.', '2022-11-04 09:53:46', '2022-11-04 09:53:46'),
(57, 67, 'kyc', 'Kyc has been approved successfully.', '2022-11-08 05:36:55', '2022-11-08 05:36:55'),
(58, 68, 'kyc', 'Kyc has been approved successfully.', '2022-11-08 06:19:27', '2022-11-08 06:19:27'),
(59, 69, 'kyc', 'Kyc has been approved successfully.', '2022-11-09 06:13:36', '2022-11-09 06:13:36'),
(60, 70, 'kyc', 'Kyc has been approved successfully.', '2022-11-09 06:28:17', '2022-11-09 06:28:17'),
(61, 71, 'kyc', 'Kyc has been approved successfully.', '2022-11-09 06:56:16', '2022-11-09 06:56:16'),
(62, 72, 'kyc', 'Kyc has been approved successfully.', '2022-11-09 07:59:35', '2022-11-09 07:59:35'),
(63, 73, 'kyc', 'Kyc has been approved successfully.', '2022-11-10 05:05:03', '2022-11-10 05:05:03'),
(64, 74, 'kyc', 'Kyc has been approved successfully.', '2022-11-10 05:22:44', '2022-11-10 05:22:44'),
(65, 75, 'kyc', 'Kyc has been approved successfully.', '2022-11-10 05:30:42', '2022-11-10 05:30:42'),
(66, 76, 'kyc', 'Kyc has been approved successfully.', '2022-11-10 06:16:00', '2022-11-10 06:16:00'),
(67, 77, 'kyc', 'Kyc has been approved successfully.', '2022-11-10 06:32:00', '2022-11-10 06:32:00'),
(68, 78, 'kyc', 'Kyc has been approved successfully.', '2022-11-10 09:42:01', '2022-11-10 09:42:01'),
(69, 79, 'kyc', 'Kyc has been approved successfully.', '2022-11-10 16:28:55', '2022-11-10 16:28:55'),
(70, 80, 'kyc', 'Kyc has been approved successfully.', '2022-11-11 04:54:26', '2022-11-11 04:54:26'),
(71, 81, 'kyc', 'Kyc has been approved successfully.', '2022-11-14 04:47:14', '2022-11-14 04:47:14'),
(72, 82, 'kyc', 'Kyc has been approved successfully.', '2022-11-14 05:40:39', '2022-11-14 05:40:39'),
(73, 84, 'kyc', 'Kyc has been approved successfully.', '2022-11-16 08:49:43', '2022-11-16 08:49:43'),
(74, 85, 'kyc', 'Kyc has been approved successfully.', '2022-11-17 12:56:51', '2022-11-17 12:56:51'),
(75, 96, 'kyc', 'Kyc has been approved successfully.', '2022-11-18 07:01:04', '2022-11-18 07:01:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_bank_details`
--

CREATE TABLE `user_bank_details` (
  `id` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL DEFAULT '0',
  `accountHolderName` text,
  `bankName` varchar(255) DEFAULT NULL,
  `ifscCode` varchar(100) DEFAULT NULL,
  `accountType` varchar(20) DEFAULT NULL,
  `accountNumber` varchar(200) DEFAULT NULL,
  `address` text,
  `state` varchar(200) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `pincode` varchar(11) DEFAULT NULL,
  `apisLog` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_bank_details`
--

INSERT INTO `user_bank_details` (`id`, `userId`, `accountHolderName`, `bankName`, `ifscCode`, `accountType`, `accountNumber`, `address`, `state`, `city`, `pincode`, `apisLog`, `created_at`, `updated_at`) VALUES
(1, 3, 'Abhi Shukla', 'CBI', 'IFSC123', 'Saving', '123123123', 'Noida', 'UP', 'Noida', '121212', NULL, '2022-09-17 20:19:22', '2022-09-17 20:19:22'),
(2, 4, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234567', 'holi gate', 'up', 'Mathura', '281001', NULL, '2022-09-19 05:53:31', '2022-09-19 05:53:31'),
(3, 5, 'raman', 'PNB', 'PUNB001040', NULL, '1234567', NULL, NULL, NULL, NULL, NULL, '2022-09-19 06:09:52', '2022-09-19 06:09:52'),
(4, 8, 'hjbhj', 'hghg', 'jhbhj', NULL, '1234', NULL, NULL, NULL, '281001', NULL, '2022-09-20 05:54:46', '2022-09-20 05:54:46'),
(5, 9, 'rama', 'PNB', 'PUNB001040', 'Saving', '1234', 'c 40', 'up', 'Mathura', '281001', NULL, '2022-09-21 04:50:13', '2022-09-21 04:50:13'),
(6, 10, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'holi gate', 'up', 'Mathura', '281001', NULL, '2022-09-26 06:48:39', '2022-09-26 06:48:39'),
(7, 11, 'werhj', 'hg', 'hg', 'Saving', '1234', 'hg', 'hb', 'hg', '239487', NULL, '2022-09-26 09:30:24', '2022-09-26 09:30:24'),
(8, 12, 'dg', 'hg', 'ghh', 'Saving', '123', 'hjj', 'jhhj', 'hjjh', '281001', NULL, '2022-09-26 10:40:15', '2022-09-26 11:31:10'),
(9, 13, 'hjhj', 'hjhjjh', 'hjhj', 'Saving', '7676', 'hjj', 'ghgh', 'ghhg', '281001', NULL, '2022-09-26 12:57:19', '2022-09-26 12:57:19'),
(10, 14, 'g', 'ghhg', 'ghhffg', 'Saving', '1234', 'ghhg', 'hggh', 'ghgh', '281001', NULL, '2022-09-27 09:35:24', '2022-09-27 09:35:24'),
(11, 15, 'hggh', 'GH', 'GJ', 'Saving', '123', 'HGH', 'HJGH', 'GHGH', '65676', NULL, '2022-09-27 10:59:38', '2022-09-27 11:01:04'),
(12, 18, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'yuuy', 'uuy', 'yuyu', '281001', NULL, '2022-09-28 07:15:57', '2022-09-28 07:15:57'),
(13, 19, 'Raju', 'PNB', 'PUNB001040', 'Saving', '123', 'holi gate', 'uttar pradesh', 'Mathura', '281001', NULL, '2022-09-29 11:51:19', '2022-09-29 11:51:19'),
(14, 20, '131333', 'hggh', 'hghggh', 'Saving', '1234', 'hggh', 'up', 'Mathura', '281001', NULL, '2022-09-29 12:40:14', '2022-09-29 12:43:04'),
(15, 21, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'holi gate', 'uttar pradesh', 'Mathura', '281001', NULL, '2022-09-30 12:20:29', '2022-09-30 12:20:29'),
(16, 23, 'hh', 'hh', 'hh', 'Saving', '1234', 'hghg', 'hh', 'hghg', '877', NULL, '2022-09-30 12:56:29', '2022-09-30 12:56:29'),
(17, 24, 'jh', 'yyu', 'gg', 'Saving', '1234', 'hggh', 'hjgh', 'hghg', '675678', NULL, '2022-10-04 11:24:03', '2022-10-04 11:24:03'),
(18, 25, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'holi gate', 'up', 'Mathura', '2181001', NULL, '2022-10-06 04:47:07', '2022-10-06 04:47:07'),
(19, 26, 'Raju', 'PNB', 'PUNB001040', 'Current', '1234', 'holi gate', 'uttar pradesh', 'Mathura', '281001', NULL, '2022-10-06 05:51:44', '2022-10-06 05:51:44'),
(20, 27, 'aVI SINH', 'PNB', 'JJDSJ89', 'Saving', '8979809090', 'secot r87', 'UP', 'noida', '494649', NULL, '2022-10-06 06:16:56', '2022-10-06 06:16:56'),
(21, 29, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'holi gate', 'uttar pradesh', 'Mathura', '2181001', NULL, '2022-10-06 06:43:08', '2022-10-06 06:51:56'),
(22, 28, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'holi gate', 'uttar pradesh', 'Mathura', '281001', NULL, '2022-10-06 06:48:21', '2022-10-06 06:48:21'),
(23, 31, 'Raju', 'PNB', 'PUNB001040', 'Current', '1234', 'hjhj', 'hbhj1hgh1', 'jhhj', '87799', NULL, '2022-10-07 04:54:41', '2022-10-07 04:54:41'),
(24, 32, 'Raju', 'PNB', 'PUNB001040', 'Current', '1234', 'ghg', 'hjgh', 'ghgh', '666777', NULL, '2022-10-07 05:34:00', '2022-10-07 05:34:00'),
(25, 30, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'holi gate', 'uttar pradesh', 'Mathura', '281001', NULL, '2022-10-07 05:49:04', '2022-10-07 05:49:04'),
(26, 33, 'Shorya', 'PNB', 'JDJDU999N', 'Saving', '98664664964', 'abcd noida', 'up', 'noida', '201301', NULL, '2022-10-07 06:40:35', '2022-10-07 06:40:35'),
(27, 34, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'Noida', 'uttar pradesh', 'Mathura', '281001', NULL, '2022-10-13 07:10:51', '2022-10-13 07:10:51'),
(28, 36, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'holi gate', 'uttar pradesh', 'Mathura', '281001', NULL, '2022-10-13 07:46:34', '2022-10-13 07:46:34'),
(29, 37, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'holi gate', 'up', 'Mathura', '281001', NULL, '2022-10-13 09:56:57', '2022-10-13 09:56:57'),
(30, 38, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'hjgdsgh', 'uttar pradesh', 'Mathura', '266362', NULL, '2022-10-14 04:36:05', '2022-10-14 04:36:05'),
(31, 39, 'ytty', 'gytyt', 'hghg', 'Saving', '12345', 'hghg', 'hggh', 'fgfg', '281001', NULL, '2022-10-14 12:03:12', '2022-10-14 12:12:38'),
(32, 41, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'c 40', 'uttar pradesh', 'Mathura', '281001', NULL, '2022-10-17 05:01:19', '2022-10-17 05:01:19'),
(33, 43, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'hgghgh', 'jhhg', 'hgg', '65566677', NULL, '2022-10-17 08:58:14', '2022-10-17 08:59:48'),
(34, 44, 'Raju', 'PNB', 'PUNB00140', 'Saving', '78564783265', 'holi gate', 'Uttar pradesh', 'MATHURA', '281001', NULL, '2022-10-17 09:45:01', '2022-10-17 10:16:35'),
(35, 47, 'RESILIENT PLASTICS PVT LTD', 'IDBI BANK', 'IBKL0001670', 'Current', '1670651100000134', 'VASANT KUNJ, DELHI', 'Delhi', 'Delhi', '110042', NULL, '2022-10-17 12:16:20', '2022-11-10 12:32:57'),
(36, 48, 'raj', 'j', 'j', 'Saving', '76', 'hgghgh', 'jhhg', 'hgg', '65566677', NULL, '2022-10-19 06:52:18', '2022-10-19 06:52:18'),
(37, 49, 'raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'u', 'u', 'u', '7667', NULL, '2022-10-19 07:36:55', '2022-10-19 07:36:55'),
(38, 50, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'holi gate', 'Uttar pradesh', 'MATHURA', '281001', NULL, '2022-10-20 06:04:20', '2022-10-20 09:50:55'),
(39, 51, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'c 40', 'Uttar pradesh', 'Mathura', '281001', NULL, '2022-10-21 07:21:05', '2022-10-21 07:21:05'),
(40, 52, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'c 40', 'Uttar Pradesh', 'Mathura', '281001', NULL, '2022-10-27 05:51:15', '2022-10-28 06:30:54'),
(41, 53, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'hgghgh', 'jhhg', 'hgg', '65566677', NULL, '2022-10-28 09:28:31', '2022-10-28 09:28:31'),
(42, 54, 'Raju', 'PNB', 'PUNB001040', 'Saving', '78564783265', 'holi agte', 'Uttar Pradesh', 'mathura', '281001', NULL, '2022-10-28 11:19:44', '2022-10-28 11:19:44'),
(43, 55, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'C 40', 'Uttar Pradesh', 'Mathura', '281001', NULL, '2022-11-02 05:21:21', '2022-11-02 05:21:21'),
(44, 56, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'Holi gate', 'Uttar Pradesh', 'Mathura', '281001', NULL, '2022-11-02 06:13:50', '2022-11-02 06:13:50'),
(45, 57, 'Na', 'NA', 'Na', 'Saving', '23234234', NULL, NULL, NULL, NULL, NULL, '2022-11-02 19:26:39', '2022-11-02 19:26:39'),
(46, 58, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'Holi gate', 'UP', 'Mathura', '281001', NULL, '2022-11-03 05:13:58', '2022-11-03 05:13:58'),
(47, 61, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'c 40', 'UP', 'Mathura', '281001', NULL, '2022-11-03 06:36:24', '2022-11-03 06:36:24'),
(48, 63, 'Raju', 'PNB', 'PUNB001040', 'Saving', '78564783265', 'Delhi d 10', 'Delhi', 'Delhi', '560034', NULL, '2022-11-03 07:16:34', '2022-11-03 07:16:34'),
(49, 60, 'Raju', 'PNB', 'PUNB001040', 'Current', '1234567890', 'C40', 'New Delhi', 'Delhi', '670989', NULL, '2022-11-03 08:01:54', '2022-11-03 08:01:54'),
(50, 64, 'AGGARWAL PACKAGING INDUSTRIES', 'ICICI BANK', 'ICIC000148', 'Saving', '1670651100000134', 'NETAJI SUBHASH PLACE', 'DELHI', 'DELHI', '110085', NULL, '2022-11-03 09:28:20', '2022-11-03 09:35:15'),
(51, 65, 'JINDAL PLASTIC', 'HDFC BANK', 'HDFC0001069', 'Saving', '50100280562987', 'DELHI PITAMPURA', 'DELHI', 'DELHI', '110058', NULL, '2022-11-03 10:03:40', '2022-11-03 10:04:03'),
(52, 66, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'c 40', 'UP', 'mathura', '281001', NULL, '2022-11-04 09:52:47', '2022-11-04 09:52:47'),
(53, 67, 'Raju', 'PNB', 'PUNB001040', 'Current', '1234567', 'mathura', 'UP', 'mathura', '281001', NULL, '2022-11-08 05:15:04', '2022-11-08 05:15:04'),
(54, 68, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'c', 'b', 'v', '281001', NULL, '2022-11-08 06:17:12', '2022-11-08 06:17:12'),
(55, 69, 'Raju', 'PNB', 'PUNB001040', 'Current', '1234', 'hgghgh', 'hggh', 'hgg', '65566677', NULL, '2022-11-09 06:10:49', '2022-11-09 06:13:24'),
(56, 70, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'hgghgh', 'jhhg', 'hgg', '65566677', NULL, '2022-11-09 06:27:39', '2022-11-09 06:27:39'),
(57, 71, 'Raju', 'hg', 'PUNB001040', 'Saving', '1234', 'hgghgh', 'jhhg', 'hgg', '65566677', NULL, '2022-11-09 06:55:14', '2022-11-09 06:55:14'),
(58, 72, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'hgghgh', 'jhhg', 'hgg', '65566677', NULL, '2022-11-09 07:58:57', '2022-11-09 07:58:57'),
(59, 73, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'hgghgh', 'jhhg', 'hgg', '65566677', NULL, '2022-11-10 05:03:32', '2022-11-10 05:03:32'),
(60, 74, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'hgghgh', 'jhhg', 'hgg', '65566677', NULL, '2022-11-10 05:21:23', '2022-11-10 05:21:23'),
(61, 75, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'hgghgh', 'jhhg', 'hgg', '65566677', NULL, '2022-11-10 05:29:40', '2022-11-10 05:29:40'),
(62, 76, 'Raju', 'PNB', 'PUNB001040', 'Current', '1234', 'hgghgh', 'jhhg', 'hgg', '65566677', NULL, '2022-11-10 06:14:55', '2022-11-10 06:26:43'),
(63, 77, 'Raju', 'PNB', 'PUNB001040', 'Current', '1234', 'hgghgh', 'jhhg', 'hgg', '65566677', NULL, '2022-11-10 06:31:25', '2022-11-10 06:31:25'),
(64, 78, 'Raju', 'PNB', 'PUNB001040', 'Current', '1234', 'hgghgh', 'jhhg', 'hgg', '65566677', NULL, '2022-11-10 09:40:07', '2022-11-10 09:40:07'),
(65, 79, 'Raju', 'PNB', 'PUNB001040', 'Current', '1234', 'hgghgh', 'jhhg', 'hgg', '65566677', NULL, '2022-11-10 16:26:18', '2022-11-10 16:28:02'),
(66, 80, 'Raju', 'PNB', 'PUNB001040', 'Current', '1234', 'hgghgh', 'jhhg', 'hgg', '65566677', NULL, '2022-11-11 04:53:20', '2022-11-11 04:53:20'),
(67, 81, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'hgghgh', 'jhhg', 'hgg', '65566677', NULL, '2022-11-14 04:44:52', '2022-11-14 04:44:52'),
(68, 82, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'hgghgh', 'jhhg', 'hgg', '65566677', NULL, '2022-11-14 05:39:32', '2022-11-14 05:39:32'),
(69, 84, 'PLASTWIND ENTERPRISES', 'STATE BANK OF INDIA', 'SBIN0016108', 'Current', '39858426376', 'Sector 31, Faridabad SCO-58&59, Huda market Faridabad', 'Haryana', 'Faridabad', '121003', NULL, '2022-11-16 07:56:20', '2022-11-16 07:56:20'),
(70, 83, 'PLASTWIND ENTERPRISES', 'STATE BANK OF INDIA', 'SBIN0016108', 'Current', '39858426376', 'Sector 31, Faridabad SCO-58&59, Huda market Faridabad', 'Haryana', 'Faridabad', '121003', NULL, '2022-11-16 08:47:18', '2022-11-16 08:47:18'),
(71, 85, 'Raju', 'PNB', 'PUNB001040', 'Current', '1234', NULL, NULL, NULL, NULL, NULL, '2022-11-17 07:03:56', '2022-11-17 12:58:52'),
(72, 96, 'Raju', 'PNB', 'PUNB001040', 'Saving', '1234', 'hgghgh', 'jhhg', 'hgg', '65566677', NULL, '2022-11-18 06:56:33', '2022-11-18 06:56:33'),
(73, 98, 'Aggarwal packaging industries', 'Bank of India', 'BKID0006070', 'Current', '607020110000333', 'Aggarwal packaging industries, D-106, Sector-4, Bawna Ind. area,', 'Delhi', 'Delhi', '110039', NULL, '2022-11-18 08:34:55', '2022-11-19 03:55:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_docs`
--

CREATE TABLE `user_docs` (
  `id` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL DEFAULT '0',
  `idProofFront` text,
  `idProofBack` text,
  `panCardFront` text,
  `addressProofFront` text,
  `addressProofBack` text,
  `salerySlip1` text,
  `salerySlip2` text,
  `salerySlip3` text,
  `bankAttachemet` text,
  `userAboutVideo` text,
  `otherDocument` text,
  `otherDocumentTitle` text,
  `aadhaarLog` text,
  `pancardLog` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_docs`
--

INSERT INTO `user_docs` (`id`, `userId`, `idProofFront`, `idProofBack`, `panCardFront`, `addressProofFront`, `addressProofBack`, `salerySlip1`, `salerySlip2`, `salerySlip3`, `bankAttachemet`, `userAboutVideo`, `otherDocument`, `otherDocumentTitle`, `aadhaarLog`, `pancardLog`, `created_at`, `updated_at`) VALUES
(1, 3, 'user-docs/16634459251632130159_Untitled_design__3_.png', 'user-docs/1663445925WhatsApp_Image_2022_08_15_at_3.04.09_AM.jpeg', 'user-docs/16634459251632130159_Untitled_design__3_.png', 'user-docs/16634459252019_maruti_wagon_r_review_images_rear_f6bd.jpg', 'user-docs/1663445925newplot__1_.png', NULL, NULL, NULL, 'user-docs/1663445925newplot.png', NULL, NULL, NULL, NULL, NULL, '2022-09-17 20:18:45', '2022-09-17 20:18:45'),
(2, 4, 'user-docs/1663566677wallpaper2you_559073.jpg', 'user-docs/1663566677wallpaper2you_559031.jpg', 'user-docs/1663566677wallpaper2you_559024.jpg', 'user-docs/1663566677wallpaper2you_366210.jpg', 'user-docs/1663566677wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1663566677wallpaper2you_248424.jpg', NULL, NULL, NULL, NULL, NULL, '2022-09-19 05:51:17', '2022-09-19 05:51:17'),
(3, 5, 'user-docs/1663567760wallpaper2you_559073.jpg', 'user-docs/1663567760wallpaper2you_559031.jpg', 'user-docs/1663567760wallpaper2you_559024.jpg', 'user-docs/1663567760wallpaper2you_366210.jpg', 'user-docs/1663567760wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1663567760wallpaper2you_248424.jpg', NULL, NULL, NULL, NULL, NULL, '2022-09-19 06:09:20', '2022-09-19 06:09:20'),
(4, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-19 06:54:15', '2022-09-19 06:54:15'),
(5, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-20 05:54:37', '2022-09-20 05:54:37'),
(6, 9, 'user-docs/1663735778wallpaper2you_559073.jpg', 'user-docs/1663735778wallpaper2you_559031.jpg', 'user-docs/1663735778wallpaper2you_559024.jpg', 'user-docs/1663735778wallpaper2you_366210.jpg', 'user-docs/1663735778wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1663735778wallpaper2you_47000.jpg', NULL, NULL, NULL, NULL, NULL, '2022-09-21 04:48:51', '2022-09-21 04:49:38'),
(7, 10, 'user-docs/1664174872wallpaper2you_559073.jpg', 'user-docs/1664174872wallpaper2you_559031.jpg', 'user-docs/1664174872wallpaper2you_559024.jpg', 'user-docs/1664174872wallpaper2you_366210.jpg', 'user-docs/1664174872wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1664174872wallpaper2you_248424.jpg', NULL, NULL, NULL, NULL, NULL, '2022-09-26 06:47:52', '2022-09-26 06:47:52'),
(8, 11, 'user-docs/1664184594wallpaper2you_559073.jpg', 'user-docs/1664184594wallpaper2you_559031.jpg', 'user-docs/1664184594wallpaper2you_559024___Copy.jpg', 'user-docs/1664184594wallpaper2you_366210___Copy.jpg', 'user-docs/1664184594wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1664184594wallpaper2you_248424.jpg', NULL, NULL, NULL, NULL, NULL, '2022-09-26 09:29:54', '2022-09-26 09:29:54'),
(9, 12, 'user-docs/1664188794wallpaper2you_559073.jpg', 'user-docs/1664188794wallpaper2you_559031.jpg', 'user-docs/1664188794wallpaper2you_559024.jpg', 'user-docs/1664188794wallpaper2you_366210.jpg', 'user-docs/1664188794wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1664188794wallpaper2you_248424.jpg', NULL, NULL, NULL, NULL, NULL, '2022-09-26 10:39:54', '2022-09-26 11:31:08'),
(10, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-26 12:56:56', '2022-10-17 13:47:36'),
(11, 14, 'user-docs/1664271301wallpaper2you_559073.jpg', 'user-docs/1664271301wallpaper2you_559031.jpg', 'user-docs/1664271301wallpaper2you_559024.jpg', 'user-docs/1664271301wallpaper2you_366210.jpg', 'user-docs/1664271301wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1664271301wallpaper2you_248424.jpg', NULL, NULL, NULL, NULL, NULL, '2022-09-27 09:35:01', '2022-09-27 09:35:01'),
(12, 15, 'user-docs/1664276340wallpaper2you_559073.jpg', 'user-docs/1664276340wallpaper2you_559031.jpg', 'user-docs/1664276340wallpaper2you_559024.jpg', 'user-docs/1664276340wallpaper2you_366210.jpg', 'user-docs/1664276340wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1664276340wallpaper2you_248424.jpg', NULL, NULL, NULL, NULL, NULL, '2022-09-27 10:59:00', '2022-09-27 11:00:58'),
(13, 18, 'user-docs/1664349325wallpaper2you_559073.jpg', 'user-docs/1664349325wallpaper2you_559031.jpg', 'user-docs/1664349325wallpaper2you_559024.jpg', 'user-docs/1664349325wallpaper2you_366210.jpg', 'user-docs/1664349325wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1664349325wallpaper2you_294520.gif', NULL, NULL, NULL, NULL, NULL, '2022-09-28 07:15:25', '2022-09-28 07:15:25'),
(14, 19, 'user-docs/1664452244wallpaper2you_559073.jpg', 'user-docs/1664452244wallpaper2you_559031.jpg', 'user-docs/1664452244wallpaper2you_559024.jpg', 'user-docs/1664452244wallpaper2you_366210.jpg', 'user-docs/1664452244wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1664452244wallpaper2you_248424.jpg', NULL, NULL, NULL, NULL, NULL, '2022-09-29 11:50:44', '2022-09-29 11:50:44'),
(15, 20, 'user-docs/1664455160wallpaper2you_559073.jpg', 'user-docs/1664455160wallpaper2you_559031.jpg', 'user-docs/1664455160wallpaper2you_559024.jpg', 'user-docs/1664455160wallpaper2you_366210.jpg', 'user-docs/1664455160wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1664455160wallpaper2you_248424.jpg', NULL, NULL, NULL, NULL, NULL, '2022-09-29 12:38:48', '2022-09-29 12:43:02'),
(16, 21, 'user-docs/1664540375wallpaper2you_559073.jpg', 'user-docs/1664540375wallpaper2you_559031.jpg', 'user-docs/1664540375wallpaper2you_559024.jpg', 'user-docs/1664540375wallpaper2you_366210.jpg', 'user-docs/1664540375wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1664540375wallpaper2you_248424.jpg', NULL, NULL, NULL, NULL, NULL, '2022-09-30 12:19:35', '2022-09-30 12:19:35'),
(17, 23, 'user-docs/1664542572wallpaper2you_559031.jpg', 'user-docs/1664542572wallpaper2you_559024.jpg', 'user-docs/1664542572wallpaper2you_559031.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-30 12:56:12', '2022-09-30 12:56:12'),
(18, 24, 'user-docs/1664882608wallpaper2you_559073.jpg', 'user-docs/1664882608wallpaper2you_559031.jpg', 'user-docs/1664882608wallpaper2you_559024.jpg', 'user-docs/1664882608wallpaper2you_366210.jpg', 'user-docs/1664882608wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1664882608wallpaper2you_248424.jpg', NULL, NULL, NULL, NULL, NULL, '2022-10-04 11:23:28', '2022-10-04 11:23:28'),
(19, 25, 'user-docs/1665031595wallpaper2you_559073.jpg', 'user-docs/1665031595wallpaper2you_559031.jpg', 'user-docs/1665031597wallpaper2you_559024.jpg', 'user-docs/1665031600wallpaper2you_366210.jpg', 'user-docs/1665031600wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1665031600wallpaper2you_248424.jpg', NULL, NULL, NULL, NULL, NULL, '2022-10-06 04:46:40', '2022-10-06 04:46:40'),
(20, 26, 'user-docs/1665035474wallpaper2you_559073.jpg', 'user-docs/1665035474wallpaper2you_559031.jpg', 'user-docs/1665035476wallpaper2you_559024.jpg', 'user-docs/1665035478wallpaper2you_366210.jpg', 'user-docs/1665035478wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1665035478wallpaper2you_248424.jpg', NULL, NULL, NULL, NULL, NULL, '2022-10-06 05:51:18', '2022-10-06 05:51:18'),
(21, 27, 'user-docs/1665036934NATURE.jfif', 'user-docs/1665036934NATURE.jfif', 'user-docs/1665036936NATURE.jfif', 'user-docs/1665036938NATURE.jfif', 'user-docs/1665036938NATURE.jfif', NULL, NULL, NULL, 'user-docs/1665036938NATURE.jfif', NULL, NULL, NULL, NULL, NULL, '2022-10-06 06:15:38', '2022-10-06 06:15:38'),
(22, 29, 'user-docs/1665038461wallpaper2you_559073.jpg', 'user-docs/1665038461wallpaper2you_559031.jpg', 'user-docs/1665038463wallpaper2you_559024.jpg', 'user-docs/1665038465wallpaper2you_366210.jpg', 'user-docs/1665038465wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1665038465wallpaper2you_248424.jpg', NULL, NULL, NULL, NULL, NULL, '2022-10-06 06:41:05', '2022-10-06 06:51:52'),
(23, 28, 'user-docs/1665038858wallpaper2you_559073.jpg', 'user-docs/1665038858wallpaper2you_559031.jpg', 'user-docs/1665038860wallpaper2you_559024.jpg', 'user-docs/1665038862wallpaper2you_366210.jpg', 'user-docs/1665038862wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1665038862wallpaper2you_248424.jpg', NULL, NULL, NULL, NULL, NULL, '2022-10-06 06:47:42', '2022-10-06 06:47:42'),
(24, 31, 'user-docs/1665118453wallpaper2you_559073.jpg', 'user-docs/1665118453wallpaper2you_559031.jpg', 'user-docs/1665118455wallpaper2you_559024.jpg', 'user-docs/1665118457wallpaper2you_366210.jpg', 'user-docs/1665118457wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1665118457wallpaper2you_248424.jpg', NULL, NULL, NULL, NULL, NULL, '2022-10-07 04:54:17', '2022-10-07 04:54:17'),
(25, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-07 05:25:15', '2022-10-07 05:33:44'),
(26, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-07 05:48:38', '2022-10-07 05:48:38'),
(27, 33, 'user-docs/1665124774NATURE.jfif', 'user-docs/1665124774NATURE.jfif', 'user-docs/1665124777NATURE.jfif', 'user-docs/1665124779NATURE.jfif', 'user-docs/1665124779NATURE.jfif', NULL, NULL, NULL, 'user-docs/1665124779NATURE.jfif', NULL, NULL, NULL, NULL, NULL, '2022-10-07 06:39:39', '2022-10-07 06:39:39'),
(28, 34, 'user-docs/1665644893wallpaper2you_559073.jpg', 'user-docs/1665644893wallpaper2you_559031.jpg', 'user-docs/1665644893WhatsApp_Image_2022_10_13_at_10.19.24_AM.jpeg', 'user-docs/1665644893WhatsApp_Image_2022_10_13_at_10.19.26_AM.jpeg', 'user-docs/1665644893WhatsApp_Image_2022_10_13_at_10.19.26_AM__1_.jpeg', NULL, NULL, NULL, 'user-docs/1665644893iStock_479304376.jpg', NULL, NULL, NULL, NULL, NULL, '2022-10-13 07:08:13', '2022-10-13 07:08:13'),
(29, 36, 'user-docs/1665647174wallpaper2you_559073.jpg', 'user-docs/1665647174wallpaper2you_559031.jpg', 'user-docs/1665647174wallpaper2you_559024.jpg', 'user-docs/1665647174wallpaper2you_559024___Copy.jpg', 'user-docs/1665647174wallpaper2you_366210.jpg', NULL, NULL, NULL, 'user-docs/1665647174wallpaper2you_248424.jpg', NULL, NULL, NULL, NULL, NULL, '2022-10-13 07:46:14', '2022-10-13 07:46:14'),
(30, 37, 'user-docs/1665654986wallpaper2you_559031.jpg', 'user-docs/1665654986wallpaper2you_559073.jpg', 'user-docs/1665654986wallpaper2you_559024.jpg', 'user-docs/1665654986wallpaper2you_366210.jpg', 'user-docs/1665654986wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1665654986wallpaper2you_248424.jpg', NULL, NULL, NULL, NULL, NULL, '2022-10-13 09:56:26', '2022-10-13 09:57:16'),
(31, 38, 'user-docs/1665722158wallpaper2you_559073.jpg', 'user-docs/1665722158wallpaper2you_559031.jpg', 'user-docs/1665722158wallpaper2you_559024.jpg', 'user-docs/1665722158wallpaper2you_559024___Copy.jpg', 'user-docs/1665722158wallpaper2you_366210.jpg', NULL, NULL, NULL, 'user-docs/1665722158wallpaper2you_294520.gif', NULL, NULL, NULL, NULL, NULL, '2022-10-14 04:35:17', '2022-10-14 04:35:58'),
(32, 39, 'user-docs/1665748956wallpaper2you_559031.jpg', 'user-docs/1665748956wallpaper2you_559073.jpg', 'user-docs/1665748956wallpaper2you_559024.jpg', 'user-docs/1665748956wallpaper2you_366210.jpg', 'user-docs/1665748956wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1665748956wallpaper2you_248424.jpg', NULL, NULL, NULL, NULL, NULL, '2022-10-14 12:02:36', '2022-10-14 12:12:35'),
(33, 41, 'user-docs/1665982852wallpaper2you_559031.jpg', 'user-docs/1665982852wallpaper2you_559073.jpg', 'user-docs/1665982852wallpaper2you_559024.jpg', 'user-docs/1665982852wallpaper2you_559031.jpg', 'user-docs/1665982852wallpaper2you_559031.jpg', NULL, NULL, NULL, 'user-docs/1665982852wallpaper2you_559073.jpg', NULL, NULL, NULL, NULL, NULL, '2022-10-17 05:00:13', '2022-10-17 05:00:52'),
(34, 43, 'user-docs/1665997078wallpaper2you_559031.jpg', 'user-docs/1665997078wallpaper2you_559073.jpg', 'user-docs/1665997078wallpaper2you_559024.jpg', 'user-docs/1665997078wallpaper2you_366210.jpg', 'user-docs/1665997078wallpaper2you_559031.jpg', NULL, NULL, NULL, 'user-docs/1665997078wallpaper2you_559031.jpg', NULL, NULL, NULL, NULL, NULL, '2022-10-17 08:57:58', '2022-10-17 08:59:45'),
(35, 44, 'user-docs/1665999855wallpaper2you_559073.jpg', 'user-docs/1665999855wallpaper2you_559031.jpg', 'user-docs/1665999855wallpaper2you_559024.jpg', 'user-docs/1665999855wallpaper2you_559024___Copy.jpg', 'user-docs/1665999855wallpaper2you_366210.jpg', NULL, NULL, NULL, 'user-docs/1665999855wallpaper2you_559024.jpg', NULL, NULL, NULL, NULL, NULL, '2022-10-17 09:35:58', '2022-10-17 10:16:26'),
(36, 47, 'user-docs/1666008853AADHAR_CARD_OF_RAVINDER_SINGH_PASSWORD_RAVI1982___Copy.pdf', 'user-docs/1666008853AADHAR_CARD_OF_RAVINDER_SINGH_PASSWORD_RAVI1982___Copy.pdf', 'user-docs/1666008853PAN_CARD.jpg', 'user-docs/1666008853AADHAR_CARD_OF_RAVINDER_SINGH_PASSWORD_RAVI1982___Copy.pdf', 'user-docs/1666008853AADHAR_CARD_OF_RAVINDER_SINGH_PASSWORD_RAVI1982___Copy.pdf', NULL, NULL, NULL, 'user-docs/16660088531_12_21_TO_31_12_21.pdf', NULL, NULL, NULL, NULL, NULL, '2022-10-17 12:14:13', '2022-11-10 12:32:53'),
(37, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-19 06:52:01', '2022-10-19 07:53:18'),
(38, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-19 07:36:38', '2022-10-19 07:36:38'),
(39, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-20 06:03:48', '2022-10-20 09:50:53'),
(40, 51, 'user-docs/1666336810wallpaper2you_559031.jpg', 'user-docs/1666336810wallpaper2you_559073.jpg', 'user-docs/1666336810wallpaper2you_559024.jpg', 'user-docs/1666336810wallpaper2you_366210___Copy.jpg', 'user-docs/1666336810wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1666336810wallpaper2you_248424.jpg', NULL, NULL, NULL, NULL, NULL, '2022-10-21 07:19:47', '2022-10-21 07:20:10'),
(41, 52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-27 05:50:22', '2022-10-28 06:30:50'),
(42, 53, 'user-docs/1666949293wallpaper2you_559073.jpg', 'user-docs/1666949293wallpaper2you_559073.jpg', 'user-docs/1666949293wallpaper2you_559024.jpg', 'user-docs/1666949293wallpaper2you_366210.jpg', 'user-docs/1666949293wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1666949293wallpaper2you_248424.jpg', NULL, 'user-docs/1666949293wallpaper2you_559031.jpg', NULL, NULL, NULL, '2022-10-28 09:28:13', '2022-11-09 16:38:46'),
(43, 54, 'user-docs/1666955947wallpaper2you_559031.jpg', 'user-docs/1666955947wallpaper2you_559073.jpg', 'user-docs/1666955947wallpaper2you_559024.jpg', 'user-docs/1666955947wallpaper2you_559024.jpg', 'user-docs/1666955947wallpaper2you_559031.jpg', NULL, NULL, NULL, 'user-docs/1666955947wallpaper2you_559031.jpg', NULL, 'user-docs/1666955947wallpaper2you_559024___Copy.jpg', NULL, NULL, NULL, '2022-10-28 11:19:07', '2022-10-28 11:19:07'),
(44, 55, 'user-docs/1667366336wallpaper2you_559031.jpg', 'user-docs/1667366336wallpaper2you_559073.jpg', 'user-docs/1667366336wallpaper2you_559024.jpg', 'user-docs/1667366336wallpaper2you_366210.jpg', 'user-docs/1667366336wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1667366336wallpaper2you_248424.jpg', NULL, 'user-docs/1667366336wallpaper2you_559031.jpg', NULL, NULL, NULL, '2022-11-02 05:18:56', '2022-11-02 05:18:56'),
(45, 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-02 06:13:21', '2022-11-02 06:13:21'),
(46, 57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-02 19:26:25', '2022-11-02 19:26:25'),
(47, 58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-03 05:13:10', '2022-11-03 05:13:10'),
(48, 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-03 06:35:56', '2022-11-03 06:35:56'),
(49, 63, 'user-docs/1667459730wallpaper2you_559073.jpg', 'user-docs/1667459730wallpaper2you_559031.jpg', 'user-docs/1667459730wallpaper2you_559024.jpg', 'user-docs/1667459730wallpaper2you_366210.jpg', 'user-docs/1667459730wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1667459730wallpaper2you_248424.jpg', NULL, 'user-docs/1667459730wallpaper2you_559073.jpg', NULL, NULL, NULL, '2022-11-03 07:15:30', '2022-11-03 07:15:30'),
(50, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-03 08:01:09', '2022-11-03 08:01:09'),
(51, 64, 'user-docs/1667468110AGGARWAL_PACK_SCH_2.pdf', 'user-docs/1667468110AGGARWAL_PACK_SCH_2.pdf', 'user-docs/1667468110AGGARWAL_PACKAGING_SCH_3.pdf', 'user-docs/1667468110AGGARWAL_PACK_SCH_2.pdf', 'user-docs/1667468110AGGARWAL_PACK_SCH_1.pdf', NULL, NULL, NULL, 'user-docs/1667468110AGGARWAL_PACK_PL.pdf', NULL, 'user-docs/1667468110AGGARWAL_PACK_PL.pdf', NULL, NULL, NULL, '2022-11-03 09:27:01', '2022-11-03 09:35:50'),
(52, 65, 'user-docs/1667469780AGGARWAL_PACK_SCH_2.pdf', 'user-docs/1667469780AGGARWAL_PACK_SCH_2.pdf', 'user-docs/1667469780AGGARWAL_PACKAGING_SCH_3.pdf', 'user-docs/1667469780AGGARWAL_PACK_PL.pdf', 'user-docs/1667469780AGGARWAL_PACK_PL.pdf', NULL, NULL, NULL, 'user-docs/1667469780AGGARWAL_PACK_SCH_2.pdf', NULL, 'user-docs/1667469780Comp_AGG_Pack_Mar_2022.pdf', NULL, NULL, NULL, '2022-11-03 10:03:00', '2022-11-03 10:04:01'),
(53, 66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-04 09:52:26', '2022-11-04 09:52:26'),
(54, 67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-08 05:13:14', '2022-11-08 05:13:14'),
(55, 68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-08 06:14:49', '2022-11-08 06:17:01'),
(56, 69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-09 06:10:32', '2022-11-09 06:13:20'),
(57, 70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-09 06:27:17', '2022-11-09 06:27:17'),
(58, 71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-09 06:54:48', '2022-11-09 06:54:48'),
(59, 72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-09 07:58:45', '2022-11-09 07:58:45'),
(60, 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-10 05:02:52', '2022-11-10 05:02:52'),
(61, 74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-10 05:21:10', '2022-11-10 05:21:10'),
(62, 75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-10 05:29:27', '2022-11-10 05:29:27'),
(63, 76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-10 06:14:41', '2022-11-10 06:26:40'),
(64, 77, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-10 06:31:11', '2022-11-10 06:31:11'),
(65, 78, 'user-docs/1668073155wallpaper2you_559073.jpg', 'user-docs/1668073155wallpaper2you_559031.jpg', 'user-docs/1668073155wallpaper2you_559024.jpg', 'user-docs/1668073155wallpaper2you_559024___Copy.jpg', 'user-docs/1668073155wallpaper2you_294520.gif', NULL, NULL, NULL, 'user-docs/1668073155wallpaper2you_248424.jpg', NULL, 'user-docs/1668073155wallpaper2you_559031.jpg', NULL, NULL, NULL, '2022-11-10 09:39:15', '2022-11-10 09:39:15'),
(66, 79, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-10 16:23:38', '2022-11-10 16:27:59'),
(67, 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-11 04:53:05', '2022-11-11 04:53:05'),
(68, 81, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-14 04:44:38', '2022-11-14 04:44:38'),
(69, 82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-14 05:39:18', '2022-11-14 05:39:18'),
(70, 83, 'user-docs/1668583826MONATO_DOCUMENTS_UPDATED.zip', 'user-docs/1668583826Screenshot_20221110_170027.png', 'user-docs/1668583828Screenshot_20221110_170027.png', 'user-docs/1668583828Screenshot_20221110_170027.png', 'user-docs/1668583828Screenshot_20221110_170027.png', NULL, NULL, NULL, 'user-docs/1668583828Screenshot_20221110_170027.png', NULL, 'user-docs/1668583828BOB_487_JUNE22.pdf', NULL, NULL, NULL, '2022-11-16 07:29:36', '2022-11-16 08:47:13'),
(71, 84, 'user-docs/1668585117Adhar_Card.jpeg', 'user-docs/1668585117Adhar_Card.jpeg', 'user-docs/1668585117Pan_Card.jpeg', 'user-docs/1668585117Adhar_Card.jpeg', 'user-docs/1668585117Adhar_Card.jpeg', NULL, NULL, NULL, 'user-docs/166858511701_april_to_04_april.jpeg', NULL, NULL, NULL, NULL, NULL, '2022-11-16 07:51:57', '2022-11-16 07:51:57'),
(72, 85, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user-docs/1668668571degree.pdf', NULL, NULL, NULL, '2022-11-17 07:02:51', '2022-11-17 12:58:50'),
(73, 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user-docs/1668714903Result.pdf', 'IT RETURN', NULL, NULL, '2022-11-17 19:55:03', '2022-11-17 19:55:03'),
(74, 96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user-docs/1668754573ccc2.pdf', 'XYZ', NULL, NULL, '2022-11-18 06:56:13', '2022-11-18 06:56:13'),
(75, 98, 'user-docs/1668760127Vikas_Aadhar_Front.jpg', 'user-docs/1668760127Vikas_Jindal_Masked_Aadhar.pdf', 'user-docs/1668760127Vikas_Jindal_PAN.pdf', 'user-docs/1668760127Vikas_Jindal_Masked_Aadhar.pdf', NULL, NULL, NULL, NULL, 'user-docs/166876012701042022_04052022.pdf', NULL, NULL, NULL, NULL, NULL, '2022-11-18 08:28:47', '2022-11-19 03:55:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_otps`
--

CREATE TABLE `user_otps` (
  `id` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL DEFAULT '0',
  `mobileEmail` varchar(255) DEFAULT NULL,
  `sendOtp` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `roleId` varchar(255) DEFAULT NULL,
  `name` text,
  `description` text,
  `userPermissions` longtext,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `roleId`, `name`, `description`, `userPermissions`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', 'Superadmin', 'Superadmin', '[\"all\"]', 1, '2022-06-30 20:08:56', '2022-09-11 22:29:04'),
(2, '2', 'Loan User', 'Loan User', '[\"newcustomers\",\"rejectedcustomers\",\"kycverifiedcustomers\",\"finalapprovalfordisbursement\",\"today-disbursement\",\"pending-disbursement\",\"category-management\"]', 1, '2022-08-02 21:38:26', '2022-08-05 20:42:54'),
(6, 'BUSINESS4371', 'Business', 'Business', '[\"newcustomers\",\"add-customers\",\"edit-customers\",\"rejectedcustomers\",\"kycverifiedcustomers\",\"approve-reject-employment\",\"employment-verification-rejected\",\"credit-assessment-status-list\",\"send-for-admin-approval\",\"final-credit-assessment-status-list\",\"send-for-customer-assessment\"]', 1, '2022-10-13 05:02:45', '2022-11-18 07:17:54'),
(8, 'OPERATION3443', 'operation', 'operation', '[\"newcustomers\",\"add-customers\",\"edit-customers\",\"approverejectkyc\",\"rejectedcustomers\",\"kycverifiedcustomers\",\"approve-reject-employment\",\"employment-verification-rejected\",\"credit-assessment-status-list\",\"send-for-customer-assessment\",\"customer-approval-pending\",\"customer-approval-rejected\",\"finalapprovalfordisbursement\",\"schedule-disbursement\",\"today-disbursement\",\"loan-disburse\",\"pending-disbursement\",\"disbursed-loan-list\",\"view-emi-details\"]', 1, '2022-10-17 09:36:57', '2022-10-17 10:03:35'),
(9, 'CREDIT5114', 'Credit', 'Credit + login', '[\"newcustomers\",\"add-customers\",\"edit-customers\",\"approverejectkyc\",\"rejectedcustomers\",\"kycverifiedcustomers\",\"approve-reject-employment\",\"employment-verification-rejected\",\"credit-assessment-status-list\",\"send-for-customer-assessment\",\"customer-approval-pending\",\"customer-approval-rejected\",\"finalapprovalfordisbursement\",\"schedule-disbursement\",\"today-disbursement\",\"loan-disburse\",\"pending-disbursement\",\"disbursed-loan-list\",\"view-emi-details\",\"product-by-category-list\",\"add-product-by-category\",\"edit-product-by-category\",\"category-list\",\"add-category\",\"edit-category\"]', 1, '2022-10-17 11:15:38', '2022-10-17 11:16:29'),
(10, 'OPERATIONS754', 'Operations', 'He can apen veur', NULL, 1, '2022-10-18 10:10:39', '2022-10-18 10:10:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apply_loan_histories`
--
ALTER TABLE `apply_loan_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_flow_analysis`
--
ALTER TABLE `cash_flow_analysis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `co_applicant_details`
--
ALTER TABLE `co_applicant_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_score_questions`
--
ALTER TABLE `credit_score_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_score_questions_categories`
--
ALTER TABLE `credit_score_questions_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_score_question_answers`
--
ALTER TABLE `credit_score_question_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_score_users_answers`
--
ALTER TABLE `credit_score_users_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deviation_records`
--
ALTER TABLE `deviation_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employer_masters`
--
ALTER TABLE `employer_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employer_type_masters`
--
ALTER TABLE `employer_type_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employment_histories`
--
ALTER TABLE `employment_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_emi_details`
--
ALTER TABLE `loan_emi_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_discussion_on_calls`
--
ALTER TABLE `personal_discussion_on_calls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_materials_txn_details`
--
ALTER TABLE `raw_materials_txn_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_access_logs`
--
ALTER TABLE `system_access_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_supports`
--
ALTER TABLE `tech_supports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenures`
--
ALTER TABLE `tenures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_activity_histories`
--
ALTER TABLE `user_activity_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_bank_details`
--
ALTER TABLE `user_bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_docs`
--
ALTER TABLE `user_docs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_otps`
--
ALTER TABLE `user_otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apply_loan_histories`
--
ALTER TABLE `apply_loan_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cash_flow_analysis`
--
ALTER TABLE `cash_flow_analysis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `co_applicant_details`
--
ALTER TABLE `co_applicant_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `credit_score_questions`
--
ALTER TABLE `credit_score_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `credit_score_questions_categories`
--
ALTER TABLE `credit_score_questions_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `credit_score_question_answers`
--
ALTER TABLE `credit_score_question_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `credit_score_users_answers`
--
ALTER TABLE `credit_score_users_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deviation_records`
--
ALTER TABLE `deviation_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `employer_masters`
--
ALTER TABLE `employer_masters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employer_type_masters`
--
ALTER TABLE `employer_type_masters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employment_histories`
--
ALTER TABLE `employment_histories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loan_emi_details`
--
ALTER TABLE `loan_emi_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=948;

--
-- AUTO_INCREMENT for table `personal_discussion_on_calls`
--
ALTER TABLE `personal_discussion_on_calls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `raw_materials_txn_details`
--
ALTER TABLE `raw_materials_txn_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_access_logs`
--
ALTER TABLE `system_access_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `tech_supports`
--
ALTER TABLE `tech_supports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tenures`
--
ALTER TABLE `tenures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `user_activity_histories`
--
ALTER TABLE `user_activity_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `user_bank_details`
--
ALTER TABLE `user_bank_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `user_docs`
--
ALTER TABLE `user_docs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `user_otps`
--
ALTER TABLE `user_otps`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
