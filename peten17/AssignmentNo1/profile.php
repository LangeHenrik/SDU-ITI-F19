<?php
include "header.php"; // adds header from other pages.
include "config.php";

 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

    <meta charset="utf-8">
    <link rel="stylesheet" href="/profileStyle.css">
    <title>Profile</title>
  </head>
  <body>

    <div class="content">
      <div class="usernameTag">
        <p><?php echo htmlspecialchars($_SESSION["username"]); ?></p>
      </div>
      <div class="userInfo">
        <p>Name: <?php echo htmlspecialchars($_SESSION["firstname"]) .' '. htmlspecialchars($_SESSION["lastname"]); ?></p>
        <p>Email: <?php echo htmlspecialchars($_SESSION["email"]); ?></p>
        <p>City: <?php echo htmlspecialchars($_SESSION["city"]); ?></p>
        <p>Zipcode: <?php echo htmlspecialchars($_SESSION["zipcode"]); ?></p>
        <p>Phonenumber: <?php echo htmlspecialchars($_SESSION["phonenumber"]); ?></p>
      </div>

    </div>


  </body>
</html>
