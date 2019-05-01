<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: startpage.php");
    exit();
}

require_once "config.php";


$username = $password = $usernameLabel = $passwordLabel = "";

if (isset($_POST["submit"])) {    // checks if the login-button is pressed.

  if (empty($_POST["username"]) or empty($_POST["password"])) {
     $usernameLabel  ="Please enter username to login";
	   $passwordLabel = "Please enter password to login";
  }else {
    // get and sanitize input
	$username = htmlentities(filter_var($_POST["username"]),FILTER_SANITIZE_STRING);
	$password = htmlentities(filter_var($_POST["password"]),FILTER_SANITIZE_STRING);
    $sql = "SELECT id, username, pwd, firstname, lastname, zipcode, city, email, phonenumber FROM users WHERE username = :username";

    if ($stmt = $conn->prepare($sql)) {
      // bind params to query
      $stmt->bindParam(":username",$username,PDO::PARAM_STR);

      if ($stmt->execute()) {
        // checks if the username exists in the database
        if ($stmt->rowCount() == 1) {
          if ($row = $stmt->fetch()) {
            // get data from row.
              $id = $row["id"];
              $username = $row["username"];
              $hashed_pass = $row["password"];


              if (password_verify($password,$hashed_pass)) {
				  // password is correct start session.
                session_start();

                // store data in session.
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;
                $_SESSION["firstname"] = $row["firstname"];
                $_SESSION["lastname"] = $row["lastname"];
                $_SESSION["zipcode"] = $row["zipcode"];
                $_SESSION["city"] = $row["city"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["phonenumber"] = $row["phonenumber"];
                // sends user to startpage
                header("location:startpage.php");
              }else {
                  $passwordLabel = "Password not correct. ";
                }

              // close statement
              unset($stmt);
          }
		}else{
		$usernameLabel = "No user with that username";
	  }
	  }

          // closes connection to database
          unset($conn);







    }
  }

}

 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="indexStyle.css">
</head>

<body>
  <div class="header">
    <h1>Welcome to my website!</h1>
  </div>
  <div class="loginBox">
    <form class="loginForm" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
      <fieldset>
        <legend>Login</legend>
        <p>Username:</p>
        <input type="text" name="username" value="" id="username"> <label> <?php echo $usernameLabel ?></label> <br>
        <p>Password:</p>
        <input type="password" name="password" value="" id="password"> <label> <?php echo $passwordLabel?></label> <br>
        <br /><input type="submit" name="submit" value="Log in">
        <p>Not a member yet?</p> <a href="register.php">Click here to sign up!</a>
      </fieldset>
    </form>

  </div>

</body>

</html>
