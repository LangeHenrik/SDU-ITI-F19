<?php

session_start();

if((isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
	header("location: index.php");
}

require_once "db_conn.php";
 
$username = $password = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
	$sql = "SELECT id, username, password FROM users WHERE username = :username";
	
	if($stmt = $conn->prepare($sql)){
		
		$stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
        $param_username = trim($_POST["username"]);
		
		if($stmt->execute()){
			if($stmt->rowCount() == 1){
				if($row = $stmt->fetch()){
					$id = $row["id"];
					$username = $row["username"];
					$password = $row["password"];
					if($password == trim($_POST["password"])){
						session_start();
						
						$_SESSION["loggedin"] = true;
						$_SESSION["id"] = $id;
						$_SESSION["username"] = $username;                            
						
						header("location: index.php");
					} else{
						echo "The password you entered was not valid.";
					}
				}
			} else{
				echo "No account found with that username.";
			}
		} else{
			echo "Oops! Something went wrong. Please try again later.";
		}
	}

	unset($conn);
	unset($stmt);
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
	<title> </title>
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
		<h1 class="fh5co-logo"><a class="navbar-brand" href="index.php"> </a></h1>
		<ul>
			<li class="active"><a href="index.php">Home</a></li>
			<li><a href="upload.php">Upload</a></li>
			<li><a href="users.php">Users</a></li>
			<li><a href="register.php">Register</a></li>
		</ul>
		<?php if((isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
			echo '<?php if((isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){';
		} ?>
	</div>
	<header id="fh5co-header" role="banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<a href="#" class="fh5co-menu-btn js-fh5co-menu-btn">Menu <i class="icon-menu"></i></a>
					<a class="navbar-brand" href="index.php"> </a>		
				</div>
			</div>
		</div>
	</header>
	<!-- END .header -->

	<div id="fh5co-main">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<h2>Login</h2>
					<div class="fh5co-spacer fh5co-spacer-sm"></div>
					<form name="loginform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
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
							<div class="col-md-12">
								<div class="form-group">
									<input type="submit" class="btn btn-primary" value="Login">
								</div>
							</div>
						</div>
					</form>
					<p>Don't have an account? <a href="register.php">Register here</a></p>
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
