-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2019 at 11:39 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acmeproperties`
--

-- --------------------------------------------------------

--
-- Table structure for table `calculations`
--

CREATE TABLE `calculations` (
  `CalculationsID` int(11) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Purchase_Price` int(11) NOT NULL,
  `Deposit_Paid` int(11) NOT NULL,
  `Bond_Term_In_Years` int(11) NOT NULL,
  `Fixed_Interest_Rate` int(11) NOT NULL,
  `Calculation_Results` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calculations`
--

INSERT INTO `calculations` (`CalculationsID`, `Name`, `Purchase_Price`, `Deposit_Paid`, `Bond_Term_In_Years`, `Fixed_Interest_Rate`, `Calculation_Results`) VALUES
(5, '', 500, 34, 1, 6, 76),
(6, 'Chief Sales Officer', 500, 1, 6, 1, 499),
(4, 'Jones', 500, 200, 6, 6, 76),
(7, 'Account Type To Customer', 500, 200, 1, 6, 300),
(8, 'Sales Strategy Manager', 1, 200, 6, 6, -199),
(9, 'Jones', 500, 200, 6, 6, 34),
(10, 'Jones', 500, 200, 6, 6, 34),
(11, 'Jones', 500, 1, 6, 6, 57);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UsersID` int(11) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Surname` varchar(40) NOT NULL,
  `Password` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UsersID`, `Name`, `Surname`, `Password`) VALUES
(1, 'Jones', 'Modjadji', 'Bones');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calculations`
--
ALTER TABLE `calculations`
  ADD PRIMARY KEY (`CalculationsID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UsersID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calculations`
--
ALTER TABLE `calculations`
  MODIFY `CalculationsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UsersID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
