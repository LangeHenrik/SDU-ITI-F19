DROP DATABASE IF EXISTS `jonasr16`;
CREATE DATABASE `jonasr16`;
USE `jonasr16`;

CREATE TABLE IF NOT EXISTS `images` (
  `username` varchar(500) NOT NULL,
  `path` varchar(500) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `images` (`username`, `path`, `title`, `description`, `id`) VALUES
	('a', 'uploads/banan-maskeraddrakt-4.jpg', 'Title', 'Description', 1),
	('a', 'uploads/kachowder.png', 'Unholy image', 'dont look', 2),
	('a', 'uploads/banan-maskeraddrakt-4.jpg', 'Another one', 'Hi', 3),
	('a', 'uploads/banan-g8gyLJqB58u745T3TWUuMg.jpg', 'Banan', 'just a bananananana', 4),
	('BananaLover21', 'uploads/bananaDestroyed.jpg', 'i destroyed my banana', 'Vuong', 5),
	('BananaHater41', 'uploads/hotdog.jpg', 'Not a banana', 'dunno', 6);

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `firstname` varchar(500) NOT NULL,
  `lastname` varchar(500) NOT NULL,
  `zip` varchar(500) NOT NULL,
  `city` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `phonenumber` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`username`, `password`, `firstname`, `lastname`, `zip`, `city`, `email`, `phonenumber`) VALUES
	('a', '$2y$10$joKPh/cgxphfyelyFBW96.etLHkYoRklpsCsN2g89mgMq4yaKwAfG', 'c', 'd', 'e', 'f', 'g', 'h'),
	('aa', '$2y$10$ufT5xr3AzSDffpxvtuNCOO.Oxhq61vxYi86eEmc7Nfz1Evbi6aiO.', 'c', 'd', 'e', 'f', 'g', 'h'),
	('ab', '$2y$10$Uw2yZZVQJ8ZY/nzSCGh1ROikcUQbdrdohYse440zNXndhIn5yQuS2', 'b', 'b', 'b', 'b', 'b', 'b'),
	('ac', '$2y$10$E/HfiDKN/M/75jCH3.Dvqe8iZ3YfwehTDXaF39MKzu9a/vY5RQgUS', 'a', 'a', 'a', 'a', 'a', 'a'),
	('BananaLover21', '$2y$10$bRM7FuMq7t2las5GMrasCeLHv2dPUmSQYl5AgIkoBl4aJtm./jkYC', 'Big', 'Chungus', '6969', 'England', 'xX_KiddySlayer420_Xx', 'NaN'),
	('BananaHater41', '$2y$10$ybAeiYQQ7GF0PE1FTTKoh.WByYBMHc9OMKiWO0GdLcshr0S4dlXeS', 'John', 'Snow', '5001', 'Sverige', 'lul no', '911');
