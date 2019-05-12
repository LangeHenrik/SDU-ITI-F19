-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 13, 2019 at 12:22 AM
-- Server version: 5.7.26-0ubuntu0.18.04.1
-- PHP Version: 7.2.17-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iti_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(36) NOT NULL,
  `user_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `user_password` varchar(300) COLLATE utf8_bin NOT NULL,
  `user_phonenumber` int(8) NOT NULL,
  `user_email` varchar(100) COLLATE utf8_bin NOT NULL,
  `user_zipcode` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`, `user_phonenumber`, `user_email`, `user_zipcode`) VALUES
(1, 'Jens123123', '$2y$10$TlGfm5/tDz.TM.Go6W6YyudDTzMqRerc4EQxr4Jy0nL/7wJkLhbWe', 22456150, 'persha95@gmail.com', 5240),
(2, 'Jens', '$2y$10$LRRW4.aPLCB0UUjI7//eX.mgffvghWKhJPtHCYvB5fYnMwVXCv.cO', 22456150, 'persha95@gmail.com', 5240),
(3, 'mette', '$2y$10$cFc2ovlHiftje9M0Iy0ED.upiYZ/frEzGQ9jELvHos7M1wRyEJ54W', 22456150, 'persha95@gmail.com', 5240),
(4, 'Jensabc', '$2y$10$3gO6Ba9nGIJga72eoSxd4OGzsd4JSuhAzEemdmB7uT.5rLHo51MHC', 22456150, 'persha95@gmail.com', 5240),
(5, 'Maja', '$2y$10$5VPgcx0cvXuoKtPn7bBlF.Pg4ugqbEXzq1pO57iVRaKjI8f7ZrY0W', 22456150, 'persha95@gmail.com', 5240),
(6, 'jytte', '$2y$10$Atn7h8MHwaNfMDwaYhXb/uhoIcTjGp9vixA4.rQlxJJ5rxttbghy2', 22456150, 'persha95@gmail.com', 5240);

-- --------------------------------------------------------

--
-- Table structure for table `user_post`
--

CREATE TABLE `user_post` (
  `user_post_id` int(36) NOT NULL,
  `user_post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_post_header` varchar(100) COLLATE utf8_bin NOT NULL,
  `user_post_description` varchar(500) COLLATE utf8_bin NOT NULL,
  `user_post_url` blob NOT NULL,
  `post_by` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_post`
--

INSERT INTO `user_post` (`user_post_id`, `user_post_time`, `user_post_header`, `user_post_description`, `user_post_url`, `post_by`) VALUES
(2, '2019-05-09 01:02:30', 'Wallpaper', 'i want to share wallpapers with you guys\r\n', 0x75706c6f6164732f7562756e74755f6c6f636b73637265656e5f77616c6c70617065722e6a7067, 1),
(73, '2019-05-09 16:33:17', 'Amazing Linux wallpaper', 'amazing stuff!!', 0x75706c6f6164732f5562756e74752d57616c6c7061706572732d31352e6a7067, 2),
(75, '2019-05-09 16:35:35', 'I really liked this picture', 'want to show it to you guysssss', 0x75706c6f6164732f343233373734362d6261636b67726f756e64732e6a7067, 2),
(81, '2019-05-11 19:52:30', 'black hole', 'The first ever picture captured of a black hole! :O', 0x75706c6f6164732f356364373237666563643362302e6a706567, 2),
(110, '2019-05-12 22:18:54', 'McLaren car', 'I really love this car, nice design and amazing technologies!', 0x75706c6f6164732f356364383962636538643066652e77656270, 6);

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
  ADD PRIMARY KEY (`user_post_id`),
  ADD UNIQUE KEY `user_post_id` (`user_post_id`),
  ADD UNIQUE KEY `user_post_id_2` (`user_post_id`),
  ADD UNIQUE KEY `user_post_id_3` (`user_post_id`),
  ADD UNIQUE KEY `user_post_id_4` (`user_post_id`),
  ADD UNIQUE KEY `user_post_id_5` (`user_post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(36) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_post`
--
ALTER TABLE `user_post`
  MODIFY `user_post_id` int(36) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
