<?php
session_start();

require_once 'db_config.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    echo "Connected to $dbname at $servername successfully.";
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//htmlentities for xxs defence
	$newusername = htmlentities($_POST['newusername']);
	$psw = htmlentities($_POST['passw']);
	$fname = htmlentities($_POST['firstname']);
	$lname = htmlentities($_POST['lastname']);
	$phone = htmlentities($_POST['phone']);
	$email = htmlentities($_POST['email']);
	$zip = htmlentities($_POST['zip']);
	$city = htmlentities($_POST['city']);
	
	//Puts a stock profile picture in the database (in future it could be changed for other uploaded picture)
	$exttype= "image/png";
	$imagetmp= file_get_contents('empty.png');

	//hashing password for storing in DB
	$hashed_password = password_hash($psw, PASSWORD_DEFAULT);
	
	//checks if username is taken
	$stmt = $conn->prepare("SELECT username FROM users WHERE username = :newusername");
	
	$stmt->bindParam(":newusername", $newusername);
	
	$stmt->execute();

	if($stmt->rowCount() > 0){
		
		echo "Username already exists! Please choose another.";
		$_SESSION['usernameExists'] = true;
		header('Location: index.php');
		
	} else {
		
		//checks if email is taken
		$stmt = $conn->prepare("SELECT email FROM users WHERE email = :email");
		
		$stmt->bindParam(":email", $email);
	
		$stmt->execute();
		
		if($stmt->rowCount() > 0){
			
			echo "Email already exists!";
			$_SESSION['emailExists'] = true;
			header('Location: index.php');
			
		} else {
			
			//creates user in DB
			$stmt = $conn->prepare("INSERT INTO users (username, psw, firstname, lastname, phone, email, zip, city, exttype, imagetmp) VALUES (:newusername, :hashed_password, :fname, :lname, :phone, :email, :zip, :city, :exttype, :imagetmp);");

			//bindParam for sql injection defence
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
			
			echo "New record created successfully";
		}
	}
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}


$conn = null;

header('Location: index.php');

?>

