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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table spacebook.comments: 0 rows
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `text`, `image_id`, `user_id`) VALUES
	(1, 'bla', 34, 8),
	(2, 'Yee', 34, 8),
	(14, 'This is a comment\r\n', 49, 8),
	(11, 'Yo!', 34, 8);
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
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

-- Dumping data for table spacebook.images: 0 rows
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` (`id`, `image_path`, `title`, `description`, `user_id`, `date`) VALUES
	(49, 'user_images\\MeRKm.jpg', 'Cat 2', 'The cat (Felis catus) is a small carnivorous mammal.[1][2] It is the only domesticated species in the family Felidae and often referred to as the domestic cat to distinguish it from wild members of the family.[4] The cat is either a house cat, kept as a pet, or a feral cat, freely ranging and avoiding human contact.[5] A house cat is valued by humans for companionship and for its ability to hunt rodents. About 60 cat breeds are recognized by various cat registries.[6]\r\n\r\nCats are similar in anatomy to the other felid species, with a strong flexible body, quick reflexes, sharp teeth and retractable claws adapted to killing small prey. They are predators who are most active at dawn and dusk (crepuscular). Cats can hear sounds too faint or too high in frequency for human ears, such as those made by mice and other small animals. Compared to humans, they see better in the dark (they see in near total darkness) and have a better sense of smell, but poorer color vision. Cats, despite being solitary hunters, are a social species. Cat communication includes the use of vocalizations including mewing, purring, trilling, hissing, growling and grunting as well as cat-specific body language.[7] Cats also communicate by secreting and perceiving pheromones.\r\n\r\nFemale domestic cats can have kittens from spring to late autumn, with litter sizes ranging from two to five kittens.[8] Domestic cats can be bred and shown as registered pedigreed cats, a hobby known as cat fancy. Failure to control the breeding of pet cats by spaying and neutering, as well as abandonment of pets, has resulted in large numbers of feral cats worldwide, contributing to the extinction of entire bird species, and evoking population control.[9]\r\n\r\nIt was long thought that cat domestication was initiated in Egypt, because cats in ancient Egypt were venerated since around 3100 BC.[10][11] However, the earliest indication for the taming of an African wildcat (F. lybica) was found in Cyprus, where a cat skeleton was excavated close by a human Neolithic grave dating to around 7500 BC.[12] African wildcats were probably first domesticated in the Near East.[13] The leopard cat (Prionailurus bengalensis) was tamed independently in China around 5500 BC, though this line of partially domesticated cats leaves no trace in the domestic cat populations of today.[14][15]', 8, '2019-03-22 12:46:51'),
	(48, 'user_images\\1RoAc.jpg', 'cat', 'The cat (Felis catus) is a small carnivorous mammal.[1][2] It is the only domesticated species in the family Felidae and often referred to as the domestic cat to distinguish it from wild members of the family.[4] The cat is either a house cat, kept as a pet, or a feral cat, freely ranging and avoiding human contact.[5] A house cat is valued by humans for companionship and for its ability to hunt rodents. About 60 cat breeds are recognized by various cat registries.[6]\r\n\r\nCats are similar in anatomy to the other felid species, with a strong flexible body, quick reflexes, sharp teeth and retractable claws adapted to killing small prey. They are predators who are most active at dawn and dusk (crepuscular). Cats can hear sounds too faint or too high in frequency for human ears, such as those made by mice and other small animals. Compared to humans, they see better in the dark (they see in near total darkness) and have a better sense of smell, but poorer color vision. Cats, despite being solitary hunters, are a social species. Cat communication includes the use of vocalizations including mewing, purring, trilling, hissing, growling and grunting as well as cat-specific body language.[7] Cats also communicate by secreting and perceiving pheromones.\r\n\r\nFemale domestic cats can have kittens from spring to late autumn, with litter sizes ranging from two to five kittens.[8] Domestic cats can be bred and shown as registered pedigreed cats, a hobby known as cat fancy. Failure to control the breeding of pet cats by spaying and neutering, as well as abandonment of pets, has resulted in large numbers of feral cats worldwide, contributing to the extinction of entire bird species, and evoking population control.[9]\r\n\r\nIt was long thought that cat domestication was initiated in Egypt, because cats in ancient Egypt were venerated since around 3100 BC.[10][11] However, the earliest indication for the taming of an African wildcat (F. lybica) was found in Cyprus, where a cat skeleton was excavated close by a human Neolithic grave dating to around 7500 BC.[12] African wildcats were probably first domesticated in the Near East.[13] The leopard cat (Prionailurus bengalensis) was tamed independently in China around 5500 BC, though this line of partially domesticated cats leaves no trace in the domestic cat populations of today.[14][15]', 8, '2019-03-22 12:45:56'),
	(34, 'user_images\\pxYHE.jpg', 'Test', 'Bla bla bla...', 8, '2019-03-22 08:49:31'),
	(50, 'user_images\\eE9HD.jpg', 'Spacy cats', 'The cat (Felis catus) is a small carnivorous mammal.[1][2] It is the only domesticated species in the family Felidae and often referred to as the domestic cat to distinguish it from wild members of the family.[4] The cat is either a house cat, kept as a pet, or a feral cat, freely ranging and avoiding human contact.[5] A house cat is valued by humans for companionship and for its ability to hunt rodents. About 60 cat breeds are recognized by various cat registries.[6]\r\n\r\nCats are similar in anatomy to the other felid species, with a strong flexible body, quick reflexes, sharp teeth and retractable claws adapted to killing small prey. They are predators who are most active at dawn and dusk (crepuscular). Cats can hear sounds too faint or too high in frequency for human ears, such as those made by mice and other small animals. Compared to humans, they see better in the dark (they see in near total darkness) and have a better sense of smell, but poorer color vision. Cats, despite being solitary hunters, are a social species. Cat communication includes the use of vocalizations including mewing, purring, trilling, hissing, growling and grunting as well as cat-specific body language.[7] Cats also communicate by secreting and perceiving pheromones.\r\n\r\nFemale domestic cats can have kittens from spring to late autumn, with litter sizes ranging from two to five kittens.[8] Domestic cats can be bred and shown as registered pedigreed cats, a hobby known as cat fancy. Failure to control the breeding of pet cats by spaying and neutering, as well as abandonment of pets, has resulted in large numbers of feral cats worldwide, contributing to the extinction of entire bird species, and evoking population control.[9]\r\n\r\nIt was long thought that cat domestication was initiated in Egypt, because cats in ancient Egypt were venerated since around 3100 BC.[10][11] However, the earliest indication for the taming of an African wildcat (F. lybica) was found in Cyprus, where a cat skeleton was excavated close by a human Neolithic grave dating to around 7500 BC.[12] African wildcats were probably first domesticated in the Near East.[13] The leopard cat (Prionailurus bengalensis) was tamed independently in China around 5500 BC, though this line of partially domesticated cats leaves no trace in the domestic cat populations of today.[14][15]', 8, '2019-03-22 12:47:01'),
	(51, 'user_images\\FuyOU.jpg', 'Cattt', 'The cat (Felis catus) is a small carnivorous mammal.[1][2] It is the only domesticated species in the family Felidae and often referred to as the domestic cat to distinguish it from wild members of the family.[4] The cat is either a house cat, kept as a pet, or a feral cat, freely ranging and avoiding human contact.[5] A house cat is valued by humans for companionship and for its ability to hunt rodents. About 60 cat breeds are recognized by various cat registries.[6]\r\n\r\nCats are similar in anatomy to the other felid species, with a strong flexible body, quick reflexes, sharp teeth and retractable claws adapted to killing small prey. They are predators who are most active at dawn and dusk (crepuscular). Cats can hear sounds too faint or too high in frequency for human ears, such as those made by mice and other small animals. Compared to humans, they see better in the dark (they see in near total darkness) and have a better sense of smell, but poorer color vision. Cats, despite being solitary hunters, are a social species. Cat communication includes the use of vocalizations including mewing, purring, trilling, hissing, growling and grunting as well as cat-specific body language.[7] Cats also communicate by secreting and perceiving pheromones.\r\n\r\nFemale domestic cats can have kittens from spring to late autumn, with litter sizes ranging from two to five kittens.[8] Domestic cats can be bred and shown as registered pedigreed cats, a hobby known as cat fancy. Failure to control the breeding of pet cats by spaying and neutering, as well as abandonment of pets, has resulted in large numbers of feral cats worldwide, contributing to the extinction of entire bird species, and evoking population control.[9]\r\n\r\nIt was long thought that cat domestication was initiated in Egypt, because cats in ancient Egypt were venerated since around 3100 BC.[10][11] However, the earliest indication for the taming of an African wildcat (F. lybica) was found in Cyprus, where a cat skeleton was excavated close by a human Neolithic grave dating to around 7500 BC.[12] African wildcats were probably first domesticated in the Near East.[13] The leopard cat (Prionailurus bengalensis) was tamed independently in China around 5500 BC, though this line of partially domesticated cats leaves no trace in the domestic cat populations of today.[14][15]', 8, '2019-03-22 12:47:10'),
	(52, 'user_images\\aWDQX.jpg', 'Damn a cat', 'The cat (Felis catus) is a small carnivorous mammal.[1][2] It is the only domesticated species in the family Felidae and often referred to as the domestic cat to distinguish it from wild members of the family.[4] The cat is either a house cat, kept as a pet, or a feral cat, freely ranging and avoiding human contact.[5] A house cat is valued by humans for companionship and for its ability to hunt rodents. About 60 cat breeds are recognized by various cat registries.[6]\r\n\r\nCats are similar in anatomy to the other felid species, with a strong flexible body, quick reflexes, sharp teeth and retractable claws adapted to killing small prey. They are predators who are most active at dawn and dusk (crepuscular). Cats can hear sounds too faint or too high in frequency for human ears, such as those made by mice and other small animals. Compared to humans, they see better in the dark (they see in near total darkness) and have a better sense of smell, but poorer color vision. Cats, despite being solitary hunters, are a social species. Cat communication includes the use of vocalizations including mewing, purring, trilling, hissing, growling and grunting as well as cat-specific body language.[7] Cats also communicate by secreting and perceiving pheromones.\r\n\r\nFemale domestic cats can have kittens from spring to late autumn, with litter sizes ranging from two to five kittens.[8] Domestic cats can be bred and shown as registered pedigreed cats, a hobby known as cat fancy. Failure to control the breeding of pet cats by spaying and neutering, as well as abandonment of pets, has resulted in large numbers of feral cats worldwide, contributing to the extinction of entire bird species, and evoking population control.[9]\r\n\r\nIt was long thought that cat domestication was initiated in Egypt, because cats in ancient Egypt were venerated since around 3100 BC.[10][11] However, the earliest indication for the taming of an African wildcat (F. lybica) was found in Cyprus, where a cat skeleton was excavated close by a human Neolithic grave dating to around 7500 BC.[12] African wildcats were probably first domesticated in the Near East.[13] The leopard cat (Prionailurus bengalensis) was tamed independently in China around 5500 BC, though this line of partially domesticated cats leaves no trace in the domestic cat populations of today.[14][15]', 8, '2019-03-22 12:47:21'),
	(53, 'user_images\\zcuub.jpg', 'Hello catness', 'The cat (Felis catus) is a small carnivorous mammal.[1][2] It is the only domesticated species in the family Felidae and often referred to as the domestic cat to distinguish it from wild members of the family.[4] The cat is either a house cat, kept as a pet, or a feral cat, freely ranging and avoiding human contact.[5] A house cat is valued by humans for companionship and for its ability to hunt rodents. About 60 cat breeds are recognized by various cat registries.[6]\r\n\r\nCats are similar in anatomy to the other felid species, with a strong flexible body, quick reflexes, sharp teeth and retractable claws adapted to killing small prey. They are predators who are most active at dawn and dusk (crepuscular). Cats can hear sounds too faint or too high in frequency for human ears, such as those made by mice and other small animals. Compared to humans, they see better in the dark (they see in near total darkness) and have a better sense of smell, but poorer color vision. Cats, despite being solitary hunters, are a social species. Cat communication includes the use of vocalizations including mewing, purring, trilling, hissing, growling and grunting as well as cat-specific body language.[7] Cats also communicate by secreting and perceiving pheromones.\r\n\r\nFemale domestic cats can have kittens from spring to late autumn, with litter sizes ranging from two to five kittens.[8] Domestic cats can be bred and shown as registered pedigreed cats, a hobby known as cat fancy. Failure to control the breeding of pet cats by spaying and neutering, as well as abandonment of pets, has resulted in large numbers of feral cats worldwide, contributing to the extinction of entire bird species, and evoking population control.[9]\r\n\r\nIt was long thought that cat domestication was initiated in Egypt, because cats in ancient Egypt were venerated since around 3100 BC.[10][11] However, the earliest indication for the taming of an African wildcat (F. lybica) was found in Cyprus, where a cat skeleton was excavated close by a human Neolithic grave dating to around 7500 BC.[12] African wildcats were probably first domesticated in the Near East.[13] The leopard cat (Prionailurus bengalensis) was tamed independently in China around 5500 BC, though this line of partially domesticated cats leaves no trace in the domestic cat populations of today.[14][15]', 8, '2019-03-22 12:47:38');
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
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Dumping data for table spacebook.users: 14 rows
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
	(23, 'Kristian', 'Kristian', 'Kinder', 6800, 'Odense M', 'silverleaves13@gmail.com', '27933608', '$2y$10$VLBewNXJQwcSxoeJUiIFBuif4fNdB/w6H6vgNecNO.SFaPKK9f1De'),
	(24, 'blablabla', 'Kristian', 'Kinder', 6800, 'Odense M', 'silverleaves13@gmail.com', '27933608', '$2y$10$gDbsDYl9rDkaakBcRb5Y1.Lx6X6xV.fSCOVx6cN2ieDpkfqlQBVF2');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
