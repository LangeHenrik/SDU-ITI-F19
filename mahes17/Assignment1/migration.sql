-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.2.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2019-03-22 08:20:17
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table mahes17.picture
DROP TABLE IF EXISTS `picture`;
CREATE TABLE IF NOT EXISTS `picture` (
  `picture_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pictureImage` varchar(100) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`picture_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `picture_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `person` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table mahes17.timelog
DROP TABLE IF EXISTS `timelog`;
CREATE TABLE IF NOT EXISTS `timelog` (
  `timelog_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eventName` varchar(100) NOT NULL,
  `eventTimestamp` varchar(100) NOT NULL,
  `responsible` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`timelog_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
