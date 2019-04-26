
<html>
<head>
<title> Assignment 1</title>



<link rel="stylesheet" type= "text/css" href="style.css">
</head>
<body>
<form  method ="post" action = "storing.php">
	<div class="loginbox">
	
	<img src="images/adele3.jpg"class="avatar">
	<h1> Login Here</h1>
	
	
	
	<p>User name</p>
<input id= "usernameField" input type="text" name="username" onblur="checkUsername()" placeholder="Enter Username" required><br>
	
	<p>Password</p>
 <input id= "passwordField" input type="Password" name="password" onblur="checkPassword()" placeholder="Enter password" required>
	<br>
	<input  type="submit" value="login" />
	
    
</form> 
<script>
function checkUsername() {



    var username = document.getElementById("usernameField").value;
    var regex = /^[a-zA-Z\d]{5,20}$/;


    if (regex.test(username)) {
        document.getElementById("usernameField").style.color = "green";
        return regex.test(username);

    }
    else {
        document.getElementById("usernameField").style.color = "red";
        return regex.test(username)
    }

}
function checkPassword() {


/*An <input> element with type="password" that must contain 6 or more characters 
 that are of at least one number, and one uppercase and lowercase letter:*/
    var password = document.getElementById("passwordField").value;
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/;


    if (regex.test(password)) {
        document.getElementById("passwordField").style.color = "green";
        return regex.test(password);

    }
    else {
        document.getElementById("passwordField").style.color = "red";
        return regex.test(password)
    }
	
}
</script>

	<a href="registerUserPage.php">Do not have an account</a><br>
	

	</form>

	
	
</div>

</body>

</html>