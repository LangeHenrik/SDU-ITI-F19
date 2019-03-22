-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.2.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2019-03-22 14:25:53
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for mahes17
DROP DATABASE IF EXISTS `mahes17`;
CREATE DATABASE IF NOT EXISTS `mahes17` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `mahes17`;


-- Dumping structure for table mahes17.person
DROP TABLE IF EXISTS `person`;
CREATE TABLE IF NOT EXISTS `person` (
  `person_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) NOT NULL,
  `userPassword` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `zipcode` int(10) unsigned DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phoneNumber` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`person_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table mahes17.person: ~4 rows (approximately)
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
INSERT INTO `person` (`person_id`, `firstName`, `userPassword`, `lastName`, `zipcode`, `city`, `email`, `phoneNumber`) VALUES
	(10, 'Patrik', '$2y$10$614V.aCgvRe5wVyU4o6dce/jtPt9jMYorR/0xFUikcBNgegwKNMGy', 'Star', 12332, 'Bikini Bottom', 'patrick@seea.com', 1233221),
	(11, 'Malte', '$2y$2y$10$GT56vZJVHQhV2XEieWe/Ze1Ca5/nhHsimsBlz1zmungFSS05nOcK2', 'Hesk', 5200, 'Odense', 'maltehesk@hotmail.com', 24877134),
	(12, 'Patrick', '$2y$10$IR2IRmd1f7r1GyLtvmlf0OUu.Dht2pWKpQvfkAYujN1ZtkzOygal.', 'Star', 2878, 'Bikini Bottom', 'patrick@seea.com', 32343),
	(13, 'Tim', '$2y$10$vfH1kPAiTxpvkgou0dknSuakYVUyk.kr5pFyx1laHnDMO1x2dAr0.', 'TIm', 2132, 'dsfsdfds', 'tim@sdasd.com', 12323333);
/*!40000 ALTER TABLE `person` ENABLE KEYS */;


-- Dumping structure for table mahes17.picture
DROP TABLE IF EXISTS `picture`;
CREATE TABLE IF NOT EXISTS `picture` (
  `picture_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pictureImage` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `desc` varchar(200) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`picture_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `picture_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `person` (`person_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table mahes17.picture: ~2 rows (approximately)
/*!40000 ALTER TABLE `picture` DISABLE KEYS */;
INSERT INTO `picture` (`picture_id`, `pictureImage`, `title`, `desc`, `user_id`) VALUES
	(1, '/cat.jpg', 'Cute cat', 'Pic of cute cat', 11),
	(2, '/dog.jpg', 'Cute dog', 'A dog', 11);
/*!40000 ALTER TABLE `picture` ENABLE KEYS */;


-- Dumping structure for table mahes17.timelog
DROP TABLE IF EXISTS `timelog`;
CREATE TABLE IF NOT EXISTS `timelog` (
  `timelog_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eventName` varchar(100) NOT NULL,
  `eventTimestamp` varchar(100) NOT NULL,
  `responsible` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`timelog_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table mahes17.timelog: ~3 rows (approximately)
/*!40000 ALTER TABLE `timelog` DISABLE KEYS */;
INSERT INTO `timelog` (`timelog_id`, `eventName`, `eventTimestamp`, `responsible`) VALUES
	(1, 'event', 'timestamp', 'responsible'),
	(2, 'Logged in', '2019-03-21 01:13:51', 'Testuser.com'),
	(3, 'Logged in', '2019-03-22 02:22:45', 'maltehesk@hotmail.com');
/*!40000 ALTER TABLE `timelog` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
