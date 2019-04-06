SET time_zone = '+01:00';

USE bjtob17;

CREATE TABLE IF NOT EXISTS user
(
  user_id        INT AUTO_INCREMENT PRIMARY KEY,

  username       VARCHAR(255) NOT NULL UNIQUE,
  hashedPassword VARCHAR(255) NOT NULL,
  firstName      VARCHAR(255) NOT NULL,
  lastName       VARCHAR(255) NOT NULL,
  zip            INT          NOT NULL,
  city           VARCHAR(255) NOT NULL,
  email          VARCHAR(255) NOT NULL,
  phone          VARCHAR(30)  NOT NULL,

  created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);