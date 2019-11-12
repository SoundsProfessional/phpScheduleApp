-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 12, 2019 at 02:35 AM
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
  `bizName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `availability`
--

INSERT INTO `availability` (`Name`, `Date`, `is`, `7`, `1`, `2`, `3`, `4`, `5`, `6`, `bizName`) VALUES
('HanSolo', '2019-09-01', 0, 0, 0, 0, 0, 0, 0, 0, 'OnlyOneEmployee'),
('HanSolo', '2019-10-27', 0, 1, 1, 1, 1, 0, 0, 0, 'OnlyOneEmployee'),
('HanSolo', '2019-11-03', 0, 1, 1, 1, 1, 0, 0, 0, 'OnlyOneEmployee'),
('HanSolo', '2019-11-10', 0, 1, 1, 1, 1, 1, 1, 1, 'OnlyOneEmployee'),
('HanSolo', '2019-12-22', 0, 0, 0, 0, 1, 0, 0, 0, 'OnlyOneEmployee');

-- --------------------------------------------------------

--
-- Table structure for table `biz_account`
--

CREATE TABLE `biz_account` (
  `Name` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `biz_account`
--

INSERT INTO `biz_account` (`Name`, `Password`) VALUES
('', ''),
('awefas', 'waefa'),
('december', 'x'),
('JustOneEmployee', 'password'),
('november', '8'),
('OnlyOneEmployee', 'password'),
('secretKitchen', 'asdf'),
('singleWorker', 'password'),
('wefwef', 'wefwef'),
('xxx', 'xxx');

-- --------------------------------------------------------

--
-- Table structure for table `employee_account`
--

CREATE TABLE `employee_account` (
  `bizName` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_account`
--

INSERT INTO `employee_account` (`bizName`, `Name`, `Password`) VALUES
('november', '123', '123'),
('november', 'AlwaysAvail', 'd'),
('november', 'asdf', '3we'),
('november', 'asdfaw', 'gaa'),
('november', 'bananas', 'dsdf'),
('november', 'bob', '234'),
('november', 'Connor', '123'),
('december', 'explodrix', 'sdfa'),
('OnlyOneEmployee', 'HanSolo', 'password'),
('november', 'sundaysam', 'sdf'),
('november', 'testolio', 'asdf'),
('november', 'testts', 'awers'),
('november', 'trew', 'trew'),
('november', 'tuesdays', 's'),
('december', 'tuyg', 'd'),
('november', 'weekendMan', 'x');

-- --------------------------------------------------------

--
-- Table structure for table `explicitListDayEmp`
--

CREATE TABLE `explicitListDayEmp` (
  `bizName` varchar(100) NOT NULL,
  `empName` varchar(100) NOT NULL,
  `monDate` date NOT NULL,
  `isDefault` tinyint(1) NOT NULL,
  `dayIncr` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `explicitListDayEmp`
--

INSERT INTO `explicitListDayEmp` (`bizName`, `empName`, `monDate`, `isDefault`, `dayIncr`) VALUES
('november', 'weekendMan', '2019-11-13', 0, '`3`'),
('november', 'tuyg', '2019-11-14', 0, '`4`'),
('november', 'Connor', '2019-11-10', 1, '`7`'),
('november', 'weekendMan', '2019-11-10', 1, '`1`'),
('november', 'tuyg', '2019-10-27', 0, '`7`'),
('november', 'weekendMan', '2019-10-27', 0, '`1`'),
('november', 'weekendMan', '2019-10-27', 0, '`2`'),
('november', 'weekendMan', '2019-10-27', 0, '`3`'),
('november', 'tuyg', '2019-10-27', 0, '`4`'),
('november', 'tuyg', '2019-10-27', 0, '`5`'),
('november', 'tuyg', '2019-10-27', 0, '`6`'),
('OnlyOneEmployee', 'HanSolo', '2019-10-27', 0, '`7`'),
('OnlyOneEmployee', 'HanSolo', '2019-10-27', 0, '`1`'),
('OnlyOneEmployee', 'HanSolo', '2019-03-10', 0, '`2`'),
('OnlyOneEmployee', 'HanSolo', '2019-09-29', 0, '`3`'),
('OnlyOneEmployee', 'HanSolo', '2019-10-20', 1, '`6`');

-- --------------------------------------------------------

--
-- Table structure for table `explicitSchedule`
--

CREATE TABLE `explicitSchedule` (
  `bizName` varchar(100) NOT NULL,
  `monDate` date NOT NULL,
  `isDefault` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `explicitSchedule`
--

INSERT INTO `explicitSchedule` (`bizName`, `monDate`, `isDefault`) VALUES
('november', '2019-11-03', 0);

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
-- Indexes for table `explicitListDayEmp`
--
ALTER TABLE `explicitListDayEmp`
  ADD KEY `bizName` (`bizName`),
  ADD KEY `empName` (`empName`);

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
-- Constraints for table `explicitListDayEmp`
--
ALTER TABLE `explicitListDayEmp`
  ADD CONSTRAINT `explicitListDayEmp_ibfk_1` FOREIGN KEY (`bizName`) REFERENCES `biz_account` (`Name`),
  ADD CONSTRAINT `explicitListDayEmp_ibfk_2` FOREIGN KEY (`empName`) REFERENCES `employee_account` (`Name`);

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
