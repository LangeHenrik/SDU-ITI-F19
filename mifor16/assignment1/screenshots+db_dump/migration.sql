DROP Database IF EXISTS mifor16;
CREATE Database mifor16;
USE mifor16;

drop table if exists images;
drop table if exists users;

CREATE TABLE `images` (
  `counter` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(2000) DEFAULT NULL,
  `path` varchar(2000) DEFAULT NULL,
  `title` varchar(2000) DEFAULT NULL,
  `description` varchar(4369) DEFAULT NULL,
  UNIQUE KEY `images_counter_uindex` (`counter`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='table for images';

INSERT INTO `images` VALUES (1,'mikkel','uploads/picklerick2.jpg','A Pickle.','PICKLEEEEEEEEEEEEEEEEEEE RIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIICK'),(2,'mikkel','uploads/picklerick2.jpg','One More Pickle.','PICKLEEEEEEEEEEEEEEEEEEE RIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIICK'),(3,'mikkel','uploads/4kboy.jpeg','Big Pic','This is big'),(4,'mikkel','uploads/bigboy2.jpg','big boy 2','HELLO'),(5,'mikkel','uploads/bigboy2.jpg','Cool.','Very cool.'),(6,'mikkel','uploads/bigboy2.jpg','A new test.','Hello.');



CREATE TABLE `users` (
  `username` varchar(2000) DEFAULT NULL,
  `password` varchar(2000) DEFAULT NULL,
  `first` varchar(2000) DEFAULT NULL,
  `last` varchar(2000) DEFAULT NULL,
  `zip` varchar(2000) DEFAULT NULL,
  `city` varchar(2000) DEFAULT NULL,
  `mail` varchar(2000) DEFAULT NULL,
  `phone` varchar(2000) DEFAULT NULL);

INSERT INTO `users` VALUES ('pickle','$2y$10$kXhAzcos7MoFvKlJysIEOelVtF1F3I00wKejcrqbE/s8PGb0Tt/3.','fmewop','fwemop','femwop','femwop','gmewop@mwei.dk','fweijopew'),('pickle1','$2y$10$jnwGjPCnv0rt8oJgB1XkAe6nFGdWPPbt2FsOpwXXpWTHRU84Mylo.','fwjeiop','fjweiof','fjewif','fjwei','fjewi@fenio.dk','fwejiof'),('tissemand','$2y$10$Gmrq.vAepCGh4ubKCb9qYeClxEiSdMc3kqweSfXkgtRvxmpAmhRkm','fjiew','fejwio','gerjio','grrjio','gjieo@gjeiro.dk','fwpjoi'),('mikkel','$2y$10$bd13qVFquVWx80lfrTr2b.pW7EoK68yIjNWahLgEmPQK1NNkR7EJq','Mikkel','F','5230','Odense','mail@mail.dk','88888888');

