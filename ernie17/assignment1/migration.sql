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


-- Dumping database structure for ernie17_picture_place
DROP DATABASE IF EXISTS `ernie17_picture_place`;
CREATE DATABASE IF NOT EXISTS `ernie17_picture_place` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ernie17_picture_place`;

-- Dumping structure for tabel ernie17_picture_place.picture
DROP TABLE IF EXISTS `picture`;
CREATE TABLE IF NOT EXISTS `picture` (
  `picture_id` int(11) NOT NULL AUTO_INCREMENT,
  `picture_user_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `header` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`picture_id`),
  KEY `picture_user_id` (`picture_user_id`),
  CONSTRAINT `picture_ibfk_1` FOREIGN KEY (`picture_user_id`) REFERENCES `picture_user` (`picture_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Dumping data for table ernie17_picture_place.picture: ~18 rows (approximately)
/*!40000 ALTER TABLE `picture` DISABLE KEYS */;
INSERT INTO `picture` (`picture_id`, `picture_user_id`, `image_name`, `header`, `description`) VALUES
	(5, 1, '1553179912-Cat01.jpg', 'Yoga cat', 'Cat tries to form circle'),
	(6, 1, '1553179999-Cat02.jpg', 'Cat in tree', 'Cat sitting in a snowy tree'),
	(8, 1, '1553180031-Cat03.jpg', 'Flower Kitten', 'Kitten leaps over flowers in garden'),
	(9, 1, '1553180131-Cat04.jpg', 'Blue-eyed kitten', 'White kitten sits in window and waits for the opportune moment'),
	(10, 1, '1553180186-Cat05.jpg', 'Cup Kitty', 'Kitten relaxes in cup'),
	(11, 2, '1553183950-Cat06.jpg', 'Truck kitty', 'Kitten taking a nap in the truck'),
	(12, 2, '1553183990-Cat07.jpg', 'Sneaky Cat', 'The cat next door is taking a sneak peak'),
	(13, 2, '1553184093-Cat08.jpg', 'Cats!', 'The cat family has been summoned'),
	(14, 2, '1553184129-Cat09.jpeg', 'Cute Kitten', 'Kitten is licking its paw like it knows what it is doing'),
	(15, 2, '1553184169-Cat10.jpg', 'Playful kittens', 'Cat mom is a bit tired of the playful kittens'),
	(16, 2, '1553184294-Cat11.jpg', 'Staring Cat', 'The cat is unsure of what it should think'),
	(17, 2, '1553184367-Cat12.jpg', 'Beggy Kitty', 'No one stands a chance against those adorable eyes'),
	(18, 2, '1553184418-Cat13.jpg', 'First time model', 'First time the kitten is photographed'),
	(19, 3, '1553184576-Cat14.png', 'Shelf Kitten', 'The kitten is trying to hide under the shelf'),
	(20, 3, '1553184660-Cat15.jpg', 'Box Cat', 'This cat mostly stays in the box. Unless there is food in the bowl'),
	(21, 3, '1553184698-Cat16.jpg', 'Skater kitty', 'This kitten is street and knows how to skate'),
	(22, 3, '1553184766-Cat17.jpg', 'Sofa Cat', 'This cat believes that it can hide by laying completely still'),
	(23, 3, '1553184840-Cat18.jpg', 'Philosophical kitty', 'This kitten curious as to what will happen if it takes the jump'),
	(24, 3, '1553184954-Cat19.jpeg', 'Suncat', 'The sunlight, it BURNS!'),
	(25, 3, '1553185022-Cat20.jpg', 'Mystical cat', 'Did you get the Cat Chow at the store?'),
	(26, 3, '1553185071-Cat21.jpg', 'Puzzled kitten', 'But, what do you mean I won&rsquo;t grow up to be a tiger?');
/*!40000 ALTER TABLE `picture` ENABLE KEYS */;

-- Dumping structure for tabel ernie17_picture_place.picture_user
DROP TABLE IF EXISTS `picture_user`;
CREATE TABLE IF NOT EXISTS `picture_user` (
  `picture_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`picture_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table ernie17_picture_place.picture_user: ~4 rows (approximately)
/*!40000 ALTER TABLE `picture_user` DISABLE KEYS */;
INSERT INTO `picture_user` (`picture_user_id`, `username`, `pass`, `firstname`, `lastname`, `zip`, `city`, `email`, `phone`) VALUES
	(1, 'admin', 'Winter2019', 'Tony', 'Stark', '90263', 'Malibu', 'tony@starkindustries.net', '+13104562489'),
	(2, 'Kongen', 'dyneL4rsen', 'Dyne', 'Larsen', '8600', 'Silkeborg', 'larsen@jysksengetoj.dk', '+4510203040'),
	(3, 'Jack', 's3cr3tpasS', 'John', 'Smith', '0000', 'Arthur\'s Town', 'jack@sparrow.org', '+177889944'),
	(4, 'TheQueen', 'amalienB0rg', 'Margrethe', 'Ingrid', '1257', 'Copenhagen', 'hoftelefonen@kongehuset.dk', '+4533401010');
/*!40000 ALTER TABLE `picture_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
