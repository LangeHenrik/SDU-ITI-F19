-- --------------------------------------------------------
-- Vært:                         127.0.0.1
-- Server-version:               10.3.14-MariaDB - mariadb.org binary distribution
-- ServerOS:                     Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for rande17
DROP DATABASE IF EXISTS `rande17`;
CREATE DATABASE IF NOT EXISTS `rande17` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `rande17`;

-- Dumping structure for tabel rande17.image
DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `image_id` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `rating` float DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `user` text NOT NULL,
  `imgblob` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.
-- Dumping structure for tabel rande17.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` text NOT NULL,
  `username` text NOT NULL,
  `password` text DEFAULT NULL,
  `salt` text DEFAULT NULL,
  `mail` text NOT NULL,
  `Created` datetime NOT NULL DEFAULT current_timestamp(),
  `active` enum('0','1') NOT NULL DEFAULT '0',
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `phone` text NOT NULL,
  `city` text NOT NULL,
  `zip` text NOT NULL,
  UNIQUE KEY `ID` (`ID`(40)) USING HASH KEY_BLOCK_SIZE=40,
  UNIQUE KEY `name` (`username`(100)) USING HASH KEY_BLOCK_SIZE=40,
  UNIQUE KEY `mail` (`mail`(100)) USING HASH KEY_BLOCK_SIZE=40
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
