<?php
require_once 'db_config.php';
    // Defining and initializing variables as empty
    $username = "";
    $pass_1 = "";
    $pass_2 = "";
    $name_1 = "";
    $name_2 = "";
    $name = "";
    $zip = "";
    $city = "";
    $email = "";
    $ph_number = "";
    $error_username = "";
    $error_pass_1 = "";
    $error_pass_2 = "";
    $error_name_1 = "";
    $error_name_2 = "";
    $error_zip = "";
    $error_city = "";
    $error_email = "";
    $error_ph_number = "";
    $amountOfErrors = 0;
	// connect to the database


	$link = new PDO("mysql:host=$DB_servername;dbname=$DB_name", $DB_username, $DB_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	
	if($link == false){
		die("Error: no connection");
	}
	// if the register button is clicked
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

	    //checking if username exists
        if(empty(trim($_POST["username"]))){
            $error_username = "Please enter a username!";
            $amountOfErrors++;
        }
        else{
            // Preparing statement
            $prepStm = $link->prepare("SELECT * from accounts where username = :username");
            // Fetching the username from the client
            $tempUsername = trim($_POST["username"]);

            // Inserting parameters into the prepared statement
            $prepStm->bindParam(':username', $tempUsername);

            //executing the statement
            $prepStm->execute();
            $fetchedInfo = $prepStm->fetchAll();

            if(sizeof($fetchedInfo, 0) > 0){
                $error_username = "This username is already taken!";
                $amountOfErrors++;
            }
            else{
                $username = $tempUsername;
            }
        }

		// Resetting my prepared statement for later use
        $prepStm = "";

        // Checking if both passwords are the same and if they are written
        if (empty(trim($_POST["pass_1"]))){
            $error_pass_1 = "Please enter a password!";
            $amountOfErrors++;
        }
        elseif (strlen(trim($_POST["pass_1"])) < 8){
            $error_pass_1 = "Password must be atleast 8 characters!";
            $amountOfErrors++;
        }
        elseif(trim($_POST["pass_1"]) != trim($_POST["pass_2"])){
            $error_pass_2 = "Both passwords must be the same!";
            $amountOfErrors++;
        }
        else{
            $password = trim($_POST["pass_1"]);
        }

        // Checking if the rest of the info is filled out

        if(empty(trim($_POST["name_1"]))){
            $error_name_1 = "Please enter a first name.";
        } else{
            $name_1 = trim($_POST["name_1"]);
        }

        if(empty(trim($_POST["name_2"]))){
            $error_name_2 = "Please enter a last name.";
        } else{
            $name_2 = trim($_POST["name_2"]);
        }

        if(empty(trim($_POST["zip"]))){
            $error_zip = "Please enter a zip code.";
        } else{
            $zip = trim($_POST["zip"]);
        }

        if(empty(trim($_POST["city"]))){
            $error_city = "Please enter a city.";
        } else{
            $city = trim($_POST["city"]);
        }

        if(empty(trim($_POST["email"]))){
            $error_email = "Please enter an email.";
        } else{
            $email = trim($_POST["email"]);
        }

        if(empty(trim($_POST["ph_number"]))){
            $error_ph_number = "Please enter a phone number.";
        } else{
            $ph_number = trim($_POST["ph_number"]);
        }



		// saving user to database
		if($amountOfErrors == 0){

		    $password = hash($hashAlgo, $pass_1); // Hashing password
			$name = $name_1 . " " . $name_2;
			$stmt = $link->prepare("INSERT INTO accounts ( username, password, name, zip, city, email, ph_number) VALUES (:username, :password, :name, :zip, :city, :email, :ph_number)");
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':password', $password);
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':zip', $zip);
			$stmt->bindParam(':city', $city);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':ph_number', $ph_number);
			$stmt->execute();
			header("location: iFrame.php");
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login Page </title>
		<link rel="stylesheet" type="text/css" href="../MVC/public/css/register.css">
	</head>
	<body>

		<div id="frm">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="form-group <?php echo (!empty($error_username)) ? 'has-error' : ''; ?>" >
					<label>Username:</label><br>
                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $error_username; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($error_pass_1)) ? 'has-error' : ''; ?>">
                    <label>Password:</label><br>
                    <input type="text" name="pass_1" class="form-control" value="<?php echo $pass_1; ?>">
                    <span class="help-block"><?php echo $error_pass_1; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($error_pass_2)) ? 'has-error' : ''; ?>">
                    <label>Confirm Password:</label><br>
                    <input type="text" name="pass_2" class="form-control" value="<?php echo $pass_2; ?>">
                    <span class="help-block"><?php echo $error_pass_2; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($error_name_1)) ? 'has-error' : ''; ?>">
                    <label>First name:</label><br>
                    <input type="text" name="name_1" class="form-control" value="<?php echo $name_1; ?>">
                    <span class="help-block"><?php echo $error_name_1; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($error_name_2)) ? 'has-error' : ''; ?>">
                    <label>Last name:</label><br>
                    <input type="text" name="name_2" class="form-control" value="<?php echo $name_2; ?>">
                    <span class="help-block"><?php echo $error_name_2; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($error_zip)) ? 'has-error' : ''; ?>">
                    <label>Zip code:</label><br>
                    <input type="text" name="zip" class="form-control" value="<?php echo $zip; ?>">
                    <span class="help-block"><?php echo $error_zip; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($error_city)) ? 'has-error' : ''; ?>">
                    <label>City:</label><br>
                    <input type="text" name="city" class="form-control" value="<?php echo $city; ?>">
                    <span class="help-block"><?php echo $error_city; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($error_email)) ? 'has-error' : ''; ?>">
                    <label>Email:</label><br>
                    <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                    <span class="help-block"><?php echo $error_email; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($error_ph_number)) ? 'has-error' : ''; ?>">
                    <label>Phone number:</label><br>
                    <input type="text" name="ph_number" class="form-control" value="<?php echo $ph_number; ?>">
                    <span class="help-block"><?php echo $error_ph_number; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-default" value="Reset">
                </div>
				<p>
					Already a member? <a href="login.php">Go back</a>
				</p>
				
			</form>
		</div>
	</body>
</html>