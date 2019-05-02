DROP DATABASE IF EXISTS `it_assignment_2`;
CREATE DATABASE IF NOT EXISTS `it_assignment_2`;
USE `it_assignment_2`;

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(16) COLLATE latin1_danish_ci NOT NULL,
  `password_hash` char(255) COLLATE latin1_danish_ci NOT NULL,
  `firstname` char(32) COLLATE latin1_danish_ci NOT NULL,
  `lastname` char(32) COLLATE latin1_danish_ci NOT NULL,
  `zip` char(8) COLLATE latin1_danish_ci DEFAULT NULL,
  `city` char(32) COLLATE latin1_danish_ci DEFAULT NULL,
  `email` char(64) COLLATE latin1_danish_ci DEFAULT NULL,
  `number` char(30) COLLATE latin1_danish_ci DEFAULT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_danish_ci;

DROP TABLE IF EXISTS `picture`;
CREATE TABLE IF NOT EXISTS `picture` (
  `picid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `picture` blob NOT NULL,
  `user` char(16) COLLATE latin1_danish_ci NOT NULL,
  `header` varchar(50) COLLATE latin1_danish_ci NOT NULL,
  `description` varchar(200) COLLATE latin1_danish_ci DEFAULT NULL,
  PRIMARY KEY (`picid`),
  KEY `FK_picture_user` (`user`),
  CONSTRAINT `FK_picture_user` FOREIGN KEY (`user`) REFERENCES `user` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_danish_ci;

INSERT INTO user(username, password_hash, firstname, lastname, zip, city, email, number)
	VALUES('niko6116', '$10$3zKjdy3VDipWsoqSZbUDAOlGwWYgAxXaAdJfN9A5WdVKzKivqx.ym', 'Nikolaj', 'Filipsen', '5000', 'Odense', 'test@gmail.com', '00000000');

