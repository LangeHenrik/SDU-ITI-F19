-- MariaDB dump 10.17  Distrib 10.4.2-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: assignment1
-- ------------------------------------------------------
-- Server version	10.4.2-MariaDB-1:10.4.2+maria~bionic

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `assignment1`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `assignment1` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `assignment1`;

--
-- Table structure for table `Images`
--

DROP TABLE IF EXISTS `Images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Images` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(30) NOT NULL,
  `user` varchar(31) NOT NULL,
  `header` varchar(50) DEFAULT NULL,
  `text` longtext DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Images`
--

LOCK TABLES `Images` WRITE;
/*!40000 ALTER TABLE `Images` DISABLE KEYS */;
INSERT INTO `Images` VALUES (2,'vpl3o8zxxMVg.jpg','foobar','Sunrise','An early morning sunrise in Kiruna after a long bus ride.','2019-03-14 13:18:53'),(3,'Ho5QZpk4esKF.jpg','foobar','Iglo','Welcome Iglo in Kiruna','2019-03-14 13:20:56'),(4,'13K20aB8ypj5.JPG','testuser1','Long Exposure','Long Exposure Photography of a Street','2019-03-22 07:54:40');
/*!40000 ALTER TABLE `Images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(31) NOT NULL,
  `password` varchar(128) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `city` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'jack','$2y$10$Z0lyhhy4.fd2as0PAzYAiu6eQibnP78fruWaKNuiB1xjj7bI36xny','','','','','',''),(3,'foobar','$2y$10$fWfiBTwYB.5nhONvQmdDbOGuw8ZSOh1xzMTsC6GQ3Kk.YxkNrbfRK','foo','bar','12345','Atlantis','foobar@example.com','1234567890'),(4,'testuser1','$2y$10$h6ZMkqj0mz3ep8Kmq5kwouetkxDJ9ExZecaeOIVdu0RXRtF3bwrvO','Test1','User','1234','Someplace','testuser1@example.com','+123456789');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-22  7:58:23
