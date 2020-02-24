-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2020 at 12:22 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospitalpqt`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_treatment_online`
--

CREATE TABLE `add_treatment_online` (
  `token_no` int(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `phoneno` bigint(15) NOT NULL,
  `patient_name` varchar(20) NOT NULL,
  `patient_age` int(5) NOT NULL,
  `patient_gender` text NOT NULL,
  `treatment_type` varchar(50) NOT NULL,
  `medical_history` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_treatment_online`
--

INSERT INTO `add_treatment_online` (`token_no`, `date`, `time`, `phoneno`, `patient_name`, `patient_age`, `patient_gender`, `treatment_type`, `medical_history`) VALUES
(1, '2020-02-12', '16:05:09', 8850302165, 'hosp786', 21, 'male', 'xray', 'no'),
(2, '2020-02-12', '16:07:19', 8850302165, 'hosp786', 46, 'male', 'fracture', 'no'),
(3, '2020-02-12', '16:32:03', 8850302165, 'hosp786', 65, 'male', 'fracture', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `phoneno` bigint(15) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`phoneno`, `password`) VALUES
(7738463932, '1234'),
(778541269, '12345');

-- --------------------------------------------------------

--
-- Table structure for table `admin_page`
--

CREATE TABLE `admin_page` (
  `msg` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_page`
--

INSERT INTO `admin_page` (`msg`) VALUES
('07:43:30'),
('07:52:57'),
('19:53:54'),
(''),
('30  20:55:22'),
('43 12:08:30'),
('43 12:10:33'),
('43 12:11:57'),
('44  12:27:11'),
('44  12:32:32'),
('44  12:34:24'),
('44  12:50:39'),
('44  12:58:09'),
('44 12:58:38'),
('44 12:58:54'),
('44 12:59:08'),
('44 13:00:22'),
('44 13:00:58'),
('44 13:02:27'),
('46  12:37:54'),
('48  11:27:46'),
('48 11:54:05'),
('35 16:56:15');

-- --------------------------------------------------------

--
-- Table structure for table `billing_time`
--

CREATE TABLE `billing_time` (
  `token_no` varchar(4) NOT NULL,
  `date` date NOT NULL,
  `phone` bigint(11) NOT NULL,
  `in_time` time NOT NULL,
  `out_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing_time`
--

INSERT INTO `billing_time` (`token_no`, `date`, `phone`, `in_time`, `out_time`) VALUES
('55', '2020-02-11', 8850302165, '01:00:30', '01:02:30'),
('52', '2020-02-11', 8850302165, '11:54:51', '11:56:51'),
('57', '2020-02-11', 8850302165, '11:57:21', '11:59:21'),
('58', '2020-02-11', 8850302165, '12:00:04', '12:02:04'),
('53', '2020-02-11', 8850302165, '12:10:21', '12:12:21'),
('54', '2020-02-11', 8850302165, '12:20:51', '12:22:51'),
('58', '2020-02-11', 8850302165, '12:36:41', '12:38:41'),
('56', '2020-02-11', 8850302165, '12:51:21', '12:53:21'),
('61', '2020-02-11', 8850302165, '12:54:08', '12:56:08'),
('60', '2020-02-11', 8850302165, '13:07:11', '13:09:11'),
('59', '2020-02-11', 8850302165, '13:21:51', '13:23:51'),
('63', '2020-02-12', 8850302165, '14:35:52', '14:37:52'),
('64', '2020-02-12', 8850302165, '14:54:22', '14:56:22'),
('62', '2020-02-11', 8850302165, '15:11:29', '15:13:29'),
('65', '2020-02-12', 8850302165, '15:13:59', '15:15:59'),
('67', '2020-02-12', 8850302165, '15:30:11', '15:32:11'),
('66', '2020-02-12', 8850302165, '15:31:22', '15:33:22'),
('68', '2020-02-12', 8850302165, '15:43:36', '15:45:36'),
('1', '2020-02-12', 8850302165, '16:16:39', '16:18:39'),
('2', '2020-02-12', 8850302165, '16:40:49', '16:42:49'),
('3', '2020-02-12', 8850302165, '17:05:33', '17:07:33');

-- --------------------------------------------------------

--
-- Table structure for table `blood_cabin_entry_table`
--

CREATE TABLE `blood_cabin_entry_table` (
  `token_no` int(10) NOT NULL,
  `date` date NOT NULL,
  `lab_blood` varchar(10) NOT NULL,
  `dist_lab_from` time NOT NULL,
  `in_time` time NOT NULL,
  `time_to_lab` time NOT NULL,
  `treat_time` time NOT NULL,
  `treat_start_lab_blood` time NOT NULL,
  `actual_treat_start_blood` time NOT NULL,
  `out_time_lab_blood` time NOT NULL,
  `actual_treat_out_blood` time NOT NULL,
  `wait_time_lab_blood` time NOT NULL,
  `billing_time` time NOT NULL,
  `wait_time_billing` time NOT NULL,
  `medicine_time` time NOT NULL,
  `out_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blood_cabin_entry_table`
--

INSERT INTO `blood_cabin_entry_table` (`token_no`, `date`, `lab_blood`, `dist_lab_from`, `in_time`, `time_to_lab`, `treat_time`, `treat_start_lab_blood`, `actual_treat_start_blood`, `out_time_lab_blood`, `actual_treat_out_blood`, `wait_time_lab_blood`, `billing_time`, `wait_time_billing`, `medicine_time`, `out_time`) VALUES
(15, '2020-02-10', 'on', '00:03:30', '18:36:31', '18:40:01', '00:05:30', '18:40:31', '00:00:00', '18:46:01', '00:00:00', '00:00:30', '18:02:53', '23:14:52', '18:07:23', '18:11:23'),
(45, '2020-02-11', 'on', '00:03:30', '10:25:34', '10:29:04', '00:05:30', '10:29:34', '00:00:00', '10:35:04', '00:00:00', '00:00:30', '10:21:48', '23:44:44', '10:26:18', '10:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_cabin_entry_table`
--

CREATE TABLE `doctor_cabin_entry_table` (
  `token_no` int(10) NOT NULL,
  `date` date NOT NULL,
  `doc_cabin` varchar(10) NOT NULL,
  `dist_lab_from` time NOT NULL,
  `in_time` time NOT NULL,
  `time_to_lab` time NOT NULL,
  `treat_time` time NOT NULL,
  `treat_start_doc` time NOT NULL,
  `actual_treat_start_doc` time NOT NULL,
  `out_time_doc` time NOT NULL,
  `actual_treat_out_doc` time NOT NULL,
  `wait_time_doc` time NOT NULL,
  `billing_time` time NOT NULL,
  `wait_time_billing` time NOT NULL,
  `medicine_time` time NOT NULL,
  `out_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_cabin_entry_table`
--

INSERT INTO `doctor_cabin_entry_table` (`token_no`, `date`, `doc_cabin`, `dist_lab_from`, `in_time`, `time_to_lab`, `treat_time`, `treat_start_doc`, `actual_treat_start_doc`, `out_time_doc`, `actual_treat_out_doc`, `wait_time_doc`, `billing_time`, `wait_time_billing`, `medicine_time`, `out_time`) VALUES
(2, '2020-02-12', 'on', '00:01:00', '16:07:19', '16:08:19', '00:30:00', '16:08:49', '16:08:49', '16:38:49', '16:38:49', '00:00:30', '16:40:49', '00:00:00', '00:00:00', '16:49:19'),
(3, '2020-02-12', 'on', '00:01:00', '16:32:03', '16:33:03', '00:30:00', '16:33:33', '16:33:33', '17:03:33', '17:03:33', '00:00:30', '17:05:33', '00:00:00', '00:00:00', '17:14:03'),
(68, '2020-02-12', 'on', '00:01:00', '15:10:06', '15:11:06', '00:30:00', '15:11:36', '00:00:00', '15:41:36', '00:00:00', '00:00:30', '15:43:36', '00:00:00', '00:00:00', '15:52:06');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_table`
--

CREATE TABLE `feedback_table` (
  `name` varchar(50) NOT NULL,
  `phoneno` bigint(15) NOT NULL,
  `treatment_type` varchar(20) NOT NULL,
  `rating` varchar(10) NOT NULL,
  `extratime` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback_table`
--

INSERT INTO `feedback_table` (`name`, `phoneno`, `treatment_type`, `rating`, `extratime`) VALUES
('mohammed', 773820142, 'admit', 'good', 1),
('', 0, '', '', 0),
('', 0, '', '', 0),
('', 0, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `medicine_time`
--

CREATE TABLE `medicine_time` (
  `token_no` varchar(4) NOT NULL,
  `date` date NOT NULL,
  `phone` bigint(11) NOT NULL,
  `in_time` time NOT NULL,
  `out_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mri_cabin_entry_table`
--

CREATE TABLE `mri_cabin_entry_table` (
  `token_no` int(10) NOT NULL,
  `date` date NOT NULL,
  `lab_mri` varchar(4) NOT NULL,
  `dist_lab_from` time NOT NULL,
  `in_time` time NOT NULL,
  `time_to_lab` time NOT NULL,
  `treat_time` time NOT NULL,
  `treat_start_lab_mri` time NOT NULL,
  `actual_treat_start_mri` time NOT NULL,
  `out_time_lab_mri` time NOT NULL,
  `actual_treat_out_mri` time NOT NULL,
  `wait_time_lab_mri` time NOT NULL,
  `billing_time` time NOT NULL,
  `wait_time_billing` time NOT NULL,
  `medicine_time` time NOT NULL,
  `out_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mri_cabin_entry_table`
--

INSERT INTO `mri_cabin_entry_table` (`token_no`, `date`, `lab_mri`, `dist_lab_from`, `in_time`, `time_to_lab`, `treat_time`, `treat_start_lab_mri`, `actual_treat_start_mri`, `out_time_lab_mri`, `actual_treat_out_mri`, `wait_time_lab_mri`, `billing_time`, `wait_time_billing`, `medicine_time`, `out_time`) VALUES
(67, '2020-02-12', 'on', '00:03:00', '14:54:41', '14:57:41', '00:30:00', '14:58:11', '00:00:00', '15:28:11', '00:00:00', '00:00:30', '15:30:11', '00:00:00', '15:34:41', '15:38:41');

-- --------------------------------------------------------

--
-- Table structure for table `offline_register`
--

CREATE TABLE `offline_register` (
  `name` varchar(50) NOT NULL,
  `phoneno` bigint(15) NOT NULL,
  `age` int(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `treatment_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sono_cabin_entry_table`
--

CREATE TABLE `sono_cabin_entry_table` (
  `token_no` int(10) NOT NULL,
  `date` date NOT NULL,
  `lab_sono` varchar(10) NOT NULL,
  `dist_lab_from` time NOT NULL,
  `in_time` time NOT NULL,
  `time_to_lab` time NOT NULL,
  `treat_time` time NOT NULL,
  `treat_start_lab_sono` time NOT NULL,
  `actual_treat_start_sono` time NOT NULL,
  `out_time_lab_sono` time NOT NULL,
  `actual_treat_out_sono` time NOT NULL,
  `wait_time_lab_sono` time NOT NULL,
  `billing_time` time NOT NULL,
  `wait_time_billing` time NOT NULL,
  `medicine_time` time NOT NULL,
  `out_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sono_cabin_entry_table`
--

INSERT INTO `sono_cabin_entry_table` (`token_no`, `date`, `lab_sono`, `dist_lab_from`, `in_time`, `time_to_lab`, `treat_time`, `treat_start_lab_sono`, `actual_treat_start_sono`, `out_time_lab_sono`, `actual_treat_out_sono`, `wait_time_lab_sono`, `billing_time`, `wait_time_billing`, `medicine_time`, `out_time`) VALUES
(66, '2020-02-12', 'on', '00:03:00', '14:15:19', '14:18:19', '00:18:00', '15:11:22', '00:00:00', '15:29:22', '00:00:00', '00:53:03', '15:31:22', '00:00:00', '15:35:52', '15:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_login_online`
--

CREATE TABLE `user_login_online` (
  `id` int(11) NOT NULL,
  `phone` bigint(11) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login_online`
--

INSERT INTO `user_login_online` (`id`, `phone`, `pass`, `name`) VALUES
(23, 8850302165, '$2y$10$cgwUNT3oqOkhLv.2CuvQje9x8/Ju4sXXhPCnhyfzdonOqm3fJXWQu', 'huz123'),
(25, 9699337104, '$2y$10$WP1CzeISLXTfwv5MeVpx9ua7K9MDObUE6GNfR4J7/c9lWIuXtJYhK', 'aziz786'),
(24, 9967114580, '$2y$10$S6InFjIwz2WeFRThEp/wfOHoqf9yyVUQZ.7151BZa0yw/zia7njN.', 'hosp786');

-- --------------------------------------------------------

--
-- Table structure for table `xray_cabin_entry_table`
--

CREATE TABLE `xray_cabin_entry_table` (
  `token_no` int(10) NOT NULL,
  `date` date NOT NULL,
  `lab_xray` varchar(10) NOT NULL,
  `dist_lab_from` varchar(10) NOT NULL,
  `in_time` time NOT NULL,
  `time_to_lab` time NOT NULL,
  `treat_time` time NOT NULL,
  `treat_start_lab_xray` time NOT NULL,
  `actual_treat_start_xray` time NOT NULL,
  `out_time_lab_xray` time NOT NULL,
  `actual_treat_out_xray` time NOT NULL,
  `wait_time_lab_xray` time NOT NULL,
  `billing_time` time NOT NULL,
  `wait_time_billing` time NOT NULL,
  `medicine_time` time NOT NULL,
  `out_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xray_cabin_entry_table`
--

INSERT INTO `xray_cabin_entry_table` (`token_no`, `date`, `lab_xray`, `dist_lab_from`, `in_time`, `time_to_lab`, `treat_time`, `treat_start_lab_xray`, `actual_treat_start_xray`, `out_time_lab_xray`, `actual_treat_out_xray`, `wait_time_lab_xray`, `billing_time`, `wait_time_billing`, `medicine_time`, `out_time`) VALUES
(1, '2020-02-12', 'on', '00:03:00', '16:05:09', '16:08:09', '00:06:00', '16:08:39', '16:08:39', '16:14:39', '16:14:39', '00:00:30', '16:16:39', '00:00:00', '16:21:09', '16:25:09'),
(58, '2020-02-11', 'on', '00:03:00', '11:48:34', '11:51:34', '00:06:00', '11:52:04', '00:00:00', '11:58:04', '00:00:00', '00:00:30', '12:00:04', '00:00:00', '12:04:34', '12:08:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_treatment_online`
--
ALTER TABLE `add_treatment_online`
  ADD PRIMARY KEY (`token_no`),
  ADD UNIQUE KEY `token_no_2` (`token_no`),
  ADD UNIQUE KEY `token_no_3` (`token_no`),
  ADD KEY `token_no` (`token_no`),
  ADD KEY `token_no_4` (`token_no`);

--
-- Indexes for table `billing_time`
--
ALTER TABLE `billing_time`
  ADD PRIMARY KEY (`in_time`);

--
-- Indexes for table `blood_cabin_entry_table`
--
ALTER TABLE `blood_cabin_entry_table`
  ADD PRIMARY KEY (`token_no`);

--
-- Indexes for table `doctor_cabin_entry_table`
--
ALTER TABLE `doctor_cabin_entry_table`
  ADD PRIMARY KEY (`token_no`);

--
-- Indexes for table `mri_cabin_entry_table`
--
ALTER TABLE `mri_cabin_entry_table`
  ADD PRIMARY KEY (`token_no`);

--
-- Indexes for table `sono_cabin_entry_table`
--
ALTER TABLE `sono_cabin_entry_table`
  ADD PRIMARY KEY (`token_no`);

--
-- Indexes for table `user_login_online`
--
ALTER TABLE `user_login_online`
  ADD PRIMARY KEY (`phone`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `xray_cabin_entry_table`
--
ALTER TABLE `xray_cabin_entry_table`
  ADD PRIMARY KEY (`token_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_treatment_online`
--
ALTER TABLE `add_treatment_online`
  MODIFY `token_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blood_cabin_entry_table`
--
ALTER TABLE `blood_cabin_entry_table`
  MODIFY `token_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `mri_cabin_entry_table`
--
ALTER TABLE `mri_cabin_entry_table`
  MODIFY `token_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `sono_cabin_entry_table`
--
ALTER TABLE `sono_cabin_entry_table`
  MODIFY `token_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `user_login_online`
--
ALTER TABLE `user_login_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `xray_cabin_entry_table`
--
ALTER TABLE `xray_cabin_entry_table`
  MODIFY `token_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
