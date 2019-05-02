DROP DATABASE IF EXISTS camkr16;

CREATE DATABASE camkr16;

CREATE TABLE user(
  user_id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(30),
  password VARCHAR(100),
  firstname varchar(30),
	lastname varchar(50),
	zip int,
	city varchar(30),
	email varchar(40),
	phone int
);

CREATE TABLE post(
  post_id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT REFERENCES user(user_id),
  title VARCHAR(100),
  description TEXT,
  extension VARCHAR(4),
  file BLOB
);

