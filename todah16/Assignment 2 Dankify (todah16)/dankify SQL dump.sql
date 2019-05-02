-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 02, 2019 at 03:09 PM
-- Server version: 10.3.12-MariaDB
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dankify`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `user_name` varchar(40) NOT NULL,
  `img_id` int(10) NOT NULL,
  `text` varchar(250) NOT NULL,
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`user_name`, `img_id`, `text`, `comment_id`) VALUES
('Zunac', 31, ' \r\n        THE WORLD', 16),
('Zunac', 33, ' fgkofihy\r\n        ', 15),
('McFaggit', 22, 'Aww yeah', 6),
('Zunac', 33, ' asdasd\r\n        ', 14),
('Zunac', 33, ' rogtjoth\r\n        ', 13),
('Zunac', 32, 'Alright! \r\n        ', 12);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `img_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `description` varchar(240) DEFAULT NULL,
  `user_name` varchar(40) NOT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=MyISAM AUTO_INCREMENT=139 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`img_id`, `name`, `description`, `user_name`) VALUES
(137, 'TestFile6.jpeg', 'Beanscription', 'Zunac'),
(136, 'TestFile7.jpeg', '80Mph', 'Zunac'),
(133, 'TestFile4.jpeg', 'Beanscription', 'Zunac'),
(132, 'hitler did nothing wrong.JPG', ' \r\n    hello there', 'Zunac'),
(131, 'hitler did nothing wrong.JPG', ' \r\n    ', 'Zunac');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `passw` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `zip` int(10) UNSIGNED NOT NULL,
  `city` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `passw`, `first_name`, `last_name`, `zip`, `city`, `email`, `phone_number`) VALUES
(4, 'Zunac', '$2y$10$CSrnRlZ3FKc2wgPNjdU5CucGiN6nW4EA7pwYlcLkjSRSI4gCp6rXS', 'Tobias', 'Dahl', 5230, 'Odense M', 'tobias_dahl@yahoo.dk', 51227307),
(13, 'DankCompany', '$2y$10$fMdiec5SfihpZnpLUeuAmuGdiYJd2s4QI25VmQfi611uzfs6mDVTq', 'Tobias', 'Dahl', 5230, 'Odense M', 'tobias_dahl@yahoo.dk', 51227307),
(12, 'Zunaca', '$2y$10$cxqI3rCcM9hEkNhi3D3EcOuwYg9Fb5lIjPqEu9XmcxuJgVP6I7DlW', 'Tobias', 'Dahl', 5230, 'Odense M', 'tobias_dahl@yahoo.dk', 51227307),
(8, 'Dio', '$2y$10$h2C.j6NbhcQ6uZ1DmwF9uei.66XNISn.q.nCR9S2iXfuuW4GgRCc.', 'Dio', 'Dahl', 5230, 'Odense M', 'tobias_dahl@yahoo.dk', 51227307),
(14, 'McFaggit', '$2y$10$3H0XOvqxWnr1028QxCgTv.4b31.lmwpZTs18whoPI8RRZwnGik7/a', 'Kristian', 'Kinder', 5230, 'Odense M', 'silverleaves13@gmail.com', 29733608);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
