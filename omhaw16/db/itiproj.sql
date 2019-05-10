-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 09, 2019 at 06:55 PM
-- Server version: 5.7.26-0ubuntu0.18.04.1
-- PHP Version: 7.2.17-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itiproj`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postID` int(255) NOT NULL,
  `postedby` int(100) NOT NULL,
  `imgName` blob NOT NULL,
  `imgTitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `imgDesc` varchar(255) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `imgDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `postedby`, `imgName`, `imgTitle`, `imgDesc`, `imgDate`) VALUES
(28, 11, 0x6d65737369726f6f7a2e706e67, 'PNGPGNPGNPGNG', 'png ', '2019-05-08 16:29:12');

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
(2, 'omarr', '123344', 'Test', 'Testesen', 5230, 'Odense', 65502611, 'oof@example.com'),
(3, 'root', '12341234', 'omar', 'omar', 13838, 'omarcity', 12344555, 'omar@gmail.com'),
(6, 'rooz', '1234rooz', 'Omar', 'Hawwash', 5200, 'Odense', 60213084, 'omarnabilhawwash@gmail.com'),
(7, 'deRoon', '12345678', 'Omar', 'de Roon', 10303, 'CityCity', 12838383, 'icty@city.com'),
(8, 'omaromar', '12345678', 'Omar', 'omar', 12333, 'rosk', 12333333, 'omar@gmailmail.com'),
(9, 'testhello', '12345678', 'Omar', 'Omar', 12838, 'CityMyCity', 23445555, 'big@oof.com'),
(10, 'whatsup001', '12345678', 'Hello', 'Maaan', 39393, 'The Village', 38293839, 'oof@oof.com'),
(11, 'oof', '12345678', 'Omar', 'Test', 36813, 'OofCity', 37475948, 'oof@bigoof.com'),
(12, 'mynamejeff', '12345678', 'Omar', 'Jeff', 94848, 'Jeffcity', 33839383, 'jeff@jeff.com'),
(13, 'jeffhello', '12345678', 'Jeff', 'Jeffensen', 38383, 'JeffCity', 83383939, 'jeffhello@email.com');

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
  MODIFY `postID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
