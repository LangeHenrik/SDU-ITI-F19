<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
		$sql = "SELECT user_id FROM users WHERE username = :username";
		
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
				echo "Something went wrong. Please try again later.";
			}
		}
		
		$sql = "SELECT user_id FROM users WHERE email = :email";
		
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
				echo "Something went wrong. Please try again later.";
			}
		}
		
		$sql = "INSERT INTO users (username, password, firstname, lastname, zip, city, email, phonenumber) VALUES (:username, :password, :firstname, :lastname, :zip, :city, :email, :phonenumber)";
		
		if ($stmt = $conn->prepare($sql) and $valid_input) {
			
			$hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
			
			$stmt->bindParam(":username", $_POST["username"], PDO::PARAM_STR);
			$stmt->bindParam(":password", $hash, PDO::PARAM_STR);
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

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Register</title>
		
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
		<a href="#" class="fh5co-offcanvass-close js-fh5co-offcanvass-close">Menu  </a>
		<h1 class="fh5co-logo"><a class="navbar-brand" href="../home/">Image Heap</a></h1>
		<ul>
			<li><a href="../home/">Home</a></li>
			<li><a href="../upload/">Upload</a></li>
			<li><a href="../users/">Users</a></li>
			<li class="active"><a href="../register/">Register</a></li>
		</ul>
		<?php if((isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true)){
			echo '<a href="logout.php" class="btn btn-primary">Logout</a>';
		} ?>
	</div>
	<header id="fh5co-header" role="banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<a href="#" class="fh5co-menu-btn js-fh5co-menu-btn">Menu </a>
					<a class="navbar-brand" href="../home/">Image Heap</a>		
				</div>
			</div>
		</div>
	</header>
	<!-- END .header -->
	
	<script type="text/javascript">
	
		function checkUsername() {
			var username = document.getElementById("username").value;
			var paragraph = document.getElementById("username_alert");
			regex_Username = /[a-z]{1,255}$/g
			
			if(regex_Username.test(username)){
				paragraph.style.display = "none";
				document.getElementById("buttonSubmit").disabled = false;
			}else{
				paragraph.style.display = "block";
				document.getElementById("buttonSubmit").disabled = true;
			}
		}
		
		function checkPassword() {
			var password = document.getElementById("password").value;
			var paragraph = document.getElementById("password_alert");
			regex_password = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/g
			
			if(regex_password.test(password)){
				paragraph.style.display = "none";
				document.getElementById("buttonSubmit").disabled = false;
			}else{
				paragraph.style.display = "block";
				document.getElementById("buttonSubmit").disabled = true;
			}
		}
		
		function checkConfirmPassword() {
			var password = document.getElementById("password").value;
			var confirm_password = document.getElementById("confirm_password").value;
			var paragraph = document.getElementById("confirm_password_alert");
			
			if(confirm_password === password){
				paragraph.style.display = "none";
				document.getElementById("buttonSubmit").disabled = false;
			}else{
				paragraph.style.display = "block";
				document.getElementById("buttonSubmit").disabled = true;
			}
		}
		
		function checkFirstName() {
			var firstName = document.getElementById("firstname").value;
			var paragraph = document.getElementById("firstname_alert");
			regex_firstName = /[a-z]{1,255}$/g
			
			if(regex_firstName.test(firstName)){
				paragraph.style.display = "none";
				document.getElementById("buttonSubmit").disabled = false;
			}else{
				paragraph.style.display = "block";
				document.getElementById("buttonSubmit").disabled = true;
			}
		}
		
		function checkLastName() {
			var lastName = document.getElementById("lastname").value;
			var paragraph = document.getElementById("lastname_alert");
			regex_lastName = /[a-z]{0,255}$/g
			
			if(regex_lastName.test(lastName)){
				paragraph.style.display = "none";
				document.getElementById("buttonSubmit").disabled = false;
			}else{
				paragraph.style.display = "block";
				document.getElementById("buttonSubmit").disabled = true;
			}
		}
		
		function checkZip() {
			var zip = document.getElementById("zip").value;
			var paragraph = document.getElementById("zip_alert");
			regex_zip = /^[0-9]{4}$/g
			
			if(regex_zip.test(zip)){
				paragraph.style.display = "none";
				document.getElementById("buttonSubmit").disabled = false;
			}else{
				paragraph.style.display = "block";
				document.getElementById("buttonSubmit").disabled = true;
			}
		}
		
		function checkCity() {
			var city = document.getElementById("city").value;
			var paragraph = document.getElementById("city_alert");
			regex_city = /[a-z]{1,255}$/g
			
			if(regex_city.test(city)){
				paragraph.style.display = "none";
				document.getElementById("buttonSubmit").disabled = false;
			}else{
				paragraph.style.display = "block";
				document.getElementById("buttonSubmit").disabled = true;
			}
		}
		
		function checkEmail() {
			var email = document.getElementById("email").value;
			var paragraph = document.getElementById("email_alert");
			regex_email = /^([a-z]+[.]?[a-z]+)+@([a-z]+[.]?[a-z]+)+[.][a-z]{2,5}$/g
			
			if(regex_email.test(email)){
				paragraph.style.display = "none";
				document.getElementById("buttonSubmit").disabled = false;
			}else{
				paragraph.style.display = "block";
				document.getElementById("buttonSubmit").disabled = true;
			}
		}
		
		function checkPhoneNumber() {
			var phoneNumber = document.getElementById("phonenumber").value;
			var paragraph = document.getElementById("phonenumber_alert");
			regex_phoneNumber = /^[0-9]{8,30}$/g
			
			if(regex_phoneNumber.test(phoneNumber)){
				paragraph.style.display = "none";
				document.getElementById("buttonSubmit").disabled = false;
			}else{
				paragraph.style.display = "block";
				document.getElementById("buttonSubmit").disabled = true;
			}
		}
		
	</script>

	<div id="fh5co-main">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<h2>Register</h2>
					<div class="fh5co-spacer fh5co-spacer-sm"></div>
					<form name="registerform" autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="row">
							<div class="col-md-6">
							<div class="form-group" >
								<input type="text" id="username" class="form-control" name="username" placeholder="Username" required oninput="checkUsername()">	
								<div id="username_alert" style="display:none">
									Please enter a username.
								</div>
							</div></div>
							<div class="col-md-6">
							<div class="form-group" >
								<input id="password" type="password" class="form-control" name="password" placeholder="Password" required oninput="checkPassword()">
								<div id="password_alert" style="display:none">
									Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters
								</div>
							</div>
							</div>
							<div class="col-md-6">
							</div>
							<div class="col-md-6">
							<div class="form-group" >
								<input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="Confirm password" required oninput="checkConfirmPassword()">	
								<div id="confirm_password_alert" style="display:none">
									Password does not match.
								</div>
							</div></div>
							<div class="col-md-6">
							<div class="form-group" >
								<input type="text" id="firstname" class="form-control" name="firstname" placeholder="First name" required oninput="checkFirstName()">
								<div id="firstname_alert" style="display:none">
									First name must contain a character.
								</div>
							</div></div>
							<div class="col-md-6">
							<div class="form-group" >
								<input type="text" id="lastname" class="form-control" name="lastname" placeholder="Last name" required oninput="checkLastName()">
								<div id="lastname_alert" style="display:none">
									Last name must contain a character.
								</div>
							</div></div>
							<div class="col-md-6">
							<div class="form-group" >
								<input type="text" id="zip" class="form-control" name="zip" placeholder="Zip" required oninput="checkZip()">
								<div id="zip_alert" style="display:none">
									Zip must contain a 4 digit number.
								</div>
							</div></div>
							<div class="col-md-6">
							<div class="form-group" >
								<input type="text" id="city" class="form-control" name="city" placeholder="City" required oninput="checkCity()">
								<div id="city_alert" style="display:none">
									City must contain a character.
								</div>
							</div></div>
							<div class="col-md-6">
							<div class="form-group" >
								<input type="text" id="email" class="form-control" name="email" placeholder="E-mail" required oninput="checkEmail()">
								<div id="email_alert" style="display:none">
									Please enter a valid email.
								</div>
							</div></div>
							<div class="col-md-6">
							<div class="form-group" >
								<input type="text" id="phonenumber" class="form-control" name="phonenumber" placeholder="Phone Number" required oninput="checkPhoneNumber()">
								<div id="phonenumber_alert" style="display:none">
									Please enter a valid phone number (at least 8 digits).
								</div>
							</div></div>
							<div class="col-md-12">
								<input type="submit" id="buttonSubmit" class="btn btn-primary" value="Register">
								<div class="form-group">
								</div>
							</div>
						</div>
					</form>
					<p>Already have an account? <a href="../login/">Login here</a></p>
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
