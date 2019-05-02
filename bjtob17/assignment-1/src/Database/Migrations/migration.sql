SET time_zone='+01:00';

CREATE TABLE IF NOT EXISTS user (
  user_id INT AUTO_INCREMENT PRIMARY KEY,

  username VARCHAR(255) NOT NULL UNIQUE,
  hashedPassword VARCHAR(255) NOT NULL,
  firstName VARCHAR(255) NOT NULL,
  lastName VARCHAR(255) NOT NULL,
  zip INT NOT NULL,
  city VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  phone VARCHAR(30) NOT NULL,

  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS photo (
  photo_id INT AUTO_INCREMENT PRIMARY KEY,

  title varchar(255) NOT NULL,
  caption varchar(255) NOT NULL,
  imgName varchar(255) NOT NULL,
  uploadDate INT DEFAULT UNIX_TIMESTAMP(),
  author_id INT NOT NULL REFERENCES user(user_id),

  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 2 users
-- username: bob, password: password
-- usenrame: bob2, password: password
INSERT INTO bjtob17.user (user_id, username, hashedPassword, created_at, updated_at, firstName, lastName, zip, city, email, phone) VALUES (1, 'bob', '$2y$10$dsUpxjdToZoq8qTCSQaDqu13kXYwArJwvG/4Pj/SQkbntN5fR53oK', '2019-03-08 08:20:40', '2019-03-08 08:20:40', 'bob', 'bob', 1234, 'odense', 'bob@email.dk', '22222222');
INSERT INTO bjtob17.user (user_id, username, hashedPassword, created_at, updated_at, firstName, lastName, zip, city, email, phone) VALUES (2, 'bob2', '$2y$10$2z1bEZqOZorXYTkzCxRKMObRP4n/eyxp/NTA3nhkhTOFRA4LBXs6i', '2019-03-08 08:34:58', '2019-03-08 08:34:58', 'ob', 'ob2', 1234, 'blaby', 'lol@hej.org', '+45112233');

INSERT INTO bjtob17.photo (photo_id, title, caption, imgName, uploadDate, author_id, created_at, updated_at) VALUES (1, 'grim ged', 'grim ged', 'a9817c182dfe552fd60948a698317ed000275875733b60b19080eca5015c5a4c.jpg', 1552033287, 1, '2019-03-08 08:21:27', '2019-03-08 08:21:27');
INSERT INTO bjtob17.photo (photo_id, title, caption, imgName, uploadDate, author_id, created_at, updated_at) VALUES (2, 'grimdyr', 'grimdyr', 'eb3bbfe64ecabcdb7ee8bab237b2ccc23ec6cbe6622411b7a3e24958c6ec0860.jpg', 1552034130, 2, '2019-03-08 08:35:30', '2019-03-08 08:35:30');


