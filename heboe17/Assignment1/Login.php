<?php 
	require 'Logout_required.php';
?>

<?php	
	$loggedin=false;
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
		
			$query = $conn->prepare("SELECT password_hash FROM user WHERE username = :username;");
			 
			$query->bindParam(':username',$entered_username);
			$query->execute();
			$query->setFetchMode(PDO::FETCH_ASSOC);
			$result = $query->fetchAll();
			
			$passwordHash = $result[0]['password_hash'];
			
			if (!empty($result)){
				$password_box=false;
				$username_box=true;

				if (password_verify($entered_password, $passwordHash)) {
					$loggedin=true;
					$password_box=true;
				}
			}
		} catch (PDOException $e) {
			$error = $e->getMessage();
			echo "Error: " . $error;
		}
		
		$conn = null;		
	}

	if ($loggedin===true){
		$_SESSION["logged_in"]=true;
		header("Location:Posts.php");
	}
?>

<!DOCTYPE html>
<html>    
	<head>        
		<title>HCHB's Exercise</title>
			<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --> 
			<!-- <link rel="shortcut icon" type="image/png" href="/favicon.png"/> --> 
			<!-- <body background="bgimage.jpg">  -->
			<!-- <body bgcolor="#E6E6FA">  -->

			<script src="Login.js"></script>
			<link rel="stylesheet" type="text/css" href="GeneralLook.css">
	</head>
	<body>       
		<?php
			include 'NavigationBar.php';
		?>
			<div class='main'>

			<?php
				include 'GeneralContentLeft.php';
			?>
			
			<div class='content' id='login'>
				<form action="Login.php" method="post" onsubmit="return checkFields()">
					<br>
					<?php
					if($username_box){
						echo '<label for="username">Username</label>';
						echo '<br>';
						if(isset($_POST["username"])){
							echo '<input type="text" name="username" id="username" value='.$entered_username.' />';
						}else{
							echo '<input type="text" name="username" id="username"/>';
						}
					} else {
						echo '<label for="username">Invalid Username</label>';
						echo '<br>';
						echo '<input type="text" name="username" id="username" style="border:2px solid red;"/> ';
					}
					?>	
					<br>
					<?php
					if($password_box){
						echo '<label for="password">Password</label>';
						echo '<br>';
						echo '<input type="password" name="password" id="password"/> ';
					} else {
						echo '<label for="password">Invalid password</label>';
						echo '<br>';
						echo '<input type="password" name="password" id="password" style="border:2px solid red;"/> ';
					}
					?>	
					<br> 
					<input type="submit" name="submit" id="submit" value='Login'/> 	
				</form> 
				<a href="RegisterUser.php" class='button'> Register </a>		
			</div>

			<?php
				include 'GeneralContentRight.php';
			?>
		</div>
	</body>
</html>

