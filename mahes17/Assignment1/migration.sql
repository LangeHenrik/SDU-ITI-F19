-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.2.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2019-05-02 10:00:56
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for mahes17
DROP DATABASE IF EXISTS `mahes17`;
CREATE DATABASE IF NOT EXISTS `mahes17` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `mahes17`;


-- Dumping structure for table mahes17.pictures
DROP TABLE IF EXISTS `pictures`;
CREATE TABLE IF NOT EXISTS `pictures` (
  `img_id` int(10) NOT NULL AUTO_INCREMENT,
  `img_userid` int(10) NOT NULL,
  `img_uploaddate` datetime NOT NULL,
  `img_header` varchar(100) NOT NULL,
  `img_desc` varchar(1000) NOT NULL,
  `img_path` varchar(100) NOT NULL,
  PRIMARY KEY (`img_id`),
  KEY `FK_images_users` (`img_userid`),
  CONSTRAINT `FK_images_users` FOREIGN KEY (`img_userid`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- Dumping data for table mahes17.pictures: ~3 rows (approximately)
/*!40000 ALTER TABLE `pictures` DISABLE KEYS */;
INSERT INTO `pictures` (`img_id`, `img_userid`, `img_uploaddate`, `img_header`, `img_desc`, `img_path`) VALUES
	(1, 5, '2019-03-22 01:18:17', 'This a dog', 'Cute dog', 'pictures/dog.jpg'),
	(2, 5, '2019-03-22 01:19:28', 'This a cat', 'nice cat', 'pictures/cat.jpg'),
	(3, 7, '2019-04-25 01:21:13', 'This is a fish', 'Wet fish', 'pictures/fish.jpg');
/*!40000 ALTER TABLE `pictures` ENABLE KEYS */;


-- Dumping structure for table mahes17.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `zipcode` int(4) NOT NULL,
  `city` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phonenumber` varchar(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table mahes17.users: ~4 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `created`, `username`, `password`, `firstname`, `lastname`, `zipcode`, `city`, `email`, `phonenumber`) VALUES
	(5, '2019-04-28 01:13:14', 'hrmalte', '$2y$10$DSETDDce72R5nBH1d1p3DOmXFQdQYwWYlburnscnp/vnAaswnasH.', 'Malte', 'Møller', 5200, 'Odense V', 'maltehesk1@hotmail.com', '22529876'),
	(6, '2019-04-24 01:17:32', 'larsLarsen', '$2y$10$5owgyL/yfNcG1xCTyc.E8eKfDmUM//lbvNv1JFjL4xixRen4J5WW.', 'Lars', 'Larsen', 5200, 'Odense V', 'randomp@example.com', '12345678'),
	(7, '2019-05-02 19:39:20', 'Malte', '$2y$10$v/mxCoCTbhaWn7k3/mlmj.vfX6an0JGo47WWUZIm3pjkXbTwMnLRK', 'Malte', 'Hesk', 5200, 'Odense V', 'maltehesk@hotmail.com', '24877134'),
	(8, '2019-05-02 08:15:58', 'kim1524', '$2y$10$B2.AaI1xSJSp0D6wMuUKB.jp726d2H.Cot66NBhEDB/CW1eGScY2i', 'Kim', 'Poulsen', 8377, 'Kernetby', 'kim1221@hotmail.com', '37725552');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
