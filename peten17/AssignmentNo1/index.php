
<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}



if (isset($_POST["submit"])) {
if (isset($_POST['username'])  && isset($_POST['password']) ) {
  if ($_POST['username'] === "admin" && $_POST['password'] === "password") {
    echo "Username and password are correct.";
    $_SESSION['login'] = TRUE;
    header('LOCATION:startpage.php');

  } else {
    echo "incorrect login";
    die();
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
      <form class="loginForm" method="post">
        <fieldset>
          <legend>Login</legend>
          <p>Username:</p>
          <input type="text" name="username" value="" id="username"> <br>
          <p>Password:</p>
          <input type="password" name="password" value="" id="password">
          <input type="submit" name="submit" value="Submit">
          <p>Not a member yet?</p> <a href="startpage.php">Click here to sign up!</a>
        </fieldset>
      </form>

    </div>

  </body>
</html>
