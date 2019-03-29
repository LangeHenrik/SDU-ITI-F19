-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.12-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for kinoe16
CREATE DATABASE IF NOT EXISTS `kinoe16` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `kinoe16`;

-- Dumping structure for table kinoe16.images
CREATE TABLE IF NOT EXISTS `images` (
  `idImg` int(20) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `uidUsers` tinytext NOT NULL,
  `path` longtext NOT NULL,
  `name` longtext NOT NULL,
  PRIMARY KEY (`idImg`),
  KEY `idUser` (`idUser`),
  CONSTRAINT `images_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUsers`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table kinoe16.users
CREATE TABLE IF NOT EXISTS `users` (
  `idUsers` int(11) NOT NULL AUTO_INCREMENT,
  `uidUsers` tinytext NOT NULL,
  `emailUsers` tinytext NOT NULL,
  `pwdUsers` longtext NOT NULL,
  PRIMARY KEY (`idUsers`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
