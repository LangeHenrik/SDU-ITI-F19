drop database if exists flore17;

create schema `flore17`;

create table flore17.users (
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
	primary key (username), 
	unique (username)
);

create table flore17.posts (
	imagename char(200) not null,
    exttype char(200) not null,
    imagetmp longblob not null,
    header char(50) not null,
    comm char(250) not null
);
