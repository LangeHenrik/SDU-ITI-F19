CREATE DATABASE IF NOT EXISTS madre10;
USE madre10;

DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS images;
DROP TABLE IF EXISTS users;


CREATE TABLE users (
  user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(250) NOT NULL,
  password VARCHAR(250) NOT NULL,
  firstname VARCHAR(250),
  lastname VARCHAR(250),
  zip VARCHAR(250),
  city VARCHAR(250),
  email VARCHAR(250) UNIQUE NOT NULL,
  phone VARCHAR(250)
);

CREATE TABLE images (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  owner INT,
  file_name VARCHAR(250),
  uploaded_on datetime NOT NULL,
  title VARCHAR(250),
  description VARCHAR(250),
  image LONGBLOB,
  FOREIGN KEY (owner) REFERENCES users(user_id)
);

CREATE TABLE comments (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_id INT,
  image_id INT,
  content VARCHAR(1000),
  created_on datetime,
  FOREIGN KEY (user_id) REFERENCES users(user_id),
   FOREIGN KEY (image_id) REFERENCES images(id)
);


INSERT INTO users(username, password, firstname, lastname, zip, city, email, phone) VALUES
('testuser','$2y$10$84MsrvJyi9xrPeyYl6wb2O8Xwz1a80ZT.x7P/ERi4edukQEIvCerq', 'John', 'Doe', '5000', 'Odense', 'test@test.dk', '80808080');

