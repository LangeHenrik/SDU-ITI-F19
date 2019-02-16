CREATE TABLE users
(
  user_id  INT PRIMARY KEY AUTO_INCREMENT,
  username CHAR(20) UNIQUE,
  password VARCHAR(255)
);
