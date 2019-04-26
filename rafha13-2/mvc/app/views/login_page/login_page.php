<!DOCTYPE html>
<html>
	<head>
		
		<title>Assignment 2</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src='/rafha13/mvc/public/js/FormValidation.js'></script>
		<link rel="stylesheet" type="text/css" href='/rafha13/mvc/public/css/PageStyle.css'>

	</head>
	<!--Comment-->
	<body>
	
		<div class="nav">

			
			<inline>
				<a> Welcome! Please login or create a user to use this service!</a>
			</inline>
						
			<div class="weather">
				<img src='/rafha13/mvc/public/images/weather.png' style="height:35px"/>
			</div>
				
		</div>
		
		<div class="back">
			<div class="add" style="left:15px">
				<h2 style="color:white">Absolute greatest place for ads!</h2>
			</div>
				
			<div class="maincolumn">
				
				<div class="box" style="left:10%"> 
					<p class="title"> Sign up for free! <p>
					
					<form class="form" onsubmit="checkFields()" method="post" action="createUser.php">
						
						<input onblur="checkUsername()" required type="text" name="newUsername" placeholder="New username..." id="newUsername" size="20%"/>
						<br> <br>
						<input onblur="checkPassword()" required type="password" name="newPassword" placeholder="New password..." id="newPassword" />
						<br> <br>
						<input onblur="checkSecondPassword()" required type="password" name="newConfirmPassword" placeholder="Confirm password..." id="newConfirmPassword"/>
						<br> <br>
						<input onblur="checkFirstname()" required type="text" name="newFirstname" placeholder="Your firstname..." id="newFirstname">
						<br> <br>
						<input onblur="checkLastname()" required type="text" name="newLastname" placeholder="Your lastname..." id="newLastname"/>
						<br> <br>
						<input onblur="checkZip()" required type="number" name="newZip" placeholder="Your ZIP..." id="newZip"/>
						<br> <br>
						<input onblur="checkCity()" required type="text" name="newCity" placeholder="Your City..." id="newCity"/>
						<br> <br>
						<input onblur="checkEmail()" required type="text" name="newEmail" placeholder="Your Email..." id="newEmail"/>
						<br> <br>
						<input onblur="checkPhone()" required type="text" name="newPhone" placeholder="Your phonenumber..." id="newPhone"/>
						<br> <br>
						
						<input type="submit" value="Register!" />	
					</form>
					
				</div>
				
				<div class="box" style="right:10%">
					<p class="title"> Already a user? Log in! <p>
					
					<form class="form" method="post" action="loginUser.php">
						<input type="text" name="username" placeholder="Username..." id="login_username"/>
						
						<br> <br> <br> 
						
						<input type="password" name="password" placeholder="Password..." id="login_password"/>
						
						<br> <br> <br>
						
						<input type="submit" value="Login!"/>
					</form>
					
					<p> Is the homepage empty? </p>
					<form action="dummy_data.php">
						<input type="submit" value="Click me for dummy data!"/>
					</form>
					
				</div>
				
			</div>
			
			<div class="add" style="right:15px">
				<h2 style="color:white">Absolute greatest place for ads!</h2>
			</div>		
		</div>
		
		
	</body>
</html> 