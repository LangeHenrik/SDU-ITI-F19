<!doctype html>
<?php session_start();?>
<html>
<head>
	<meta charset="utf-8">
	<title>Log in</title>
	<link href="style.css" rel="stylesheet" type="text/css" media="all" />
	  
</head>

<body style="background-color: lightgray">
	<script type="text/javascript">
		function checkLogin(){
			if(myform.username.value==""){
				alert("Please enter your username!");
				myform.username.focus();
				return false;
			}
			else if(myform.password.value==""){
				alert("Please enter your password!");
				myform.password.focus();
				return false;
			}
		}
	
	</script>
	
	<div class="message warning">
	<div class="inset">
	<div class="login-head">
		<h1>Log in</h1>
		 <div class="alert-close"> </div> 			
	</div>
	
	
	
	
	
	
	
	<form method="post" name="myform">
		<li>
       <input id="Text1" type="text" name="username" placeholder="Username" /></li>
    	<li>
       <input id="Password2" type="password" name="password" placeholder="Password"  /></li>
    
       <div class="submit">
        &nbsp;<input id="Submit2" type="submit" value="Submit" onClick="return checkLogin()"/>
              <h3><a href="Register.php">Create Account</a></h3> 
          <div class="clear"> </div>
        </div>
		<!---
		username:<input type="text" name="username"/><br/>
		password:<input type="password" name="password"/><br/>
		<input type="submit" value="Login" onClick="return checkLogin()"><br/>
		<a href="Register.php">Register</a>
		-->
	</form>
		</div>
	</div>
		<div class="clear"> </div>
	<?php
	$conn = mysqli_connect("localhost","root","","shzha19") or die('Unable to connect!');
	mysqli_query($conn,"set names utf8");
	if(isset($_POST["username"])){
		$name = $_POST["username"];
		$password = $_POST["password"];
		$password = md5($password);
		$_SESSION["username"]=$name;
		$cmdStr = "select password from usersinfo where username = '{$name}'";
		$result = mysqli_query($conn, $cmdStr);
		$myrow = mysqli_fetch_array($result);
		$pwd_from_data = $myrow[0];
		if($password == $pwd_from_data){
			//header("Location:testuser.php?username="."{$name}");
			header("Location:pictures.php");
		}
		else{
			echo "<script>alert('Your username or password is wrong!')</script>";
		}
		

		
				
	}
	?>


	
	
	

	
</body>
</html>