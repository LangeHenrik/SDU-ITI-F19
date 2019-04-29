DROP DATABASE IF EXISTS mscho17;

CREATE DATABASE mscho17;

USE mscho17;

CREATE TABLE user_login(
	user_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	user_name VARCHAR(50) NOT NULL,
	user_password VARCHAR(500) NOT NULL,
	user_email VARCHAR(50) NOT NULL,
	PRIMARY KEY(user_id)
	);

CREATE TABLE post(
	post_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	post_title VARCHAR(50),
	post_header VARCHAR(50),
	post_description VARCHAR(140),
	post_picture_location VARCHAR(200),
	PRIMARY KEY(post_id)
	);
	
	
INSERT INTO user_login (user_id, user_name, user_password, user_email) VALUES (1, 'StandardUser007', '$10$15T4Schi1N59MBeeCat3f.aA.ntHdlGwAd21sAtzH6lXOj29ZsGta', 'hej@hej.hej');


INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (3,	"a", "b", "empty", "pictures/image_part_001.jpg" );
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (4,	"a", "b", "empty", "pictures/image_part_002.jpg" );
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (5,	"a", "b", "empty", "pictures/image_part_003.jpg" );
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (6,	"a", "b", "empty", "pictures/image_part_004.jpg" );
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (7,	"a", "b", "empty", "pictures/image_part_005.jpg" );
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (8,	"a", "b", "empty", "pictures/image_part_006.jpg" );
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (9,	"a", "b", "empty", "pictures/image_part_007.jpg" );
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (10, "a", "b", "empty", "pictures/image_part_008.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (11, "a", "b", "empty", "pictures/image_part_009.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (12, "a", "b", "empty", "pictures/image_part_010.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (13, "a", "b", "empty", "pictures/image_part_011.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (14, "a", "b", "empty", "pictures/image_part_012.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (15, "a", "b", "empty", "pictures/image_part_013.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (16, "a", "b", "empty", "pictures/image_part_014.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (17, "a", "b", "empty", "pictures/image_part_015.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (18, "a", "b", "empty", "pictures/image_part_016.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (19, "a", "b", "empty", "pictures/image_part_017.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (20, "a", "b", "empty", "pictures/image_part_018.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (21, "a", "b", "empty", "pictures/image_part_019.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (22, "a", "b", "empty", "pictures/image_part_020.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (23, "a", "b", "empty", "pictures/image_part_021.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (24, "a", "b", "empty", "pictures/image_part_022.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (25, "a", "b", "empty", "pictures/image_part_023.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (26, "a", "b", "empty", "pictures/image_part_024.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (27, "a", "b", "empty", "pictures/image_part_025.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (28, "a", "b", "empty", "pictures/image_part_026.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (29, "a", "b", "empty", "pictures/image_part_027.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (30, "a", "b", "empty", "pictures/image_part_028.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (31, "a", "b", "empty", "pictures/image_part_029.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (32, "a", "b", "empty", "pictures/image_part_030.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (33, "a", "b", "empty", "pictures/image_part_031.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (34, "a", "b", "empty", "pictures/image_part_032.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (35, "a", "b", "empty", "pictures/image_part_033.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (36, "a", "b", "empty", "pictures/image_part_034.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (37, "a", "b", "empty", "pictures/image_part_035.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (38, "a", "b", "empty", "pictures/image_part_036.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (39, "a", "b", "empty", "pictures/image_part_037.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (40, "a", "b", "empty", "pictures/image_part_038.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (41, "a", "b", "empty", "pictures/image_part_039.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (42, "a", "b", "empty", "pictures/image_part_040.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (43, "a", "b", "empty", "pictures/image_part_041.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (44, "a", "b", "empty", "pictures/image_part_042.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (45, "a", "b", "empty", "pictures/image_part_043.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (46, "a", "b", "empty", "pictures/image_part_044.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (47, "a", "b", "empty", "pictures/image_part_045.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (48, "a", "b", "empty", "pictures/image_part_046.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (49, "a", "b", "empty", "pictures/image_part_047.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (50, "a", "b", "empty", "pictures/image_part_048.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (51, "a", "b", "empty", "pictures/image_part_049.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (52, "a", "b", "empty", "pictures/image_part_050.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (53, "a", "b", "empty", "pictures/image_part_051.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (54, "a", "b", "empty", "pictures/image_part_052.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (55, "a", "b", "empty", "pictures/image_part_053.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (56, "a", "b", "empty", "pictures/image_part_054.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (57, "a", "b", "empty", "pictures/image_part_055.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (58, "a", "b", "empty", "pictures/image_part_056.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (59, "a", "b", "empty", "pictures/image_part_057.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (60, "a", "b", "empty", "pictures/image_part_058.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (61, "a", "b", "empty", "pictures/image_part_059.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (62, "a", "b", "empty", "pictures/image_part_060.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (63, "a", "b", "empty", "pictures/image_part_061.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (64, "a", "b", "empty", "pictures/image_part_062.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (65, "a", "b", "empty", "pictures/image_part_063.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (66, "a", "b", "empty", "pictures/image_part_064.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (67, "a", "b", "empty", "pictures/image_part_065.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (68, "a", "b", "empty", "pictures/image_part_066.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (69, "a", "b", "empty", "pictures/image_part_067.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (70, "a", "b", "empty", "pictures/image_part_068.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (71, "a", "b", "empty", "pictures/image_part_069.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (72, "a", "b", "empty", "pictures/image_part_070.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (73, "a", "b", "empty", "pictures/image_part_071.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (74, "a", "b", "empty", "pictures/image_part_072.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (75, "a", "b", "empty", "pictures/image_part_073.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (76, "a", "b", "empty", "pictures/image_part_074.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (77, "a", "b", "empty", "pictures/image_part_075.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (78, "a", "b", "empty", "pictures/image_part_076.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (79, "a", "b", "empty", "pictures/image_part_077.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (80, "a", "b", "empty", "pictures/image_part_078.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (81, "a", "b", "empty", "pictures/image_part_079.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (82, "a", "b", "empty", "pictures/image_part_080.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (83, "a", "b", "empty", "pictures/image_part_081.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (84, "a", "b", "empty", "pictures/image_part_082.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (85, "a", "b", "empty", "pictures/image_part_083.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (86, "a", "b", "empty", "pictures/image_part_084.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (87, "a", "b", "empty", "pictures/image_part_085.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (88, "a", "b", "empty", "pictures/image_part_086.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (89, "a", "b", "empty", "pictures/image_part_087.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (90, "a", "b", "empty", "pictures/image_part_088.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (91, "a", "b", "empty", "pictures/image_part_089.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (92, "a", "b", "empty", "pictures/image_part_090.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (93, "a", "b", "empty", "pictures/image_part_091.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (94, "a", "b", "empty", "pictures/image_part_092.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (95, "a", "b", "empty", "pictures/image_part_093.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (96, "a", "b", "empty", "pictures/image_part_094.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (97, "a", "b", "empty", "pictures/image_part_095.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (98, "a", "b", "empty", "pictures/image_part_096.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (99, "a", "b", "empty", "pictures/image_part_097.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (100, "a", "b","empty", "pictures/image_part_098.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (101, "a", "b","empty", "pictures/image_part_099.jpg");
INSERT INTO post (post_id, post_title, post_header, post_description, post_picture_location) VALUES (102, "a", "b","empty", "pictures/image_part_100.jpg");
