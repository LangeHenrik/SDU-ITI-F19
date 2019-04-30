-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.2.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2019-03-22 16:30:48
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for lafab16
CREATE DATABASE IF NOT EXISTS `lafab16` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `lafab16`;

-- Dumping structure for table lafab16.users
CREATE TABLE IF NOT EXISTS `users` (
  `idUsers` int(11) NOT NULL AUTO_INCREMENT,
  `uidusers` tinytext NOT NULL,
  `emailUsers` tinytext NOT NULL,
  `city` tinytext,
  `zip` tinytext,
  `numb` tinytext,
  `pwd` longtext NOT NULL,
  PRIMARY KEY (`idUsers`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table lafab16.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`idUsers`, `uidusers`, `emailUsers`, `city`, `zip`, `numb`, `pwd`) VALUES
	(1, 'lafab16', 'lafab16@student.sdu.dk', 'Odense M', '5230', '', '$2y$10$Jo2.F/sws/mF9ZMKlOEU8epgg5Lqo8P5NodtBV8R.sYz0h2ixSMue'),
	(2, 'test', 'test@mail.dk', 'Odense C', '5000', '22446688', '$2y$10$Kj4AeyRIHPy9u6u6Iz.O4.0j1mGbf6aqLcwDzOpbcDxJ7nqqcuDNa');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

-- Dumping structure for table lafab16.images1
CREATE TABLE IF NOT EXISTS `images1` (
  `idPic` int(11) NOT NULL AUTO_INCREMENT,
  `uidusers` tinytext,
  `idUs` int(11) DEFAULT NULL,
  `path` varchar(200) NOT NULL,
  `tex` longtext NOT NULL,
  PRIMARY KEY (`idPic`),
  KEY `idUs` (`idUs`),
  CONSTRAINT `images1_ibfk_1` FOREIGN KEY (`idUs`) REFERENCES `users` (`idUsers`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table lafab16.images1: ~1 rows (approximately)
/*!40000 ALTER TABLE `images1` DISABLE KEYS */;
INSERT INTO `images1` (`idPic`, `uidusers`, `idUs`, `path`, `tex`) VALUES
	(13, 'lafab16', 1, '../Assignment1/freaky.mp4', 'When the force is with you! '),
	(14, 'lafab16', 1, '../Assignment1/drawing.mp4', 'The modified robot drawing! ');
/*!40000 ALTER TABLE `images1` ENABLE KEYS */;


-- Dumping structure for table lafab16.images2
CREATE TABLE IF NOT EXISTS `images2` (
  `idPic` int(11) NOT NULL AUTO_INCREMENT,
  `uidusers` tinytext,
  `idUs` int(11) DEFAULT NULL,
  `path` varchar(200) NOT NULL,
  `tex` text NOT NULL,
  PRIMARY KEY (`idPic`),
  KEY `idUs` (`idUs`),
  CONSTRAINT `images2_ibfk_1` FOREIGN KEY (`idUs`) REFERENCES `users` (`idUsers`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table lafab16.images2: ~3 rows (approximately)
/*!40000 ALTER TABLE `images2` DISABLE KEYS */;
INSERT INTO `images2` (`idPic`, `uidusers`, `idUs`, `path`, `tex`) VALUES
	(5, 'lafab16', 1, '../Assignment1/trash.mp4', 'All of the elements testet together. It worked!\r\nThe program for the UR5 manipulator written in the TeachPend using our URCap.'),
	(6, 'lafab16', 1, '../Assignment1/URCap.PNG', 'We developed a URCap to control the griber from Universal Robots own Teachpend.\r\nThe URCap is written in UR\'s own language called <i>PolyScope</i>.\r\n		<br/>\r\nWe tranfered our URCap to the TeachPend, where the Raspberry was connected with a TCP (Transmission Control Protocol).'),
	(7, 'lafab16', 1, '../Assignment1/printing.mp4', 'The design made in Autodesk Fusion was saved as STL-files.\r\nWe then used the STL-files to slice the griber in the 3D-printes software and convert it to G-code for the printer to use.\r\nThe griber was printed with 3 shells and 20% infill.'),
	(8, 'lafab16', 1, '../Assignment1/rasp.mp4', 'When the program for the diode was in place we substituded the diode with the actuator-circuit.\r\nThe program was written on the computer and transfered to the Raspberry.'),
	(9, 'lafab16', 1, '../Assignment1/light.mp4', 'We had the circuit in place. Now we just needed to write a program for the Raspberry Pi, to activate the circuit.\r\nWe used C++ and began with a simple program just to turn on and off a red diode.'),
	(10, 'lafab16', 1, '../Assignment1/motor2.mp4', 'We needed to design a circuit for the actuator. The actuator is a push/pull designed with a solenoid.\r\nWhen the actuator is activated the solenoid forms a magnetic field that pulls the split in and hold it.\r\nWhen the actuator is deavtiveted the spring will bring the split back to the "start position".'),
	(11, 'lafab16', 1, '../Assignment1/elements.jpg', 'We printed the elements from the STL-files designed in Autodesk Fusion. '),
	(12, 'lafab16', 1, '../Assignment1/simu.mp4', 'We designed the griber in Autodesk Fusion 360 and simulated the functionallety to be sure it would work before printing it.\r\nThe actuator (the boks with the spring) tended to get really warm when activated, therefore we made some airholes in the base. We also used the airholdes to fix the actuator with four splits.');
/*!40000 ALTER TABLE `images2` ENABLE KEYS */;


-- Dumping structure for table lafab16.images3
CREATE TABLE IF NOT EXISTS `images3` (
  `idPic` int(11) NOT NULL AUTO_INCREMENT,
  `uidusers` tinytext,
  `idUs` int(11) DEFAULT NULL,
  `path` varchar(200) NOT NULL,
  `tex` text NOT NULL,
  PRIMARY KEY (`idPic`),
  KEY `idUs` (`idUs`),
  CONSTRAINT `images3_ibfk_1` FOREIGN KEY (`idUs`) REFERENCES `users` (`idUsers`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table lafab16.images3: ~0 rows (approximately)
/*!40000 ALTER TABLE `images3` DISABLE KEYS */;
INSERT INTO `images3` (`idPic`, `uidusers`, `idUs`, `path`, `tex`) VALUES
	(7, 'lafab16', 1, '../Assignment1/finalthrow.mp4', 'The system tested together.\r\nThe coordinates from the object detection is translated from the image frame to the robot frame, so the robot can pick it up.\r\nThe off-set is calculated and the object is thrown.\r\nThe jointpositions and joint velocities are saved in a database we made in SQL Workbench.'),
	(8, 'lafab16', 1, '../Assignment1/trow.jpg', 'When you want to calculate the arc of a thrown object you need to calculate the Jacobian.\r\nYou detemine the jointposition when the griber releases the object, calculate the Jacobian, and calculate the velocity and acceleration the joints must have to reach the desired piont.  When you have a velocity vector you can calculate the off-set that satisfy the requirements.\r\nThe picture shows the off-set for our throw.'),
	(9, 'lafab16', 1, '../Assignment1/ros.mp4', 'We needed a way to control the UR5 manipulator. We desided to use ROS(Robot Operating System).\r\nROS already had a package for Universal Robots, <i>UR mordern driver and a package to communicate with the endeffector. We used UR-sim to simulate our program before we tested it on the real robot.'),
	(10, 'lafab16', 1, '../Assignment1/detect.mp4', 'A big part of the project was to detect and locate the object with the camera. We wrote the program in C++ with the <i> OpenCV</i> libary.\r\n		<br/> <br/>\r\n		The method shown, uses the a set of HUE parameters to detect the object based on the color, convert the image to a binary image and return a centerpoint(x,y in the image plane).'),
	(11, 'lafab16', 1, '../Assignment1/opstilling.jpg', 'his was the lineup for the project. A camera was placed above the table, pointing down.');
/*!40000 ALTER TABLE `images3` ENABLE KEYS */;


-- Dumping structure for table lafab16.images4
CREATE TABLE IF NOT EXISTS `images4` (
  `idPic` int(11) NOT NULL AUTO_INCREMENT,
  `uidusers` tinytext,
  `idUs` int(11) DEFAULT NULL,
  `path` varchar(200) NOT NULL,
  `tex` text NOT NULL,
  PRIMARY KEY (`idPic`),
  KEY `idUs` (`idUs`),
  CONSTRAINT `images4_ibfk_1` FOREIGN KEY (`idUs`) REFERENCES `users` (`idUsers`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table lafab16.images4: ~1 rows (approximately)
/*!40000 ALTER TABLE `images4` DISABLE KEYS */;
INSERT INTO `images4` (`idPic`, `uidusers`, `idUs`, `path`, `tex`) VALUES
	(1, 'lafab16', 1, '../Assignment1/invertpendulum.PNG', 'The inverted pendulum\r\n\r\nThe pendulum is located on a cart, which is controlled by a DC-motor in each end.\r\nTo balance the pendulum we need to find some relationship between the angle of the rod and the acceleration of the cart.'),
	(2, 'lafab16', 1, '../Assignment1/invertsimscape.mp4', '<h1>Inverted pendulum simulated</h1>\r\n		A simulation of the inverted pendulum system made in <i>Matlab Simscape</i>.\r\n		<br>\r\n		The pendulum is started in a upwards position and the simulation shows the behavior of the pendulum and the cart.'),
	(3, 'lafab16', 1, '../Assignment1/sorting.mp4', '	A simulation of a sorting facility made in <i>Experior 6</i>. The three sensors and three actuators are controlled by a PLC\r\n		simulated in <i>Automation Studio</i> from B&ampR.\r\n		The little program is written in Structured Text.');
/*!40000 ALTER TABLE `images4` ENABLE KEYS */;
