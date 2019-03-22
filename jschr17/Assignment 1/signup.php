<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $firstname = $lastname = $zipcode = $city = $email = $phonenumber = "";
$username_err = $password_err = $confirm_password_err = $firstname_err = $lastname_err = $zipcode_err = $city_err = $email_err = $phonenumber_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link4, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
	// Validate first name
	if(empty(trim($_POST["firstname"]))){
		$firstname_err = "Please enter a first name.";
	} elseif(!preg_match("/^[a-zA-Z ]*$/" ,$_POST["firstname"])){
        $firstname_err = "Only letters and whitespace allowed";
    }
	else{
		$firstname = trim($_POST["firstname"]);
	}
	// Validate last name
	if(empty(trim($_POST["lastname"]))){
		$lastname_err = "Please enter a last name.";
	} elseif(!preg_match("/^[a-zA-Z ]*$/" ,$_POST["lastname"])){
        $lastname_err = "Only letters and whitespace allowed";
    }
	else{
		$lastname = trim($_POST["lastname"]);
	}
	// Validate zip code
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
	// Validate city
	if(empty(trim($_POST["city"]))){
		$city_err = "Please enter a city.";
	} elseif(!preg_match("/^[a-zA-Z ]*$/" ,$_POST["city"])){
	    $city_err = "Only letters and whitespace allowed";
    }
	else{
		$city = trim($_POST["city"]);
	}
	// Validate email
	if(empty(trim($_POST["email"]))){
		$email_err = "Please enter an email.";
	} elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
	    $email_err = "Not a valid email";
    }
	else{
		$email = trim($_POST["email"]);
	}
	// Validate phonenumber
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
	
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($firstname_err) && empty($lastname_err) && empty($zipcode_err) && empty($city_err) && empty($email_err) && empty($phonenumber_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, firstname, lastname, zip, city, email, phonenumber) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link4, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssss", $param_username, $param_password, $param_firstname, $param_lastname, $param_zipcode, $param_city, $param_email, $param_phonenumber);
            
            // Set parameters
            $param_username = $username;
			$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
			$param_firstname = $firstname;
			$param_lastname = $lastname;
			$param_zipcode = $zipcode;
			$param_city = $city;
			$param_email = $email;
            $param_phonenumber = $phonenumber;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: index.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link4);
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
        <form name="registerForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validate()">
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
            <p>Already have an account? <a href="index.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>

















