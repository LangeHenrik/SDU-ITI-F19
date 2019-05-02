DROP DATABASE IF EXISTS rafha13;
/* to fill the database please run dummydata.php. It can be found as a function called dummydata() in /rafha13-2/mvc/app/models/User.php, 
and can be called from a button on the login-page of the website. */

CREATE SCHEMA `rafha13` ;

CREATE TABLE rafha13.siteUser (
	user_Image LONGBLOB,
    user_img_type VARCHAR(30),
    username VARCHAR(30) PRIMARY KEY UNIQUE,
    user_Password CHAR(64),
    user_Firstname VARCHAR(30), 
    user_Lastname VARCHAR(30),
    user_ZIP INT(4),
    user_City VARCHAR(30),
    user_Email VARCHAR(30),
    user_Phone VARCHAR(30),
    user_id VARCHAR(30) UNIQUE
);

CREATE TABLE rafha13.content (
	image LONGBLOB,
    post_img_type VARCHAR(30),
    post_user VARCHAR(30),
    title VARCHAR(30),
    description VARCHAR(1000),
    image_id VARCHAR(30) UNIQUE
);