<?php
include_once(__DIR__ . '/../../core/Database.php');

$database = new Database();
$conn = $database->getConn();

$username = $password = $confirm_password = $firstname = $lastname = $zipcode = $city = $email = $phonenumber = "";
$username_err = $password_err = $confirm_password_err = $firstname_err = $lastname_err = $zipcode_err = $city_err = $email_err = $phonenumber_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        $sql = "SELECT user_id FROM users WHERE username = :param_username";
        $stmt1 = $conn->prepare($sql);
        if($conn->prepare($sql)){

            $stmt1->bindParam(':param_username', $param_username, PDO::PARAM_STR);

            if($stmt1->execute()){

                $row = $stmt1->fetch();
                
                if($row == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
	if(empty(trim($_POST["firstname"]))){
		$firstname_err = "Please enter a first name.";
	} elseif(!preg_match("/^[a-zA-Z ]*$/" ,$_POST["firstname"])){
        $firstname_err = "Only letters and whitespace allowed";
    }
	else{
		$firstname = trim($_POST["firstname"]);
	}
	if(empty(trim($_POST["lastname"]))){
		$lastname_err = "Please enter a last name.";
	} elseif(!preg_match("/^[a-zA-Z ]*$/" ,$_POST["lastname"])){
        $lastname_err = "Only letters and whitespace allowed";
    }
	else{
		$lastname = trim($_POST["lastname"]);
	}
	if(empty(trim($_POST["zipcode"]))){
		$zipcode_err = "Please enter a zip code.";
	} elseif(!preg_match("#[0-9]{4}#" ,$_POST["zipcode"])){
        $zipcode_err = "Only numbers";
    } elseif(strlen($_POST["zipcode"]) > 4){
	    $zipcode_err = "Max lenght is 4";
    }
	else{
		$zipcode = trim($_POST["zipcode"]);
	}
	if(empty(trim($_POST["city"]))){
		$city_err = "Please enter a city.";
	} elseif(!preg_match("/^[a-zA-Z ]*$/" ,$_POST["city"])){
	    $city_err = "Only letters and whitespace allowed";
    }
	else{
		$city = trim($_POST["city"]);
	}
	if(empty(trim($_POST["email"]))){
		$email_err = "Please enter an email.";
	} elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
	    $email_err = "Not a valid email";
    }
	else{
		$email = trim($_POST["email"]);
	}
	if(empty(trim($_POST["phonenumber"]))){
		$phonenumber_err = "Please enter a phone number.";
	} elseif(!preg_match("/^[0-9\-\(\)\/\+\s]*$/" ,$_POST["phonenumber"])){
        $phonenumber_err = "Only numbers allowed";
    } elseif(strlen($_POST["phonenumber"]) > 8){
	    $phonenumber_err = "Max length is 8";
    }
	else{
		$phonenumber = trim($_POST["phonenumber"]);
	}

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($firstname_err) && empty($lastname_err) && empty($zipcode_err) && empty($city_err) && empty($email_err) && empty($phonenumber_err)){

        $sql = "INSERT INTO users (username, password, firstname, lastname, zipcode, city, email, phonenumber) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
         $stmt2 = $conn->prepare($sql);
        if($conn->prepare($sql)){

            $param_username = $username;
			$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
			$param_firstname = $firstname;
			$param_lastname = $lastname;
			$param_zipcode = $zipcode;
			$param_city = $city;
			$param_email = $email;
            $param_phonenumber = $phonenumber;

            if($stmt2->execute([$param_username, $param_password, $param_firstname, $param_lastname, $param_zipcode, $param_city, $param_email, $param_phonenumber])){
                // Redirect to login page
                header("location: other");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
    }
    $database->__destruct();
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
        form {display: inline-block}
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form name="registerForm" action="<?php /*echo htmlspecialchars($_SERVER["PHP_SELF"]);*/ ?>" method="post" onsubmit="return validate()">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
                <label>First name</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
                <span class="help-block"><?php echo $firstname_err; ?></span>
            </div> 	
            <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                <label>Last name</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                <span class="help-block"><?php echo $lastname_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($zipcode_err)) ? 'has-error' : ''; ?>">
                <label>Zip code</label>
                <input type="text" name="zipcode" class="form-control" value="<?php echo $zipcode; ?>">
                <span class="help-block"><?php echo $zipcode_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
                <label>City</label>
                <input type="text" name="city" class="form-control" value="<?php echo $city; ?>">
                <span class="help-block"><?php echo $city_err; ?></span>
            </div> 		
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($phonenumber_err)) ? 'has-error' : ''; ?>">
                <label>Phonenumber</label>
                <input type="text" name="phonenumber" class="form-control" value="<?php echo $phonenumber; ?>">
                <span class="help-block"><?php echo $phonenumber_err; ?></span>
            </div> 			
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="other">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>

















