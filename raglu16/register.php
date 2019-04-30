<?php

session_start();

require_once "db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$sql = "SELECT id FROM users WHERE username = :username";
	
	$valid_input = False;
	
	if($stmt = $conn->prepare($sql)){
		$stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
		
		$param_username = trim($_POST["username"]);
		
		if($stmt->execute()){
			if($stmt->rowCount() == 1){
				echo "This username is already taken.";
				$valid_input = False;
			} else{
				$valid_input = True;
			}
		} else{
			echo "Oops! Something went wrong. Please try again later.";
		}
	}
	
	$sql = "SELECT id FROM users WHERE email = :email";
	
	if($stmt = $conn->prepare($sql) and $valid_input){
		$stmt->bindParam(":email", $param_username, PDO::PARAM_STR);
		
		$param_username = trim($_POST["email"]);
		
		if($stmt->execute()){
			if($stmt->rowCount() == 1){
				echo "This E-mail is already taken.";
				$valid_input = False;
			} else{
				$valid_input = True;
			}
		} else{
			echo "Oops! Something went wrong. Please try again later.";
		}
	}
	
	if($_POST["password"] == $_POST["confirm_password"] and $valid_input){
		$valid_input = True;
	} else {
		echo "Password does not match.";
		$valid_input = False;
	}
	
    $sql = "INSERT INTO users (username, password, firstname, lastname, zip, city, email, phonenumber) VALUES (:username, :password, :firstname, :lastname, :zip, :city, :email, :phonenumber)";
	
    if ($stmt = $conn->prepare($sql) and $valid_input) {
        $stmt->bindParam(":username", $_POST["username"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $_POST["password"], PDO::PARAM_STR);
		$stmt->bindParam(":firstname", $_POST["firstname"], PDO::PARAM_STR);
		$stmt->bindParam(":lastname", $_POST["lastname"], PDO::PARAM_STR);
		$stmt->bindParam(":zip", $_POST["zip"], PDO::PARAM_INT);
		$stmt->bindParam(":city", $_POST["city"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $_POST["email"], PDO::PARAM_STR);
		$stmt->bindParam(":phonenumber", $_POST["phonenumber"], PDO::PARAM_INT);
		
        if ($stmt->execute()) {
            echo "Your new account has successfully been created.";
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }

    unset($stmt);
    unset($conn);
}
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Hydrogen</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<!-- Google Webfonts -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">
	<!-- Salvattore -->
	<link rel="stylesheet" href="css/salvattore.css">
	<!-- Theme Style -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	<div id="fh5co-offcanvass">
		<a href="#" class="fh5co-offcanvass-close js-fh5co-offcanvass-close">Menu <i class="icon-cross"></i> </a>
		<h1 class="fh5co-logo"><a class="navbar-brand" href="index.php">Hydrogen</a></h1>
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="upload.php">Upload</a></li>
			<li><a href="users.php">Users</a></li>
			<li class="active"><a href="register.php">Register</a></li>
		</ul>
		<?php if((isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
			echo '<a href="logout.php" class="btn btn-primary">Logout</a>';
		} ?>
	</div>
	<header id="fh5co-header" role="banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<a href="#" class="fh5co-menu-btn js-fh5co-menu-btn">Menu <i class="icon-menu"></i></a>
					<a class="navbar-brand" href="index.php">Hydrogen</a>		
				</div>
			</div>
		</div>
	</header>
	<!-- END .header -->

	<div id="fh5co-main">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<h2>Register</h2>
					<div class="fh5co-spacer fh5co-spacer-sm"></div>
					<form name="registerform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()" method="post">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" name="username" placeholder="Username" required>	
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="password" class="form-control" name="password"  placeholder="Password" required>
								</div>
							</div>
							<div class="col-md-6">
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="password" class="form-control" name="confirm_password" placeholder="Confirm password" required>	
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" name="firstname" placeholder="First name" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" name="lastname" placeholder="Last name" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" name="zip" placeholder="Zip" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" name="city" placeholder="City" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" name="email" placeholder="E-mail" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" name="phonenumber" placeholder="Phone Number" required>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="submit" class="btn btn-primary" value="Register">
								</div>
							</div>
						</div>
					</form>
					<p>Already have an account? <a href="login.php">Login here</a></p>
				</div>	
        	</div>
       </div>
	</div>

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<!-- Salvattore -->
	<script src="js/salvattore.min.js"></script>
	<!-- Main JS -->
	<script src="js/main.js"></script>
	
	</body>
</html>
