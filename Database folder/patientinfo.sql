-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 11, 2024 at 09:57 AM
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
-- Database: `patientinfo`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctorinfo`
--

CREATE TABLE `doctorinfo` (
  `DIC` varchar(13) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `MName` varchar(20) NOT NULL,
  `GName` varchar(20) NOT NULL,
  `Degree` varchar(20) NOT NULL,
  `College` varchar(20) NOT NULL,
  `Experience` int NOT NULL,
  `Specialization` varchar(20) NOT NULL,
  `Skill` text NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Image` blob NOT NULL,
  `Age` int NOT NULL,
  `BirthD` date NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `RegistrationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Password` varbinary(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `PIC` varchar(13) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `FathName` varchar(20) NOT NULL,
  `GFName` varchar(20) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Address` varchar(25) NOT NULL DEFAULT 'Adama',
  `HNo` varchar(10) NOT NULL,
  `Age` int NOT NULL,
  `BirthDate` date NOT NULL,
  `Marital` varchar(7) NOT NULL,
  `EName` varchar(40) NOT NULL,
  `EPhone` varchar(15) NOT NULL,
  `EEmail` varchar(20) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `Password` varbinary(128) NOT NULL,
  `RegDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctorinfo`
--
ALTER TABLE `doctorinfo`
  ADD PRIMARY KEY (`DIC`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`PIC`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
