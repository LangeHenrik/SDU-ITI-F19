DROP DATABASE IF EXISTS rafha13;

CREATE SCHEMA `rafha13` ;

CREATE TABLE rafha13.siteUser (
	user_Image LONGBLOB,
    user_img_type VARCHAR(30),
    user_Name VARCHAR(30) PRIMARY KEY UNIQUE,
    user_Password CHAR(64),
    user_Firstname VARCHAR(30), 
    user_Lastname VARCHAR(30),
    user_ZIP INT(4),
    user_City VARCHAR(30),
    user_Email VARCHAR(30),
    user_Phone VARCHAR(30)
);

CREATE TABLE rafha13.content (
	post_image LONGBLOB,
    post_img_type VARCHAR(30),
    post_user VARCHAR(30),
    post_title VARCHAR(30),
    post_description VARCHAR(1000)
);