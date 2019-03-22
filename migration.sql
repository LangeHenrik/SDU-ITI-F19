DROP DATABASE IF EXISTS michc15;

CREATE DATABASE michc15;

USE michc15;

CREATE TABLE user_login(
	user_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	user_name VARCHAR(50) NOT NULL,
	user_password VARCHAR(500) NOT NULL,
	user_email VARCHAR(400) NOT NULL,
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
	
	
	