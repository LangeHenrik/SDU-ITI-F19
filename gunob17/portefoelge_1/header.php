<?php
  session_start();
 ?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>port</title>
  </head>
<header>


  <body id="bod">
    <!--<div class="headline">
      <h1>Portextra</h1>
    </div>-->
    <ul class ="header">
      <li><a href="index.php">Home</a></li>
      <li><a href="login.php">Login</a></li>
      <li><a href="uploade.php">Uploade</a></li>
      <li><a href="users.php">Users</a></li>
      <?php
      if (isset($_SESSION['userid'])) {
        echo'<form id="logout" action="includes/logout.inc.php" method="post">
            <button type="submit" name="logout_submit">Logout</button>
            </form>';
      }
       ?>
    </ul>


</header>
