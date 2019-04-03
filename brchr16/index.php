<?php
session_start();
if ( ! empty( $_POST ) ) 
{
	if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) 
	{
		require_once('DbInfo.php');
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$getPw = $conn->prepare("SELECT password FROM user WHERE username=:username");
		$getPw->bindParam(':username', $_POST['username']);
		$getPw->execute();
		$temp = $getPw->fetch();
		$tempPw = $temp['password'];
		$conn = null;
		
		
		
		if ( $_POST['password'] == $tempPw ) 
		{
    		$_SESSION['user_id'] = $_POST['username'];
			$_SESSION['valid'] = true;
			$_SESSION['timeout'] = time();
			 header("Location: Picture.php");
			 
		}
		else 
		{
			session_destroy();
			header("Location: index.php");
			
		}
	}
}

?>
<!DOCTYPE html>
<body>
<form onsubmit="" method="post">
    <label for="name">name</label>
    <br> 
    <input type="text" name="username" id="username" required/> 
    <br> 
    <label for="password">password</label>
    <br> 
    <input type="password" name="password" id="password" required/> 
    <br>
    <input type="submit" value="login" id="login"/> 
</form>
<a href = "signuppage.php"> Signup </a>
<br>
<div id="ajaxcontainer"></div>

<script>
function ajax() {
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		document.getElementById("ajaxcontainer").innerHTML = this.responseText;
	}
};
xmlhttp.open("GET", "HelloWorld.php", true);
xmlhttp.send();
}


function js() {

document.getElementById("ajaxcontainer").innerHTML = Math.random()*10000;
}
setInterval(ajax, 1000);
</script>
</body>
</html>

