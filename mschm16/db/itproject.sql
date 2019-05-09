-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Vært: 127.0.0.1
-- Genereringstid: 09. 05 2019 kl. 13:55:19
-- Serverversion: 5.6.17
-- PHP-version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `itproject`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `postId` int(4) NOT NULL AUTO_INCREMENT,
  `postName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `postImg` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `postText` text COLLATE utf8_unicode_ci NOT NULL,
  `fk_userId` int(4) NOT NULL,
  PRIMARY KEY (`postId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Data dump for tabellen `posts`
--

INSERT INTO `posts` (`postId`, `postName`, `postImg`, `postText`, `fk_userId`) VALUES
(1, 'My first post', 'cw.jpg', 'This is my first post that contains a chaos knight', 1),
(5, 'Ajax pic code', '0f8b2870896edcde8f6149fe2733faaf.jpg', 'code stuff', 1),
(3, 'Colors', 'colors.jpg', 'Color desc', 2),
(6, 'TestMoon', 'moon.png', 'Moon ', 1),
(7, 'Starboi', 'star.png', 'Starboi desc ', 1),
(8, 'Messi', 'messirooz.png', 'fc barcelona player ', 4);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(4) NOT NULL AUTO_INCREMENT,
  `userName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userFirst` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userLast` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userPass` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userMail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userPhone` int(10) NOT NULL,
  `userZip` int(5) NOT NULL,
  `userCity` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`userId`, `userName`, `userFirst`, `userLast`, `userPass`, `userMail`, `userPhone`, `userZip`, `userCity`) VALUES
(1, 'Obarok', 'Mikkel', 'Schmøde', '1234', 'mikkel@mail.com', 60775361, 5200, 'Odense V'),
(2, 'Omhaw', 'Omar', 'Hawai', '11', 'omar@mail.dk', 55772361, 4000, 'Roskilde'),
(3, 'Habil', 'Hanna', 'Billbord', '12345', 'hanna@mail.dk', 55776688, 4700, 'NÃ¦stved'),
(4, 'Obaarok', 'Mikkeel', 'Schmooede', '12345678', 'mymail@mail.com', 60775362, 5200, 'Odense VV');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
