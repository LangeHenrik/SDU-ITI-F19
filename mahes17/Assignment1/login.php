<?php
   session_start();
		
   if (isset($_POST['login_button'])) { //Button pressed

		include('breakpoint.php');

		$loginError = array();
		

		if (isset($GLOBALS['loginError'])) {$loginError = $GLOBALS['loginError'];}
		
		$clientPassword = $clientEmail = "";

		if (isset($_POST['email'])) {$clientEmail = filter_var($_POST['email'], FILTER_SANITIZE_STRING);} 
		if (isset($_POST['userPassword'])) {$clientPassword = filter_var($_POST['userPassword'], FILTER_SANITIZE_STRING);}
		
		include("./PDO.php");
	
		$eventName = 'Login attempt'; //Log a login attempt
		$SQLNow = 'now()'; // SQL now method return the current time
	
		//Log to database
		$stmt = $conn-> prepare("INSERT INTO timelog (eventName, eventTimestamp, responsible) VALUES (:event, :timestampEvent, :responsible)");
		$stmt->bindParam(':event', $eventName);
		$stmt->bindParam(':timestampEvent', $SQLNow);
		$stmt->bindParam(':responsible', $clientEmail);		
	
		//Get hashed password
		$stmt = $conn-> prepare("SELECT userPassword FROM Person where email = ':email'");
		$stmt->bindParam(':email', $clientEmail);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$hashedPassword = $stmt->fetchColumn();


		if(password_verify($clientPassword , $hashedPassword )) {

			//Correct password.
			

			$_SESSION['email'] = $clientEmail;

			header("Location: ./pictures.php");
		} else {
			$loginError = array();
			
			array_push($loginError, "Email and password does not match!");

			$GLOBALS['loginError'] = $loginError;

            header("Location: ./login.php");
			
		}
	
		exit();
   }
   
   if (isset($_POST['register'])) {
	   header("Location: ./register.php");
   }
   
   
   
?>
<!DOCTYPE html>

<html>

<head>

	<title> Login </title>  
	
	<link rel="stylesheet" type="text/css" href="css.css">

</head>

<body>

<div align="center"> <h1> Login page </h1> </div>

<form action="" method="POST">
	
<hr>

<center>

  <div class="container">
  
    <label ><b>Email</b></label>
    <input type="text" placeholder="Enter email" name="email" required>

	<br/>
	
    <label> <b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="userPassword" required>

	<br/>
	
	
	<input type="button" value = "Login" name= "login_button" >
	<input type="button" value="Register" formnovalidate name = "register">
    

  </div>
 <center>

</form>


 <hr>
</body>


</html>

