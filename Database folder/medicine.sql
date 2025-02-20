-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 11, 2024 at 09:58 AM
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
-- Database: `medicine`
--

-- --------------------------------------------------------

--
-- Table structure for table `medicinestore`
--

CREATE TABLE `medicinestore` (
  `Medical_Id` int NOT NULL,
  `Name` varchar(20) NOT NULL,
  `UniqueName` varchar(20) NOT NULL,
  `Manufacturer` varchar(20) NOT NULL,
  `ExpireDate` date NOT NULL,
  `Ammount` int NOT NULL,
  `Price` int NOT NULL,
  `Dosage` varchar(15) NOT NULL,
  `Strength` varchar(10) NOT NULL,
  `Regulatory` varchar(20) NOT NULL,
  `Therapeutic` varchar(20) NOT NULL,
  `ByName` varchar(20) NOT NULL,
  `ByDocId` varchar(13) NOT NULL,
  `DateBought` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medicinestore`
--
ALTER TABLE `medicinestore`
  ADD PRIMARY KEY (`Medical_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medicinestore`
--
ALTER TABLE `medicinestore`
  MODIFY `Medical_Id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
