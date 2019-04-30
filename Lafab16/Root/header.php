<?php
  session_start(); //to make sure we have an session started on every page
 ?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
    <link rel="stylesheet" href="style.css"/> <!-- link to the stylesheet -->


    <title> Assignment 1 </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  </head>
  <body>
    <header class="headerscale">
      <a href="index_new.php">
      <h1 style="text-align:center;">
      <i class="fas fa-robot"></i>Portfolio Robottechnology<i class="fas fa-robot"></i>
      </h1>
      </a>
    </header>

    <nav class="navscale">
      <div>
        <ul>
          <li><a href="index_new.php">Home</a></li>
          <li><a href="index.php">Logged in?</a></li>
          <li><a href="Sem1.php">1. semester</a></li>
          <li><a href="Sem2.php">2. semester</a></li>
          <li><a href="Sem3.php">3. semester</a></li>
          <li><a href="Sem4.php">4. semester</a></li>
        </ul>

        <div class="align-right">
          <?php
          if (isset($_SESSION['userId'])) { // Show the logout button
            echo '  <form action="Includes/logout_inc.php" method="post">
                <button class="align-right header" type="submit" name="logout-submit">Logout</button>
              </form>';
          }
          else { //show the login and register button
            echo '<form action="includes/login_inc.php" method="post">
              <input class="align-right header" type="text" name="mailuid" placeholder="Username/E-mail..">
              <input class="align-right header" type="password" name="pwd" placeholder="Password.." size="5">
              <button class="align-right header" type="submit" name="login-submit">Login</button>
              <span class="align-right header">
              <a href="signup.php">Signup</a>
              </span>
            </form>';
          }
         ?>
        </div>
      </div>
    </nav>


  </body>
</html>
