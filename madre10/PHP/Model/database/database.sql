CREATE DATABASE IF NOT EXISTS madre10;
USE madre10;

DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS images;
DROP TABLE IF EXISTS users;


CREATE TABLE users (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(250) NOT NULL,
  password VARCHAR(250) NOT NULL,
  firstname VARCHAR(250),
  lastname VARCHAR(250),
  zip VARCHAR(250),
  city VARCHAR(250),
  email VARCHAR(250) NOT NULL DEFAULT '',
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
  FOREIGN KEY (owner) REFERENCES users(id)
);

CREATE TABLE comments (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_id INT,
  image_id INT,
  content VARCHAR(1000),
  created_on datetime,
  FOREIGN KEY (user_id) REFERENCES users(id),
   FOREIGN KEY (image_id) REFERENCES images(id)
);


INSERT INTO users(username, password, firstname, lastname, zip, city, email, phone) VALUES
('phoellen','password', 'Martin', 'Dreymann', '5000', 'Odense', 'madre10@student.sdu.dk', '60641990'),
('trump','nukes', 'Donald', 'J. Trump', 'no idea', 'Washington', 'dtj@fakenews.com', '13371337');

INSERT INTO images (id, owner, file_name, uploaded_on, title, description) VALUES
(1, 1, 'php1.jpg', NOW(), 'Guide lines', 'This is an example description'),
(2, 1, 'php2.jpg', NOW()+1, 'Headache', 'This is an example description'),
(3, 1, 'php3.jpg', NOW()+2, 'Think of the future!', 'This is an example description');


INSERT INTO comments(id, user_id, image_id, content, created_on) VALUES
(1,1,1,'First test comment from user 1', NOW()),
(2,1,1,'Second test comment from user 1', NOW()+1);

