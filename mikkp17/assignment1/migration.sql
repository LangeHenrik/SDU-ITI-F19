-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.2.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2019-03-22 01:26:15
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for mikkp17
DROP DATABASE IF EXISTS `mikkp17`;
CREATE DATABASE IF NOT EXISTS `mikkp17` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `mikkp17`;


-- Dumping structure for table mikkp17.images
DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
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

-- Dumping data for table mikkp17.images: ~3 rows (approximately)
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` (`img_id`, `img_userid`, `img_uploaddate`, `img_header`, `img_desc`, `img_path`) VALUES
	(36, 5, '2019-03-22 01:18:17', 'Skull and Bones', 'This is a wallpaper for the game Skull and Bones!', 'uploads/skull_and_bones_2018_video_game-wallpaper-2560x1440.jpg'),
	(37, 5, '2019-03-22 01:19:28', 'Subnautica art', 'This is some art for the game Subnautica!', 'uploads/subnautica-4000x2202-2015-game-diving-tentacles-sea-bottom-blue-2318.jpg'),
	(38, 6, '2019-03-22 01:21:13', 'Hey! This is a cool picture.', 'This is a cool picture of a skyrim wallpaper! ', 'uploads/the_elder_scrolls_v_skyrim_dragonborn_warrior_skyrim_sword_helmet_2242_3840x2160.jpg');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;


-- Dumping structure for table mikkp17.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstn` varchar(255) NOT NULL,
  `lastn` varchar(255) NOT NULL,
  `zip` int(4) NOT NULL,
  `city` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phonenumber` varchar(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table mikkp17.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `created`, `username`, `password`, `firstn`, `lastn`, `zip`, `city`, `email`, `phonenumber`) VALUES
	(5, '2019-03-22 01:17:14', 'mikkp17', '$2y$10$DSETDDce72R5nBH1d1p3DOmXFQdQYwWYlburnscnp/vnAaswnasH.', 'Mikkel', 'Pedersen', 5260, 'Odense', 'mikkp17@student.sdu.dk', '31120061'),
	(6, '2019-03-22 01:20:30', 'randomPerson', '$2y$10$5owgyL/yfNcG1xCTyc.E8eKfDmUM//lbvNv1JFjL4xixRen4J5WW.', 'Random', 'Person', 5260, 'Odense', 'randomp@example.com', '12345678');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
