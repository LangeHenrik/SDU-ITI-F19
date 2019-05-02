-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 02. 05 2019 kl. 10:16:14
-- Serverversion: 10.1.38-MariaDB
-- PHP-version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mipou16`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `images`
--

CREATE TABLE `images` (
  `id` int(100) NOT NULL,
  `userid` int(11) NOT NULL,
  `imagepath` longtext NOT NULL,
  `headertext` longtext,
  `imagetext` longtext,
  `likeS` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Data dump for tabellen `images`
--

INSERT INTO `images` (`id`, `userid`, `imagepath`, `headertext`, `imagetext`, `likeS`) VALUES
(10, 1, '../View/upload/download.jpg', 'groudhog day', 'test1', 3),
(11, 1, '../View/upload/download1.jpg', 'dice', 'test2', 2),
(12, 1, '../View/upload/download2.jpg', 'hover cat', 'test3', 1),
(13, 2, '../View/upload/download3.jpg', 'WTF', 'test4', 0),
(14, 3, '../View/upload/download4.jpg', 'fat cat', 'test5', 3);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

CREATE TABLE `users` (
  `uuid` int(100) NOT NULL,
  `username` longtext NOT NULL,
  `password` longtext NOT NULL,
  `firstname` longtext,
  `lastname` longtext,
  `zip` longtext,
  `city` longtext,
  `email` longtext,
  `phone` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`uuid`, `username`, `password`, `firstname`, `lastname`, `zip`, `city`, `email`, `phone`) VALUES
(1, 'mipou', '$2y$10$PIf8pJr/A7vnBxaLrsHx/ex0XKByoIumAqYFOpHAhRAOzLtQktNbe', 'michael', 'poulsen', '5792', 'årslev', 'mipou16@student.sdu.dk', '12345678'),
(2, 'kongen', '$2y$10$teTp.AaiBNW9dQCePVEkreD1SUl6XsJuvFN5921xugGQr5b4NOlg.', 'hr.', 'konge', '1234', 'kongstrup', 'kongen@kongemail.com', '88888888'),
(3, 'test3', '$2y$10$sWwGHg8Yf8XcU6PPbIBm4ebqJqohbG/uSZwgEJu/rDrwcoju.Pghy', 'test3', 'test3', '4563', 'testkøbing', 'test1@test1.com', '99887744');

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indeks for tabel `users`
--
ALTER TABLE `users`
  ADD KEY `uuid` (`uuid`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `images`
--
ALTER TABLE `images`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tilføj AUTO_INCREMENT i tabel `users`
--
ALTER TABLE `users`
  MODIFY `uuid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Begrænsninger for dumpede tabeller
--

--
-- Begrænsninger for tabel `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`uuid`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
