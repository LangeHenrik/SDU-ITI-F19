<html>
<head>
<script>
	function checkPassword(form){
		password1 = form.password1.value; 
		password2 = form.password2.value; 
		var x = document.getElementById("acceptDiv");
		
		// If password not entered 
		if (password1 == '') 
			alert ("Please enter Password"); 
			  
		// If confirm password not entered 
		else if (password2 == '') 
			alert ("Please enter confirm password"); 
			  
		// If Not same return False.     
		else if (password1 != password2) { 
			alert ("\nPassword did not match: Please try again...") 
			return false; 
		} 

		// If same return True. 
		else{ 
			alert("Password Match.") 
			x.style = visible;
			return true; 
		} 
	}
	
</script>

	<title>Register account</title>
</head>
<body>
	<form method="POST" onSubmit="return checkPassword(form)">
		<label for="username">Username</label>
		<input type="text" name="username" id="username"/>
		<br></br>
		<label for="password">Password</label>
		<input type="password" name="password1"/>
		<br></br>
		<label for="password2">Retype password</label>
		<input type="password" name="password2"/>
		<br></br>
		<input type="submit" name="submitButton"/>
	</form>
	<div id="acceptDiv" style="visibility:hidden">
		<p>Account has been added, please return to the main page and login.</p>
	</div>
</body>
</html>

<?php
/*
	$password = 0;
	$password2 = 1;
	
		echo "test3";
		if (isset($_POST["password"]) !== isset($_POST["password2"])){
			echo "test4";
			echo "Passwords don't match.";
		}
		echo "test1";
		if (isset($_POST["password"]) == isset($_POST["password2"]) && empty($_POST["password"]) && empty($_POST["password2"])){
			echo "test2";
			echo "Account has been added, please return to the main page and login.";	
		} 
*/
?>