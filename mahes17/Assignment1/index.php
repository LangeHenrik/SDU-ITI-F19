<?php

//print_r($_POST);

   session_start();

   if (isset($_POST['login_button']) && !empty($_POST['login_button'])) { //Button pressed


		   if (isset($GLOBALS['loginError'])) {$loginError = $GLOBALS['loginError'];}

		     // include "breakpoint.php";

		        $clientPassword = $clientEmail = "";

		         if (isset($_POST['email'])) {$clientEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);}
		         if (isset($_POST['userPassword'])) {$clientPassword = filter_var($_POST['userPassword'], FILTER_SANITIZE_STRING);}

		     include "PDO.php";

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

         $result = $stmt -> fetch(PDO::FETCH_NUM);

		     //$stmt->setFetchMode(PDO::FETCH_ASSOC);
		     //$hashedPassword = $stmt->fetchColumn();
          echo $clientPassword;

		     if(password_verify($clientPassword , $result )) {
           //Correct password.

			   $_SESSION['email'] = $clientEmail;

			      header("Location: ./pictures.php");
		     } else {
			        $loginError = array();

			        array_push($loginError, "Email and password does not match!." );

			        $GLOBALS['loginError'] = $loginError;

			        print_r($loginError);
            //header("Location: ./login.php"); //Do not reload

		}


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


	<input type="submit" value = "Login" name= "login_button" >
	<input type="submit" value="Register" formnovalidate name = "register">


  </div>
 <center>

</form>


 <hr>
</body>


</html>
