<?php
if (session_status() ==	 PHP_SESSION_NONE){
	session_start();
}?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register a new user</title>
</head>

<body>
<?php
require_once "db_config.php";

$regex_fullname="/[a-z|A-Z]{1,}\\s[a-z|A-Z]{1,}/";
$regex_username="/^[a-z0-9]+$/";
$regex_password="/^(?=.+\d).{8,}$/";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$username=$_POST["username"];
	$password=$_POST["password"];
	$fullname=$_POST["fullname"];
	$reenter=$_POST["newPass"];
	
	$isUsernameFilled = False;
	if(empty(!$username) && preg_match($regex_username, $username)){
		$isUsernameFilled = True;
	}else{
		echo '<br> <div>Illegal characters in username</div>';
	}
	
	$isPasswordFilled = False;
	if(empty(!$password) && preg_match($regex_password, $password)){
		$isPasswordFilled = True;
	}else{
		'<br> <div>Password must be 8 characters long</div>';
	}
	
	$isFullnameFilled = False;
	if(empty(!$fullname) && preg_match($regex_fullname, $fullname)){
		$isFullnameFilled = True;
	}
	
	$isReenterFilled = False;
	if(empty(!$reenter) && $password == $reenter){
		$isReenterFilled = True;
	}else{
		echo '<br> <div>Password is not the same</div>';
	}
	
	if($isUsernameFilled && $isPasswordFilled && $isFullnameFilled && $isReenterFilled){
		$sql = "SELECT 1 FROM user WHERE username = :username;";
		$statement = $con -> prepare($sql);
		$statement -> bindParam(":username", $_POST["username"]);
		$statement -> execute();
		
		$alreadyInDB = $statement -> fetchColumn();
		if($alreadyInDB){
			echo '<br> <div>User already exists</div>';
		}else{
			$sql = "INSERT into user (username,name,password) values (:username,:fullname,:password);";
			$statement = $con -> prepare($sql);
			$statement -> bindParam(":username",$username);
			$statement -> bindParam(":fullname",$fullname);
			$statement -> bindParam(":password",$password);
			$statement -> execute();
			
			$_SESSION['user'] = $_POST["username"];
			header("Location: imagepage.php");
		}
	}
	
	
}
?>
<div>
    <form method="post">
    <h1>Register a new user</h1>
    <input id="full" name="fullname" placeholder="Full name" type="text"><br>
	<input name="username" placeholder="Username" type="text" onkeyup="showHint(this.value)">
	<span>Suggestions: </span><span id="txtHint"></span>
	<br>
    <input name="password" placeholder="Password" type="password"><br>
    <input name="newPass" placeholder="Re-enter password" type="password"><br>
    
	<script>
	function showHint(str){
		if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "gethint.php?q="+str, true);
        xmlhttp.send();
    }
	}
	</script>
    <div>
        <input type="submit" value="Register">
        <p style="font-size: larger">Already have a user registered? <a href="index.php"> Log in</a></p>
    </div>
    </form>
</div>


</body>
</html>