<?php 
	require 'Logout_required.php';


	$post_username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
	$post_password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
	$repeat_password = filter_input(INPUT_POST, "password_repeat", FILTER_SANITIZE_STRING);
	$email =  filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
	$phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_NUMBER_INT);
	$zip = filter_input(INPUT_POST, "zip", FILTER_SANITIZE_NUMBER_INT);
	$first_name = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_STRING);
	$last_name = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_STRING);
	$city = filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING);
	
	$post_username = htmlentities($post_username);
	$post_password = htmlentities($post_password);
	$repeat_password = htmlentities($repeat_password);
	$email = htmlentities($email);
	$phone = htmlentities($phone);
	$zip = htmlentities($zip);
	$first_name = htmlentities($first_name);
	$last_name = htmlentities($last_name);
	$city = htmlentities($city);
	
	$regex_Username = "/^([A-Za-z0-9]){1}([A-z0-9]|[-_]){0,19}$/";
	$regex_Password = "/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\S{8,})/";
	$regex_Name = "/^[A-Z]([a-z]{0,99})$/";
	$regex_Name_last = "/^[A-Z]([a-z]{0,99})$/";
	$regex_Email = "/(^([A-z]+[.]?[A-z]+)+@([A-z]+[.]?[A-z]+)+[.][a-z]{2,5}$)/";
	$regex_Phone = "/^[+][0-9]{8,30}$/";
	$regex_Zip = "/^[0-9]{4}$/";
	$regex_City = "/^(?=.[a-zA-Z ]{1,99}$)(^([A-Z]([a-z]*)+\s?)+$)/";
	
	$username_match = preg_match($regex_Username, $post_username);
	$password_match = preg_match($regex_Password, $post_password);
	$first_name_match = preg_match($regex_Name, $first_name);
	$last_name_match = preg_match($regex_Name_last, $last_name);
	$email_match = preg_match($regex_Email, $email);
	$phone_match = preg_match($regex_Phone, $phone);
	$zip_match = preg_match($regex_Zip, $zip);
	$city_match = preg_match($regex_City, $city);
	
	if ($post_password === $repeat_password){
		$repeat_password_match = 1;
		$passwordHash = password_Hash($post_password, PASSWORD_DEFAULT);
	} else {
		$repeat_password_match = 0;
	}

	if ($username_match && $password_match && $repeat_password_match && $first_name_match && $last_name_match && $email_match && $phone_match && $zip_match && $city_match){
		
		require_once 'db_config.php';
		
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname",
			$username,
			$password,
			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	
	
			$check_username = $conn->prepare("SELECT username FROM user WHERE username = :username;");
			
			$check_username->bindParam(':username',$post_username);
			$check_username->execute();
			$check_username->setFetchMode(PDO::FETCH_ASSOC);
			$result = $check_username->fetchAll();
			if (!empty($result)){
				$username_match=false;
			}
			
			$check_email = $conn->prepare("SELECT email FROM user WHERE email = :email;");
			$check_email->bindParam(':email',$email);
			
			$check_email->execute();
			$check_email->setFetchMode(PDO::FETCH_ASSOC);
			$result = $check_email->fetchAll();
			if (!empty($result)){
				$email_match=false;
			}
	
			if($username_match && $email_match){
				$stmt = $conn->prepare("INSERT INTO user(username, password_hash, email, phone, zip, first_name, last_name, city) VALUES(:username, :passwordHash, :email, :phone, :zip, :firstName, :lastName, :city);");
				
				$stmt->bindParam(':username',$post_username);
				$stmt->bindParam(':passwordHash',$passwordHash);
				$stmt->bindParam(':email',$email);
				$stmt->bindParam(':phone',$phone);
				$stmt->bindParam(':zip',$zip);
				$stmt->bindParam(':firstName',$first_name);
				$stmt->bindParam(':lastName',$last_name);
				$stmt->bindParam(':city',$city);
				
				$stmt->execute();
				
				$conn = null;	
				
				header("Location:Login.php");
			} else {
				$conn = null;	
			}
		} catch (PDOException $e) {
			$error = $e->getMessage();
			echo "Error: " . $error;
			$conn = null;	
		}
			
	}

?>

<html>    
	<head>        
		<title>HCHB's Exercise</title>
			<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --> 
			<!-- <link rel="shortcut icon" type="image/png" href="/favicon.png"/> --> 
			<!-- <body background="bgimage.jpg">  -->
			<!-- <body bgcolor="#E6E6FA">  -->
			<script src="RegisterUser.js"></script>
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
			<div class="content">
				<form action="RegisterUser.php" method="post" onsubmit="return checkFields()">
					<label for="username">Username</label>
					<br> 
					<?php
					if(isset($_POST["username"])){
						if($username_match){
							echo '<input type="text" name="username" id="username" value='.$post_username.' />';
						}else{
							echo '<input type="text" name="username" id="username" style="border:2px solid red;"/> ';
						}
					} else {
							echo '<input type="text" name="username" id="username"/>';
					}
					?>
					<br> 
					
					<label for="password">Password</label>
					<br> 
					<?php
					if(isset($_POST["password"])){
						if($password_match){
							echo '<input type="password" name="password" id="password" />';
						}else{
							echo '<input type="password" name="password" id="password" style="border:2px solid red;"/> ';
						}
					} else {
							echo '<input type="password" name="password" id="password"/>';
					}
					?>
					<br>
					
					<label for="password_repeat">Repeat password</label>
					<br>
					<?php
					if(isset($_POST["password_repeat"])){
						if($repeat_password_match){
							echo '<input type="password" name="password_repeat" id="password_repeat" />';
						}else{
							echo '<input type="password" name="password_repeat" id="password_repeat" style="border:2px solid red;"/> ';
						}
					} else {
							echo '<input type="password" name="password_repeat" id="password_repeat"/>';
					}
					?>
					<br> 
					
					<label for="email">Email adress</label>
					<br>
					<?php
					if(isset($_POST["email"])){
						if($email_match){
							echo '<input type="text" name="email" id="email" value='.$email.' />';
						}else{
							echo '<input type="text" name="email" id="email" style="border:2px solid red;"/> ';
						}
					} else {
							echo '<input type="text" name="email" id="email"/>';
					}
					?>
					<br> 
					
					<label for="phone">phone number</label>
					<br>
					<?php
					if(isset($_POST["phone"])){
						if($phone_match){
							echo '<input type="text" name="phone" id="phone" value='.$phone.' />';
						}else{
							echo '<input type="text" name="phone" id="phone" style="border:2px solid red;"/> ';
						}
					} else {
							echo '<input type="text" name="phone" id="phone"/>';
					}
					?>
					<br>
					
					<label for="zip">zip code</label>
					<br> 
					<?php
					if(isset($_POST["zip"])){
						if($zip_match){
							echo '<input type="text" name="zip" id="zip" value='.$zip.' />';
						}else{
							echo '<input type="text" name="zip" id="zip" style="border:2px solid red;"/> ';
						}
					} else {
							echo '<input type="text" name="zip" id="zip"/>';
					}
					?>
					<br> 
					
					<label for="first_name">First name</label>
					<br> 
					<?php
					if(isset($_POST["first_name"])){
						if($first_name_match){
							echo '<input type="text" name="first_name" id="first_name" value='.$first_name.' />';
						}else{
							echo '<input type="text" name="first_name" id="first_name" style="border:2px solid red;"/> ';
						}
					} else {
							echo '<input type="text" name="first_name" id="first_name"/>';
					}
					?>
					<br> 
					
					<label for="last_name">Last name</label>
					<br> 
					<?php
					if(isset($_POST["last_name"])){
						if($last_name_match){
							echo '<input type="text" name="last_name" id="last_name" value='.$last_name.' />';
						}else{
							echo '<input type="text" name="last_name" id="last_name" style="border:2px solid red;"/> ';
						}
					} else {
							echo '<input type="text" name="last_name" id="last_name"/>';
					}
					?>
					<br> 
					
					<label for="city">City</label>
					<br> 
					<?php
					if(isset($_POST["city"])){
						if($city_match){
							echo '<input type="text" name="city" id="city" value='.$city.' />';
						}else{
							echo '<input type="text" name="city" id="city" style="border:2px solid red;"/> ';
						}
					} else {
							echo '<input type="text" name="city" id="city"/>';
					}
					?>
					<br> 
					
					<input type="submit" name="submit" id="submit" value='register'/> 
				</form> 
			</div>
			<?php
				include 'GeneralContentRight.php';
			?>
		</div>
	</body>
</html>
