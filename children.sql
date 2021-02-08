-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 50.62.209.187:3306
-- Generation Time: Nov 30, 2020 at 10:06 PM
-- Server version: 5.5.51-38.1-log
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `OFCDIR_TEST`
--

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE `children` (
  `childID` int(11) NOT NULL,
  `child_add_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idDirectory` int(11) DEFAULT NULL,
  `child_entry_chron` int(11) DEFAULT NULL COMMENT 'Chronological child entry by age\n1 = oldest\n8 = youngest',
  `Name` varchar(45) DEFAULT NULL,
  `Birthdate` date DEFAULT NULL,
  `Gender` varchar(1) DEFAULT NULL,
  `Age` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `School` varchar(45) DEFAULT NULL,
  `Grade` varchar(45) DEFAULT NULL,
  `Teacher` varchar(45) DEFAULT 'Multiple'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`childID`, `child_add_date`, `idDirectory`, `child_entry_chron`, `Name`, `Birthdate`, `Gender`, `Age`, `Email`, `School`, `Grade`, `Teacher`) VALUES
(34, '2019-09-15 02:01:33', 20, 5, 'Child5', '2005-05-05', 'F', NULL, '5@5.com', 'Evangel Classical School', '05', 'Multiple'),
(36, '2019-09-15 02:04:30', 20, 7, 'Child7', '2007-07-07', 'F', NULL, '7@7.com', 'Homeschool', '07', 'Multiple'),
(39, '2019-09-15 04:39:34', 20, 2, 'Chris', '1988-04-09', 'M', NULL, 'chrishoeglund@gmail.com', 'Not in School', '02', 'Multiple'),
(40, '2019-09-15 04:40:52', 20, 4, 'Rebecca (Weinberg)', '1994-03-22', 'F', NULL, 'beccaleen11@gmail.com', 'Evangel Classical School', '03', 'Multiple'),
(41, '2019-09-15 04:41:46', 20, 6, 'Child6', '2006-06-06', 'M', NULL, '6@6.com', 'Evangel Classical School', 'UG', 'Multiple'),
(42, '2019-09-15 04:43:15', 20, 8, 'Child8', '2008-08-08', 'F', NULL, '8@8.com', 'International School of Communications', '08', 'Multiple'),
(38, '2019-09-15 03:17:03', 20, 3, 'Amanda2 (Siedenburg)', '1991-11-24', 'F', NULL, 'mannacole2@gmail.com', 'Homeschool', '03', 'Multiple'),
(30, '2019-09-15 00:20:38', 20, 1, 'Jonathan', '1986-05-27', 'M', NULL, 'jonhoeglund@gmail.com', 'Pinewood Elementary School', '02', 'Multiple'),
(43, '2019-09-28 06:14:41', 174, 1, 'Test1 Child1', '1999-09-01', 'M', NULL, 'test@me.com', 'Evangel Classical School', '09', 'Multiple'),
(44, '2019-09-28 06:15:42', 174, 2, 'Child2', '2004-09-02', 'F', NULL, 'child2@me.com', 'Evangel Classical School', 'PS', 'Multiple');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`childID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `children`
--
ALTER TABLE `children`
  MODIFY `childID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
