DROP DATABASE IF EXISTS it_assignment_1;

CREATE DATABASE it_assignment_1;

CREATE TABLE `user` (
	`userid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`username` CHAR(16) NOT NULL,
	`password_hash` CHAR(255) NOT NULL,
	`firstname` CHAR(32) NOT NULL,
	`lastname` CHAR(32) NOT NULL,
	`zip` CHAR(8) NULL DEFAULT NULL,
	`city` CHAR(32) NULL DEFAULT NULL,
	`email` CHAR(64) NULL DEFAULT NULL,
	`number` CHAR(30) NULL DEFAULT NULL,
	PRIMARY KEY (`userid`),
	UNIQUE INDEX `username` (`username`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=8;

CREATE TABLE `picture` (
	`picid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`picture` BLOB NOT NULL,
	`user` CHAR(16) NOT NULL,
	`header` VARCHAR(50) NOT NULL,
	`description` VARCHAR(200) NULL DEFAULT NULL,
	PRIMARY KEY (`picid`),
	INDEX `FK_picture_user` (`user`),
	CONSTRAINT `FK_picture_user` FOREIGN KEY (`user`) REFERENCES `user` (`username`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=34;

