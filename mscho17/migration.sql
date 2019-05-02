DROP DATABASE IF EXISTS mscho17;

CREATE DATABASE mscho17;

USE mscho17;

CREATE TABLE user_login(
	user_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	username VARCHAR(50) NOT NULL,
	user_password VARCHAR(500) NOT NULL,
	user_email VARCHAR(50) NOT NULL,
	PRIMARY KEY(user_id)
	);

CREATE TABLE post(
	image_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	title VARCHAR(50),
	post_header VARCHAR(50),
	description VARCHAR(140),
	image blob,
	user_id integer UNSIGNED NOT NULL,
	PRIMARY KEY(image_id),
	FOREIGN KEY (user_id) references user_login(user_id)
	);
	
	
INSERT INTO user_login (user_id, username, user_password, user_email) VALUES (1, 'StandardUser007', '$2y$10$CQPoEFosWnZyfXIFe9sxeex7mFHB0POPiv5Ff0ViR3cNJtGVT7RGS', 'hej@hej.hej');
INSERT INTO user_login (user_id, username, user_password, user_email) VALUES (2, 'stuff', 'nohash', 'hej@hej.hej');


INSERT INTO post (title, post_header, description, image, user_id) VALUES (	"a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_001.jpg", "2" );
INSERT INTO post (title, post_header, description, image, user_id) VALUES (	"a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_002.jpg", "2" );
INSERT INTO post (title, post_header, description, image, user_id) VALUES (	"a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_003.jpg", "2" );
INSERT INTO post (title, post_header, description, image, user_id) VALUES (	"a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_004.jpg", "2" );
INSERT INTO post (title, post_header, description, image, user_id) VALUES (	"a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_005.jpg", "2" );
INSERT INTO post (title, post_header, description, image, user_id) VALUES (	"a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_006.jpg", "2" );
INSERT INTO post (title, post_header, description, image, user_id) VALUES (	"a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_007.jpg", "2" );
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_008.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_009.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_010.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_011.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_012.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_013.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_014.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_015.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_016.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_017.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_018.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_019.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_020.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_021.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_022.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_023.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_024.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_025.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_026.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_027.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_028.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_029.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_030.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_031.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_032.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_033.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_034.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_035.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_036.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_037.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_038.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_039.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_040.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_041.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_042.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_043.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_044.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_045.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_046.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_047.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_048.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_049.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_050.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_051.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_052.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_053.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_054.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_055.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_056.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_057.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_058.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_059.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_060.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_061.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_062.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_063.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_064.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_065.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_066.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_067.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_068.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_069.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_070.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_071.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_072.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_073.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_074.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_075.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_076.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_077.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_078.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_079.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_080.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_081.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_082.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_083.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_084.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_085.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_086.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_087.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_088.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_089.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_090.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_091.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_092.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_093.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_094.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_095.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_096.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b", "empty", "/mscho17/mvc/public/pictures/image_part_097.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b","empty", "/mscho17/mvc/public/pictures/image_part_098.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b","empty", "/mscho17/mvc/public/pictures/image_part_099.jpg", "2");
INSERT INTO post (title, post_header, description, image, user_id) VALUES ( "a", "b","empty", "/mscho17/mvc/public/pictures/image_part_100.jpg", "2");
