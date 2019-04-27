<?php 

	if(!isset($_SESSION['passwordMismatch'])) {
		$_SESSION['passwordMismatch'] = false;
	}

	//sets usernameExists parameter
	if(!isset($_SESSION['usernameExists'])) {
		$_SESSION['usernameExists'] = false;
	}

	//sets emailExists parameter
	if(!isset($_SESSION['emailExists'])) {
		$_SESSION['emailExists'] = false;
	}

	if(!isset($_SESSION['count'])) {
		$_SESSION['count'] = 20;
	}

	//If login password and username does not match, send alert 
	if($_SESSION['passwordMismatch']) {
		echo "<script> alert('Password and Username does not match!'); </script>";
		$_SESSION['passwordMismatch'] = false;
	}

	//If username exists in DB, send alert
	if($_SESSION['usernameExists']) {
		echo "<script> alert('Username already exists! Please choose another.'); </script>";
		$_SESSION['usernameExists'] = false;
	}

	//If email exists in DB, send alert
	if($_SESSION['emailExists']) {
		echo "<script> alert('Email already exists!'); </script>";
		$_SESSION['emailExists'] = false;
	}

?>
<html>
	<head>	
		<link rel="stylesheet" type="text/css" href="/Flore17/mvc/public/style.css">
		<script src="/Flore17/mvc/public/javascript.js"></script>
	</head>
	
	<body>

	<?php include '../app/views/partials/menu.php'; ?>

	<?php include '../app/views/partials/add.php'; ?>

	<div class="maincolumn">
		
		<div class="header1"><h1>Members login ind here:</h1></div>
		
		<?php include '../app/views/partials/loginForm.php'; ?>
			
		<?php include '../app/views/partials/signin.php'; ?>
			
	</div>

	<?php include '../app/views/partials/add.php'; ?>

	</body>
</html>