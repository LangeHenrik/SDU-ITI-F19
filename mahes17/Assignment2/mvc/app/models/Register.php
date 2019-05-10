<?php

class register extends Database {

    public function registerUser(){

      require_once ("../Core/Database.php");

      $username_error = "";
      $password_error = "";
      $passwordRepeat_error = "";
      $firstName_error = "";
      $lastName_error = "";
      $zipcode_error = "";
      $city_error = "";
      $email_error = "";
      $phoneNumber_error = "";
      $error = false;

      $usernameRegex = "/^[a-z0-9_-]+$/i";
      $nameRegex = "/^[a-z ,.'-]+$/i";
      $numberRegex = "/^[0-9]+$/";
      $passwordRegex = "/^(?=.+\d).{8,}$/i";

      if($_SERVER["REQUEST_METHOD"] == "POST"){

      	if(empty($_POST["username"])){
      		$username_error = "Username required";
      		$error = true;
      	}else if(!preg_match($usernameRegex, $_POST["username"])){
      		$username_error = "Username contains illegal characters. Only letters, numbers, - and _ are allowed.";
      		$error = true;
      	}

      	if(empty($_POST["password"])){
      		$password_error = "Password required";
      		$error = true;
      	}else if(!preg_match($passwordRegex, $_POST["password"])){
      		$password_error = "Entered password is invalid. One upper case letter, one digit and at least 8 characters are required.";
      		$error = true;
      	}

      	if(empty($_POST["passwordRepeat"])){
      		$passwordRepeat_error = "Repeated password required";
      		$error = true;
      	}else if($_POST["passwordRepeat"] !== $_POST["password"]){
      		$passwordRepeat_error = "Repeated password does not match the other password!";
      		$error = true;
      	}

      	if(empty($_POST["firstName"])){
      		$firstName_error = "First name required";
      		$error = true;
      	}else if(!preg_match($nameRegex, $_POST["firstName"])){
      		$firstName_error = "First name contains invalid characters. Only letters and following symbols are allowed: , . - '";
      		$error = true;
      	}

      	if(empty($_POST["lastName"])){
      		$lastName_error = "Last name required";
      		$error = true;
      	}else if(!preg_match($nameRegex, $_POST["lastName"])){
      		$lastName_error = "Last name contains invalid characters. Only letters and following symbols are allowed: , . - '";
      		$error = true;
      	}

      	if(empty($_POST["zipcode"])){
      		$zipcode_error = "zipcode code required";
      		$error = true;
      	}else if(!preg_match($numberRegex, $_POST["zipcode"])){
      		$zipcode_error = "zipcode code is invalid. Only numbers allowed.";
      		$error = true;
      	}

      	if(empty($_POST["city"])){
      		$city_error = "City name required";
      		$error = true;
      	}else if(!preg_match($nameRegex, $_POST["city"])){
      		$city_error = "City name contains invalid characters. Only letters and following symbols are allowed: , . - '";
      		$error = true;
      	}

      	if(empty($_POST["email"])){
      		$email_error = "E-mail required";
      		$error = true;
      	}else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
      		$email_error = "Entered e-mail address is not valid";
      		$error = true;
      	}

      	if(empty($_POST["phoneNumber"])){
      		$phoneNumber_error = "Phone number required";
      		$error = true;
      	}else if(!preg_match($numberRegex, $_POST["phoneNumber"])){
      		$phoneNumber_error = "Phone number is not valid. Only digits allowed.";
      		$error = true;
      	}

      	if(!$error){

      		$sql = "SELECT 1 FROM users WHERE username = :username;";
      		$stmt = $conn -> prepare($sql);
      		$stmt -> bindParam(":username", $_POST["username"]);
      		$stmt -> execute();
      		$userExists = $stmt -> fetchColumn();
      		if($userExists){
      			$username_error = "Username already exists";
      			$error = true;
      		}else{
      			$sql = "SELECT 1 FROM users WHERE email = :email;";
      			$stmt = $conn -> prepare($sql);
      			$stmt -> bindParam(":email", $_POST["email"]);
      			$stmt -> execute();
      			$emailExists = $stmt -> fetchColumn();
      			if($emailExists){
      				$email_error = "Entered e-mail address already exists";
      				$error = true;
      			}
      		}

      		if(!$error){

      			$sql = "INSERT INTO users (username, created, password, firstname, lastname, zipcode, city, email, phonenumber) VALUES (:username, NOW(), :password, :firstname, :lastname, :zipcode, :city, :email, :phonenumber);";
      			$stmt = $conn -> prepare($sql);
      			$stmt -> bindParam(":username", $_POST["username"]);
      			$hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
      			$stmt -> bindParam(":password", $hashed_password);
      			$stmt -> bindParam(":firstname", $_POST["firstName"]);
      			$stmt -> bindParam(":lastname", $_POST["lastName"]);
      			$stmt -> bindParam(":zipcode", $_POST["zipcode"]);
      			$stmt -> bindParam(":city", $_POST["city"]);
      			$stmt -> bindParam(":email", $_POST["email"]);
      			$stmt -> bindParam(":phonenumber", $_POST["phoneNumber"]);
      			$stmt -> execute();

      			$_SESSION['user'] = $_POST["username"];
      			header("Location: pictures.php");
      		}
      	}
      }
    }
}
?>
