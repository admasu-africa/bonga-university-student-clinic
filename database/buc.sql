-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2023 at 07:01 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buc`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `student_id` varchar(25) NOT NULL,
  `app_given_by` varchar(30) NOT NULL,
  `app_given_date` date NOT NULL,
  `app_for_date` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`student_id`, `app_given_by`, `app_given_date`, `app_for_date`, `status`) VALUES
('aku1201212', 'BUE003', '2023-03-09', '2023-03-25', 0),
('aku1201212', 'BUE003', '2023-03-09', '2023-03-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `drug_store`
--

CREATE TABLE `drug_store` (
  `drug_id` int(11) NOT NULL,
  `drug_name` varchar(50) NOT NULL,
  `quantity` int(5) NOT NULL,
  `measure` varchar(50) NOT NULL,
  `batch_no` int(11) NOT NULL,
  `expire_date` date NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `registered_date` date NOT NULL DEFAULT current_timestamp(),
  `registered_by` varchar(30) NOT NULL DEFAULT 'store_keeper'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `drug_store`
--

INSERT INTO `drug_store` (`drug_id`, `drug_name`, `quantity`, `measure`, `batch_no`, `expire_date`, `supplier_id`, `registered_date`, `registered_by`) VALUES
(32, 'Amoxa', 11, 'box', 1010, '2024-02-02', 1, '2023-02-06', 'BUE004'),
(33, 'paracetamol', 2, 'pk', 2231, '2024-05-06', 1, '2023-02-06', 'BUE004'),
(34, 'tryomazol', 20, 'pk', 12212, '2025-05-09', 1, '2023-02-09', 'BUE004'),
(36, 'pain killer', 1, 'littre', 9987, '2023-03-18', 1, '2023-02-18', 'BUE004');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` varchar(30) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `password` varchar(45) NOT NULL,
  `position` varchar(20) NOT NULL,
  `phone_no` varchar(30) DEFAULT NULL,
  `address` varchar(500) NOT NULL,
  `salary` int(10) NOT NULL,
  `registered_date` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `fname`, `lname`, `password`, `position`, `phone_no`, `address`, `salary`, `registered_date`, `status`) VALUES
('BUE001', 'Admasu', 'Bashu', 'a01610228fe998f515a72dd730294d87', 'Admin', NULL, '09832045867', 10000, '2023-02-06', 1),
('BUE0017', 'Sisay', 'Yalew', 'a01610228fe998f515a72dd730294d87', 'Doctor', '0923886765', 'BU ethiopia', 32245, '0000-00-00', 1),
('BUE002', 'Melaku', 'Dese', 'a01610228fe998f515a72dd730294d87', 'Manager', NULL, '0919531473', 10000, '2023-02-06', 1),
('BUE0020', 'Ismael', 'Hussen', 'a01610228fe998f515a72dd730294d87', 'Pharmacist', '0988888888', 'BU Bonga, Ethiopia', 43343, '0000-00-00', 0),
('BUE003', 'Abreham', 'Hailu', 'a01610228fe998f515a72dd730294d87', 'Doctor', '0923942811', 'Addis ababa', 12000, '0000-00-00', 1),
('BUE004', 'Yalew', 'Fetene', 'a01610228fe998f515a72dd730294d87', 'Storekeeper', NULL, '0919101010', 12000, '2023-02-06', 1),
('BUE005', 'Beyena', 'Tira', 'a01610228fe998f515a72dd730294d87', 'Lab technician', NULL, '0919202020', 10000, '2023-02-06', 1),
('BUE006', 'Bonsa', 'Belachew', 'a01610228fe998f515a72dd730294d87', 'Clerk', NULL, '0919303030', 3000, '2023-02-06', 1),
('BUE007', 'Abdulkerim', 'Aragaw', 'a01610228fe998f515a72dd730294d87', 'Pharmacist', NULL, '0945112233', 1800, '2023-02-19', 1),
('BUE012', 'Abdurahiman', 'Kedir', 'a01610228fe998f515a72dd730294d87', 'Pharmacist', '0965432212', 'Bale Robe', 15340, '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_by` varchar(20) NOT NULL,
  `feedbacked_date` date NOT NULL,
  `feedback` varchar(100) NOT NULL,
  `feedback_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `header` text NOT NULL,
  `content` text NOT NULL,
  `posted_date` datetime NOT NULL,
  `posted_by` varchar(30) NOT NULL,
  `view` varchar(20) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`header`, `content`, `posted_date`, `posted_by`, `view`, `post_id`) VALUES
('Ethiopia', 'Ehiopia is the largest country in the world', '2023-02-26 09:21:39', 'BUE002', 'all', 22),
('About Our graduation', 'Congratulation to all of you!', '2023-03-07 08:56:59', 'BUE002', 'all', 23),
('Beyene', 'Proffessor Beyene Petros is one the politician in Ethiopia', '2023-03-07 08:57:49', 'BUE002', 'all', 24),
('checking header', 'checking the contents of news', '2023-03-09 06:07:55', 'BUE002', 'employee', 26),
('this is from you managers too', 'the contents of manager post', '2023-03-09 01:53:03', 'BUE002', 'employee', 27);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification` varchar(255) NOT NULL,
  `notified_date` datetime(6) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification`, `notified_date`, `status`) VALUES
('The Drug Amoxa is only 343 Days to expire', '2023-02-24 09:28:49.000000', 0),
('The Drug paracetamol is only 436 Days to expire', '2023-02-24 09:28:49.000000', 0),
('The Drug tryomazol is only 804 Days to expire', '2023-02-24 09:28:49.000000', 0),
('The Drug pain killer is only 22 Days to expire', '2023-02-24 09:28:49.000000', 0),
('The Drug pain killer is only 21 Days to expire', '2023-02-25 16:23:45.000000', 0),
('The Drug pain killer is only 20 Days to expire', '2023-02-26 21:44:48.000000', 0),
('The Drug pain killer is only 19 Days to expire', '2023-02-27 06:11:06.000000', 0),
('The Drug pain killer is only 16 Days to expire', '2023-03-02 10:14:02.000000', 0),
('The Drug pain killer is only 13 Days to expire', '2023-03-05 22:34:17.000000', 0),
('The Drug pain killer is only 11 Days to expire', '2023-03-07 21:52:03.000000', 0),
('The Drug pain killer is only 10 Days to expire', '2023-03-08 13:01:29.000000', 0),
('The Drug rrrr is only 17 Days to expire', '2023-03-08 13:01:29.000000', 0),
('The Drug pain killer is only 9 Days to expire', '2023-03-09 07:08:02.000000', 0),
('The Drug rrrr is only 16 Days to expire', '2023-03-09 07:08:02.000000', 0),
('The Drug pain killer is only 8 Days to expire', '2023-03-10 05:28:58.000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `student_id` varchar(30) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `mname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) NOT NULL,
  `password` varchar(45) NOT NULL,
  `dept` varchar(30) NOT NULL,
  `batch` int(11) DEFAULT NULL,
  `sex` varchar(30) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `region` varchar(30) DEFAULT NULL,
  `zone` varchar(30) DEFAULT NULL,
  `kebele` varchar(30) DEFAULT NULL,
  `phone_no` int(11) DEFAULT NULL,
  `registered_date` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `status_check` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`student_id`, `fname`, `mname`, `lname`, `password`, `dept`, `batch`, `sex`, `age`, `region`, `zone`, `kebele`, `phone_no`, `registered_date`, `status`, `status_check`) VALUES
('aku11', 'A', 'B', 'C', 'a01610228fe998f515a72dd730294d87', 'cs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-22', 0, '0'),
('Aku1106111', 'Aksum', 'University', 'AKU', 'a01610228fe998f515a72dd730294d87', 'CS', 2011, 'F', 21, 'Et', 'Et', 'ET', 977886655, '2023-02-25', 0, '1'),
('Aku1106161', 'Aschalew', 'Kore', 'Ochole', 'a01610228fe998f515a72dd730294d87', 'Agri', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-19', 0, '1'),
('Aku1106251', 'Abel', 'Gebre', 'Amare', 'a01610228fe998f515a72dd730294d87', 'CS', 2011, 'M', 23, 'AA', '09', '12', 958536403, '2023-02-21', 0, '1'),
('Aku1106295', 'Asd', 'Asd', 'Asd', 'a01610228fe998f515a72dd730294d87', 'Asd', 2111, 'M', 43, 'asd', 'asd', 'asd', 988776655, '2023-03-07', 0, '1'),
('AKU1106329', 'GEMECHU', 'Bulti', 'CHALA', 'a01610228fe998f515a72dd730294d87', 'CS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-24', 0, '1'),
('Aku1111', 'Ayele', 'Bekele', 'Hailu', '1bbd886460827015e5d605ed44252251', 'CS', 2011, 'M', 23, 'A', 'A', 'A', 988776655, '2023-03-10', 1, '1'),
('Aku12011', 'AAAA', 'BBBB', 'CCCC', 'a01610228fe998f515a72dd730294d87', 'CS', 2012, 'F', 19, 'A', 'B', 'C', 990998863, '2023-02-20', 0, '1'),
('Aku1201212', 'Ismael', 'Hussen', 'Nuri', 'a01610228fe998f515a72dd730294d87', 'CS', 2012, 'M', 24, 'AA', '04', '12', 978634262, '2023-02-20', 0, '1'),
('RU0015/13', 'Temam', 'Wake', 'Biru', 'a01610228fe998f515a72dd730294d87', 'CS', 2011, 'M', 26, 'O', 'B', 'K', 910899877, '2023-03-09', 0, '1'),
('Ru008/12', 'Getachew', NULL, 'Negash', 'a01610228fe998f515a72dd730294d87', 'CS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-25', 0, '1'),
('Ru019/12', 'Abinet', 'Abebe', 'Kebede', 'a01610228fe998f515a72dd730294d87', 'Cs', 2012, 'M', 43, 'Debub', 'Keffa', '03', 988766565, '2023-03-09', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `patient_info`
--

CREATE TABLE `patient_info` (
  `student_id` varchar(30) NOT NULL,
  `history` text DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `visited_date` date DEFAULT NULL,
  `lab_test` varchar(200) DEFAULT NULL,
  `lab_result` varchar(200) DEFAULT NULL,
  `patient_info_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `patient_info`
--

INSERT INTO `patient_info` (`student_id`, `history`, `status`, `visited_date`, `lab_test`, `lab_result`, `patient_info_id`) VALUES
('Aku1106111', 'this is the thing from aksumso be gentle men okey', 0, '2023-02-25', NULL, NULL, 47),
('aku11', 'the history of a with capital A', 0, '2023-02-25', 'Microscopy,BF,', 'Microscopy: 8-6,BF: -ve,', 50),
('Aku1106251', 'abels history', 0, '2023-02-25', NULL, NULL, 51),
('Aku1106161', 'how are you asche my friend', 0, '2023-02-25', NULL, NULL, 52),
('Aku1201212', 'kjlkajsdkl\nthis is the text area', 0, '2023-02-26', 'HIV,BF,', 'HIV: -ve,BF: +ve,', 54),
('AKU1106329', 'Gemechu history DDDDDDDDDDDDDDDDEEEEEEEEEEEEEEEEEEEEEEE\namxo \nparaceto\nkjasd\n', 0, '2023-03-08', NULL, NULL, 74),
('Aku1201212', 'This is the history of ismaelin the universitys of bonga', 1, '2023-03-08', NULL, NULL, 75),
('Ru008/12', 'this patient comes to \nthe second time', 0, '2023-03-09', 'TB,Microscopy,BF,', 'TB: +ve, Microscopy: 1-3, BF: +ve, ', 76),
('Ru019/12', 'tkaljsdkljaklsdj', 0, '2023-03-09', NULL, NULL, 77),
('RU0015/13', 'aksdjfkljasdkl', 1, '2023-03-09', NULL, NULL, 78);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

CREATE TABLE `pharmacy` (
  `drug_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `measure` varchar(30) NOT NULL,
  `registered_date` date NOT NULL,
  `provided_by` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `comfirmed_by` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `position_info`
--

CREATE TABLE `position_info` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `position_info`
--

INSERT INTO `position_info` (`position_id`, `position_name`) VALUES
(1, 'admin'),
(2, 'manager'),
(3, 'doctor'),
(4, 'pharmacist'),
(5, 'lab technician'),
(6, 'clerk');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `drug_id` int(11) DEFAULT NULL,
  `drug_name` varchar(30) NOT NULL,
  `dose` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `given_dose` int(11) DEFAULT NULL,
  `prescribed_by` varchar(30) NOT NULL,
  `given_by` varchar(30) DEFAULT NULL,
  `patient_info_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`drug_id`, `drug_name`, `dose`, `description`, `given_dose`, `prescribed_by`, `given_by`, `patient_info_id`) VALUES
(NULL, 'gss', 5, 'ddesc', NULL, 'BUE003', NULL, 54),
(NULL, 'Axxx', 65, 'ddesc', NULL, 'BUE003', NULL, 74),
(NULL, 'refampciline', 12, 'ddesc', NULL, 'BUE003', NULL, 76);

-- --------------------------------------------------------

--
-- Table structure for table `provide_request`
--

CREATE TABLE `provide_request` (
  `drug_id` int(11) NOT NULL,
  `requested_quantity` int(11) NOT NULL,
  `requested_by` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `comfirmed_by` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `requested_date` date NOT NULL,
  `comfirmed_date` date NOT NULL,
  `approved_date` varchar(30) NOT NULL,
  `approved_by` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `registered_by` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `registered_date` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `request_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referal`
--

CREATE TABLE `referal` (
  `student_id` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `refer_to` varchar(100) NOT NULL,
  `cc` text NOT NULL,
  `brief_diagnosis` text NOT NULL,
  `pe` text NOT NULL,
  `investigation` text NOT NULL,
  `treatment_given` text NOT NULL,
  `reason_for_referal` text NOT NULL,
  `time_of_referal` datetime NOT NULL,
  `refered_by` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `referal`
--

INSERT INTO `referal` (`student_id`, `refer_to`, `cc`, `brief_diagnosis`, `pe`, `investigation`, `treatment_given`, `reason_for_referal`, `time_of_referal`, `refered_by`, `status`) VALUES
('Aku1106111', 'TO G/TSADIK SHAWO GENERAL HOSPITAL', 'cc', 'Brief HX and Diagnosis', 'P/E (Patient finding)', 'Investigation Done', 'Treatment Given', 'Reason for referal', '2023-03-08 06:02:33', 'BUE003', 0),
('Aku1106111', 'TO G/TSADIK SHAWO GENERAL HOSPITAL', 'd', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', '2023-03-08 06:03:39', 'BUE003', 0),
('Aku1201212', 'TO G/TSADIK SHAWO GENERAL HOSPITAL', 'sdfgsdfgsdfg', 'sdfgesdfgsdfg', 'sdfgsdfg', 'sdfgsdfgrtvcvc', 'dfgsdf xfdgsdfgs', 'sdfgsdfgggs', '2023-03-08 19:26:51', 'BUE003', 2),
('RU0015/13', ' G/TSADIK SHAWO GENERAL HOSPITAL', 'khkjk;', 'uyuui', 'tytu', 'tryu', 'yutuy', 'uyiu', '2023-03-09 13:48:33', 'BUE003', 2);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(30) NOT NULL,
  `supplier_address` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_address`) VALUES
(1, 'bonga pharmacy', 'bonga');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD KEY `student_id` (`student_id`),
  ADD KEY `app_given_by` (`app_given_by`);

--
-- Indexes for table `drug_store`
--
ALTER TABLE `drug_store`
  ADD PRIMARY KEY (`drug_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `registered_by` (`registered_by`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `position` (`position`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `feedback_by` (`feedback_by`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `posted_by` (`posted_by`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `patient_info`
--
ALTER TABLE `patient_info`
  ADD PRIMARY KEY (`patient_info_id`),
  ADD KEY `id` (`student_id`);

--
-- Indexes for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD KEY `provided_by` (`provided_by`),
  ADD KEY `comfirmed_by` (`comfirmed_by`),
  ADD KEY `drug_id` (`drug_id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `position_info`
--
ALTER TABLE `position_info`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD KEY `prescribed_by` (`prescribed_by`),
  ADD KEY `given_by` (`given_by`),
  ADD KEY `patient_info_id` (`patient_info_id`),
  ADD KEY `prescription_ibfk_1` (`drug_id`);

--
-- Indexes for table `provide_request`
--
ALTER TABLE `provide_request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `drug_id` (`drug_id`),
  ADD KEY `comfirmed_by` (`comfirmed_by`),
  ADD KEY `requested_by` (`requested_by`),
  ADD KEY `approved_by` (`approved_by`),
  ADD KEY `registered_by` (`registered_by`);

--
-- Indexes for table `referal`
--
ALTER TABLE `referal`
  ADD KEY `referal_ibfk_1` (`student_id`),
  ADD KEY `refered_by` (`refered_by`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drug_store`
--
ALTER TABLE `drug_store`
  MODIFY `drug_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `patient_info`
--
ALTER TABLE `patient_info`
  MODIFY `patient_info_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `provide_request`
--
ALTER TABLE `provide_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `patient` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`app_given_by`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `drug_store`
--
ALTER TABLE `drug_store`
  ADD CONSTRAINT `drug_store_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `drug_store_ibfk_2` FOREIGN KEY (`registered_by`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`feedback_by`) REFERENCES `patient` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`posted_by`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_info`
--
ALTER TABLE `patient_info`
  ADD CONSTRAINT `patient_info_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `patient` (`student_id`);

--
-- Constraints for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD CONSTRAINT `pharmacy_ibfk_1` FOREIGN KEY (`provided_by`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pharmacy_ibfk_2` FOREIGN KEY (`comfirmed_by`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pharmacy_ibfk_3` FOREIGN KEY (`drug_id`) REFERENCES `drug_store` (`drug_id`),
  ADD CONSTRAINT `pharmacy_ibfk_4` FOREIGN KEY (`request_id`) REFERENCES `provide_request` (`request_id`);

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`drug_id`) REFERENCES `pharmacy` (`drug_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`prescribed_by`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prescription_ibfk_3` FOREIGN KEY (`given_by`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prescription_ibfk_4` FOREIGN KEY (`patient_info_id`) REFERENCES `patient_info` (`patient_info_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `provide_request`
--
ALTER TABLE `provide_request`
  ADD CONSTRAINT `provide_request_ibfk_1` FOREIGN KEY (`drug_id`) REFERENCES `drug_store` (`drug_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `provide_request_ibfk_2` FOREIGN KEY (`comfirmed_by`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `provide_request_ibfk_3` FOREIGN KEY (`requested_by`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `provide_request_ibfk_4` FOREIGN KEY (`approved_by`) REFERENCES `employee` (`employee_id`),
  ADD CONSTRAINT `provide_request_ibfk_5` FOREIGN KEY (`requested_by`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `provide_request_ibfk_6` FOREIGN KEY (`registered_by`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `referal`
--
ALTER TABLE `referal`
  ADD CONSTRAINT `referal_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `patient` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `referal_ibfk_2` FOREIGN KEY (`refered_by`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
