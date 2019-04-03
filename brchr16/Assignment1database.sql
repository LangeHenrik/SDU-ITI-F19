-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.2.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2019-03-22 23:11:33
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for assignment1
CREATE DATABASE IF NOT EXISTS `assignment1` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_danish_ci */;
USE `assignment1`;


-- Dumping structure for table assignment1.picture
CREATE TABLE IF NOT EXISTS `picture` (
  `pictureid` int(6) NOT NULL AUTO_INCREMENT,
  `picturename` varchar(30) COLLATE latin1_danish_ci DEFAULT NULL,
  `username` varchar(30) COLLATE latin1_danish_ci DEFAULT NULL,
  `title` varchar(30) COLLATE latin1_danish_ci DEFAULT NULL,
  PRIMARY KEY (`pictureid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_danish_ci;

-- Dumping data for table assignment1.picture: ~7 rows (approximately)
/*!40000 ALTER TABLE `picture` DISABLE KEYS */;
INSERT INTO `picture` (`pictureid`, `picturename`, `username`, `title`) VALUES
	(1, 'pic1.jpg', 'test', 'landscape1'),
	(2, 'pic2.jpg', 'test1', 'landscape2'),
	(3, 'pic3.jpg', 'test2', 'landscape3'),
	(4, 'pic4.jpg', 'test3', 'landscape4'),
	(5, 'pic5.jpg', 'test4', 'landscape5'),
	(6, 'pic6.jpg', 'test', 'landscape6'),
	(7, 'pic7.jpg', 'test', 'landscape7');
/*!40000 ALTER TABLE `picture` ENABLE KEYS */;


-- Dumping structure for table assignment1.user
CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(30) COLLATE latin1_danish_ci NOT NULL,
  `password` varchar(30) COLLATE latin1_danish_ci DEFAULT NULL,
  `firstname` varchar(30) COLLATE latin1_danish_ci DEFAULT NULL,
  `lastname` varchar(30) COLLATE latin1_danish_ci DEFAULT NULL,
  `zip` int(4) DEFAULT NULL,
  `city` varchar(30) COLLATE latin1_danish_ci DEFAULT NULL,
  `email` varchar(30) COLLATE latin1_danish_ci DEFAULT NULL,
  `phonenumber` varchar(12) COLLATE latin1_danish_ci DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_danish_ci;

-- Dumping data for table assignment1.user: ~7 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`username`, `password`, `firstname`, `lastname`, `zip`, `city`, `email`, `phonenumber`) VALUES
	(':user_name', 'tester', 'test', 'tester', 123, 'odense', 'email@email.com', '004587654321'),
	('test', 'tester', 'testing', 'person', 5000, 'odense', 'tester@email.com', '004512345678'),
	('test1', 'tester', 'test', 'tester', 123, 'odense', 'email@email.com', '004587654321'),
	('test2', 'tester', 'test', 'tester', 123, 'odense', 'email@email.com', '004587654321'),
	('test3', 'tester', 'test', 'tester', 123, 'odense', 'email@email.com', '004587654321'),
	('test4', 'tester', 'test', 'tester', 123, 'odense', 'email@email.com', '004587654321'),
	('test7', '3333', '33333', '33333', 5555, '3333', '33333', '3333');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
