-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.2.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2019-03-22 21:06:58
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for nifra17
CREATE DATABASE IF NOT EXISTS `nifra17` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_danish_ci */;
USE `nifra17`;


-- Dumping structure for table nifra17.images
CREATE TABLE IF NOT EXISTS `images` (
  `username` varchar(255) COLLATE latin1_danish_ci NOT NULL,
  `path` varchar(255) COLLATE latin1_danish_ci NOT NULL,
  `title` varchar(255) COLLATE latin1_danish_ci NOT NULL,
  `description` varchar(255) COLLATE latin1_danish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_danish_ci;

-- Dumping data for table nifra17.images: ~7 rows (approximately)
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` (`username`, `path`, `title`, `description`) VALUES
	('Test1', 'uploads/Belbin.png', 'asdfghj', 'asdfgh'),
	('Test1', 'uploads/ricecup ironman series.PNG', 'This is rice', 'CupManDescription bla bla bla bla'),
	('Test2', 'uploads/unknown.png', 'Det her ved jeg ikke hvad er', 'Test beskrivelse â€¦â€¦.'),
	('Admin', 'uploads/_104133270_78bd83b4-ec17-4ce1-be30-07dc58cc0f6d.jpg', 'Billedetekst', 'Det her er en beskrivelse af ingenting'),
	('Admin', 'uploads/photo-1534278931827-8a259344abe7.jpg', 'Pindsvin', 'Pindsvin beskrivelse'),
	('Test3', 'uploads/Trumpdoll.png', 'Trrruuuuump', 'doooooooooooooooollllllll'),
	('Test3', 'uploads/POTD_chick_3597497k.jpg', 'Chicken?', 'Or is it a duck?');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;


-- Dumping structure for table nifra17.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE latin1_danish_ci NOT NULL,
  `password` varchar(255) COLLATE latin1_danish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_danish_ci;

-- Dumping data for table nifra17.users: ~4 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`) VALUES
	(1, 'Test1', 'Testen'),
	(2, 'Test2', 'hej'),
	(3, 'Test3', 'Testetetet'),
	(4, 'Admin', 'Adminpassword');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
