CREATE TABLE images
(
  image_id  INT PRIMARY KEY AUTO_INCREMENT,
  filehash  CHAR(64) UNIQUE,
  extension VARCHAR(4)
);

CREATE TABLE feed_entries
(
  entry_id    INT PRIMARY KEY AUTO_INCREMENT,
  user_id     INT REFERENCES users (user_id),
  image_id    INT REFERENCES images (filehash),
  description TEXT NOT NULL,
  title       TEXT NOT NULL
);
