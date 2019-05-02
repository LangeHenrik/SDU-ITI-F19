CREATE TABLE users
(
  user_id   INT PRIMARY KEY AUTO_INCREMENT,
  username  CHAR(20) UNIQUE,
  password  VARCHAR(255),
  firstname VARCHAR(20),
  lastname  VARCHAR(20),
  city      VARCHAR(20),
  zip       VARCHAR(20),
  email     VARCHAR(20),
  phone     VARCHAR(20)
);
