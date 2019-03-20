<?php
?>
<!DOCTYPE html>

<html>

<head>

	<title> Register </title>  
	
	<link rel="stylesheet" type="text/css" href="css.css">

</head>

<body>

<form method="POST" action="login.php" onSubmit= "return Validate()" name="validateForm" margin-left="20%" >

<hr border = "2">

 <h1> Register as user </h1> 
  <div class="container">
	<div>
		<label ><b>Username</b></label>
		<input type="text" placeholder="Enter Username" id="username" required>
		
		<div id="username_error" > </div>
	</div>
	
	<br/>
	
	<div>
		<label> <b>Password</b></label>
		<input type="password" placeholder="Enter Password" id="userPassword" required>
		
	</div>
	
	<br/>
	
	<div>
		<label> <b>Repeat Password</b></label>
		<input type="password" placeholder="Repeat Password" id="repeatPassword" required>
		
		<div id="repassword_error" > </div>
	</div>
	
	<br/>
	
	<div>
		<label> <b>First name</b></label>
		<input type="text" placeholder="Enter first name" id="firstName" required>
		
		<div id="firstName_error"> </div>
		
	</div>

	<br/>
	
	<div>
		<label> <b>Last name</b></label>
		<input type="text" placeholder="Enter last name" id="lastName" required>
		
		<div id="lastName_error"> </div>
		
	</div>

	<br/>
	
	<div>
		<label> <b>Zip code</b></label>
		<input type="text" placeholder="Enter Zip code" id="zipCode" required>
		
		<div id="zipCode_error"> </div>
		
	</div>

	<br/>
	
	<div>
		<label> <b>City</b></label>
		<input type="text" placeholder="City" id="city" required>
		
		<div id="city_error"> </div>
	
	</div>

	<br/>
	
	<div>
		<label> <b>Email</b></label>
		<input type="email" placeholder="Email" id="email" required>
		
	</div>

	<br/>
	
	<div>
		<label> <b>Phone number</b></label>
		<input type="text" placeholder="Phone number" id="phoneNumber" required>
		
		<div id="phoneNumber_error"> </div>
	</div>

	<br/>
	
	<button type="submit" formnovalidate formaction = "./login.php"> Back </button>	
    <button type="submit" value="Register" name="register_user"> Register </button>	

  </div>

 <hr>
</form>

<script>

	var username = document.getElementById("username");
	var password = document.getElementById("userPassword");
	var repeatPassword = document.getElementById("repeatPassword");
	var firstName = document.getElementById("firstName");
	var lastName = document.getElementById("lastName");
	var zipCode = document.getElementById("zipCode");
	var city = document.getElementById("city");
	var email = document.getElementById("email");
	var phoneNumber = document.getElementById("phoneNumber");
	
	//Error displaying
	var name_error = document.getElementById("name_error");
	var password_error = document.getElementById("password_error");
	var firstName_error = document.getElementById("firstName_error");
	var lastName_error = document.getElementById("lastName_error");
	var zipCode_error = document.getElementById("zipCode_error");
	var city_error = document.getElementById("city_error");
	var phoneNumber_error = document.getElementById("phoneNumber_error");
	
	//Set event listeners
	//Blur = when element lose focus
	
	username.addEventListener("blur", nameVerify);
	password.addEventListener("blur", passwordVerify);
	firstName.addEventListener("blur", firstNameVerify);
	lastName.addEventListener("blur", lastNameVerify);
	zipCode.addEventListener("blur", zipCodeVerify);
	city.addEventListener("blur", cityVerify);
	phoneNumber.addEventListener("blur", phoneNumberVerify);
	
	//Validation functions
	function Validate(){
		
		if(username.value==""){
			username.style.border = "1px solid red ";
			name_error.textContent = "Username must be at least 3 letters!"
			username.focus();
			return false;
		}
		
		if(password.value!=repeatPassword){
			password.style.border = "1px solid red ";
			password_error.textContent = "Password does not match!"
			password.focus();
			return false;
		}
		
		if(firstName.value==""){
			firstName.style.border = "1px solid red ";
			firstName_error.textContent = "Name must be maximum 20 letters!"
			firstName.focus();
			return false;
		}
		
		if(lastName.value==""){
			lastName.style.border = "1px solid red ";
			lastName_error.textContent = "Last name must be maximum 20 letters!"
			lastName.focus();
			return false;
		}
		
		if(zipCode.value==""){
			zipCode.style.border = "1px solid red ";
			zipCode_error.textContent = "zipcode must be numbers only!"
			zipCode.focus();
			return false;
		}
		
		if(city.value==""){
			city.style.border = "1px solid red ";
			city_error.textContent = "city must be letters only!"
			city.focus();
			return false;
		}
		
		if(phoneNumber.value==""){
			phoneNumber.style.border = "1px solid red ";
			phoneNumber_error.textContent = "Phone number must be numbers only!"
			phoneNumber.focus();
			return false;
		}
		
		return true;
		
	}
	
//Event	handlers
function nameVerify(){
	if(username.value != "") {
		username.style.border = "1px solid #FFFFFF ";
		username_error.innerHTML = "";
		return true;
	}	
}

function passwordVerify(){
	if(password.value != "") {
		password.style.border = "1px solid #FFFFFF ";
		password_error.innerHTML = "";
		return true;
	}	
}

function firstNameVerify(){
	if(firstName.value != "") {
		firstName.style.border = "1px solid #FFFFFF ";
		firstName_error.innerHTML = "";
		return true;
	}	
}

function lastNameVerify(){
	if(lastName.value != "") {
		lastName.style.border = "1px solid #FFFFFF ";
		lastName_error.innerHTML = "";
		return true;
	}	
}

function zipCodeVerify(){
	if(zipCode.value != "") {
		zipCode.style.border = "1px solid #FFFFFF ";
		zipCode_error.innerHTML = "";
		return true;
	}	
}

function cityVerify(){
	if(city.value != "") {
		city.style.border = "1px solid #FFFFFF ";
		city_error.innerHTML = "";
		return true;
	}	
}

function phoneNumberVerify(){
	if(phoneNumber.value != "") {
		phoneNumber.style.border = "1px solid #FFFFFF ";
		phoneNumber_error.innerHTML = "";
		return true;
	}	
}
	
</script>

</body>


</html


<?php 
session_start();

if (isset($_POST['validateForm'])) {
	
	echo '<script language="javascript">';
	echo 'alert("Button clicked!")';
	echo '</script>';	

//Array to display errors
$errors = array(); 
$hashedPassword;

$username = htmlentities(filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING));
$password = htmlentities(filter_input(INPUT_POST, "userPassword", FILTER_SANITIZE_STRING));
$repeatPassword = htmlentities(filter_input(INPUT_POST, "repeatPassword", FILTER_SANITIZE_STRING));
$firstName = htmlentities(filter_input(INPUT_POST, "firstName", FILTER_SANITIZE_STRING));
$lastName = htmlentities(filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_STRING));
$zipCode = htmlentities(filter_input(INPUT_POST, "zipCode", FILTER_SANITIZE_NUMBER_INT));
$city = htmlentities(filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING));
$email = htmlentities(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
$phoneNumber = htmlentities(filter_input(INPUT_POST, "phoneNumber", FILTER_SANITIZE_NUMBER_INT));


if (empty($username)) { 
	array_push($errors, "Name is required"); 
	} else if (preg_match('/[0-9]/', $username)){
		array_push($errors, "Name must only contain letters!");
	}
	
if (empty($email)) { 
	array_push($errors, "Email is required!"); 
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		array_push($errors, "Not a valid email");
	}
	
$uppercase = preg_match('@[A-Z]@', $password); //Contains uppercase
$lowercase = preg_match('@[a-z]@', $password); //Contains lowercase
$number    = preg_match('@[0-9]@', $password); //Contains a number

if (empty($password)) { 
	array_push($errors, "Password is required!"); 
	} else if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
  array_push($errors, "Password must have at least: 1 upper case letter, 1 lower case letter, a number and  8 characters long!"); 
} else if ($password != $repeatPassword) {
	array_push($errors, "The two passwords do not match!");
  }
  
if(!preg_match('/[A-Za-z]\w{1,}/', $firstName)){
	array_push($errors, "First name must be at least 2 letter!");
}

	include 'PDO.php';
	
	$stmt = $conn->prepare("SELECT * FROM Person WHERE email='$email' LIMIT 1");
		
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
  
  if ($result) { // if user exists
    if ($result['email'] == $email) {
      array_push($errors, "Email already exists");
    }
  }
  
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
	  
	  $hashedPassword = password_hash($password, PASSWORD_DEFAULT

	include 'PDO.php';
	
	$stmt = $conn->prepare("INSERT INTO Person (firstname, userPassword, lastname, zipcode, city , email, phoneNumber)
    VALUES (:firstname, :userPassword, :lastname, :zipcode, :city , :email, :phoneNumber)");
	$stmt->bindParam(':firstname', $firstname);
	$stmt->bindParam(':userPassword', $hashedPassword);
	$stmt->bindParam(':lastname', $lastname);
	$stmt->bindParam(':zipcode', $zipCode);
	$stmt->bindParam(':city', $city);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':phoneNumber', $phoneNumber);
	$stmt->execute();
	
	//Log a successfull login
	$stmt = $conn->prepare("INSERT INTO timelog (eventName, eventTimestamp, email, responsible) VALUES (:event, :timestamp, :responsible)");
	$stmt->bindParam(':event', 'Logged in');
	$stmt->bindParam(':timestamp', 'now()');
	$stmt->bindParam(':responsible', $email);		
	
	
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
	} else {
		foreach($error as $error){
			echo '<p>'.$error.'</p>';
		}
	}
}
?>
