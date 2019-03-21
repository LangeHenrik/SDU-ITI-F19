DROP DATABASE IF EXISTS 'mipou16';
CREATE DATABASE 'mipou16';
USE DATABASE 'mipou16';

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `header` varchar(50) DEFAULT NULL,
  `text` varchar(100) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `images_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=latin1;



 LOCK TABLES `images` WRITE;
INSERT INTO `images` VALUES (140,'grim hund','en rigtig grim hund',13,'images/dog.jpg');
UNLOCK TABLES;



 DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `fname` varchar(20) DEFAULT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `pwd` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;



 LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (13,'mipou16','michael','poulsen','aarslev',5792,'mipou16@student.sdu.dk',12345678,'4E016A27A1DBF3043F402DAB80E59D658B5EAA43');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

 

