
-- Dumping database structure for raglu16
CREATE DATABASE IF NOT EXISTS `raglu16` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `raglu16`;

-- Dumping structure for table raglu16.images
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `image` BLOB NOT NULL,
  `user_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Dumping data for table raglu16.images: 22 rows
INSERT INTO `images` (`id`, `title`, `description`, `image`, `user_id`) VALUES
	(1, 'dog', 'this is a dog', 'images/DSC_3230.JPG', '1'),
	(2, 'also a dog', 'this is also a dog', 'images/DSC_1450.JPG', '1'),
	(3, '', '', 'images/DSC_0067.JPG', '1'),
	(4, 'Lincoln', 'He sits here', 'images/DSC_0159.JPG', '1'),
	(5, 'Trevi Fountain', 'It is very wet', 'images/DSC_0690.JPG', '1'),
	(6, 'Table for two', 'what else', 'images/DSC_0787.jpg', '1'),
	(7, 'Balcony for two', 'what more', 'images/DSC_0805.JPG', '1'),
	(8, '', '', 'images/DSC_0829.JPG', '1'),
	(9, 'more dogs', '', 'images/DSC_1457.JPG', '1'),
	(10, 'more dog', '', 'images/DSC_1810.JPG', '1'),
	(11, 'football doggo', '', 'images/DSC_1827.JPG', '1'),
	(12, 'flowers', '', 'images/DSC_1953.JPG', '1'),
	(13, 'even more dogs', 'too much dog', 'images/DSC_1912.JPG', '1'),
	(14, '', '', 'images/DSC_2019.JPG', '1'),
	(15, 'big ben', '2big4u', 'images/DSC_2341.JPG', '1'),
	(16, 'Buckingham palace', 'She was home that day', 'images/DSC_2524.JPG', '1'),
	(17, 'Tower bridge', '', 'images/DSC_2645.JPG', '1'),
	(18, '', '', 'images/DSC_2767.JPG', '1'),
	(19, 'Cherry blossom', '', 'images/DSC_2783.JPG', '1'),
	(20, 'I do not know what to call this title', 'Whatever', 'images/DSC_2792.JPG', '1'),
	(21, 'Look at that small tail', '', 'images/DSC_4033.JPG', '1'),
	(22, 'Paris', 'obviously', 'images/Paris.JPG', '1');

-- Dumping structure for table raglu16.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `zip` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phonenumber` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table raglu16.users: ~2 rows (approximately)
INSERT INTO `users` (`user_id`, `username`, `password`, `firstname`, `lastname`, `zip`, `city`, `email`, `phonenumber`) VALUES
	(1, 'raglu', '$2y$10$5GfBRuI3GS0Efi6E6hY50.ZW29yz1F3Iy3CDZfFy.wigJh81cKR.S', 'Rasmus', 'Gluud', 5000, 'Odense', 'raglu16@student.sdu.dk', 30206300),
	(2, 'raglu1', '$2y$10$5GfBRuI3GS0Efi6E6hY50.ZW29yz1F3Iy3CDZfFy.wigJh81cKR.S', 'asdf', 'asdf', 1111, 'asdf', 'asdf@asdf.asdf', 11111111);

