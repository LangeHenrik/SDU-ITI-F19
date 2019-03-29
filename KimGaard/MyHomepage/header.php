<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Loppebixen</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900|Cormorant+Garamond:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <!-- Fixed Header on scrolling with logo and links -->
  <header id="header" class="header">
    <a href="index.php" id="header-logo" class="header-logo">Loppebixen</a>
    <nav class="header-nav">
      <ul>
        <li><a href="#">Varer</a></li>
        <li><a href="#">Kontakt</a></li>
        <li><a href="upload.php">upload</a></li>
        <?php
        if (!isset($_SESSION['userId'])) {
          echo'
          <li><a href="login.php">Login</a></li>
          <li><a href="signup.php">Signup</a></li>';
        }
        ?>
      </ul>
    </nav>

    <div class="header-logout-button">
      <?php
      if (isset($_SESSION['userId'])) {
        echo '<div class="div-form"><form action="includes/logout.inc.php" method="post">
        <button class="button" type="submit" name="Logout">Logout</button>
        </form></div>';
      }
      ?>
    </div>
  </header>

</body>

</html>
