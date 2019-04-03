-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 22, 2019 at 03:12 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itiproj`
--
CREATE DATABASE IF NOT EXISTS `itiproj` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `itiproj`;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postID` int(255) NOT NULL,
  `postedby` int(100) NOT NULL,
  `imgName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `imgTitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `imgDesc` varchar(255) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `imgDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `postedby`, `imgName`, `imgTitle`, `imgDesc`, `imgDate`) VALUES
(5, 2, 'mdl.jpg', 'Matthijs de Ligt', 'De Ligt, Ajax Amsterdam, 2019.', '2019-03-21 15:09:40'),
(8, 1, 'frenkie.jpg', 'Frenkie de Jong', 'The other half of the Ajax duo.', '2019-03-22 14:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(100) NOT NULL,
  `userName` varchar(16) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `userPass` varchar(100) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `firstName` varchar(20) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `lastName` varchar(20) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `zip` int(4) NOT NULL,
  `city` varchar(255) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `phone` int(8) NOT NULL,
  `email` varchar(254) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `userName`, `userPass`, `firstName`, `lastName`, `zip`, `city`, `phone`, `email`) VALUES
(1, 'oooomar', 'root', 'Omar', 'Hawwash', 5200, 'Odense', 60213084, 'omarnabilhawwash@gmail.com'),
(2, 'omarr', '123344', 'Test', 'Testesen', 5230, 'Odense', 65502611, 'oof@example.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
