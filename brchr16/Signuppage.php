<?php
if ( !empty( $_POST ) ) 
{
	
	if ( checkFields() ) 
	{
		
		require_once('DbInfo.php');
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$getPw = $conn->prepare("INSERT INTO user (username, password, firstname, lastname, zip, city, email, phonenumber) VALUES (:username, :password, :firstname, :lastname, :zip, :city, :email, :phone);");
		$getPw->bindParam(':username', $_POST['username']);
		$getPw->bindParam(':password', $_POST['password']);
		$getPw->bindParam(':firstname', $_POST['firstname']);
		$getPw->bindParam(':lastname', $_POST['lastname']);
		$getPw->bindParam(':zip', $_POST['zip']);
		$getPw->bindParam(':city', $_POST['city']);
		$getPw->bindParam(':email', $_POST['email']);
		$getPw->bindParam(':phone', $_POST['phonenumber']);
		$getPw->execute();
		echo "User has been created, return to loginpage to log in";
		$conn = null;
		
	}
}
function checkFields(){
	$sucess = true;
	
	if(empty( $_POST['username'] )){
		$sucess = false;
		echo "forkert username";
	}
	if(empty( $_POST['password'] )){
		$sucess = false;
		echo "forkert pw";
	}
	
	if(empty( $_POST['firstname'] )){
		$sucess = false;
		echo "forkert fn";
	}
	if(empty( $_POST['lastname'] )){
		$sucess = false;
		echo "forkert ln";
	}
	if(empty( $_POST['zip'] )){
		$sucess = false;
		echo "forkert zip";
	}
	if(empty( $_POST['city'] )){
		$sucess = false;
		echo "forkert by";
	}
	if(empty( $_POST['email'] )){
		$sucess = false;
		echo "forkert mail";
	}
	if(empty( $_POST['phonenumber'] )){
		$sucess = false;
		echo "forkert tlf";
	}
	
	if(!$sucess){
		
		echo "something is wrong <br>";
	}
	return $sucess;
}

?>
<!DOCTYPE html>
<body>
<form onsubmit="" method="post">
    <label for="username">username</label>
    <br> 
    <input type="text" name="username" id="username" required/> 
    <br> 
    <label for="password">password</label>
    <br> 
    <input type="password" name="password" id="password" required/> 
    <br>
	<label for="repeat password">repeat password</label>
    <br> 
    <input type="password" name="repeat password" id="repeat password" required/> 
    <br>
    <label for="firstname">firstname</label>
    <br>
    <input type="text" name="firstname" id="firstname" required/> 
    <br> 
    <label for="lastname">lastname</label>
    <br>
    <input type="text" name="lastname" id="lastname" required/>
    <br> 
    <label for="zip">zip code</label>
    <br> 
    <input type="text" name="zip" id="zip" required/> 
    <br> 
	<label for="city">city</label>
    <br> 
    <input type="text" name="city" id="city" required/> 
    <br>
	<label for="email">email</label>
    <br> 
    <input type="text" name="email" id="email" required/> 
    <br> 
	<label for="phonenumber">phonenumber</label>
    <br> 
    <input type="text" name="phonenumber" id="phonenumber" required/> 
    <br> 
    <input type="submit" value="create user" id="submit"/> 
</form>
<a href = "index.php"> Return to loginpage </a>
</body>
</html>