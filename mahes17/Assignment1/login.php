<?php
   include("./PDO.php");
   session_start();




   if (isset($_POST['login'])) {
		$email = htmlentities(filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING));
		$password = htmlentities(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING));
		
	include("./PDO.php");
	
	$eventName = 'Login attempt'; //Log a login attempt
	$SQLNow = 'now()'; // SQL now method return the current time
	
	//Log to database
	$stmt = $conn-> prepare("INSERT INTO timelog (eventName, eventTimestamp, responsible) VALUES (:event, :timestampEvent, :responsible)");
	$stmt->bindParam(':event', $eventName);
	$stmt->bindParam(':timestampEvent', $SQLNow);
	$stmt->bindParam(':responsible', $username);		
	
	//Get password
	$stmt = $conn-> prepare("SELECT userPassword FROM Person where email = ':email'");
	$stmt->bindParam(':email', $email);
	$stmt->execute();
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$hashedPassword = $stmt->fetchColumn();


	if(password_verify($password , $hashedPassword )) {
			//Correct password.
			header("Location: ./pictures.php");
	} else {
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
  
    <label ><b>Username</b></label>
    <input type="text" placeholder="Enter email" name="username" required>

	<br/>
	
    <label> <b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="userPassword" required>

	<br/>
	
	
	<button type="submit" name="login">Login</button>
	<button type="submit" formnovalidate name = "register">Register</button>	
    

  </div>
 <center>

</form>


 <hr>
</body>


</html>

