-- --------------------------------------------------------
-- Vært:                         127.0.0.1
-- Server-version:               10.2.14-MariaDB - mariadb.org binary distribution
-- ServerOS:                     Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for spacebook
CREATE DATABASE IF NOT EXISTS `spacebook` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `spacebook`;

-- Dumping structure for tabel spacebook.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `image_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Dumping data for table spacebook.comments: 7 rows
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Dumping structure for tabel spacebook.images
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_path` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=121 DEFAULT CHARSET=latin1;

-- Dumping data for table spacebook.images: 21 rows
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` (`id`, `image_path`, `title`, `description`, `user_id`, `date`) VALUES
	(108, 'user_images\\WBxBY1l8yC.jpeg', 'Mr. Bean', 'Beanscription', 26, '2019-05-02 13:35:28'),
	(109, 'user_images\\JKIioN2iHu.jpeg', 'Mr. Bean', 'Beanscription', 26, '2019-05-02 13:37:36'),
	(110, 'user_images\\Suj5jD0uKo.jpeg', 'Mr. Bean', 'Beanscription', 26, '2019-05-02 13:38:28'),
	(111, 'user_images\\mw2sHmJFqy.jpeg', 'Mr. Bean', 'Beanscription', 26, '2019-05-02 13:39:53'),
	(112, 'user_images\\lmYr2exMIV.jpeg', 'Mr. Bean', 'Beanscription', 26, '2019-05-02 13:40:33'),
	(113, 'user_images\\XyR6CJsbdE.jpeg', 'Mr. Bean', 'Beanscription', 26, '2019-05-02 13:42:52'),
	(114, 'user_images\\29OPhvGu72.jpeg', 'Mr. Bean', 'Beanscription', 26, '2019-05-02 13:43:39'),
	(115, 'user_images\\KKgG3NIiRH.jpeg', 'Mr. Bean', 'Beanscription', 26, '2019-05-02 13:46:01'),
	(116, 'user_images\\DoIzq50g2J.jpeg', 'Mr. Bean', 'Beanscription', 26, '2019-05-02 13:46:42'),
	(117, 'user_images\\xln8z7vYDH.jpeg', 'Mr. Bean', 'Beanscription', 26, '2019-05-02 13:47:24'),
	(118, 'user_images\\CK0lcOxNeQ.jpeg', 'Mr. Bean', 'Beanscription', 26, '2019-05-02 14:12:14'),
	(119, 'user_images\\dJzTIVQR1s.jpeg', 'Mr. Bean', 'Beanscription', 26, '2019-05-02 14:12:43'),
	(120, 'user_images\\jQzGqiaqSv.jpeg', 'Mr. Bean', 'Beanscription', 26, '2019-05-02 14:13:02'),
	(101, 'user_images\\V9RCQ4gL8N.jpeg', 'Mr. Bean', 'Beanscription', 26, '2019-05-02 13:16:02'),
	(102, 'user_images\\drQpM8Rb1q.jpeg', 'Mr. Bean', 'Beanscription', 26, '2019-05-02 13:16:55'),
	(103, 'user_images\\iBGI8Z0dDL.jpeg', 'Mr. Bean', 'Beanscription', 26, '2019-05-02 13:18:33'),
	(104, 'user_images\\x7fMwAk739.jpeg', 'Mr. Bean', 'Beanscription', 26, '2019-05-02 13:19:52'),
	(105, 'user_images\\e3E3Fa7c1D.jpeg', 'Mr. Bean', 'Beanscription', 26, '2019-05-02 13:28:14'),
	(106, 'user_images\\r1pQp0KdMG.jpeg', 'Mr. Bean', 'Beanscription', 26, '2019-05-02 13:29:35'),
	(107, 'user_images\\LwuKPLf0mM.jpeg', 'Mr. Bean', 'Beanscription', 26, '2019-05-02 13:30:02'),
	(100, 'user_images\\N6O1uci0PX.jpeg', 'Mr. Bean', 'Beanscription', 26, '2019-05-02 11:42:07');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;

-- Dumping structure for tabel spacebook.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `zip` int(11) NOT NULL,
  `city` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Dumping data for table spacebook.users: 21 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `zip`, `city`, `email`, `phone`, `password`) VALUES
	(9, 'metal', '', '', 0, '', '', '', '$2y$10$fo6GOzzfaCD5GOcrgT8wl.T/2KKoJXj917nLpfHjDAd5oEewlw77m'),
	(8, 'metalfist213', '', '', 0, '', '', '', '$2y$10$pbocAj/AooMS13CynMuYo.3QQEjLDLqTAZexcFyJGtwxgvnUF1NDi'),
	(10, 'Kriller', '', '', 0, '', '', '', '$2y$10$vsdTv31A0BREnXuiU4.f4eepY/kRIbr0SECCFNYbwuDn75hPYoAMa'),
	(12, 'Broliver123', '', '', 0, '', '', '', '$2y$10$aAKvmWHNW3tbHxzYHKJP.u03Us6MBN2Ym2T4heHPVvlCkipuU2dhu'),
	(13, 'mcFagotti', '', '', 0, '', '', '', '$2y$10$./cNFCOEd3TrgGdyRdXM2eMWeUWN1uPTLcevZudy9q3QDKDHfdgpW'),
	(14, 'TobiasDank', '', '', 0, '', '', '', '$2y$10$mf5juKmkjb2tQXF8Y2jXZO.8hadieN0jv0O5mMAftZRHYCDz0Zo5q'),
	(15, 'pkmain', '', '', 0, '', '', '', '$2y$10$PRdlS3E/CiWqZcOnNEhSBeMqC4p7LAnuw8MKZAq7Rz7gwmHT7CxUy'),
	(16, '', '', '', 0, '', '', '', '$2y$10$qaKvWTojprdi/5p2zDhDXu.g4CWFMC2wjamedJxWB1KaOqIsOxOWm'),
	(17, 'asdf', '', '', 0, '', '', '', '$2y$10$Xr0eI00odLzIpD.r//BAgOeMxnmqcxuvCPh9dJxJ0sZIqbQUIibFa'),
	(18, 'asd', '', '', 0, '', '', '', '$2y$10$ylhhK9BSzcFNtTKLh6fsz.BSEu0Rf/qm58cNa.0foY6n3XYopwsnm'),
	(19, 'asdlkasklÂ½kl', '', '', 0, '', '', '', '$2y$10$MI78ZVKWcOFPpJQpqWkKEOjO2TuGGqM.nu.6HiBf..rjD.dSoqXI.'),
	(20, 's', '', '', 0, '', '', '', '$2y$10$BmUct7yY6pphDsqfe7YnlO9SKNFoGDiphOzxzjTVcGsNfSnY1oSee'),
	(21, 'jj', 'Kristian', 'Kinder', 5230, 'Odense M', 'silverleaves13@gmail.com', '29733608', '$2y$10$gdOUWum2Gsk1O6r3E6gJ1eVsNZp6nz5e46tV56H7E/bC/8aSjDSPK'),
	(25, 'sdfdfdf', 'Kristian', 'Kristian', 5230, 'Test', 'Email', '222', 'asd'),
	(26, 'John', 'Kristian', 'Kinder', 5230, 'Odense M', 'silverleaves13@gmail.com', '27933608', '$2y$10$to43JOQey5QjZHP1jmXFLuKHyvTYaGmkd6J6cfa9/adTKzmNO5mn6'),
	(23, 'Kristian', 'Kristian', 'Kinder', 6800, 'Odense M', 'silverleaves13@gmail.com', '27933608', '$2y$10$VLBewNXJQwcSxoeJUiIFBuif4fNdB/w6H6vgNecNO.SFaPKK9f1De'),
	(24, 'blablabla', 'Kristian', 'Kinder', 6800, 'Odense M', 'silverleaves13@gmail.com', '27933608', '$2y$10$gDbsDYl9rDkaakBcRb5Y1.Lx6X6xV.fSCOVx6cN2ieDpkfqlQBVF2'),
	(27, 'Broliver213', 'Oliver', 'Oliver', 5230, 'Odense M', 'silverleaves13@gmail.com', '27933608', '$2y$10$MwJkDjSF2ykQRdI8CtMmEuAL2wEJP02T4IFIkvN7TQKFYhRRrdubO'),
	(28, 'Broliver2132', 'Oliver', 'Oliver', 5230, 'Odense M', 'silverleaves13@gmail.com', '27933608', '$2y$10$LK5AmobVFsH3nU0wmbOt3O39CQQ856QLV2rfFgf5/0xFWTUq/.55q'),
	(29, 'TA', 'ADA', 'dAda', 0, 'aksldkasldk', 'asldklaskdls', 'adksaldkasl', '$2y$10$tOtH154AEirTB9BUnKwTGOoyiBGSg14GRVgjoasOg1a20iXPT5orO'),
	(30, 'd', 'd', 'd', 0, 'd', 'd', 'd', '$2y$10$rhwa9PhOtBvWmGVn9Fzy/.uHezTyGMnUZLhK9buRooz0k5Wo/PBUi');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
