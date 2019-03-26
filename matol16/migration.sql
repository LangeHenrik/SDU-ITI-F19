-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.2.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2019-03-26 11:15:34
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for project
CREATE DATABASE IF NOT EXISTS `project` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `project`;


-- Dumping structure for table project.accounts
CREATE TABLE IF NOT EXISTS `accounts` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(50) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `city` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ph_number` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table project.accounts: ~1 rows (approximately)
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
REPLACE INTO `accounts` (`ID`, `username`, `password`, `name`, `zip`, `city`, `email`, `ph_number`) VALUES
	(1, 'Hejoodatnab', '25d55ad283aa400af464c76d713c07ad', 'Marc', '5220', 'Odense SØ', 'hejoodatnab@gmail.com', '60612504');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;


-- Dumping structure for table project.pictures
CREATE TABLE IF NOT EXISTS `pictures` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `header` varchar(50) NOT NULL DEFAULT '0',
  `picturelink` varchar(200) NOT NULL DEFAULT '0',
  `desc` varchar(200) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Dumping data for table project.pictures: ~21 rows (approximately)
/*!40000 ALTER TABLE `pictures` DISABLE KEYS */;
REPLACE INTO `pictures` (`ID`, `created`, `header`, `picturelink`, `desc`) VALUES
	(1, '2019-03-22 17:58:41', 'Gris', 'https://kids.nationalgeographic.com/content/dam/kids/photos/animals/Mammals/H-P/pig-young-closeup.ngsversion.1412640764383.jpg', 'Billede af en gris'),
	(2, '2019-03-22 21:19:03', 'And', 'https://images.unsplash.com/photo-1459682687441-7761439a709d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80', 'Billede af en and'),
	(3, '2019-04-22 23:04:33', 'Hund', 'https://cdn1.medicalnewstoday.com/content/images/articles/322/322868/golden-retriever-puppy.jpg', 'Billede af en hund'),
	(4, '2019-03-21 23:04:57', 'Kat', 'https://www.idenyt.dk/globalassets/denmark/kaledyr-2/fordele-ved-at-have-kat/11-grunde-til-katte-er-skoenne.jpg?preset=width400', 'Billede af en kat'),
	(5, '2019-03-22 23:05:36', 'Kanin', 'https://dmracekanin2011.dk/wp-content/uploads/2018/02/shutterstock_589399619.jpg', 'Billede af en kanin'),
	(6, '2019-03-22 23:06:05', 'Gås', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/13/Graugans_Pirna_2010-08-26.jpg/1200px-Graugans_Pirna_2010-08-26.jpg', 'Billede af en gås'),
	(7, '2019-03-22 23:09:19', 'Fisk', 'https://samvirke.dk/sites/default/files/styles/image_component_large/public/2018-12/Sn%C3%A6bel-er-en-sj%C3%A6lden-fisk_0.jpg.jpeg?itok=Bmoln3wt', 'Billede af en fisk'),
	(8, '2019-03-26 11:09:04', 'Spurv', 'http://www.biopix.dk/photos/jom-passer-hispaniolensis-00003.jpg', 'Billede af en spurv'),
	(9, '2019-03-26 11:09:08', 'Ørn', 'https://naturguide.dk/wp-content/uploads/kongeoern_syn.jpg', 'Billede af en ørn'),
	(10, '2019-03-26 11:09:16', 'Kødædende Plante', 'https://videnskab.dk/sites/default/files/styles/columns_12_12_desktop/public/article_media/shutterstock_98404715_1.jpg?itok=fdpEtUEP&timestamp=1464590176', 'Billede af en kødædende plante'),
	(11, '2019-03-26 11:09:20', 'Flue', 'http://sangetilboern.dk/wp-content/uploads/2015/01/fluen-anton-300x240.jpg', 'Billede af en flue'),
	(12, '2019-03-26 11:09:37', 'Edderkop', 'https://bt.bmcdn.dk/media/cache/resolve/image_1240/image/4/42207/7824378-spider.jpg', 'Billede af en edderkop'),
	(13, '2019-03-26 11:11:31', 'Skildpadde', 'https://www.udeoghjemme.dk/sites/udeoghjemme.dk/files/styles/full_height_8grid/public/media/article/viden_42_2017_1.jpg', 'Billede af en skildpadde'),
	(14, '2019-03-26 11:11:36', 'Varan', 'https://i.ytimg.com/vi/mzK7PuNDQqc/maxresdefault.jpg', 'Billede af en varan'),
	(15, '2019-03-26 11:11:40', 'Løve', 'https://www.odensezoo.dk/media/1048/hanloeve-i-odense-zoo.jpg?center=0.58181818181818179,0.41566265060240964&mode=crop&width=1600&height=660&rnd=131722216800000000', 'Billede af en løve'),
	(16, '2019-03-26 11:11:45', 'Downs Syndrom Tiger', 'https://i2-prod.mirror.co.uk/incoming/article13841727.ece/ALTERNATES/s1200b/0_Downs-Syndrome-white-tiger-bred-through-incest-in-cruel-bid-to-make-money.jpg', 'Billede af en tiger'),
	(17, '2019-03-26 11:11:50', 'Kænguru', 'https://s3-eu-west-1.amazonaws.com/condidact.dk.images/f949b3bf364d7acf71c11c94b9bcdf8b-762342.emma_k.600_395.jpg', 'Billede af en kænguru'),
	(18, '2019-03-26 11:11:54', 'Abe', 'https://www.altomdata.dk/wp-content/uploads/2014/08/monkey-selfie.jpg', 'Billede af en abe'),
	(19, '2019-03-26 11:11:58', 'Bison', 'https://upload.wikimedia.org/wikipedia/commons/8/8d/American_bison_k5680-1.jpg', 'Billede af en bison'),
	(20, '2019-03-26 11:12:02', 'Hest', 'https://videnskab.dk/sites/default/files/styles/columns_12_12_desktop/public/article_media/hest.jpg?itok=15AsO-Al&timestamp=1464219173', 'Billede af en hest'),
	(21, '2019-03-26 11:12:06', 'Mus', 'https://ekstrabladet.dk/incoming/article5204644.ece/IMAGE_ALTERNATES/relationBig_910/husmus.jpg', 'Billede af en mus');
/*!40000 ALTER TABLE `pictures` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
