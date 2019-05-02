<?php 
if(session_status() == PHP_SESSION_NONE){
	session_start();
}

if(isset($_POST["login"])){
	$username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
	$password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
	$sucCess = true;
	
	if(!checkPassword($password)){
		$sucCess = false;
	}
	if(!checkUsername($username)){
		$sucCess = false;
	}
	
	if($sucCess){
		//database stuff here
		echo "checking with database... <br><br><br>";
		login($username, $password);
	} else {
		echo "stuff is not working";
	}
	
}

if(isset($_POST["register"])){
	echo "register clicked ";
	$username = htmlentities(filter_var($_POST["username"], FILTER_SANITIZE_STRING));
	$password = htmlentities(filter_var($_POST["password"], FILTER_SANITIZE_STRING));
	$repeatPassword = htmlentities(filter_var($_POST["repeatPassword"], FILTER_SANITIZE_STRING));
	$userEmail = htmlentities(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL));
	$firstName = htmlentities(filter_var($_POST["firstName"], FILTER_SANITIZE_STRING));
	$lastName = htmlentities(filter_var($_POST["lastName"], FILTER_SANITIZE_STRING));
	$zipCode = htmlentities(filter_var($_POST["zipCode"], FILTER_SANITIZE_NUMBER_INT));
	$city = htmlentities(filter_var($_POST["city"], FILTER_SANITIZE_STRING));
	$phoneNumber = htmlentities(filter_var($_POST["city"], FILTER_SANITIZE_NUMBER_INT));
	
	$sucess = true;

	if(!checkPassword($password)){
		$sucess = false;
	}
	if(!checkUsername($username)){
		$sucess = false;
	}
	if(!checkCity($city)){
		$sucess = false;
	}
	if(!checkName($firstName)){
		$sucess = false;
	}
	if(!checkName($lastName)){
		$sucess = false;
	}
	if(!checkZip($zipCode)){
		$sucess = false;
	}
	if(!checkPhoneNumber($phoneNumber)){
		$sucess = false;
	}
	
		if($sucess){
		//database stuff here
		echo "checking with database... <br><br><br> ";
		register_user($username, $password, $userEmail);
	} else {
		echo "stuff is not working ";
	}
		
}

function checkUsername($nameToCheck){
	$sucess = true;
	if(preg_match("/\W/", $nameToCheck)){
		$sucess = false;
	}
	if(preg_match("/\s/", $nameToCheck)){
		$sucess = false;
	}

	if(!$sucess){
		//database stuff here
		echo "username is wrong <br>";
	}
	return $sucess;
	
}

function checkPassword($passwordToCheck){
	$sucess = true;
	
	if(!preg_match("/\d+/",$passwordToCheck)){	
		$sucess = false;
	}

	if(!preg_match("/[a-z]+/",$passwordToCheck)){
		$sucess = false;
	}
	if(!preg_match("/[A-Z]+/",$passwordToCheck)){
		$sucess = false;
	}
	if(preg_match("/\W/",$passwordToCheck)){
		$sucess = false;
	}
	if(preg_match("/\s/",$passwordToCheck)){
		$sucess = false;
	}

	if(!$sucess){
		//database stuff here
		echo "password is wrong <br>";
	}
	return $sucess;
}

function checkCity($input){
	$sucess = true;
	if(preg_match("/\W/", $input)){
		$sucess = false;
	}

	if(!$sucess){
		//database stuff here
		echo "city is wrong <br>";
	}
	return $sucess;
}



function checkName($input){
	$sucess = true;
	if(preg_match("/\W/", $input)){
		$sucess = false;
	}
	if(preg_match("/[0-9]/", $input)){
		$sucess = false;
	}
	if(preg_match("/[0-9]/", $input)){
		$sucess = false;
	}

	if(!$sucess){
		//database stuff here
		echo "name is wrong <br>";
	}
	return $sucess;
}

function checkZip($input){
	$sucess = true;
	if(preg_match("/\W/", $input)){
		$sucess = false;
	}
	if(preg_match("/\s/", $input)){
		$sucess = false;
	}
	if(preg_match("/[a-z]/", $input)){
		$sucess = false;
	}
	if(preg_match("/[A-Z]/", $input)){
		$sucess = false;
	}
	if(!preg_match("/[0-9]{4,}/", $input)){
		$sucess = false;
	}
	
	if(!$sucess){
		//database stuff here
		echo "zip is wrong <br>";
	}
	return $sucess;
}


function checkPhoneNumber($input){
	$sucess = true;
	if(preg_match("/\W/", $input)){
		$sucess = false;
		echo "phone check 1 passed <br>";
	}
	if(preg_match("/\s/", $input)){
		$sucess = false;
		echo "phone check 2 passed <br>";
	}
	if(preg_match("/[a-z]/", $input)){
		$sucess = false;
		echo "phone check 3 passed <br>";
	}
	if(preg_match("/[A-Z]/", $input)){
		$sucess = false;
		echo "phone check 4 passed <br>";
	}
	
	
	if(!$sucess){
		//database stuff here
		echo "phone number is wrong <br>";
	}
	return $sucess;
}

function checkEmail($input){
	$sucess = true;
	if(!preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $input)){
		$sucess = false;
	}
	
	
	if(!$sucess){
		//database stuff here
		echo "email is wrong <br>";
	}
	return $sucess;
}


//StandardUser007
//SuperEasyPassword1337

function login($login_name, $login_password){
require_once 'db_config.php';

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//	echo "connection is okay <br>";
	$stmt = $conn->prepare("SELECT * FROM user_login WHERE user_name = :user_name");
	$stmt->bindParam(':user_name', $login_name);
//	echo "made it this far <br>";
	$stmt->execute();
	$result = $stmt->fetchAll();
	

	if(isset($result[0]['user_name']) and $result[0]['user_name'] == $login_name){
//		echo "username is correct <br>";
		if( password_verify($login_password, $result[0]['user_password'])){
			echo "congrats you're logged in, buy logged in content for only 99.99€";
			if(session_status() == PHP_SESSION_NONE){
				session_start();
			}
			$_SESSION["logged_in"] = true;
			$_SESSION["user_id"] = $result[0]['user_id'];
			header("Location:user.php");
		}
	}
	
} catch (PDOException $e) {
	echo "Error: " . $e->getMessage();
}
	$conn = null;
	
}

function register_user($register_name, $register_password, $email){
require_once 'db_config.php';

try {
	
	$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//	echo "passed connection.. <br>";
	$stmt = $conn->prepare("SELECT (user_name) FROM user_login WHERE user_name = :user_name OR user_email = :userEmail");
	$stmt->bindParam(':user_name', $register_name);
	$stmt->bindParam(':userEmail', $email);
//	echo "right before execute statement <br>";
	$stmt->execute();
	$result = $stmt->fetchAll();
//	echo "passed execute statement <br>";
	
	if(empty($result[0])){	
//	echo "user wast not found in databse <br>";
	$hashedPassword = password_hash($register_password, PASSWORD_DEFAULT);
	$stmt = $conn->prepare("INSERT INTO user_login (user_name, user_password, user_email) VALUES (:user_name, :user_password, :user_email)");
	$stmt->bindParam(':user_name', $register_name);
	$stmt->bindParam(':user_password', $hashedPassword);
	$stmt->bindParam(':user_email', $email);
	$stmt->execute();
//	echo "all went well <br>";
	}
//	else {
//		echo "user already exists <br>";
//		print_r($result);
//	}
	
} catch (PDOException $e) {
	echo "Error: " . $e->getMessage();
}
	$conn = null;
	
	
}

?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="loginscripts.js"></script>
</head>
<body>
<div>
	will crash if /index.php is called instead of nothing... no idea why
	<?php 
	include 'topBar.php'; 
	?>
	
<div class="login_screen">
	<?php include 'loginScreen.php'; ?>
<div class="login_screen">
	<?php include 'registeruser.php'; ?>
</div>
</div>
	
</div>

<div>
</div>


	</body>
</html>
