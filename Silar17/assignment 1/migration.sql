drop database if exists silar17;

create schema `silar17`;

create table silar17.site_user (
  user_id int(5) primary key not null auto_increment,
  user_username char(50) not null unique,
  user_password char(64) not null,
  user_fname char(50) not null,
  user_lname char(50) not null,
  user_zip numeric(4) not null,
  user_city char(50) not null,
  user_email char(50) not null,   
  user_phone char(11) not null
);

create table silar17.picture (
  picture_id int(5) primary key auto_increment,
  picture_user char(50) not null,
  picture_created datetime not null,
  picture_title char(100),
  picture_comment char(255),
  picture_likes int4 (10),
  picture_type char(30) not null,
  picture longblob not null
);

insert into silar17.site_user values 
 (1, 'user1','$2y$10$nGMkrjcf7.wkdyriT8zef.oXjB66hCQng4YKnVjcvIkE8PyEkbQRW',
 'Un','Known', 6666, 'Unknown','Unknown', '123456789'),
(2,'user2','user2','user2','user2',1235,'user2','user2','16541'),
(3,'user3','user3','user3','user3',1236,'user3','user3','16541'),
(4,'user4','user4','user 4','user 4',1237,'user 4','user 4','16541'),
(5,'user5','user5','user 5','user 5',1238,'user 5','user 5','16541'),
(6,'user6','user 6','user 6','user 6',1239,'user 6','user 6','16541'),
(7,'user7','user 7','user 7','user 7',1240,'user 7','user 7','16541'),
(8,'user8','user 8','user 8','user 8',1241,'user 8','user 8','16541'),
(9,'user9','user 9','user 9','user 9',1242,'user 9','user 9','16541'),
(10,'user10','user 10','user 10','user 10',1243,'user 10','user 10','16541'),
(11,'user11','user 11','user 11','user 11',1244,'user 11','user 11','16541'),
(12,'user12','user 12','user 12','user 12',1245,'user 12','user 12','16541'),
(13,'user13','user 13','user 13','user 13',1246,'user 13','user 13','16541'),
(14,'user14','user 14','user 14','user 14',1247,'user 14','user 14','16541'),
(15,'user15','user 15','user 15','user 15',1248,'user 15','user 15','16541'),
(16,'user16','user 16','user 16','user 16',1249,'user 16','user 16','16541'),
(17,'user17','user 17','user 17','user 17',1250,'user 17','user 17','16541'),
(18,'user18','user 18','user 18','user 18',1251,'user 18','user 18','16541'),
(19,'user19','user 19','user 19','user 19',1252,'user 19','user 19','16541'),
(20,'user20','user 20','user 20','user 20',1253,'user 20','user 20','16541'),
(21,'user21','user 21','user 21','user 21',1254,'user 21','user 21','16541'),
(22,'user22','user 22','user 22','user 22',1255,'user 22','user 22','16541')
