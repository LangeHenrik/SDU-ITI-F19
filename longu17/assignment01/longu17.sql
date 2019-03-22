-- MySQL dump 10.17  Distrib 10.3.13-MariaDB, for osx10.13 (x86_64)
--
-- Host: localhost    Database: longu17
-- ------------------------------------------------------
-- Server version	10.3.13-MariaDB

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
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User`
(
  `UserID` int
(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar
(255) DEFAULT NULL,
  `Password` varchar
(255) DEFAULT NULL,
  `First_Name` varchar
(255) DEFAULT NULL,
  `Last_Name` varchar
(255) DEFAULT NULL,
  `Zip` varchar
(255) DEFAULT NULL,
  `City` varchar
(255) DEFAULT NULL,
  `Email` varchar
(255) DEFAULT NULL,
  `Phone_Number` bigint
(20) DEFAULT NULL,
  `Profile_Image` varchar
(255) DEFAULT NULL,
  PRIMARY KEY
(`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User`
VALUES
  (1, 'LuckyLuke', 'Hejmeddig1', 'Lucky', 'Luke', '5200', 'odense v', 'narrefisse@outlook.com', 4520203982, NULL),
  (2, 'LocHTN', 'Hejmeddig1', 'Loc Hoang Thanh', 'nguyen', '5200', 'odense v', 'hejmeddig@live.dk', 4520203982, '../images/5c927e10c2b0f2.98311800.png'),
  (3, 'Anders', 'Hello12345', 'Anders', 'Ottsen', '2000', 'København C', 'Anott@hej.dk', 4527839483, '../images/5c928a9f464e69.28070653.jpg'),
  (4, 'Loc1337', 'Hejmeddig12', 'Ole', 'Vedel', '5200', 'Aalborg SØ', 'loc.1337@hotmail.com', 4583928392, '../images/5c928f9b45a826.87864026.jpg'),
  (5, 'Anders1337', 'Hejmeddig1', 'Anders Bensen', 'Ottsen', '5240', 'Odense C', 'anders.123@mail.dk', 459384732, '../images/5c933ff30c4496.60969986.jpg'),
  (6, 'Jesus1336', 'Hejmeddig1', 'Jesus', 'Kristus', '1200', 'Heaven C', 'god@mail123.dk', 44588888888, '../images/5c93a1f6467c24.05845008.jpg'),
  (7, 'Seje-heidi', 'Hejmeddig1', 'Heidi', 'Hansen', '8000', 'Aarhus C', 'heidi@mail.dk', 4527839483, '../images/5c93a3bd6b8e03.03647704.jpg'),
  (8, 'MaxPayne', 'Hejmeddig1', 'Max', 'Polle', '5240', 'Odense C', 'maxpayne@123mail.dk', 4520203982, '../images/5c93a4e98ef900.96974599.jpeg'),
  (9, 'Gordon1337', 'Hejmeddig1', 'Gordon', 'Freeman', '5240', 'København C', 'Gordon@mail123.dk', 4583948273, '../images/5c93a7410b9a99.46872740.jpeg'),
  (10, 'SpongeBoi', 'Hejmeddig1', 'Sponge', 'Bob', '8000', 'Aarhus C', 'sponge@mail.dk', 4520203982, '../images/5c93a95ade2f68.50471245.jpg'),
  (11, 'Trevor123', 'Hejmeddig1', 'Trevor', 'Phillips', '5240', 'Odense C', 'TrevorStaRR@mail.dk', 4520203982, '../images/5c93aa64704d86.71109601.jpg');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-22 16:45:44
