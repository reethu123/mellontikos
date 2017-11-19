-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 16, 2017 at 10:41 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id3589213_patient_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment_list`
--

CREATE TABLE `appointment_list` (
  `ID` int(5) NOT NULL,
  `Patient_id` int(5) NOT NULL,
  `Dept_id` int(5) NOT NULL,
  `Doctor_id` int(5) NOT NULL,
  `Time` varchar(30) NOT NULL,
  `Date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department_list`
--

CREATE TABLE `department_list` (
  `ID` int(5) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Moblie_no` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_list`
--

INSERT INTO `department_list` (`ID`, `Name`, `Moblie_no`) VALUES
(1, 'Cardiology', 9874562341),
(2, 'Anesthetics', 9678995657),
(3, 'Nephrology', 9874562341),
(4, 'Radiology', 9678345657),
(5, 'Gastroenterology', 9675645657),
(6, 'ENT', 9678345698),
(7, 'Gynaecology', 9678345609);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_list`
--

CREATE TABLE `doctor_list` (
  `ID` int(5) NOT NULL,
  `Dept_id` int(5) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Moblie_no` bigint(12) NOT NULL,
  `Email_id` varchar(30) NOT NULL,
  `Dates` varchar(50) DEFAULT NULL,
  `Time` varchar(50) DEFAULT NULL,
  `Appointments` int(5) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_list`
--

INSERT INTO `doctor_list` (`ID`, `Dept_id`, `Name`, `Moblie_no`, `Email_id`, `Dates`, `Time`, `Appointments`) VALUES
(1, 1, 'Dr Aamod Rao', 8765674563, 'amodrao@gmail.com', '17/11/17;20/11/17;22/11/17;24/11/17;27/11/17;', '8am-12pm;3pm-6pm;', 0),
(2, 4, 'Dr Sanjay Borude', 9875673452, 'sanjayborude@gmail.com', '17/11/17;20/11/17;22/11/17;24/11/17;27/11/17;', '8am-12pm;3pm-6pm;', 0),
(3, 3, 'Dr Ramneek Mahajan', 8765674563, 'ramneek@gmail.com', '17/11/17;20/11/17;22/11/17;24/11/17;27/11/17;', '8am-12pm;3pm-6pm;', 0),
(4, 2, 'Dr Pranay R. Shah', 9875673452, 'pranay@gmail.com', '17/11/17;20/11/17;22/11/17;24/11/17;27/11/17;', '8am-12pm;3pm-6pm;', 0),
(5, 7, 'Dr Sneha Ann Abraham', 7895679456, 'Sneha@gmail.com', '29/11/17;1/12/17;3/12/17;', '12pm-3pm;', 0),
(6, 1, 'Dr Prasad Mathews', 9437345653, 'Prasad @gmail.com', '29/11/17;1/12/17;3/12/17;', '5pm-8pm;', 0),
(7, 5, 'Dr M Chacko Ramacha', 9875678472, 'chacko@gmail.com', '30/11/17;1/12/17;3/12/17;', '9am-11am;2pm-5pm;', 0),
(8, 6, 'Dr Vijaya Devi', 8978762346, 'vijaya@gmail.com', '31/11/17;1/12/17;5/12/17;', '9am-11am;2pm-5pm;', 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient_list`
--

CREATE TABLE `patient_list` (
  `ID` int(5) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Gender` varchar(2) NOT NULL,
  `Moblie_no` bigint(12) NOT NULL,
  `Age` int(3) DEFAULT NULL,
  `Address` varchar(100) NOT NULL,
  `Email_id` varchar(30) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_list`
--
ALTER TABLE `appointment_list`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Patient_id` (`Patient_id`),
  ADD KEY `Dept_id` (`Dept_id`),
  ADD KEY `Doctor_id` (`Doctor_id`);

--
-- Indexes for table `department_list`
--
ALTER TABLE `department_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `doctor_list`
--
ALTER TABLE `doctor_list`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Dept_id` (`Dept_id`);

--
-- Indexes for table `patient_list`
--
ALTER TABLE `patient_list`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment_list`
--
ALTER TABLE `appointment_list`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `doctor_list`
--
ALTER TABLE `doctor_list`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `patient_list`
--
ALTER TABLE `patient_list`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment_list`
--
ALTER TABLE `appointment_list`
  ADD CONSTRAINT `appointment_list_ibfk_1` FOREIGN KEY (`Patient_id`) REFERENCES `patient_list` (`ID`),
  ADD CONSTRAINT `appointment_list_ibfk_2` FOREIGN KEY (`Dept_id`) REFERENCES `department_list` (`ID`),
  ADD CONSTRAINT `appointment_list_ibfk_3` FOREIGN KEY (`Doctor_id`) REFERENCES `doctor_list` (`ID`);

--
-- Constraints for table `doctor_list`
--
ALTER TABLE `doctor_list`
  ADD CONSTRAINT `doctor_list_ibfk_1` FOREIGN KEY (`Dept_id`) REFERENCES `department_list` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
