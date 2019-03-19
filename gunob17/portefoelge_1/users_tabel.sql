create TABLE users (
idusers int(11) AUTO_INCREMENT PRIMARY key not null,
fname tinytext not null,
lname tinytext not null,
zip int(11) not null,
city tinytext not null,
phoneN varchar(50) not null,
username tinytext not null,
email tinytext not null,
pwdusers longtext not null);

