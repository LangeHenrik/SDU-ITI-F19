<?php 
 	if(session_status()==PHP_SESSION_NONE){
 		session_start();

 	} 
 	if(isset($_SESSION["logged_in"]) && !$_SESSION["logged_in"]){
 		header("Location:index.php");
 	
 	}
//if(!$SESSION["logged_in"]){
 	//	header("location:index.php");

	$logged_in=false;
	$username_box=true;
	$password_box=true;
	
	if (isset($_POST["username"])){	
		$username_box=false;
		
		$entered_username=filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
		$entered_password=filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
		
		$entered_username=htmlentities($entered_username);
		$entered_password=htmlentities($entered_password);
		require_once 'db_config.php';
			
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname",
			$username,
			$password,
			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		
			$query = $conn->prepare("SELECT user_password FROM user_login WHERE user_name = :username;");
			 
			$query->bindParam(':username',$entered_username);
			$query->execute();
			$query->setFetchMode(PDO::FETCH_ASSOC);
			$result = $query->fetchAll();
			
			$passwordHash = $result[0]['user_password'];
			
			if (!empty($result)){
				$password_box=false;
				$username_box=true;
				if (password_verify($entered_password, $passwordHash)) {
					$logged_in=true;
					$password_box=true;
				}
			}
		} catch (PDOException $e) {
			$error = $e->getMessage();
			echo "Error: " . $error;
		}
		
		$conn = null;		
	}
	if ($logged_in===true){
		$_SESSION["logged_in"]=true;
		header("Location:upload_page.php");
	}
?>

   
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	<link rel="stylesheet" type="text/css" href="Styling_index.css">
	<title></title>
</head>
<body>
		<div id="menu_bar"> 
	<button id="registerUser" class="menu_bar_button">Register</button> 
	<button id="login" class="menu_bar_button">Login</button>
</div>

<div id="left_white_bar">&nbsp;<a href="https://mail-order-bride.net/"> <div id="left_bar"> <img src="kissrus.png" alt ="russianBride" id="leftBride"> <p id="left_white_bar_text">Click To Order Russian Bride!</p></div></div>

</a>
	<div id="right_white_bar">&nbsp; <a href="https://sendacake.com/"><div id="right_bar"><img src="cake.jpg" alt ="cake" id="rightCake"> <p>Click to Order Cake!</p></div></div>
		</a>
		<form class="login" action="index.php" method="post">
		<label id="username">Username</label>
		<br>
		<input placeholder="Enter Username" type="text" name="username">
		<br>
		<label id="password">Password</label>
		<br>
		<input placeholder="Enter Password" type="password" name="password">
		<br>
		<input type="submit" name="submit" class="submit">

		<p>Don't have an account?<a href="register_user.php">Register</a>.</p>


		</form>



</body>
</html>