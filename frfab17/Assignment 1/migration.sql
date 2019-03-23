-- --------------------------------------------------------
-- Vært:                         127.0.0.1
-- Server-version:               5.2.14-MariaDB - mariadb.org binary distribution
-- ServerOS:                     Win64
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for frfab17
DROP DATABASE IF EXISTS `frfab17`;
CREATE DATABASE IF NOT EXISTS `frfab17` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `frfab17`;

-- Dumping structure for tabel frfab17.images
DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `uploaddate` datetime NOT NULL,
  `header` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `path` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `images_user_id_fk` (`userid`),
  CONSTRAINT `images_user_id_fk` FOREIGN KEY (`userid`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table frfab17.images: ~3 rows (approximately)
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` (`id`, `userid`, `uploaddate`, `header`, `description`, `path`) VALUES
	(7, 1, '2019-03-22 21:21:48', 'Collection of hardware', 'This is a nice collection of hardware', 'images/billede_voresvilla_hvidevarer-750x500.jpg'),
	(9, 4, '2019-03-22 21:38:20', 'Fridge', 'This is a nice fridge', 'images/LG-GSL760PZXV-amerikanerskab-768x768.jpeg'),
	(10, 4, '2019-03-22 21:40:52', 'Gas oven', 'This is a gas oven', 'images/Westinghouse-WFG617SA-Freestanding-Gas-Oven-Stove-Hero-high.jpeg');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;

-- Dumping structure for tabel frfab17.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_username_uindex` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table frfab17.user: ~3 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `name`, `password`) VALUES
	(1, 'fabricius', 'Frederik Fabricius', 'Hejsa123'),
	(3, 'testbruger', 'Test Bruger', 'Test321'),
	(4, 'knast', 'Kaptajn Knas', 'Morgen123');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
