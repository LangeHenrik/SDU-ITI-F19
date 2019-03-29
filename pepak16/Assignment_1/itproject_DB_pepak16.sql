-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 22, 2019 at 11:38 PM
-- Server version: 10.1.37-MariaDB-0+deb9u1
-- PHP Version: 7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(36) COLLATE utf8_bin NOT NULL,
  `user_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `user_password` varchar(100) COLLATE utf8_bin NOT NULL,
  `user_phonenumber` int(8) NOT NULL,
  `user_email` varchar(100) COLLATE utf8_bin NOT NULL,
  `user_zipcode` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`, `user_phonenumber`, `user_email`, `user_zipcode`) VALUES
('5c8fa43a364e5', 'Jens', '123123pp', 22456150, 'persha95@gmail.com', 5240),
('5c8fb4a73ee5f', 'hansen123', '123123pp', 22456150, 'persha95@gmail.com', 5240);

-- --------------------------------------------------------

--
-- Table structure for table `user_post`
--

CREATE TABLE `user_post` (
  `user_post_id` varchar(36) COLLATE utf8_bin NOT NULL,
  `user_post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_post_header` varchar(100) COLLATE utf8_bin NOT NULL,
  `user_post_description` varchar(500) COLLATE utf8_bin NOT NULL,
  `user_post_url` varchar(500) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_post`
--

INSERT INTO `user_post` (`user_post_id`, `user_post_time`, `user_post_header`, `user_post_description`, `user_post_url`) VALUES
('5c952aaba17d6', '2019-03-22 18:34:19', 'Linux terminal', 'Ubuntu is just amazing, check it out!', 'uploads/Screenshot from 2019-03-08 20-50-02.png'),
('5c9542818b1a7', '2019-03-22 20:16:01', 'Wallpaper', 'i want to share wallpapers with you guys\r\n', 'uploads/ubuntu_lockscreen_wallpaper.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_post`
--
ALTER TABLE `user_post`
  ADD PRIMARY KEY (`user_post_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
