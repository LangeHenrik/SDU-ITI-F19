<!DOCTYPE html>
<?php
  session_start();

  if (!isset($_SESSION["username"])) {
    header("location:login.php");
  }
?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
    <title>Main page</title>
  </head>

  <body>
    <header>
      <div class="container">
        <div class="logo">
          <img src="img/logo.png" height="50" alt="" title="">
        </div>

        <nav>
          <li><a href="pictures.php">Pictures</a></li>
          <li><a href="users.php">Users</a></li>
          <?php
            if (isset($_SESSION["username"])) {
              echo '<li><a href="logout.php">Logout</a>';
            }
          ?>
        </nav>
        </div>
      </div>
    </header>

    <div class="container">
        <div class="content">

          <?php
            echo '<h1>You are now logged in '.$_SESSION["name"].'. Good for you!</h1>';
          ?>




        </div>
    </div>

  </body>
</html>
