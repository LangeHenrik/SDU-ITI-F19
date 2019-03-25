-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.2.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2019-03-22 19:35:18
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for magle17
CREATE DATABASE IF NOT EXISTS `magle17` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `magle17`;


-- Dumping structure for table magle17.media
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uploaded_by` int(11) NOT NULL,
  `media_name` tinytext NOT NULL,
  `title` tinytext NOT NULL,
  `description` tinytext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uploaded_by` (`uploaded_by`),
  CONSTRAINT `media_ibfk_1` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- Dumping data for table magle17.media: ~37 rows (approximately)
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` (`id`, `uploaded_by`, `media_name`, `title`, `description`) VALUES
	(3, 9, '1553188761-slammed.jpg', 'Lav Bil', 'Mega fed tekst! hold op det bliver fedt!'),
	(4, 9, '1553188817-download.jpg', 'Wood hut', 'Sikke en bl&aelig;ret hytte!'),
	(5, 9, '1553188847-carwithextra.jpg', 'Mega bl&aelig;ret vogn', 'WOW nogle p&aelig;ne forlygter'),
	(6, 9, '1553188880-car.jpg', 'Bl&aelig;rede hjul!', 'De her hjul er sindssygt bl&aelig;rede!'),
	(8, 9, '1553188928-picture1.jpg', 'Bl&aelig;ret pool!', 'Det her er en bl&aelig;ret pool!'),
	(9, 9, '1553188956-picture2.jpg', 'Bl&aelig;ret nok sofa i guess', 'MEGA fucking bl&aelig;ret sofa!'),
	(10, 9, '1553189167-pimpmywhat.jpg', 'Meme team', 'fordi det lige passede ind'),
	(11, 9, '1553189457-maxresdefault.jpg', 'FASAN', 'fasaner er fandme fine'),
	(12, 9, '1553189485-tukan2.jpg', 'Tukan', 'Tukaner er truncated'),
	(13, 9, '1553189527-tukan.jpg', '2 Tukaner', '2 tukaner er dobbelt s&aring; bl&aelig;ret!'),
	(14, 9, '1553189659-dinosaur.jpg', 'Det en fucking dinosaur!', 'Gas. det bar et bl&aelig;ret n&aelig;sehorn.'),
	(15, 9, '1553189726-vulkan.jpg', 'vulkan!', 'Vulkaner er ogs&aring; bl&aelig;rede!'),
	(16, 9, '1553193966-vinikg.jpg', 'Viking Bl&aelig;rer Sig Med ULV!', 'Bl&aelig;ret ud og en vanvittig viking'),
	(17, 9, '1553194010-images2.png', 'Jesus er bl&aelig;ret til p&aring;ske', 'P&aring;ske&aelig;g er rimelig bl&aelig;ret. Jesus d&oslash;de i p&aring;sken.'),
	(18, 9, '1553194042-linse.jpg', 'Linses bl&aelig;rede kasser!', 'ren bl&aelig;r'),
	(19, 9, '1553194074-matrix.jpg', 'Matrix, ok til over middel', 'jeg er ikke selv fan'),
	(20, 9, '1553194105-shakeweight3.jpg', 'shakeIT', 'SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT '),
	(21, 9, '1553194125-shakeweight2.jpg', 'shake2', 'SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT '),
	(22, 9, '1553194142-shakewheight.jpg', 'shake3', 'SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT '),
	(23, 9, '1553194162-sha.jpg', 'lille shake', 'SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT '),
	(24, 9, '1553194181-images.jpg', 'k&aelig;mpe shake', 'SHAKE IT '),
	(25, 9, '1553194246-shakewheight5.jpg', 'mer shake', 'SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT SHAKE IT '),
	(26, 9, '1553194588-vingin2.jpg', 'mer viking', 'blr&aelig;etksdnf'),
	(27, 9, '1553217568-asdhs.jpg', 'Bl&aelig;rede hjul!', 'adasgasdf'),
	(28, 9, '1553217578-blackbeautry.jpg', 'aasd', 'cxvawgwergwerg'),
	(29, 9, '1553217597-børnebog.jpg', 'asddfesd', 'asdfgasdfasdf'),
	(30, 9, '1553217607-download (1).jpg', 'llasdifaosdnf', 'lknadansdfk'),
	(31, 9, '1553217615-download (2).jpg', 'afdfafd', 'fasdfasdfsdf'),
	(32, 9, '1553217622-download (3).jpg', 'asdfasdf', 'asdfasdfsdfa'),
	(33, 9, '1553217634-download (4).jpg', '09194p34jm&aelig;mk', '098uj23ip4234i234nf'),
	(34, 9, '1553217648-download.jpg', '934250894u50234u5i', 'klushduojnsdfsonscvl&aelig;skdmnfjnlsdknfjsdnfljsndfjklsndlsnfldnfklsdnflksdnflksdnfklsdnfsdknflsdknflsknflsknflskdnfskld'),
	(35, 9, '1553217659-getsdf.jpg', 'kjsdnfkjsd', 'sljfnlsdfnsdf'),
	(36, 9, '1553217674-gladiator.jpg', 'FUCKING KRIGER TING', 'AKSDNFNDJANJFNSDFNASDKFNKASNDFNASDFKSDJKNF'),
	(37, 9, '1553217686-images.jpg', 'DET JOSDKFMSKDFMSKDF', 'SKMDFSDFLSDKFMSKLDFMSKLDF'),
	(40, 9, '1553273778-penguin.jpg', 'LINUX PINGVIN', 'PINGVIN PINGVIN PINGVIN PINGVIN PINGVIN PINGVIN PINGVIN PINGVIN PINGVIN PINGVIN '),
	(41, 9, '1553273803-piskfløde.jpg', 'DANSK PISKEFL&Oslash;DE', 'Bl&aelig;ret nok med piskefl&oslash;de!!!!!'),
	(42, 9, '1553278570-1553188908-picture.jpg', 'Bl&aelig;ret hus', 'bl&aelig;ret hus uploadet efter jeg kom til at slette det');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;


-- Dumping structure for table magle17.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(55) CHARACTER SET utf8 NOT NULL,
  `firstname` tinytext NOT NULL,
  `lastname` tinytext NOT NULL,
  `zip` varchar(24) CHARACTER SET utf8 NOT NULL,
  `city` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `phone` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Dumping data for table magle17.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `zip`, `city`, `email`, `phone`, `password`) VALUES
	(9, 'magle17', 'Mathias', 'Gleerup', '5000', 'Odense', 'template@domain.com', '+88888888', 'root1234'),
	(10, 'bruger2', 'lars', 'larsen', '2800', 'lyngby', 'test@domain.com', '+895684521', 'bruger2'),
	(11, 'nybruger', 'thomas', 'thomsen', '5700', 'svendborg', 'test2@domain.com', '+342345345', 'nybruger');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
