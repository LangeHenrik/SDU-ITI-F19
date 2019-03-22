<?php
if(isset($_POST["submit"])){
	$post_username = filter_input(INPUT_POST, "username",FILTER_SANITIZE_STRING);
	$post_password = filter_input(INPUT_POST, "password",FILTER_SANITIZE_STRING);
	$post_confirmPassword = filter_input(INPUT_POST, "confirmPassword",FILTER_SANITIZE_STRING);
	$post_firstName = filter_input(INPUT_POST, "firstName",FILTER_SANITIZE_STRING);
	$post_lastName = filter_input(INPUT_POST, "lastName",FILTER_SANITIZE_STRING);
	$post_postNumber = filter_input(INPUT_POST, "postNumber",FILTER_SANITIZE_STRING);
	$post_city = filter_input(INPUT_POST, "city",FILTER_SANITIZE_STRING);
	$post_email = filter_input(INPUT_POST, "email",FILTER_SANITIZE_STRING);
	$post_number = filter_input(INPUT_POST, "number",FILTER_SANITIZE_STRING);
	
	$post_username = htmlentities($post_username);
	$post_password = htmlentities($post_password);
	$post_confirmPassword = htmlentities($post_confirmPassword);
	$post_firstName = htmlentities($post_firstName);
	$post_lastName = htmlentities($post_lastName);
	$post_postNumber = htmlentities($post_postNumber);
	$post_city = htmlentities($post_city);
	$post_email = htmlentities($post_email);
	$post_number = htmlentities($post_number);
	
	$password_hash = password_hash($post_password, PASSWORD_DEFAULT);
	
	if ($post_password === $post_confirmPassword){
		$post_confirmPassword_match = 1;
		$passwordHash = password_hash($post_password, PASSWORD_DEFAULT);
	} else {
		$post_confirmPassword_match = 0;
	}
    
    try {
		require_once "db_config.php";
		
	
			$conn = new PDO("mysql:host=$servername;dbname=$dbname",
			$username,
			$password,
			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		
        $stmt = $conn->prepare("SELECT* FROM user_login WHERE user_name = :username");
		
		$stmt->bindParam(":username", $post_username);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
        $result = $stmt->fetchAll();
			
			print_r($result);
        if (empty($result)){
				$email_match=false;

        $stmt = $conn->prepare("INSERT INTO user_login(user_name,user_password,user_email) values (:username,:password,:emailAddress);");
        $stmt->bindParam(":username", $post_username);
        $stmt->bindParam(":password", $password_hash);
        $stmt->bindParam(":emailAddress",$post_email);
	

        $stmt->execute();
        $_SESSION['username'] = $post_username;
    	header("Location:index.php");
		
    }
    } catch (PDOException $e) {
		
        echo "Error: " . $e->getMessage();
    }
		
    $conn = null;
     
      
      
  	
}


?>

<!DOCTYPE html>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>

	<link rel="stylesheet" type="text/css" href="Styling_register.css">
		
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
		

	<div id="white_box">&nbsp;
		

	<form class="form-inline" onsubmit="return checkForm(this)" method="post">
	<h1>Register</h1>
	<p>Please enter your information to register</p>
	<label id="username">Username</label>
	<br>
	
	<input placeholder="Enter Username" type="text" name="username">
	<br>
	
	<label id="password">Password</label>
	<br>
	<input placeholder="Enter Password" type="Password" name="password">
	<br>
	<label id="confirmPassword">Confirm Password</label>
	<br>
	<input placeholder="Confirm Password" type="Password" name="confirmPassword">
	<br>
		<label id ="firstName">Firstname</label>
	<br>	
	<input placeholder="Enter Firstname" type="text" name="firstName">
	<br>
	<label placeholder="Enter Lastname" id ="lastName">Lastname</label>
	<br>
	<input type="text" name="lastName">
	<br>
	<label id ="postNumber">Postnumber</label>
	<br>
	<input type="text" name="postNumber">
	<br>
	<label id ="city">City</label>
	<br>
	<input type="text" name="city">
	<br>
	<label id ="email">Email</label>
	<br>
	<input type="text" name="email">
	<br>
	<label id ="number">Phone Number</label>
	<br>
	<input type="text" name="number">
	<br>
	<label></label>
	<input type="submit" name="submit" class="submit" >
	<p>Already have an account? <a href="index.php">Sign in</a>.</p>

		</form>
		</div>
		

		<script type="text/javascript">
		
		function checkForm(form){
			if(form.username.value==""){
				alert("Username must not be blank");
				form.username.focus();
				return false;

			}
			re = /^\w+$/;
			if(!re.test(form.username.value)){
				alert("Username must only contain letters, numbers and underscores!")
				form.username.focus();
				return false;
			}
			if(form.password.value!=form.confirmPassword.value){
				alert("Passwords must be equal")
				return false;	
				form.confirmPassword.focus();
			}
			if(form.password.value.length < 8 || form.confirmPassword.value.length < 8 ){
				alert("Password must contain at least 8 characters");
			
				form.confirmPassword.focus();
				return false;
			}
			 re = /[0-9]/;
			 if(!re.test(form.password.value)){
			 	alert("Password must contain at least one number!");
				form.confirmPassword.focus();
				return false;
			}
			 re = /[a-z]/;
			 if(!re.test(form.password.value)){
			 	alert("Password must contain at least one lowercase letter");
			 	form.confirmPassword.focus();
			 	return false;
			}
			 re = /[A-Z]/;
			 if(!re.test(form.password.value)){
			 	alert("Password must contain at least one uppercase letter");
			 	form.confirmPassword.focus();
			 	return false;
			 }
			 
			if(form.firstName.value==""||form.lastName.value==""){
					alert("Lastname and Firstname must not be blank!");
					form.firstName.focus();
					console.log("noo");
					return false;		
				}
			re = /[0-9]{4}/;
			if(!re.test(form.postNumber.value)){
				alert("Postalnumber must be 4 numbers only!")
				form.postNumber.focus();
				return false;
			}
			re = /^([a-zA-Z\u0080-\u024F]+(?:. |-| |'))*[a-zA-Z\u0080-\u024F]*$/;
			if(!re.test(form.city.value)){
				alert("city not right");
				form.city.focus();
				return false;
			}
			re = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
			if(!re.test(form.email.value)){
				alert("Email must contain @");
				return false;
			}
			re= /^\+?[0-9]{3,4}-?[0-9]{6,12}$/
			if(!re.test(form.number.value)){
				alert("Number must be landcode + number!");
					return false;
				}
			


			 else{			 	
			 
			 	return true;
			 }	
			 }

</script>
</body>
</html>