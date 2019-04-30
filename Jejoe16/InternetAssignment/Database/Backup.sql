-- --------------------------------------------------------
-- Vært:                         127.0.0.1
-- Server-version:               10.3.13-MariaDB - mariadb.org binary distribution
-- ServerOS:                     Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for internetproject
CREATE DATABASE IF NOT EXISTS `internetproject` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `internetproject`;

-- Dumping structure for tabel internetproject.images
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT 0,
  `imagepath` longtext NOT NULL DEFAULT '0',
  `headertext` longtext DEFAULT '0',
  `imagetext` longtext DEFAULT '0',
  `likeS` int(100) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_images_users` (`userid`),
  CONSTRAINT `FK_images_users` FOREIGN KEY (`userid`) REFERENCES `users` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table internetproject.images: ~5 rows (approximately)
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` (`id`, `userid`, `imagepath`, `headertext`, `imagetext`, `likeS`) VALUES
	(1, 1, 'upload/plantegning.png', 'scdsf', 'sdfsd', 0),
	(2, 1, 'upload/2019-02-18 21_19_37-mail - Kontrolpanel.png', 'dsf', 'sdf', 1),
	(3, 1, 'upload/2019-02-18 21_19_37-mail - Kontrolpanel.png', '', '', 1),
	(4, 1, 'upload/2019-02-18 21_19_37-mail - Kontrolpanel.png', 'fgdfg', 'dfg', 1),
	(5, 1, 'upload/P2040044.JPG', '', '', 0),
	(6, 1, 'upload/P2040065.JPG', 'dsf', 'sdf', 1),
	(7, 1, 'upload/P2040103.JPG', 'wewrwerwer', 'werwer', 1);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;

-- Dumping structure for tabel internetproject.users
CREATE TABLE IF NOT EXISTS `users` (
  `uuid` int(100) NOT NULL AUTO_INCREMENT,
  `username` longtext NOT NULL,
  `password` longtext NOT NULL,
  `firstname` longtext DEFAULT NULL,
  `lastname` longtext DEFAULT NULL,
  `zip` longtext DEFAULT NULL,
  `city` longtext DEFAULT NULL,
  `email` longtext DEFAULT NULL,
  `phone` longtext DEFAULT NULL,
  KEY `uuid` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table internetproject.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`uuid`, `username`, `password`, `firstname`, `lastname`, `zip`, `city`, `email`, `phone`) VALUES
	(1, 'yspede', 'jesp0301', 'jesper', 'joergensen', '5000', 'Odense C', 'jejoe16@student.sdu.dk', '88888888'),
	(8, 'user', 'jesp0301', 'klasdfj', 'slkdjf', '3233', 'skldjf', 'asdlfkj@sadf.co', '232323');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
