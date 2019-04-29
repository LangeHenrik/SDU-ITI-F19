DROP DATABASE IF EXISTS jobjo17;

CREATE DATABASE jobjo17;

CREATE TABLE users(
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(20) UNIQUE,
password VARCHAR(20),
first_name VARCHAR(30),
last_name VARCHAR(30),
zip int(4),
city VARCHAR(30),
email VARCHAR(100),
phonenumber INT(8)
);

CREATE TABLE images(
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255),
description VARCHAR(255),
uploadedby INT,
mimetype VARCHAR(16),
FOREIGN KEY(uploadedby)
REFERENCES users(id)
);
