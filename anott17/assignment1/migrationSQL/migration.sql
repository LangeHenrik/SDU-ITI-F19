-- --------------------------------------------------------
-- Vært:                         127.0.0.1
-- Server-version:               10.3.12-MariaDB - mariadb.org binary distribution
-- ServerOS:                     Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for anott17
DROP DATABASE IF EXISTS `anott17`;
CREATE DATABASE IF NOT EXISTS `anott17` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `anott17`;

-- Dumping structure for tabel anott17.person
DROP TABLE IF EXISTS `person`;
CREATE TABLE IF NOT EXISTS `person` (
  `person_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `front_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `city` varchar(30) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `email_adress` varchar(100) NOT NULL,
  PRIMARY KEY (`user_name`),
  UNIQUE KEY `person_id` (`person_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table anott17.person: ~0 rows (approximately)
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
INSERT INTO `person` (`person_id`, `user_name`, `password`, `front_name`, `last_name`, `zip_code`, `city`, `phone_number`, `email_adress`) VALUES
	(1, 'admin', 'admin', 'Anders', 'Ottsen', 4000, 'Odense', '+2000000000', 'anders@mail.dk'),
	(2, 'Jolo', 'Hejsa5678!', 'Jonas', 'Krristiansen', 6000, 'Aalborg', '+88888888888', 'jonas@hotmail.com'),
	(3, 'Rssoe', 'Rosen95!', 'Rose', 'Terese', 5000, 'Odense', '+888888888', 'rose@mail.dk'),
	(4, 'Young', 'Test123456!', 'Christian', 'Hansen', 4000, 'Odense', '+2020202020220', 'christian@gmail.com');
/*!40000 ALTER TABLE `person` ENABLE KEYS */;

-- Dumping structure for tabel anott17.picture
DROP TABLE IF EXISTS `picture`;
CREATE TABLE IF NOT EXISTS `picture` (
  `picture_id` int(11) NOT NULL AUTO_INCREMENT,
  `person` varchar(30) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `picture_file` varchar(100) NOT NULL,
  `date_uploaded` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`picture_id`,`person`),
  KEY `person` (`person`),
  CONSTRAINT `picture_ibfk_1` FOREIGN KEY (`person`) REFERENCES `person` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table anott17.picture: ~0 rows (approximately)
/*!40000 ALTER TABLE `picture` DISABLE KEYS */;
INSERT INTO `picture` (`picture_id`, `person`, `title`, `description`, `picture_file`, `date_uploaded`) VALUES
	(1, 'Rssoe', 'March2018', 'Great picture from a great time in spain.', '7eb0aeea194c377f661dd4f803520fef6635b430.jpeg', '2019-03-21 21:08:40'),
	(2, 'Young', 'FavOS', 'A pic of the #1 Operating system.', '20ff6790aeb8e79a48e50f8e5e587208c5adc28b.png', '2019-03-21 21:08:40'),
	(3, 'Jolo', 'Antarcts', 'A picture from my time in antarctics.', '73a90e70bf96b3886af191d04ec7993fa7687770.jpg', '2019-03-21 21:08:40'),
	(4, 'Rssoe', 'Pet', 'A picture of my pet.', 'df9748caf2594fb4ae1c4d05fa3c0a28b8fe4010.jpg', '2019-03-21 21:08:40');
/*!40000 ALTER TABLE `picture` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
