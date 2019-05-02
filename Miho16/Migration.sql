DROP DATABASE IF EXISTS miho16;

CREATE DATABASE if not exists miho16;

use miho16;

create table imagedb
(
  username text null,
  fileID int null,
  headline text null,
  text text null,
  date date null
);

INSERT INTO imagedb (username,fileID,headline,text,date) values ('miho16','126863778','nice cat','my cat',NOW());
INSERT INTO imagedb (username,fileID,headline,text,date) values ('miho16','364432018','happy cat','my friends cat',NOW());
INSERT INTO imagedb (username,fileID,headline,text,date) values ('miho16','126863779','lonely cat','some cat',NOW());
INSERT INTO imagedb (username,fileID,headline,text,date) values ('miho16','126863770','missing cat','that cat',NOW());
INSERT INTO imagedb (username,fileID,headline,text,date) values ('miho16','126863771','lost cat','i want my cat back',NOW());
INSERT INTO imagedb (username,fileID,headline,text,date) values ('miho16','126863772','fat cat','i stole this cat',NOW());
INSERT INTO imagedb (username,fileID,headline,text,date) values ('miho16','126863773','dangerous cat','this cat attacked me',NOW());
INSERT INTO imagedb (username,fileID,headline,text,date) values ('miho16','126863774','handsome cat','this cat helped me',NOW());
INSERT INTO imagedb (username,fileID,headline,text,date) values ('miho16','126863775','cute cat','what a cute cat',NOW());


create table userdb
(
  username text null,
  password text null,
  firstName text null,
  lastName text null,
  zip int null,
  city text null,
  emailAddress text null,
  phoneNumber int null,
  date date null
);


INSERT INTO userdb (username,password,firstName,lastName,zip,city,emailAddress,phoneNumber,date) VALUE ('miho16','$2y$10$vHpWnWemAgPdhC3UKO5ybOEZWYQlbX6fd7dpsdxqAtAal.8gS7Zpm','michael','huu',5220,'Odense C','miho16@studen.sdu.dk',88888888, NOW());
