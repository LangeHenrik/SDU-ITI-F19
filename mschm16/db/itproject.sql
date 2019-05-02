DROP DATABASE IF EXISTS anott17;
CREATE DATABASE anott17;
USE anott17;

CREATE TABLE IF NOT EXISTS `posts` (
  `postId` int(4) NOT NULL AUTO_INCREMENT,
  `postName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `postImg` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `postText` text COLLATE utf8_unicode_ci NOT NULL,
  `fk_userId` int(4) NOT NULL,
  PRIMARY KEY (`postId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;


INSERT INTO `posts` (`postId`, `postName`, `postImg`, `postText`, `fk_userId`) VALUES
(1, 'My first post', 'cw.jpg', 'This is my first post that contains a chaos knight', 1),
(5, 'Ajax pic code', '0f8b2870896edcde8f6149fe2733faaf.jpg', 'code stuff', 1),
(3, 'Colors', 'colors.jpg', 'Color desc', 2);


CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(4) NOT NULL AUTO_INCREMENT,
  `userName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userFirst` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userLast` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userPass` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userMail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userPhone` int(10) NOT NULL,
  `userZip` int(5) NOT NULL,
  `userCity` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;


INSERT INTO `users` (`userId`, `userName`, `userFirst`, `userLast`, `userPass`, `userMail`, `userPhone`, `userZip`, `userCity`) VALUES
(1, 'Obarok', 'Mikkel', 'Schmøde', '1234', 'mikkel@mail.com', 60775361, 5200, 'Odense V'),
(2, 'Omhaw', 'Omar', 'Hawai', '11', 'omar@mail.dk', 55772361, 4000, 'Roskilde'),
(3, 'Habil', 'Hanna', 'Billbord', '12345', 'hanna@mail.dk', 55776688, 4700, 'NÃ¦stved');

