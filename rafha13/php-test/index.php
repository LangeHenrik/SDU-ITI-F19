<html>

	<h1> Hello World </h1>
	
	<br><br>
	
	<form method="POST" action="">
	
		<input type="text" name="username" placeholder="username..."\>
	
		<br><br>
	
		<input type="text" name="password" placeholder="password..."\>
		<input type="Submit"\>
	
	</form>
	
</html>

<?php
	if(isset($_POST['username']) && !empty($_POST['username'])){
		// indsæt her form recognition formuleret som if($_POST[“username”] == “john”)
		echo "Your username is: ";
		echo $_POST['username'];
		echo "<br>";
	}

	if(isset($_POST['password']) && !empty($_POST['password'])){
		// indsæt her form recognition formuleret som if($_POST[“username”] == “john”)
		echo "Your password is: ";
		echo $_POST['password'];
		echo "<br>";
	}
	
?>