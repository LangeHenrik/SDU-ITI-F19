-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.2.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2019-03-22 16:06:04
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for adele2
CREATE DATABASE IF NOT EXISTS `adele2` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `adele2`;


-- Dumping structure for table adele2.notendur
CREATE TABLE IF NOT EXISTS `notendur` (
  `FullName` varchar(50) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table adele2.notendur: ~8 rows (approximately)
/*!40000 ALTER TABLE `notendur` DISABLE KEYS */;
INSERT INTO `notendur` (`FullName`, `Username`, `Address`, `Password`, `id`) VALUES
	('Regina Svala Svavarsd', 'Regina', 'Vesterdalen 20CD', 'Regina123', NULL),
	('Svava Gudrun Svavarsd', 'Svava', 'Vesterdalen 20CD', 'Svava123', NULL),
	('Thorey', 'tota', 'Vesterdalen 20CD', 'Thorey123', NULL),
	('kkk', 'kkk', 'kk', 'kk', NULL),
	('hhh', 'hhh', 'hh', 'hh', NULL),
	('hhh', 'hhh', 'hh', 'hh', NULL),
	('aaa', 'aaa', 'aaaa', 'aaaa', NULL),
	('ppppp', 'ppppp', 'pppppp', 'pppppp', NULL);
/*!40000 ALTER TABLE `notendur` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
