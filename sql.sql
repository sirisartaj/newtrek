-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2022 at 02:22 PM
-- Server version: 5.7.39-log
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tatvaglo_fee`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_attendance`
--

CREATE TABLE `tbl_student_attendance` (
  `attendance_id` int(11) NOT NULL,
  `attendance_flag` enum('P','A','L','H') NOT NULL,
  `course_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `student_academic_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `period_id` int(11) DEFAULT NULL,
  `remarks` varchar(250) NOT NULL,
  `leave_flag` tinyint(1) DEFAULT NULL,
  `leave_confirmed_by` int(11) DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL,
  `attendance_by` int(11) DEFAULT NULL,
  `attendance_date` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_student_attendance`
--
ALTER TABLE `tbl_student_attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `attan_student_id` (`student_id`),
  ADD KEY `attan_academic_id` (`student_academic_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_student_attendance`
--
ALTER TABLE `tbl_student_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;