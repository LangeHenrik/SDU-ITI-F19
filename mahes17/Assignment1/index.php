<?php

	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$email = $_POST["email"];
		$password = $_POST["userPassword"];

    include "PDO.php";

    $stmt = $conn-> prepare("SELECT userPassword FROM Person where email = ':email'");
		$stmt->bindParam(':email', $clientEmail);
		$stmt -> execute();

		$result = $stmt -> fetch(PDO::FETCH_NUM);

		if(empty($username)){
			   echo '<br> <div> Please enter a username!</div>';
		}else if(empty($result[0])){
			   echo '<br> <div> Email does not exist!</div>';
		}else if(password_verify($password, $result[0])){
			$_SESSION['email'] = $email;
			   header("Location: ./pictures.php");
		}else{
			echo '<br> <div> Wrong password! </div>';
		}
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
    <form class="loginForm" method="post">
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
