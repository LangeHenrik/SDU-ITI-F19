<?php
session_start();
if ( ! empty( $_POST ) ) {
	// is checking all of them necessary? idk but we'll do it anyways
    if ( isset( $_POST['username'] ) && isset( $_POST['password'] )&& isset( $_POST['repeatPassword'] ) && isset( $_POST['firstname'] )
		&& isset( $_POST['lastname'] )&& isset( $_POST['zip'] ) && isset( $_POST['city'] )  
		&& isset( $_POST['email']) && isset( $_POST['phonenumber'] ) ){
		// sanitize & then validate data
		if(validate()) {
		require_once('db_config.php');
		$conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// check if username already exists
		$stmt = $conn->prepare("SELECT id FROM users WHERE username =:username");
		$stmt->bindParam(':username',$_POST['username']);
		$stmt->execute();
		if(!$stmt->rowcount() < 1) {
			$_SESSION['error'] = "Username is taken";
			header("Location: registerUsers.php");
		}
		// if it doesnt then we insert using a prepared statement to avoid sql injections, just like above
		$stmt = $conn->prepare("INSERT INTO users(username,password,firstname,lastname,zip,city,email,phonenumber) 
		VALUES(:username,:password,:firstname,:lastname,:zip,:city,:email,:phonenumber)");
		$stmt->bindParam(':username', $_POST['username']);
		$hashedPw = password_hash($_POST['password'],PASSWORD_DEFAULT); // hash the password because storing it in clear text is not ideal
		$stmt->bindParam(':password', $hashedPw);
		$stmt->bindParam(':firstname', $_POST['firstname']);
		$stmt->bindParam(':lastname', $_POST['lastname']);
		$stmt->bindParam(':zip', $_POST['zip']);
		$stmt->bindParam(':city', $_POST['city']);
		$stmt->bindParam(':email', $_POST['email']);
		$stmt->bindParam(':phonenumber', $_POST['phonenumber']);
		
		$stmt->execute();
		
		$_SESSION['error'] = "Registration successful, you can now log in!";
		header("Location: index.php");
		} else {
			header("Location: registerUsers.php");
		}

    }
}
function validate() {
	// "i want all data sanitized" -> shows validation filter
	// sanitizing all the inputs first & then validating them
	// might not be the right way to do it but w/e hopefully it'll all work out
	// list of regex
	// god this is awful, SURELY theres a better way
	require_once('validationregex.php');
	
	$_POST['email'] = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
	$_POST['username'] = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
	$_POST['password'] = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
	$_POST['repeatPassword'] = filter_var($_POST['repeatPassword'],FILTER_SANITIZE_STRING);
	$_POST['firstname'] = filter_var($_POST['firstname'],FILTER_SANITIZE_STRING);
	$_POST['lastname'] = filter_var($_POST['lastname'],FILTER_SANITIZE_STRING);
	$_POST['zip'] = filter_var($_POST['zip'],FILTER_SANITIZE_NUMBER_INT);
	$_POST['city'] = filter_var($_POST['city'],FILTER_SANITIZE_STRING);
	$_POST['phonenumber'] = filter_var($_POST['phonenumber'],FILTER_SANITIZE_NUMBER_INT);
	// doing the actual validation
	if($password === $repeatPassword) { // dont bother validating other fields if passwords arent the same
		if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) { 	// validate email
			$_SESSION['error'] = "Email not valid.";
			return false;	
		} else if(!filter_var($_POST['username'], FILTER_VALIDATE_REGEXP,array( // validate username
         "options" => array("regexp"=>$unR)))) {
			 $_SESSION['error'] = "Username not valid.";
			 return false;
		 } else if(!filter_var($_POST['password'],FILTER_VALIDATE_REGEXP,array( // validate username
         "options" => array("regexp"=>$pwR)))) {
			$_SESSION['error'] = "Password must fullfil requirements";
			return false;
		 } else if(!filter_var($_POST['firstname'],FILTER_VALIDATE_REGEXP,array( // validate first name
         "options" => array("regexp"=>$nameR)))) {
			 $_SESSION['error'] = "First name not valid";
			 return false;
		 } else if(!filter_var($_POST['lastname'],FILTER_VALIDATE_REGEXP,array( // validate last name
         "options" => array("regexp"=>$nameR)))) {
			 $_SESSION['error'] = "Last name not valid";
			 return false;
		 } else if(!filter_var($_POST['zip'],FILTER_VALIDATE_REGEXP,array( // validate zip code
         "options" => array("regexp"=>$zipR)))) {
			 $_SESSION['error'] = "Zip code is invalid";
			 return false;
		 }else if(!filter_var($_POST['city'],FILTER_VALIDATE_REGEXP,array( // validate city
         "options" => array("regexp"=>$cityR)))) {
			 $_SESSION['error'] = "City is invalid";
			 return false;
		 }else if(!filter_var($_POST['phonenumber'],FILTER_VALIDATE_REGEXP,array( // validate phonenumber
         "options" => array("regexp"=>$phoneR)))) {
			 $_SESSION['error'] = "Phone number is invalid";
			 return false;
		 } else {
			 return true;
		 }
	} else {
		$_SESSION['error'] = "Passwords do not match.";
		return false;
	}

	
}





?>