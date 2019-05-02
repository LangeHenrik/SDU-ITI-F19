-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 22. 03 2019 kl. 11:38:42
-- Serverversion: 10.1.38-MariaDB
-- PHP-version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `it_loginsystem`
--
CREATE DATABASE IF NOT EXISTS `it_loginsystem` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `it_loginsystem`;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `gallery`
--

CREATE TABLE `gallery` (
  `idGallery` int(11) NOT NULL,
  `idUsers` int(11) NOT NULL,
  `titleGallery` longtext NOT NULL,
  `descGallery` longtext NOT NULL,
  `imageNameGallery` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `gallery`
--

INSERT INTO `gallery` (`idGallery`, `idUsers`, `titleGallery`, `descGallery`, `imageNameGallery`) VALUES
(18, 2, 'Boston City', 'Picture of Boston City', 'Boston City.5c93d5d6e9e1f.jpg'),
(23, 18, 'Costa Rican Frog', 'This a frog from Costa Rica', 'Costa Rican Frog.5c94add772444.jpg'),
(24, 23, 'Pensive Parakeet', 'Watch my Parakeet playing chess', 'Pensive Parakeet.5c94ae0e20237.jpg'),
(25, 2, 'Rainbow', 'Just a simple spectrum', 'Rainbow.5c94aedac011b.png'),
(26, 2, 'Obama Avatar', 'Barak Obama as an Avatar', 'Obama Avatar.5c94af26831d3.jpg'),
(27, 23, 'Virus', 'Green virus', 'Virus.5c94b58b3b444.jpg'),
(28, 23, 'Brick Wall', 'Just a wall of bricks!', 'Brick Wall.5c94b5c8e78fb.jpg'),
(29, 23, 'Coffee', 'A cup of coffee on beans', 'Coffee.5c94b63461493.jpg'),
(30, 23, 'Rope', 'A sample of rope lightly crocheted', 'Rope.5c94b6b6c202a.jpg'),
(31, 2, 'Leaves', 'An arrangement of red autumn leaves', 'Leaves.5c94b718ea387.jpg'),
(32, 2, 'Nature Wallpaper', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eleifend odio id pellentesque consequat. Etiam rutrum blandit sagittis. Suspendisse at felis vel neque molestie luctus. Aenean non vehicula justo, id finibus ex. Donec fermentum vitae est quis tincidunt. Duis a orci gravida, sodales leo ac, ornare diam. Duis ac imperdiet risus, eleifend fringilla nisi. Cras vestibulum, velit ut rhoncus euismod, mi ex pulvinar est, sed dictum risus tortor eget tellus. Suspendisse a posuere nisl, vel tincidunt mauris. Integer maximus justo et nulla venenatis, eget sodales lorem mattis.', 'Nature Wallpaper.5c94b766486dc.jpg');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `uidUsers` tinytext NOT NULL,
  `emailUsers` tinytext NOT NULL,
  `pwdUsers` longtext NOT NULL,
  `firstNameUsers` tinytext NOT NULL,
  `lastNameUsers` tinytext NOT NULL,
  `zipCodeUsers` int(11) NOT NULL,
  `cityUsers` tinytext NOT NULL,
  `phoneUsers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`idUsers`, `uidUsers`, `emailUsers`, `pwdUsers`, `firstNameUsers`, `lastNameUsers`, `zipCodeUsers`, `cityUsers`, `phoneUsers`) VALUES
(2, 'sabah15', 'sabah15@student.sdu.dk', '$2y$10$29gFMhPTJh9N6KahEP7iqOnbjovh/WBrftqqoW90/zvtW8oAN4iHu', 'Sam', 'Bahadori', 5220, 'Odense', 12345678),
(3, 'pandaridder', 'krije14@student.sdu.dk', '$2y$10$goI0eUqNApQIyoqD8E9PmeZdb84L71ww3.HP.B8vaRto64.dq.lRC', 'Kris', 'Jensen', 5250, 'Odense', 26367324),
(18, 'Nicolowich', 'nico1591@live.dk', '$2y$10$kkneeAQkQ4Uai02MizbCeemaz0LVCXzzR7a919lTPqeBLR0qeC7e2', 'Nicole', 'Ghasemi', 5220, 'Odense', 52402272),
(23, 'test', 'test@test.test', '$2y$10$3X4QlFx4y97dxMKYVDE1ceQxSDjNdS3d78oZT.yA.aRP4k3qnjB0e', 'test', 'test', 1234, 'test', 12345678);

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`idGallery`),
  ADD KEY `idUsers` (`idUsers`);

--
-- Indeks for tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `gallery`
--
ALTER TABLE `gallery`
  MODIFY `idGallery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Tilføj AUTO_INCREMENT i tabel `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Begrænsninger for dumpede tabeller
--

--
-- Begrænsninger for tabel `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`idUsers`) REFERENCES `users` (`idUsers`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
