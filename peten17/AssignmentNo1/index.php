
<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: startpage.php");
    exit;
}

require_once "config.php";


$username = $password = "";

print_r($_POST);

if (isset($_POST["submit"])) {    // checks if the login-button is pressed.

  if (empty($_POST["username"]) or empty($_POST["password"])) {
    echo "Please enter username and password to login";
  }else {
    $sql = "SELECT id, username, password FROM users WHERE username = :username";

    if ($stmt = $conn->prepare($sql)) {
      // bind params to query
      $stmt->bindParam(":username",$username,PDO::PARAM_STR);

      if ($stmt->execute()) {
        // checks if the username exists in the database
        if ($stmt->rowCount() == 1) {
          if ($row = $stmt->fetch()) {
              $id = $row["id"];
              $username = $row["username"];
              $hashed_pass = $row["password"];
              if (password_verify($password,$hashed_pass)) {
                session_start();

                // store data in session.
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;
                // sends user to startpage
                header("location:startpage.php");
              }else {
                  echo "Password not correct. ";
                }

              // close statement
              unset($stmt);
          }

          // closes connection to database
          unset($conn);
        }

      }



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
          <input type="text" name="username" value="" id="username"> <br>
          <p>Password:</p>
          <input type="password" name="password" value="" id="password">
          <input type="submit" name="submit" value="Log in">
          <p>Not a member yet?</p> <a href="register.php">Click here to sign up!</a>
        </fieldset>
      </form>

    </div>

  </body>
</html>
