# <!--Connor Was Here-->

-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 02, 2019 at 02:25 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

CREATE TABLE `availability` (
  `Name` varchar(100) NOT NULL,
  `Date` date NOT NULL,
  `is` tinyint(1) NOT NULL,
  `7` tinyint(4) DEFAULT 0,
  `1` tinyint(4) DEFAULT 0,
  `2` tinyint(4) DEFAULT 0,
  `3` tinyint(4) DEFAULT 0,
  `4` tinyint(4) DEFAULT 0,
  `5` tinyint(4) DEFAULT 0,
  `6` tinyint(4) DEFAULT 0,
  `isDefault` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `biz_account`
--

CREATE TABLE `biz_account` (
  `Name` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_account`
--

CREATE TABLE `employee_account` (
  `bizName` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `explicitSchedule`
--

CREATE TABLE `explicitSchedule` (
  `bizName` varchar(100) NOT NULL,
  `monDate` date NOT NULL,
  `7` tinyint(4) DEFAULT NULL,
  `1` tinyint(4) DEFAULT NULL,
  `2` tinyint(4) DEFAULT NULL,
  `3` tinyint(4) DEFAULT NULL,
  `4` tinyint(4) DEFAULT NULL,
  `5` tinyint(4) DEFAULT NULL,
  `6` tinyint(4) DEFAULT NULL,
  `isDefault` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requirement`
--

CREATE TABLE `requirement` (
  `bizName` varchar(100) NOT NULL,
  `monDate` date NOT NULL,
  `7` tinyint(4) DEFAULT 0,
  `1` tinyint(4) DEFAULT 0,
  `2` tinyint(4) DEFAULT 0,
  `3` tinyint(4) DEFAULT 0,
  `4` tinyint(4) DEFAULT 0,
  `5` tinyint(4) DEFAULT 0,
  `6` tinyint(4) DEFAULT 0,
  `isDefault` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`Date`,`Name`),
  ADD KEY `Name` (`Name`);

--
-- Indexes for table `biz_account`
--
ALTER TABLE `biz_account`
  ADD PRIMARY KEY (`Name`);

--
-- Indexes for table `employee_account`
--
ALTER TABLE `employee_account`
  ADD PRIMARY KEY (`Name`),
  ADD KEY `bizName` (`bizName`);

--
-- Indexes for table `explicitSchedule`
--
ALTER TABLE `explicitSchedule`
  ADD PRIMARY KEY (`monDate`,`bizName`),
  ADD KEY `bizName` (`bizName`);

--
-- Indexes for table `requirement`
--
ALTER TABLE `requirement`
  ADD PRIMARY KEY (`monDate`,`bizName`),
  ADD KEY `bizName` (`bizName`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `availability`
--
ALTER TABLE `availability`
  ADD CONSTRAINT `availability_ibfk_1` FOREIGN KEY (`Name`) REFERENCES `employee_account` (`Name`);

--
-- Constraints for table `employee_account`
--
ALTER TABLE `employee_account`
  ADD CONSTRAINT `employee_account_ibfk_1` FOREIGN KEY (`bizName`) REFERENCES `biz_account` (`Name`) ON DELETE NO ACTION;

--
-- Constraints for table `explicitSchedule`
--
ALTER TABLE `explicitSchedule`
  ADD CONSTRAINT `explicitSchedule_ibfk_1` FOREIGN KEY (`bizName`) REFERENCES `biz_account` (`Name`);

--
-- Constraints for table `requirement`
--
ALTER TABLE `requirement`
  ADD CONSTRAINT `requirement_ibfk_1` FOREIGN KEY (`bizName`) REFERENCES `biz_account` (`Name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
