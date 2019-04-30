drop database if exists flore17;

create schema `flore17`;

create table flore17.users (
	user_id int(50) not null,
	username char(50) not null,
	psw CHAR(64) not null,
	firstname char(50) not null,
	lastname char(50) not null,
	phone char(30) not null,   
	email char(50) not null,
	zip char(20) not null,
	city char(50) not null,
	exttype char(255) not null,
	imagetmp longblob not null,
	primary key (user_id), 
	unique (user_id)
);

create table flore17.posts (
	image_id int(50) not null,
	imagename char(200) not null,
    exttype char(200) not null,
    imagetmp longblob not null,
    header char(50) not null,
    comm char(250) not null,
    primary key (image_id), 
	unique (image_id)
);