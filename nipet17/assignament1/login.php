<!DOCTYPE html>

<?php

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
/*----------------------------------Database------------------------------------- */
  // Connects to database
  require_once("db_config.php");
  $object = new db_config_class;
  $db = $object->connect();

  $msg = "";


  // If submit button is pressed
  if (isset($_POST['submit'])) {
    // Check if username and password is entered
    if (isset($_POST['username']) && isset($_POST['password'])) {

      $query = "SELECT * FROM login WHERE login_username = :username AND login_password = :password";
      $stmt = $db->prepare($query);

      $stmt->execute(
        array(
          'username' => $_POST["username"],
          'password' => $_POST["password"],

        )
      );

      $count = $stmt->rowCount();

      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      $_SESSION["test"] = $result;

      if ($count > 0) {
        $_SESSION["username"] = $result["login_username"];
        $_SESSION["email"] = $result["login_email"];
        $_SESSION["name"] = $result["login_name"];
        $_SESSION["phone"] = $result["login_phone"];
        $_SESSION["zip"] = $result["login_zip"];
        $_SESSION["city"] = $result["login_city"];
        //[$_SESSION["username"], $_SESSION["email"], $_SESSION["name"], $_SESSION["password"]] = $result;
        //$_SESSION['name'] = $result(login_name);
        echo "Username and password are correct.";
        header('LOCATION:pictures.php');
      } else {
        $msg = "Incorrect login";
        //die();
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

            <?php
              if (isset($msg)) {
                echo '<label class="text-danger">'.$msg.'</label>';
              }
            ?>

            <br><br>

            <form method="post">
          		<fieldset>
      				<legend><h3>Sign in</h3></legend>
                  <label for="username" id="luser">Username</label>
                  <br>
                  <input onblur="checkName()" type="text" name="username" id="username" autofocus placeholder="Username"/>
                  <br>
                  <label for="password" id="lpassword">Password</label>
                  <br>
                  <input onblur="checkPassword()" type="password" name="password" id="password" placeholder="Password"/>
                  <br><br>
                  <input type="submit" name="submit" value="Submit">
                  <br><br>
                  <a href="sign-up.php">Haven't got any account?</a>
      			</fieldset>
      		</form>

        </div>
    </div>

  </body>
</html>
