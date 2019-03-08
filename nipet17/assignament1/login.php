<!DOCTYPE html>

<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  if (isset($_POST['Submit'])) {
    // Check if username and password is centered
    if (isset($_POST['Username']) && isset($_POST['Password'])) {
      if ($_POST['username'] === "admin" && $_POST['password'] === "password") {
        echo "Username and password are correct.";
        header('LOCATION:startpage.php');

      } else {
        echo "incorrect login";
        die();
      }
    }
  }
?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
    <title>Log in</title>
  </head>

  <body>
    <header>
      <div class="container">
        <div class="logo">
          <img src="img/logo.png" height="50" alt="" title="">
        </div>
        </div>
    </header>

    <div class="container">
        <div class="content">

            <br><br><br>
            <h2>In order to go further, you have to sign-in</h2>
            <br><br>

            <form method="post" action="index.php">
          		<fieldset>
      				<legend><h3>Sign in</h3></legend>
                <form action="pictures.php" method="post">
                  <label for="username" id="luser">Username</label>
                  <br>
                  <input onblur="checkName()" type="text" name="username" id="username" placeholder="Username"/>
                  <br>
                  <label for="password" id="lpassword">Password</label>
                  <br>
                  <input onblur="checkPassword()" type="password" name="password" id="password" placeholder="Password"/>
                  <br><br>
                  <input type="submit" name="submit" value="Submit">
                  <br><br>
                  <a href="sign-up.php">Haven't got any account?</a>
              </form>
      			</fieldset>
      		</form>

        </div>
    </div>

  </body>
</html>
