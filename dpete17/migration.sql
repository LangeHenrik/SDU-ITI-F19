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
    file LONGBLOB NOT NULL,
    header VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    uploaded_at TIMESTAMP NOT NULL DEFAULT now()
);

CREATE TABLE opinion (
    account_id BIGINT UNSIGNED,
    image_id BIGINT UNSIGNED,
    opinion ENUM('LIKES', 'DISLIKES'),
    PRIMARY KEY (account_id, image_id)
);

CREATE TABLE uploads (
    account_id BIGINT UNSIGNED,
    image_id BIGINT UNSIGNED,
    PRIMARY KEY (account_id, image_id)
);

INSERT INTO account(username, password, firstname, lastname, zip, city, email, phone)
VALUES ('admin1', '$2y$10$GHn7SOuZltfGtzGl5WnN/.ksQxLZIQf7zCksNnUbjV8hB5QoLb4V2', 'Admin', 'Nimad', 6000, 'Admincity', 'admin@admin.com', 99999999);

INSERT INTO account(username, password, firstname, lastname, zip, city, email, phone)
VALUES ('testo1', '$2y$10$UnJB5PYBLmNCjbtLj2jQMee1hGCqw2xOoI2JnywAdsbQkkhJicmKO', 'Tester', 'Retset', 6000, 'Testercity', 'tester1@tester.com', 00000001);

INSERT INTO account(username, password, firstname, lastname, zip, city, email, phone)
VALUES ('testo2', '$2y$10$UnJB5PYBLmNCjbtLj2jQMee1hGCqw2xOoI2JnywAdsbQkkhJicmKO', 'Tester', 'Retset', 6000, 'Testercity', 'tester2@tester.com', 00000002);

INSERT INTO account(username, password, firstname, lastname, zip, city, email, phone)
VALUES ('dpete17', '$2y$10$UnJB5PYBLmNCjbtLj2jQMee1hGCqw2xOoI2JnywAdsbQkkhJicmKO', 'Dennis', 'Unknown', 6000, 'Odense M', 'creator@htmlgod.com', 35700540);

# INSERT INTO image(filename, header, content) VALUES ('55a86c4f1ae2ae842081b6be159018774c8c1823295d0fdeb9c4849c684257c3', 'New Opinion System!', '');
# INSERT INTO image(filename, header, content) VALUES ('c484c50881fd73684ba154879d16d28470acf4b2aba83ac22d48235829f5a7d8', 'A Star!', '');
# INSERT INTO image(filename, header, content) VALUES ('0f942abf332a0e9d06e7535308070228c23717ffeeba8f7d8d8be43d489776db', 'SDU LOGO', '');
# INSERT INTO image(filename, header, content) VALUES ('0b922a1b3cd5ff16ea813736b1d892357f5910821c93e9a7092bcc39a47785b2', 'A Penguin!', 'My first penguin!');
#
# INSERT INTO uploads(account_id, image_id) VALUES (1, 1);
# INSERT INTO uploads(account_id, image_id) VALUES (1, 2);
# INSERT INTO uploads(account_id, image_id) VALUES (2, 3);
# INSERT INTO uploads(account_id, image_id) VALUES (4, 4);
#
# INSERT INTO opinion(account_id, image_id, opinion) VALUES (1, 1, 'LIKES');
# INSERT INTO opinion(account_id, image_id, opinion) VALUES (1, 3, 'LIKES');
# INSERT INTO opinion(account_id, image_id, opinion) VALUES (2, 2, 'LIKES');
# INSERT INTO opinion(account_id, image_id, opinion) VALUES (2, 4, 'LIKES');
# INSERT INTO opinion(account_id, image_id, opinion) VALUES (3, 3, 'LIKES');
# INSERT INTO opinion(account_id, image_id, opinion) VALUES (3, 4, 'LIKES');