
DROP DATABASE IF EXIST `miho16`;
CREATE DATABASE `miho16`;
USE `miho16`;

CREATE TABLE IF NOT EXISTS `imagedb` (
  `image_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `tittle` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `imagedb` DISABLE KEYS */;
INSERT INTO `imagedb` (`image_id`, `username`, `tittle`, `description`, `image`) VALUES
	(1, 'miho16', 'cat', 'cute cat', 'gallery/1.png'),
	(2, 'miho16', 'cat2', 'cat nugget', 'gallery/2.png');
/*!40000 ALTER TABLE `imagedb` ENABLE KEYS */;


CREATE TABLE IF NOT EXISTS `userdb` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `userdb` DISABLE KEYS */;
INSERT INTO `userdb` (`user_id`, `username`, `pass`) VALUES
	(1, 'admin', 'admin'),
	(2, 'test', 'test'),
	(3, 'miho16', 'miho16'),
	(4, 'heeej', 'heejddd'),
	(5, 'bfgnh', '$2y$10$jn41.fgGW82k4.S8dolZIucshkRd8bpxfbLR4kTCvU7scp89pIsZ.'),
	(6, 'erg', 'efrg'),
	(7, '321', '321'),
	(8, 'mikkel', 'mikkel'),
	(9, 'ghew', 'vsdbsd'),
	(10, 'few', 'fesfe123SD'),
	(11, '123', '123'),
	(12, '12345', '12345'),
	(13, 'michaelhuu', '1qW"1qW"'),
	(14, '123', '123'),
	(15, 'ngorebgore', 'gneroinhregip'),
	(16, 'miho16', 'miho16'),
	(17, 'test', 'test'),
	(18, 'admin', 'admin');
/*!40000 ALTER TABLE `userdb` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
