<?php

require "header.php";

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
<html lang="en">
<head>
    <title>Register</title>
	<script>
		function validateForm() {
			if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/.test(document.forms["registerform"]["password"].value)) {
				alert("Password is not strong enough.");
				return false;
		}
</script>
</head>
<body>
    <h2>Register</h2>
    <form name="registerform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()" method="post">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password"  placeholder="Password" required><br>
            <input type="password" name="confirm_password" placeholder="Confirm password" required><br>
			<br>
            <input type="text" name="firstname" placeholder="First name" required><br>
            <input type="text" name="lastname" placeholder="Last name" required><br>
            <input type="text" name="zip" placeholder="Zip" required><br>
            <input type="text" name="city" placeholder="City" required><br>
			<br>
            <input type="text" name="email" placeholder="E-mail" required><br>
            <input type="text" name="phonenumber" placeholder="Phone Number" required><br>
			<br>
            <input type="submit" value="Submit">
    </form>
	<p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>