<?php
    require_once'db_config.php';
    $error_username = "";
    $error_password = "";
    $username = "";
    $password = "";

    // connect to the database



    //checking if user exist and whether the password is correct
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = trim($_POST["username"]);
    try {
        $link = new PDO("mysql:host=$DB_servername;dbname=$DB_name", $DB_username, $DB_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $prepStm = $link->prepare("SELECT * from accounts where username = :username");
        $prepStm->bindParam(':username', $username);
        $prepStm->execute();
        $prepStm->setFetchMode(PDO::FETCH_ASSOC);
        $result = $prepStm->fetchColumn(2);
        print_r($result);


    }catch(PDOException $e){
        echo "Error:" .$e->getMessage();
    }

        if (($result) != md5(trim($_POST["pass_1"]))) {
            $error_password = "Either the username does not exist, or you used a wrong password!";

        }
        else{
            $IDresult = $prepStm->fetchColumn(0);
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $IDresult;
            $_SESSION['username'] = $username;
            header("location: home.php");
        }
    }

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login Page </title>
		<link rel="stylesheet" type="text/css" href="register.css">
	</head>
	<body>

    </div>
		<div id="frm">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="form-group <?php echo (!empty($error_username)) ? 'has-error' : ''; ?>" >
					<label>Username:</label><br>
                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $error_username; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($error_pass_1)) ? 'has-error' : ''; ?>">
                    <label>Password:</label><br>
                    <input type="password" name="pass_1" class="form-control" value="<?php echo $password; ?>">
                    <span class="help-block"><?php echo $error_password; ?></span>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-default" value="Reset">
                </div>
				<p>
					Not yet a member? <a href="register.php">Sign Up</a>
				</p>
				
			</form>
		</div>
	</body>
</html>