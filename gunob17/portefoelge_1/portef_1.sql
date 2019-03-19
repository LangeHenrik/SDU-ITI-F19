-- --------------------------------------------------------
-- Vært:                         127.0.0.1
-- Server-version:               10.3.13-MariaDB - mariadb.org binary distribution
-- ServerOS:                     Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for gunob17
CREATE DATABASE IF NOT EXISTS `gunob17` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gunob17`;

-- Dumping structure for tabel gunob17.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `idcom` int(20) NOT NULL AUTO_INCREMENT,
  `idus` int(11) NOT NULL,
  `picid` int(20) NOT NULL,
  `username` tinytext NOT NULL,
  `usercomment` longtext NOT NULL,
  PRIMARY KEY (`idcom`),
  KEY `idus` (`idus`),
  KEY `picid` (`picid`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`idus`) REFERENCES `users` (`idusers`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`picid`) REFERENCES `pictures` (`idpic`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table gunob17.comments: ~0 rows (approximately)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`idcom`, `idus`, `picid`, `username`, `usercomment`) VALUES
	(1, 3, 23, 'ralle', 'first comment  &lt;script&gt;  let testxss&lt;/script&gt;');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Dumping structure for tabel gunob17.pictures
CREATE TABLE IF NOT EXISTS `pictures` (
  `idpic` int(20) NOT NULL AUTO_INCREMENT,
  `idus` int(11) NOT NULL,
  `username` tinytext NOT NULL,
  `path` longtext NOT NULL,
  `name` longtext NOT NULL,
  PRIMARY KEY (`idpic`),
  KEY `idus` (`idus`),
  CONSTRAINT `pictures_ibfk_1` FOREIGN KEY (`idus`) REFERENCES `users` (`idusers`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table gunob17.pictures: ~23 rows (approximately)
/*!40000 ALTER TABLE `pictures` DISABLE KEYS */;
INSERT INTO `pictures` (`idpic`, `idus`, `username`, `path`, `name`) VALUES
	(1, 1, 'gunob', '../uploades/5c8fa7b0c8cd80.68466931.gif', '5c8fa7b0c8cd80.68466931.gif'),
	(2, 1, 'gunob', '../uploades/5c8fa90e5ff399.13989484.jpg', '5c8fa90e5ff399.13989484.jpg'),
	(3, 1, 'gunob', '../uploades/5c8fa9459c3e58.87868117.gif', '5c8fa9459c3e58.87868117.gif'),
	(4, 1, 'gunob', '../uploades/5c8fb71a8cba89.24766183.jpg', '5c8fb71a8cba89.24766183.jpg'),
	(5, 1, 'gunob', '../uploades/5c8fb75f28e3e8.63829701.png', '5c8fb75f28e3e8.63829701.png'),
	(6, 1, 'gunob', '../uploades/5c8fdca5658049.82145113.jpg', '5c8fdca5658049.82145113.jpg'),
	(7, 1, 'gunob', '../uploades/5c8fdcb49ee0d9.55290370.jpg', '5c8fdcb49ee0d9.55290370.jpg'),
	(8, 1, 'gunob', '../uploades/5c8fdccc35adc0.52294479.gif', '5c8fdccc35adc0.52294479.gif'),
	(9, 1, 'gunob', '../uploades/5c8fdcdaa69326.73954135.png', '5c8fdcdaa69326.73954135.png'),
	(10, 1, 'gunob', '../uploades/5c8fdd048020b3.71831776.gif', '5c8fdd048020b3.71831776.gif'),
	(11, 1, 'gunob', '../uploades/5c8fdd10d70c33.35076365.png', '5c8fdd10d70c33.35076365.png'),
	(12, 1, 'gunob', '../uploades/5c8fdd1a6e77d1.32367598.jpg', '5c8fdd1a6e77d1.32367598.jpg'),
	(13, 1, 'gunob', '../uploades/5c8fdd28a70699.64489108.jpg', '5c8fdd28a70699.64489108.jpg'),
	(14, 1, 'gunob', '../uploades/5c8fdd33dc9217.54907320.gif', '5c8fdd33dc9217.54907320.gif'),
	(15, 1, 'gunob', '../uploades/5c8fdd3d786756.30706036.jpg', '5c8fdd3d786756.30706036.jpg'),
	(17, 1, 'gunob', '../uploades/5c8fddede60778.86987481.jpg', '5c8fddede60778.86987481.jpg'),
	(18, 1, 'gunob', '../uploades/5c8fddf81e3451.07425839.png', '5c8fddf81e3451.07425839.png'),
	(19, 1, 'gunob', '../uploades/5c8fde0009df21.47590108.jpg', '5c8fde0009df21.47590108.jpg'),
	(20, 1, 'gunob', '../uploades/5c8fde1b315647.90103159.jpg', '5c8fde1b315647.90103159.jpg'),
	(21, 1, 'gunob', '../uploades/5c8fde377c9039.34426672.jpg', '5c8fde377c9039.34426672.jpg'),
	(22, 1, 'gunob', '../uploades/5c8fe1f40d7aa9.94733541.png', '5c8fe1f40d7aa9.94733541.png'),
	(23, 1, 'gunob', '../uploades/5c90d87cc6fea4.83484075.jpg', '5c90d87cc6fea4.83484075.jpg');
/*!40000 ALTER TABLE `pictures` ENABLE KEYS */;

-- Dumping structure for tabel gunob17.users
CREATE TABLE IF NOT EXISTS `users` (
  `idusers` int(11) NOT NULL AUTO_INCREMENT,
  `fname` tinytext NOT NULL,
  `lname` tinytext NOT NULL,
  `zip` int(11) NOT NULL,
  `city` tinytext NOT NULL,
  `phoneN` varchar(50) NOT NULL,
  `username` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `pwdusers` longtext NOT NULL,
  PRIMARY KEY (`idusers`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table gunob17.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`idusers`, `fname`, `lname`, `zip`, `city`, `phoneN`, `username`, `email`, `pwdusers`) VALUES
	(1, 'Gustav', 'Nobel', 4180, 'Soreo', '20246655', 'gunob', 'gustav@st-ladegaard.dk', '$2y$10$jdF0IO4hZIqT0sWGiT1wqe8Aiz3rBsV4GQk6J6AR1/jDL3wqMmLM2'),
	(2, 'peter', 'nilsen', 5220, 'odense', '3451234', 'peten', 'ffff@gmail.com', '$2y$10$FWirChUJ/QaGHd.CdjxrQePsx7EzlvptmrjrRj.W7Nwo/1Y4EinZa'),
	(3, 'rasmus', 'petersen', 1234, 'hÃ¸jby', '12345678', 'ralle', 'tets@gmail.com', '$2y$10$H/qbVEAyc9Dwgq.gKUlBK.3k3aUBKk3IVCjIH78P5AzvdzTAf4as2');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
