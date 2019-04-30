-- MySQL dump 10.16  Distrib 10.1.34-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: rande17
-- ------------------------------------------------------
-- Server version	10.1.34-MariaDB-0ubuntu0.18.04.1

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
-- Current Database: `rande17`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `rande17` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `rande17`;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image` (
  `image_id` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `rating` float NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES ('63611b47-0755-4d5a-8071-8a3d0102568a.jpg','sdasd','dasd',0,'2019-03-20 10:03:57','121b42a6-9434-4f12-b968-3f395fce838e'),('acd967e3-1352-4b36-a7c5-a1254db064a2.jpg','cxzcz','cxzczxc',0,'2019-03-20 10:04:17','121b42a6-9434-4f12-b968-3f395fce838e'),('79d54b36-9830-440e-b82f-fcd310533cb3.jpg','gvzxcv','VCZXVCZXV',0,'2019-03-20 10:05:14','121b42a6-9434-4f12-b968-3f395fce838e'),('86f392c9-792f-4b29-95e3-28f5e2ae8b0f.jpg','dasd','dasda',0,'2019-03-20 10:20:53','121b42a6-9434-4f12-b968-3f395fce838e'),('10d5d90f-5f87-473b-9195-bcf92d9a143c.jpg','','',0,'2019-03-20 10:45:24','121b42a6-9434-4f12-b968-3f395fce838e'),('334e1874-2185-4e5c-921f-1909e5600678.png','','',0,'2019-03-20 11:47:54','121b42a6-9434-4f12-b968-3f395fce838e'),('37e77be0-4987-43b3-a167-e7d4072c58f3.png','','',0,'2019-03-20 11:50:18','121b42a6-9434-4f12-b968-3f395fce838e'),('db978cc6-714e-4672-9197-caeebdd39ae9.png','','',0,'2019-03-20 12:22:38','121b42a6-9434-4f12-b968-3f395fce838e'),('f0c3d9d7-223d-4649-914b-038ad5b0822c.jpg','','',0,'2019-03-20 12:25:01','121b42a6-9434-4f12-b968-3f395fce838e'),('53f7787f-db84-4a43-b121-88cf34903da5.jpg','','',0,'2019-03-20 12:25:06','121b42a6-9434-4f12-b968-3f395fce838e'),('59c7109f-6278-447b-92f3-24d6882dfb34.jpg','','',0,'2019-03-20 12:26:53','121b42a6-9434-4f12-b968-3f395fce838e'),('a6e84b6b-8d75-4a16-af09-7f37cd0c47a9.png','','',0,'2019-03-20 12:27:32','121b42a6-9434-4f12-b968-3f395fce838e'),('3ee14107-bbad-432d-8eac-4750b13cdf2b.jpg','rickie','dasdasgvfa',0,'2019-03-21 21:21:11','121b42a6-9434-4f12-b968-3f395fce838e'),('3873da87-259d-442d-b465-22738ae3bdbe.jpg','','',0,'2019-03-21 21:21:31','121b42a6-9434-4f12-b968-3f395fce838e'),('0245ddec-d179-494e-aa74-d678238d9db5.jpg','','',0,'2019-03-21 21:25:28','b654c1ec-85e3-4835-ad6d-4409a5d593e1');
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `ID` text NOT NULL,
  `username` text NOT NULL,
  `password` text,
  `salt` text,
  `mail` text NOT NULL,
  `Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('7372fc55-4a9a-490f-b7a1-cbb580a9957f','c','5958776967dbe4a9a46d7c54a3f3ec97e5ba88b6a7846297a55cd8d5b4cc65a0e0f3e77152d9bdf1cb2389b4c746e20779712016866a2284e413a92b5e58875b','vV4d4wCPJHTbL4M0iLAJeENjX3MdzmsyUhTmCDVQD7dzlWAormmA6VBVnSFvHA','c','2019-03-19 21:51:37','0','c','c','','',''),('121b42a6-9434-4f12-b968-3f395fce838e','abc','637fb9bb1545dc1ad4e7941816d09c0c70e9305c2d2ad2dca6b3bbe25375acba6ef35e0780d868154fa693f71c677c67056fecf1e64a26167ee1e48944eab3c5','PrHjxMkvshduDzapgFVU9yeXWRiyBypuFsLaF6B6dxFqWQhboaBlZkrT3ELQhV','tikseye@hotmail.com','2019-03-19 21:56:38','0','Rickie','Andersen','31603069','Odense V','5200'),('b654c1ec-85e3-4835-ad6d-4409a5d593e1','a','7f4f547b1f3addc37ce9d0c499730cd27ec5837ebe1801de3faaa073ba9c0a9a7cc3ea3ca10020b5223b1c57674b4889d61b08d7bf4fc9438d82026e32543a79','NDoF665jJHp5A1YnMe1jqB8bniILfHe0wfGics33E4VJyGxGp1K6YV9nvUPHSh','aa','2019-03-21 22:24:51','0','a','a','a','aa','a');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-22 18:53:44
