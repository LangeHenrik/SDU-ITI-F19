-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.2.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2019-04-27 14:25:24
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for adele2
CREATE DATABASE IF NOT EXISTS `adele2` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `adele2`;


-- Dumping structure for table adele2.picture
CREATE TABLE IF NOT EXISTS `picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `picturename` varchar(50),
  `username` varchar(50),
  `title` varchar(50),
  `type` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table adele2.picture: ~5 rows (approximately)
/*!40000 ALTER TABLE `picture` DISABLE KEYS */;
INSERT INTO `picture` (`id`, `picturename`, `username`, `title`, `type`) VALUES
	(1, '1.jpg', 'testing', 'dog', _binary 0x424C4F42),
	(3, '2.jpg', 'Regina', 'test', NULL),
	(4, '3.jpg', 'Regina', 'test2', NULL),
	(6, 'texti.jpg', 'Regina', 'vv', NULL),
	(7, '1. B&W-Cool.png', 'Regina', 'testings', NULL);
/*!40000 ALTER TABLE `picture` ENABLE KEYS */;


-- Dumping structure for table adele2.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(50) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table adele2.user: ~8 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `FullName`, `Username`, `Address`, `Password`) VALUES
	(1, 'Regina Svala Svavarsd', 'Regina', 'Vesterdalen 20CD', 'Regina123'),
	(2, 'Svava Gudrun Svavarsd', 'Svava', 'Vesterdalen 20CD', 'Svava123'),
	(3, 'Ingo', 'Ingo', 'dalo', 'dalo'),
	(4, 'inggg', 'gg', 'gg', 'gg'),
	(5, 'Svavar ', 'Svavar', 'Vogabraut 26', 'Svavar81'),
	(6, 'Tota Litla', 'totalitla', 'Dalo 2', 'Totalitla123'),
	(7, 'Svabbi Litli', 'Svabbilitli', 'Vogabraut 26', 'Svabbilitli123'),
	(8, '1', '1', '1', '1');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
