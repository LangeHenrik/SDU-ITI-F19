<?php
//checks is entered username and password matched

session_start();

require_once 'db_config.php';

//checks if input is empty
if(isset($_POST['username'], $_POST['password'])) {
	
	//htmlentities for xxs defence
    $user = htmlentities($_POST['username']);
    $psw = htmlentities($_POST['password']);
	
	//gets user that fits the entered username
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		echo "Connected to $dbname at $servername successfully.";
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$stmt = $conn->prepare("Select * From users WHERE username = :user");
		
		//bindParam for sql injection defence
		$stmt->bindParam(":user", $user);

		$stmt->execute();

		$db_pass = $stmt->fetch(PDO::FETCH_ASSOC);

	} catch (PDOException $pe) {
		die("Could not connect to the database $dbname :" . $pe->getMessage());
	}
}

//verify if the passwords match
if(password_verify($psw, $db_pass['psw'])){ 

	$hashed_password = password_hash($psw, PASSWORD_DEFAULT);
	$_SESSION['username'] = $user;
	$_SESSION['password'] = $hashed_password;
	$_SESSION['isLogged'] = true;

	session_write_close();     
	header('Location: Pictures.php');
	exit;
	
} else {
	
	$_SESSION['passwordMismatch'] = true;
	//password and username does not match!
	header('Location: index.php');
	
}

$conn = null;
?>
