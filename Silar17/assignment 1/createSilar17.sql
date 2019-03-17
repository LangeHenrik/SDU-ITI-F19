drop database if exists silar17;

create schema `silar17`;

create table silar17.site_user (
  user_id int(5) primary key not null auto_increment,
  user_username char(50) not null unique,
  user_password char(50) not null,
  user_fname char(50) not null,
  user_lname char(50) not null,
  user_zip numeric(4) not null,
  user_city char(50) not null,
  user_email char(50) not null,   
  user_phone char(11) not null
);
create table silar17.zip (
  zip_city char(50) not null unique, 
  zip numeric(4) not null unique,
  primary key (zip)
); 

create table silar17.picture (
  picture_id int(5) primary key not null auto_increment,
  picture_user char(50) not null,
  picture_created datetime not null,
  picture_title char(30),
  picture_comment char(255),
  picture_likes int4 (10),
  picture_type char(30) not null,
  picture longblob not null
  
);

insert into silar17.site_user values 
 ('H.C.Andersen','1805-04-02',
 'H','C', 5220, 'Odense SØ','mail', '56413854556');
 
insert into silar17.zip values 
 ('Rudkøbing',5900),
 ('Odense SØ',5220);