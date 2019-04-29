-- Reset database
DROP DATABASE IF EXISTS latra16;
CREATE DATABASE latra16;

USE latra16;

-- Create tables
CREATE TABLE latra16.user (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(255) NOT NULL UNIQUE,
	hashPassword VARCHAR(255) NOT NULL,
	firstName VARCHAR(255) NOT NULL,
	lastName VARCHAR(255) NOT NULL,
	city VARCHAR(255),
	zip INT NOT NULL,
	email VARCHAR(255),
	phone VARCHAR(255),
	reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE latra16.photo (
	photo_id INT AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(255) NOT NULL,
	caption VARCHAR(255) NOT NULL,
	upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	uploader_id INT NOT NULL REFERENCES user(user_id),
	photo_name VARCHAR(255) NOT NULL
);


-- Insert data
INSERT INTO latra16.user 
	(username, hashPassword, firstName, lastName, city, zip, email, phone) 
	VALUES 
	('lassetraberg', 'Lasse123!','Lasse', 'Traberg-Larsen', 'Odense', '5270', 'lasse@traberg-larsen.dk', '28499228');

INSERT INTO latra16.user 
	(username, hashPassword, firstName, lastName, city, zip, email, phone) 
	VALUES 
	('champagnepapi', 'Moet1743!','Aubrey', 'Graham', 'Toronto', '666', 'drizzydrake@ovo.com', '2025550189');

INSERT INTO latra16.photo
	(title, caption, uploader_id, photo_name)
	VALUES
	('The Alps of Austria', 'This photo was taken on High179.', '1', '8908be87f4fe5858006d55799ca52e0859dd8587.jpg');

INSERT INTO latra16.photo
	(title, caption, uploader_id, photo_name)
	VALUES
	('Trollstigen in Norway', 'An avalance made it impossible to continue.', '2', 'b1dc29f784c26e53ace590dc13a2ee706d1338fc.jpg');

INSERT INTO latra16.photo
	(title, caption, uploader_id, photo_name)
	VALUES
	('Atlanterhavsveien', 'This road is said to be one of the most dangerous roads in the world!', '1', 'a6d02fad7e9c702f6cc72f5d4a53f25a5980f5f6.jpg');	

INSERT INTO latra16.photo
	(title, caption, uploader_id, photo_name)
	VALUES
	('Frozen Forests', 'The forests of the Alps are truly magical.', '2', 'db5981c136d341fb623ec4f7ab0db45cc487f0b5.jpg');		

INSERT INTO latra16.photo
	(title, caption, uploader_id, photo_name)
	VALUES
	('Top of the World', 'I am on the top of the world. Just as in my career.', '2', '4c378820fad5b8b7dcabde2baf92a1cf498bd51e.jpg');		

INSERT INTO latra16.photo
	(title, caption, uploader_id, photo_name)
	VALUES
	('The Danish Ocean', 'Exploring Denmark from the seaside!', '1', 'ac261c5d766ef99be9db1b850e3378035e832d75.jpg');		

INSERT INTO latra16.photo
	(title, caption, uploader_id, photo_name)
	VALUES
	('Island Hopping', 'On a catemaran in Croatia, everything is good!', '2', '6080a373ac834d8a16e4e073fb2362e644759105.jpg');		