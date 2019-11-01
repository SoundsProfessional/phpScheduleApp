-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 31, 2019 at 10:13 PM
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
  `Employee_ID` int(10) NOT NULL,
  `Date` date NOT NULL,
  `Bool` tinyint(1) NOT NULL,
  `DefaultVal` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `biz_account`
--

CREATE TABLE `biz_account` (
  `Biz_ID` int(10) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `biz_account`
--

INSERT INTO `biz_account` (`Biz_ID`, `Name`, `Password`) VALUES
(26, 'Harrys', 'asdf'),
(27, 'Scarys', 'asdf'),
(28, 'pure', 'asdf'),
(29, 'oh yeah', 'okay');

-- --------------------------------------------------------

--
-- Table structure for table `employee_account`
--

CREATE TABLE `employee_account` (
  `Biz_Id` int(10) NOT NULL,
  `Employee_ID` int(10) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_account`
--

INSERT INTO `employee_account` (`Biz_Id`, `Employee_ID`, `Name`, `Password`) VALUES
(26, 3, 'z', 'y'),
(26, 5, 'x', 'y'),
(26, 6, 'Andrew', 'PW2'),
(28, 7, 'Andrew', 'PW2'),
(26, 8, 'attemt', 'extend'),
(26, 9, 'attemt', ' extend'),
(28, 10, 'wsdf', ' ewrw'),
(28, 11, 'wsdx', ' ewrx'),
(28, 12, 'wertwert', ' qwe'),
(28, 13, 'd', ' qwe'),
(28, 14, 'd', ' qwe'),
(28, 15, 'fe', ' qwe'),
(28, 16, 'fe', ' qwe'),
(28, 17, 'fe', ' qwe'),
(28, 18, 'fe', ' qwe');

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE `requirements` (
  `Biz_Id` int(100) NOT NULL,
  `Date` date NOT NULL,
  `List_Of_IntVal` int(100) NOT NULL,
  `DefaultVal` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `Biz_Id` int(10) NOT NULL,
  `Date` date NOT NULL,
  `DefaultVal` int(100) NOT NULL,
  `List_Of_EmploList` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`Date`),
  ADD KEY `Employee_ID` (`Employee_ID`);

--
-- Indexes for table `biz_account`
--
ALTER TABLE `biz_account`
  ADD PRIMARY KEY (`Biz_ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `employee_account`
--
ALTER TABLE `employee_account`
  ADD PRIMARY KEY (`Employee_ID`),
  ADD KEY `Biz_Id` (`Biz_Id`);

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`Date`),
  ADD KEY `Biz_Id` (`Biz_Id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD KEY `Biz_Id` (`Biz_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biz_account`
--
ALTER TABLE `biz_account`
  MODIFY `Biz_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `employee_account`
--
ALTER TABLE `employee_account`
  MODIFY `Employee_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `availability`
--
ALTER TABLE `availability`
  ADD CONSTRAINT `availability_ibfk_1` FOREIGN KEY (`Employee_ID`) REFERENCES `employee_account` (`Employee_ID`);

--
-- Constraints for table `employee_account`
--
ALTER TABLE `employee_account`
  ADD CONSTRAINT `employee_account_ibfk_1` FOREIGN KEY (`Biz_Id`) REFERENCES `biz_account` (`Biz_ID`);

--
-- Constraints for table `requirements`
--
ALTER TABLE `requirements`
  ADD CONSTRAINT `requirements_ibfk_1` FOREIGN KEY (`Biz_Id`) REFERENCES `biz_account` (`Biz_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
