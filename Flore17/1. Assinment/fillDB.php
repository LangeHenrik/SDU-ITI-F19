<?php
//php called at first load of the page to fill DB with dummy Data (only for testing) 

require_once 'db_config.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	for($x = 1; $x < 45; $x++) {
		$header = "Some Header";
		$comm = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.";
		$imagename = "Unknown";
		$exttype= "image/png";
		$imagetmp= file_get_contents('pictures/' . $x . '.png');
		
		$stmt = $conn->prepare("INSERT INTO posts (imagename, exttype, imagetmp, header, comm) VALUES (:imagename, :exttype, :imagetmp, :header, :comm)");
		
		$stmt->bindParam(":imagename", $imagename);
		$stmt->bindParam(":exttype", $exttype);
		$stmt->bindParam(":imagetmp", $imagetmp, PDO::PARAM_LOB);
		$stmt->bindParam(":header", $header);
		$stmt->bindParam(":comm", $comm);
		
		$stmt->execute();

	}
	
	
	$newusername = "frederiklorenzen";
	$fname = "Frederik";
	$lname = "Lorenzen";
	$phone = "+4527829188";
	$email = "Frederik_kl@hotmail.com";
	$zip = "5700";
	$city = "Svendborg";
	
	//checks if username is taken
	$stmt = $conn->prepare("SELECT username FROM users WHERE username = :newusername");
	
	$stmt->bindParam(":newusername", $newusername);
	
	$stmt->execute();

	if($stmt->rowCount() > 0){
	} else {
	
	$stmt = $conn->prepare("INSERT INTO users (username, psw, firstname, lastname, phone, email, zip, city, exttype, imagetmp) VALUES (:newusername, :hashed_password, :fname, :lname, :phone, :email, :zip, :city, :exttype, :imagetmp);");

	$hashed_password = password_hash("Frederik1243", PASSWORD_DEFAULT);
	$exttype= "image/png";
	$imagetmp= file_get_contents('empty.png');
	
	$stmt->bindParam(":newusername", $newusername);
	$stmt->bindParam(":hashed_password", $hashed_password);
	$stmt->bindParam(":fname", $fname);
	$stmt->bindParam(":lname", $lname);
	$stmt->bindParam(":phone", $phone);
	$stmt->bindParam(":email", $email);
	$stmt->bindParam(":zip", $zip);
	$stmt->bindParam(":city", $city);
	$stmt->bindParam(":exttype", $exttype);
	$stmt->bindParam(":imagetmp", $imagetmp, PDO::PARAM_LOB);
			
	$stmt->execute();
	}
	
	$newusername = "admin";
	$fname = "Jens";
	$lname = "Jensen";
	$phone = "+4512345678";
	$email = "JJ@gmail.com";
	$zip = "5000";
	$city = "Odense";
	
	//checks if username is taken
	$stmt = $conn->prepare("SELECT username FROM users WHERE username = :newusername");
	
	$stmt->bindParam(":newusername", $newusername);
	
	$stmt->execute();

	if($stmt->rowCount() > 0){
	} else {
	
	$stmt = $conn->prepare("INSERT INTO users (username, psw, firstname, lastname, phone, email, zip, city, exttype, imagetmp) VALUES (:newusername, :hashed_password, :fname, :lname, :phone, :email, :zip, :city, :exttype, :imagetmp);");

	$hashed_password = password_hash("Password123", PASSWORD_DEFAULT);
	$exttype= "image/png";
	$imagetmp= file_get_contents('empty.png');
	
	$stmt->bindParam(":newusername", $newusername);
	$stmt->bindParam(":hashed_password", $hashed_password);
	$stmt->bindParam(":fname", $fname);
	$stmt->bindParam(":lname", $lname);
	$stmt->bindParam(":phone", $phone);
	$stmt->bindParam(":email", $email);
	$stmt->bindParam(":zip", $zip);
	$stmt->bindParam(":city", $city);
	$stmt->bindParam(":exttype", $exttype);
	$stmt->bindParam(":imagetmp", $imagetmp, PDO::PARAM_LOB);
			
	$stmt->execute();
	}
	
	$newusername = "Flore17";
	$fname = "Flore";
	$lname = "Lore";
	$phone = "+4534231223";
	$email = "123@student.sdu.dk";
	$zip = "5000";
	$city = "Odense";
	
	//checks if username is taken
	$stmt = $conn->prepare("SELECT username FROM users WHERE username = :newusername");
	
	$stmt->bindParam(":newusername", $newusername);
	
	$stmt->execute();

	if($stmt->rowCount() > 0){
	} else {
	$stmt = $conn->prepare("INSERT INTO users (username, psw, firstname, lastname, phone, email, zip, city, exttype, imagetmp) VALUES (:newusername, :hashed_password, :fname, :lname, :phone, :email, :zip, :city, :exttype, :imagetmp);");

	$hashed_password = password_hash("aPassword1", PASSWORD_DEFAULT);
	$exttype= "image/png";
	$imagetmp= file_get_contents('empty.png');
	
	$stmt->bindParam(":newusername", $newusername);
	$stmt->bindParam(":hashed_password", $hashed_password);
	$stmt->bindParam(":fname", $fname);
	$stmt->bindParam(":lname", $lname);
	$stmt->bindParam(":phone", $phone);
	$stmt->bindParam(":email", $email);
	$stmt->bindParam(":zip", $zip);
	$stmt->bindParam(":city", $city);
	$stmt->bindParam(":exttype", $exttype);
	$stmt->bindParam(":imagetmp", $imagetmp, PDO::PARAM_LOB);
			
	$stmt->execute();
	
	}
	
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}

$header = "";

$comm = "";

$conn = null;

?>

