DROP DATABASE IF EXISTS jenav16;

CREATE DATABASE if not exists jenav16;

create table Assets
(
  username text null,
  fileID int null,
  headline text null,
  text text null,
  date date null
);

INSERT INTO Assets (username,fileID,headline,text,date) values ('Chester_The_Tester','902422096','Lovely beach','This is a very nice beach',NOW());
INSERT INTO Assets (username,fileID,headline,text,date) values ('Chester_The_Tester','365181332','Red Panda','The red panda is the cutest panda',NOW());
INSERT INTO Assets (username,fileID,headline,text,date) values ('Chester_The_Tester','262251649','PS1','Play station 1 logo',NOW());
INSERT INTO Assets (username,fileID,headline,text,date) values ('Futuristic_City_Lover','655083730','City 1','City 1',NOW());
INSERT INTO Assets (username,fileID,headline,text,date) values ('Futuristic_City_Lover','532651464','City 2','This one is from ghost in the shell',NOW());
INSERT INTO Assets (username,fileID,headline,text,date) values ('Futuristic_City_Lover','758686978','City 1 backup','City 1',NOW());
INSERT INTO Assets (username,fileID,headline,text,date) values ('Designer','815747483','Rådyr','Minimalistisk rådyr',NOW());
INSERT INTO Assets (username,fileID,headline,text,date) values ('Designer','260982681','Rød sol','Rød sol over vand',NOW());
INSERT INTO Assets (username,fileID,headline,text,date) values ('Designer','234203922','Lyd skov','Gul',NOW());


create table Users
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


INSERT INTO Users (username,password,firstName,lastName,zip,city,emailAddress,phoneNumber,date) VALUE ('Chester_The_Tester','$2y$10$d3CumUljQy9dPJcrddmLYOJvJHEq2NPAm4uASvxJfPW1zyG7k7Gle','Chester','Tester',5000,'Odense C','Chester@Tester.com',20494444, NOW());
INSERT INTO Users (username,password,firstName,lastName,zip,city,emailAddress,phoneNumber,date) VALUE ('Designer','$2y$10$GXAd5ZCAUK0W3bPqC2zqIOnKOVDz9XnBDhBBr2ymg1vXSL4gkmyZe','Dennis','Designer',5000,'Odense C','Dennis@Designer.dk',54892083, NOW());
INSERT INTO Users (username,password,firstName,lastName,zip,city,emailAddress,phoneNumber,date) VALUE ('Futuristic_City_Lover','$2y$10$4sQI8W55nebSI1RfNIjUJeGMf9m3UkIjq7bepQmfLSjY1dEfgogDS','Niels','Nielssen',5000,'Odense C','Niels@gmail.com',32492384, NOW());

