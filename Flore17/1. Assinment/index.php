<?php

session_start();

//fills DB with dummy data
if(!isset($_SESSION['DBfilled'])) {
	$_SESSION['DBfilled'] = true;
	require_once 'fillDB.php';
}

//check if the user already is logged in.
if(!isset($_SESSION['isLogged'])) {
	$_SESSION['isLogged'] = false;
	$_SESSION['page'] = "login";
}

//if logged in, go to previus page
if($_SESSION['isLogged']) {
	if($_SESSION['page'] == "Pictures") {
		header("location:Pictures.php"); 
		die(); 
	} else if($_SESSION['page'] == "Users") {
		header("location:Users.php"); 
		die();
	}
}

//sets passwordMismatch parameter
if(!isset($_SESSION['passwordMismatch'])) {
	$_SESSION['passwordMismatch'] = false;
}

//sets usernameExists parameter
if(!isset($_SESSION['usernameExists'])) {
	$_SESSION['usernameExists'] = false;
}

//sets emailExists parameter
if(!isset($_SESSION['emailExists'])) {
	$_SESSION['emailExists'] = false;
}

//If login password and username does not match, send alert 
if($_SESSION['passwordMismatch']) {
	echo "<script> alert('Password and Username does not match!'); </script>";
	$_SESSION['passwordMismatch'] = false;
}

//If username exists in DB, send alert
if($_SESSION['usernameExists']) {
	echo "<script> alert('Username already exists! Please choose another.'); </script>";
	$_SESSION['usernameExists'] = false;
}

//If email exists in DB, send alert
if($_SESSION['emailExists']) {
	echo "<script> alert('Email already exists!'); </script>";
	$_SESSION['emailExists'] = false;
}
?>

<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-
		UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
		crossorigin="anonymous">
		
		<title>Login</title>
		
		<meta name="viewport" content="width=divice-width, initial-scale=1.0">
		
		<script src="javascript.js"></script>
		
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
		<div class="topnav">
		
			<a class="active" href="index.php">Login</a>
			
			<a href="Users.php">Users</a>
			
			<a href="Pictures.php">Pictures</a>
			
			<a href="logout.php">Log Out</a>
			
		</div> 
		
		<div class="addcolumn">
		
			<div class="add">
			
				<h1 class="addtext" >Absolute greatest place for ads!</h1>
				
			</div>
			
		</div>
		
		<div class="maincolumn">
		
			<div class="header1"><h1>Members login ind here:</h1></div>
		
			<div class="login">
				
				<!--Form for logging an existing user in-->
				<div class="loginForm">
		
					<form action="loginCheck.php" method="POST">
						<label style="font-size:2vw;" for="name">Username:</label>
						<br> 
						<input type="text" name="username" id="username" placeholder="Enter username Here" required> 
						<br> 
						<label style="font-size:2vw;" for="password">Password:</label>
						<br> 
						<input type="password" name="password" id="password" placeholder="Enter password here" required> 
						<br>
						<button type="submit" class="signUP">Login</button>
						
					</form> 
					
				</div>
				
			</div>
			
			<div class="signin">
				<!--Button for fetching the sign up modal-->
				<button onclick="document.getElementById('id01').style.display='block'" class="signUP" >Sign Up</button>

				<div id="id01" class="modal">

					<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
				  
					<form class="modal-content" onsubmit="checkFields()" action="makeUser.php" method="POST" >
					<!--Form for making a user (checks inputs as the are entered)-->
						<div class="container">
					
							<h1>Sign Up</h1>
					  
							<p>Please fill in this form to create an account.</p>
					  
							<hr>

							<label for="name">Choose Username:</label>

							<input onblur="checkUsernameFree()" type="text" name="newusername" id="newusername" placeholder="Username" required> 

							<label for="password">Enter a Password:</label>

							<input onblur="checkPassword()" type="password" name="passw" id="passw" placeholder="Password" required> 

							<label for="password">Repeat Password:</label>

							<input onblur="checkPasswordMatch()" type="password" name="enterPassword" id="enterPassword" placeholder="Password"required> 

							<label for="fname">Enter Firstname:</label>

							<input onblur="checkFirstname()" type="text" name="firstname" id="firstname" placeholder="Firstname"required> 

							<label for="name">Enter Lastname:</label>

							<input onblur="checkLastname()" type="text" name="lastname" id="lastname" placeholder="Lastname"required> 

							<label for="phone">Enter Phone Number:</label>

							<input onblur="checkPhone()" type="text" name="phone" id="phone" placeholder="+45********"required> 

							<label for="email">Enter Email Address:</label>

							<input onblur="checkEmail()" type="text" name="email" id="email" placeholder="Mail"required>
	 
							<label for="zip">Enter Zip:</label>

							<input onblur="checkZip()" type="text" name="zip" id="zip" placeholder="Zip-code"required> 

							<label for="city">Enter City:</label>
	 
							<input onblur="checkCity()" type="text" name="city" id="city" placeholder="City"required> 
					  
							<p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

							<div class="clearfix">
						
								<button type="submit" class="signupbtn">Sign Up</button>
					  
								<button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
						
							</div>
					  
						</div>
					
					</form>
				
				</div>
			  
			</div>
		
		</div>
		
		<div class="addcolumn">
		
			<div class="add">
			
				<h1 class="addtext" >Absolute greatest place for ads!</h1>
				
			</div>
			
		</div>
		
	</body>
</html>



