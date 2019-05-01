<?php

if (isset($_POST['register-user'])){

	$username = $password = $uppercase = $lowercase = $number= $repeatPassword =
	$firstName = $lastName = $zipCode = $city = $email = $phoneNumber = "";


		if (isset($_POST['username'])) {$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);}
		if (isset($_POST['userPassword'])) {
		$password = filter_var($_POST['userPassword'], FILTER_SANITIZE_STRING);
		$uppercase = preg_match('@[A-Z]@', $password); //Contains uppercase
		$lowercase = preg_match('@[a-z]@', $password); //Contains lowercase
		$number    = preg_match('@[0-9]@', $password);} //Contains a number
		if (isset($_POST['repeatPassword'])) {$repeatPassword = filter_var($_POST['repeatPassword'], FILTER_SANITIZE_STRING);}
		if (isset($_POST['firstName'])) {$firstName = filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);}
		if (isset($_POST['lastName'])) {$lastName = filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);}
		if (isset($_POST['zipCode'])) {$zipCode = filter_var($_POST['zipCode'], FILTER_SANITIZE_STRING);}
		if (isset($_POST['city'])) {$city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);}
		if (isset($_POST['email'])) {$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);}
		if (isset($_POST['phoneNumber'])) {$phoneNumber = filter_var($_POST['phoneNumber'], FILTER_SANITIZE_STRING);}

		//Array to display errors
		$errors = array();

		if (empty($username)) {
			array_push($errors, "Name is required");
			} else if (!preg_match('/^[a-zA-Z ]*$/', $username)) {
				array_push($errors, "Name must only contain letters!");
			}

		if (empty($email)) {
			array_push($errors, "Email is required!");
			} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				array_push($errors, "Not a valid email");
			}

		if (empty($password)) {
			array_push($errors, "Password is required!");
			} else if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
		  array_push($errors, "Password must have at least: 1 upper case letter, 1 lower case letter, a number and  8 characters long!");
		} else if ($password != $repeatPassword) {
			array_push($errors, "The two passwords do not match!");
		  }

		if (isset($_POST['firstName'])) {
			if(!preg_match('/[A-Za-z]\w{1,}/', $firstName)){
				array_push($errors, "First name must be at least 2 letter!");
			}
        }

		$uppercase = preg_match('@[A-Z]@', $zipCode); //Contains uppercase
		$lowercase = preg_match('@[a-z]@', $zipCode); //Contains lowercase
		$number    = preg_match('@[0-9]@', $zipCode); //Contains a number

		if (isset($_POST['zipCode'])) {
			if($uppercase || $lowercase || !$number){
				array_push($errors, "Only numbers as zipcode!");
			}
        }



		include 'PDO.php';

		if (isset($_POST['email'])) {

		     $stmt = $conn->prepare("SELECT * FROM Person WHERE email='$email' LIMIT 1");

				$stmt->execute();
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				$result = $stmt->fetchAll();

				if ($result) { // if user exists
					if ($result['email'] == $email) {
						array_push($errors, "Email already exists");
					}
				}
        }


		  // Finally, register user if there are no errors in the form
		  if (count($errors) == 0) {

			  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

			include './PDO.php';

			$stmt = $conn->prepare("INSERT INTO Person (firstname, userPassword, lastname, zipcode, city , email, phoneNumber)
			VALUES (:firstname, :userPassword, :lastname, :zipcode, :city , :email, :phoneNumber)");
			$stmt->bindParam(':firstname', $firstName);
			$stmt->bindParam(':userPassword', $hashedPassword);
			$stmt->bindParam(':lastname', $lastName);
			$stmt->bindParam(':zipcode', $zipCode);
			$stmt->bindParam(':city', $city);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':phoneNumber', $phoneNumber);
			$stmt->execute();


			$event = 'New user registered ';
			$SQLNow = 'now()';

			//Log a successfull login
			$stmt = $conn->prepare("INSERT INTO timelog (eventName, eventTimestamp, responsible) VALUES (:eventDesc, :currentTime, :responsible);");
			$stmt->bindParam(':eventDesc', $event);
			$stmt->bindParam(':currentTime', $SQLNow);
			$stmt->bindParam(':responsible', $email);


			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			} else {
				print_r($errors);
			}
}

			if (isset($_POST['back'])){
				header('location: index.php');
			}

?>

<html>

<head>

	<title> Register </title>

	<link rel="stylesheet" type="text/css" href="css.css">

</head>

<body>

<form method="POST" onKeyPress="Validate()" action="register.php"  margin-left="20%" >

<hr>

 <h1> Register as user </h1>
  <div class="container">
	<div>
		<label ><b>Username</b></label>
		<input type="text" placeholder="Enter Username" id="username" name="username" required>
		<div id="username_error" > </div>
	</div>
	<br/>
	<div>
		<label> <b>Password</b></label>
		<input type="password" placeholder="Enter Password" id="userPassword" name="userPassword" required
	</div
	<br
	<div>
		<label> <b>Repeat Password</b></label>

		<input type="password" placeholder="Repeat Password" id="repeatPassword" name="repeatPassword" required>

		<div id="repassword_error" > </div>
	</div
	<br
	<div>
		<label> <b>First name</b></label>
		<input type="text" placeholder="Enter first name" id="firstName" name="firstName" required>

		<div id="firstName_error"> </div
	</div
	<br
	<div>
		<label> <b>Last name</b></label>
		<input type="text" placeholder="Enter last name" id="lastName" name="lastName" required>

		<div id="lastName_error"> </div
	</div
	<br
	<div>
		<label> <b>Zip code</b></label>
		<input type="number" placeholder="Enter Zip code" id="zipCode" name="zipCode" required>

		<div id="zipCode_error"> </div
	</div
	<br/>
	<div>
		<label> <b>City</b></label>
		<input type="text" placeholder="City" id="city" name="city" required>

		<div id="city_error"> </div>
	</div>
	<br/>
	<div>
		<label> <b>Email</b></label>
		<input type="email" placeholder="Email" id="email" name="email" required>
	</div>
	<br/>
	<div>
		<label> <b>Phone number</b></label>
		<input type="number" placeholder="Phone number" id="phoneNumber" name="phoneNumber" required>

		<div id="phoneNumber_error"> </div>
	</div>
	<br/>
	<button  formnovalidate name="back" > Back </button>
	<!-- Using htmlspecialchars against XSS-->
    <button type="submit" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" value="Register" onclick="Validate()" name="register-user"> Register </button>

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
	var name_error = document.getElementById("username_error");
	var password_error = document.getElementById("password_error");
	var firstName_error = document.getElementById("firstName_error");
	var lastName_error = document.getElementById("lastName_error");
	var zipCode_error = document.getElementById("zipCode_error");
	var city_error = document.getElementById("city_error");
	var phoneNumber_error = document.getElementById("phoneNumber_error");


	//Validation function to show/remove error messages
	function Validate(){

		if(username.value.length < 2){
			username.style.border = "1px solid red ";
			name_error.textContent = "Username must be at least 3 letters!"

		}else {
			username.style.border = "1px solid black ";
			username_error.innerHTML = "";

		}



		if(password.value!=repeatPassword.value){

			password.style.border = "1px solid red ";
			password_error.textContent = "Password does not match!"
			repeatPassword.style.border = "1px solid red ";
			repeatPassword.textContent = "Password does not match!"
			password.focus();

		} else {
			password.style.border = "1px solid black ";
			password_error.innerHTML = "";
			repeatPassword.style.border = "1px solid black ";
			repeatPassword.innerHTML = "";

		}

		if(firstName.value.length > 19 && allLetter(firstName)){
			firstName.style.border = "1px solid red ";
			firstName_error.textContent = "Name must be maximum 20 letters!"
			firstName.focus();
			return false;
		} else {
          firstName.style.border = "1px solid black ";
		  firstName_error.innerHTML = "";

        }


		if(lastName.value.length > 19 && allLetter(lastname)){
			lastName.style.border = "1px solid red ";
			lastName_error.textContent = "Last name must be maximum 20 letters!"
			lastName.focus();
			return false;
		} else {
			lastName.style.border = "1px solid black ";
			lastName_error.innerHTML = "";

		}


		if(allLetter(city)){
			city.style.border = "1px solid red ";
			city_error.textContent = "city must be letters only!"
			city.focus();
			return false;
		} else {
			city.style.border = "1px solid #000000 ";
			city_error.innerHTML = "";
		}

		return true;

	}

	function allLetter(input)
  {
	var letters = /^[A-Za-z]+$/;
	if(!input.value.match(letters))
    {
		return false;
    }

		return false;

  }

</script>

</body>


</html>
