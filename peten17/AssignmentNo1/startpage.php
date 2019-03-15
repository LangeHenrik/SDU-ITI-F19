<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
  }

if (isset($_POST["logout"])) {
  $_SESSION = array();
  session_destroy();
  header("location:index.php");

}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Homepage</title>
  </head>
  <body>
    <h1>Welcome <?php $_SESSION["Username"]; ?>!</h1>
    <div class="page-header">
            <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
        </div>
    <form class="logout" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <input type="submit" name="logout" value="Log out">
    </form>

  </body>
</html>
