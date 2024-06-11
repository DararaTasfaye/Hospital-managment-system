-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 11, 2024 at 09:55 AM
-- Server version: 8.0.31
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appointmentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `new_appointment`
--

CREATE TABLE `new_appointment` (
  `AppointmentID` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Full Name` varchar(30) NOT NULL,
  `Patient_Id` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Patient_Email` varchar(30) NOT NULL,
  `Patient_Phone` varchar(15) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Duration` int NOT NULL,
  `Type` varchar(30) NOT NULL,
  `Note` text NOT NULL,
  `Appointed_On` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Doc_Full_Name` varchar(50) NOT NULL,
  `Doc_ID` varchar(12) NOT NULL,
  `Complete` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `new_appointment`
--
ALTER TABLE `new_appointment`
  ADD PRIMARY KEY (`AppointmentID`),
  ADD KEY `Patient_Id` (`Patient_Id`),
  ADD KEY `Patient_Email` (`Patient_Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
