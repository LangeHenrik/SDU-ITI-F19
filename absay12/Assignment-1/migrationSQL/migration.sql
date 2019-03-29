-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 29. 03 2019 kl. 03:26:06
-- Serverversion: 10.1.38-MariaDB
-- PHP-version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absay12`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `person`
--

CREATE TABLE `person` (
  `person_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `front_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `city` varchar(30) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `email_adress` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `person`
--

INSERT INTO `person` (`person_id`, `user_name`, `password`, `front_name`, `last_name`, `zip_code`, `city`, `phone_number`, `email_adress`) VALUES
(9, 'absay12', '123', 'Abdi', 'ali', 5230, 'Odense M', '50505050', 'humorlinkd@gmail.com'),
(10, 'test', 'test', 'test', 'test', 3000, 'odense', '20202020', 'test@gmail.com'),
(18, 'Testingtesting12', 'Abdirashid12', 'Abdirashid', 'Ali', 5000, 'odense', '+4520202020', 'testing@gmail.com');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `picture`
--

CREATE TABLE `picture` (
  `picture_id` int(11) NOT NULL,
  `person` varchar(30) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `picture_file` varchar(100) NOT NULL,
  `date_uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `picture`
--

INSERT INTO `picture` (`picture_id`, `person`, `title`, `description`, `picture_file`, `date_uploaded`) VALUES
(1, 'test', 'sadfsadf', 'asdfasdf', 'c950e81ba53e93336014d01aad85992a7437a9b2.jpg', '2019-03-29 00:41:16'),
(2, 'test', 'hello', 'here is some description', '04e5d882b5853fafeb11f8067db4a959e412373c.jpg', '2019-03-29 01:06:15'),
(3, 'test', 'One last test', 'One last testvOne last testOne last testOne last test\r\nOne last testOne last testOne last test', '9f79776491a3ea60a7e2948bf294fdccd8f2648b.png', '2019-03-29 01:06:55');

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`user_name`),
  ADD UNIQUE KEY `person_id` (`person_id`);

--
-- Indeks for tabel `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`picture_id`,`person`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `person`
--
ALTER TABLE `person`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Tilføj AUTO_INCREMENT i tabel `picture`
--
ALTER TABLE `picture`
  MODIFY `picture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
