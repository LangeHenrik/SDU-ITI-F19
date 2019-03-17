DROP DATABASE IF EXISTS dpete17;

CREATE DATABASE dpete17;

use dpete17;

CREATE TABLE account (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL,
    firstname VARCHAR(100),
    lastname VARCHAR(100),
    zip CHAR(4),
    city VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    phone CHAR(8) UNIQUE
);

CREATE TABLE image (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(100) UNIQUE NOT NULL,
    header VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    uploaded_at TIMESTAMP NOT NULL
);

CREATE TABLE uploads (
    account_id BIGINT UNSIGNED,
    image_id BIGINT UNSIGNED,
    PRIMARY KEY (account_id, image_id)
);