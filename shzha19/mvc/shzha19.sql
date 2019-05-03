-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2019-05-03 07:31:56
-- 服务器版本： 5.7.24
-- PHP 版本： 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `shzha19`
--

-- --------------------------------------------------------

--
-- 表的结构 `postview`
--

DROP TABLE IF EXISTS `postview`;
CREATE TABLE IF NOT EXISTS `postview` (
  `image_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `postview`
--

INSERT INTO `postview` (`image_id`, `username`, `title`, `description`, `image`) VALUES
(47, 'Zelda', 'dog', '2', '/shzha19/mvc/public/pictures/1556816713.jpeg'),
(48, 'Emma', 'I\'m Emma', 'hi', '/shzha19/mvc/public/pictures/1556816907.jpeg'),
(52, 'Shu', 'Mr. Bean', 'Beanscription', '/shzha19/mvc/public/pictures/1556868207.jpeg'),
(51, 'Shu', 'Mr. Bean', 'Beanscription', '/shzha19/mvc/public/pictures/1556866906.jpeg'),
(46, 'Zelda', 'The history of dogs as pets', 'dogs', '/shzha19/mvc/public/pictures/1556816540.jpeg'),
(45, 'Shu', 'flower', 'rose', '/shzha19/mvc/public/pictures/1556816162.jpeg');

-- --------------------------------------------------------

--
-- 表的结构 `usersinfo`
--

DROP TABLE IF EXISTS `usersinfo`;
CREATE TABLE IF NOT EXISTS `usersinfo` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `usersinfo`
--

INSERT INTO `usersinfo` (`user_id`, `username`, `password`, `firstname`, `lastname`, `zip`, `city`, `email`, `phone`, `photo`) VALUES
(52, 'Shu', '96e79218965eb72c92a549dd5a330112', 'a', 'b', '123', 'odense', 'shu@test.com', '12345', '/shzha19/mvc/public/photos/1556815957.jpeg'),
(55, 'Emma', '96e79218965eb72c92a549dd5a330112', '1', '1', '1', '1', 'emma@test.com', '12345', '/shzha19/mvc/public/photos/1556816871.jpeg'),
(53, 'Zelda', '96e79218965eb72c92a549dd5a330112', 'a', 'b', '123', 'Odense', 'zelda@test.com', '12345', '/shzha19/mvc/public/photos/default.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
