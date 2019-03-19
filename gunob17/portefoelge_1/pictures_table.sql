create TABLE pictures (
idpic int(20) AUTO_INCREMENT not null PRIMARY key,
idus int(11) not null,
username tinytext not null,
path longtext  not null,
name longtext not null,
FOREIGN KEY (idus) REFERENCES users(idusers));
