/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE IF NOT EXISTS `internetproject` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `internetproject`;

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` (`id`, `userid`, `imagepath`, `headertext`, `imagetext`, `likeS`) VALUES
	(10, 1, '../View/upload/2013-12-31 11.40.24.jpg', 'Mad', 'Mad', 1),
	(11, 2, '../View/upload/2014-01-22 19.31.53.jpg', 'Singapore', 'Singapore', 0),
	(12, 2, '../View/upload/2013-12-20 11.20.33.jpg', 'osprey', 'osprey', 0),
	(25, 2, '../View/upload/download.jpg', 'tewdsf', 'sdf', 1),
	(26, 2, '../View/upload/download.jpg', 'tes', 'ters', 1),
	(27, 2, '../View/upload/hus-seng-diy-4.jpg', 'teshad', 'terssdf', 0),
	(28, 2, '../View/upload/5cc2b09c3d565.png', 'titletest', 'desctest', 0),
	(29, 2, '../View/upload/5cc360702d80b.png', 'titletest', 'desctest', 0),
	(30, 2, '../View/upload/5cc365993d100.png', 'titletest', 'desctest', 0),
	(31, 13, '../View/upload/log.png', 'sdf', 'helgoland', 0);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`uuid`, `username`, `password`, `firstname`, `lastname`, `zip`, `city`, `email`, `phone`) VALUES
	(1, 'yspede', 'jesp0301', 'jesper', 'joergensen', '5000', 'Odense C', 'jejoe16@student.sdu.dk', '88888888'),
	(8, 'user', 'jesp0301', 'klasdfj', 'slkdjf', '3233', 'skldjf', 'asdlfkj@sadf.co', '232323'),
	(9, 'yspedesdfsdf', 'asdfghjkl', 'adf', 'adsf', '3242', 'asdf', 'sdaf@sdf.com', '234234234'),
	(10, 'yspedeasdfasdghdfh', 'yspedeasdfasdghdfh', 'yspedeasdfasdghdfh', 'yspedeasdfasdghdfh', '23423', 'yspedeasdfasdghdfh', 'asdfyspedeasdfasdghdfh@g.com', '234234'),
	(11, 'hellooooooooooooooooo', 'hellooooooooooooooooo', 'hellooooooooooooooooo', 'hellooooooooooooooooo', '3243', 'hellooooooooooooooooo', 'hellooooooooooooooooo@gmail.com', '23423'),
	(2, 'Jesper', 'jesp0301', 'Jesper', 'joergensen', '5000', 'Odense C', 'jejoe16@student.sdu.dk', '234234234'),
	(12, 'Jens', '$2y$10$MhSKSXCg.jEPpJQZI8dbuObRYrpVsacTGvE3YHWztZll6Kghs2P8G', 'sdfs', 'sdfsd', '23433', 'sdfsdfsdf', 'sadfasdf@ga.com', '34234234'),
	(13, 'jesperj', '$2y$10$jVkgFglLxSZiOTmwUFmrLus36.LICmUjkaePINK4pZrESpeu0QUt2', 'sdf', 'sdgf', 's345', 'dfgsdg', 'stempelkort@gmail.com', 'asdf234234');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
