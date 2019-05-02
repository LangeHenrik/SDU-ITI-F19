-- MySQL dump 10.13  Distrib 8.0.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: nipet17
-- ------------------------------------------------------
-- Server version	8.0.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `login` (
  `login_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `login_username` varchar(20) NOT NULL,
  `login_email` varchar(200) NOT NULL,
  `login_name` varchar(200) NOT NULL,
  `login_password` varchar(30) NOT NULL,
  `login_phone` int(10) unsigned NOT NULL,
  `login_zip` int(10) unsigned NOT NULL,
  `login_city` varchar(100) NOT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,'admin','admin@admin.com','admin admin','password',12345678,5230,'Odense M'),(2,'NP.Breje','NP.Breje@gmail.com','Nicklas Petersen','password',30829701,5230,'Odense M'),(3,'Anden','and.anders@andeby.dk','Anders And','anden123',24321245,1111,'Andeby'),(4,'Leasy.peter','peter@leasy.dk','Leasy Peter','kommerikketiltiden',88888888,5000,'Odense C'),(5,'BH','BH@email.com','Bo Hansen','',45464748,6261,'Bredebro'),(6,'Nicklas','Nicklas@email.com','Nicklas Petersen','password',30829701,5230,'Odense M'),(7,'Nicklas2','NP.Breje@gmail.com','Nicklas Petersen','password',30829701,5230,'Odense M'),(8,'Nicklas3','NP.Breje@gmail.com','Nicklas Petersen','password',30829701,5230,'Odense M'),(9,'PiaK','pikj@df.dk','Pia Kjaersgaard','Danmark123',12345678,2860,'Søborg'),(10,'','np.breje@gmail.com','Nicklas Petersen','',30829701,6261,'Bredebro');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `photo` (
  `photo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `photo_image` varchar(200) DEFAULT NULL,
  `photo_text` text,
  `photo_header` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`photo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photo`
--

LOCK TABLES `photo` WRITE;
/*!40000 ALTER TABLE `photo` DISABLE KEYS */;
INSERT INTO `photo` VALUES (1,'SDU.PNG','This is the SDU logo!','SDU'),(2,'bilag sharpen.PNG','This is a picture of \"sharpen\"','Sharpen'),(3,'Screenshot (70).png','This is a screenshot of the webpage!','Screenshot');
/*!40000 ALTER TABLE `photo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-22 18:16:09
