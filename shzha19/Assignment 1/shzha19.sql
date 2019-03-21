-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2019-03-21 15:47:06
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
-- 表的结构 `msgview`
--

DROP TABLE IF EXISTS `msgview`;
CREATE TABLE IF NOT EXISTS `msgview` (
  `MsgID` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `MsgHeader` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MsgContent` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MsgID`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `msgview`
--

INSERT INTO `msgview` (`MsgID`, `username`, `MsgHeader`, `MsgContent`, `picture`) VALUES
(18, 'Oskar', 'Header', 'Toothless', '/ass/pictures/1553182933.jpeg'),
(15, 'Zelda', 'Header', 'The official home for The Legend of Zelda', '/ass/pictures/1553182368.jpeg'),
(16, 'Oskar', 'Header', 'How to train your dragon', '/ass/pictures/1553182678.jpeg'),
(13, 'Emma', 'Header', 'Beautiful cat!', '/ass/pictures/1553181561.jpeg'),
(14, 'Zelda', 'Header', 'The legend of Zelda', '/ass/pictures/1553182252.jpeg');

-- --------------------------------------------------------

--
-- 表的结构 `usersinfo`
--

DROP TABLE IF EXISTS `usersinfo`;
CREATE TABLE IF NOT EXISTS `usersinfo` (
  `usersID` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`usersID`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `usersinfo`
--

INSERT INTO `usersinfo` (`usersID`, `username`, `password`, `firstname`, `lastname`, `zip`, `city`, `email`, `phone`, `photo`) VALUES
(45, 'Emma', '96e79218965eb72c92a549dd5a330112', 'a', 'b', '123', 'Odense', 'emma@test.com', '12345', '/ass/photos/default.jpg'),
(46, 'Zelda', '96e79218965eb72c92a549dd5a330112', 'a', 'b', '123', 'Tokyo', 'zelda@test.com', '12345', '/ass/photos/1553182106.jpeg'),
(47, 'Oskar', '96e79218965eb72c92a549dd5a330112', 'a', 'a', '123', 'Odense', 'oskar@test.com', '12345', '/ass/photos/1553182636.jpeg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
