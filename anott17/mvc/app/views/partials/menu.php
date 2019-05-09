<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel ="stylesheet" type="text/css" href="css/style.css">
    <script src= "js/showuser.js"></script>
    <title></title>
  </head>
  <body>
    <div class="pictureDiv">
      <?php
        echo '
        <form class="logOutForm" action="/anott17/mvc/public/home/logout" method="post">
          <button name="logout" class="logOutButton">Log out</button>
        </form>';
        echo '<h1>Pictures</h1>';
      ?>
    </div>
    <div class="menuDiv">
      <a href="pictures" class="menuButton">
        Pictures
      </a>
      <a href="upload" class="menuButton">
        Upload pictures
      </a>
      <a href="users" class="menuButton">
        Users
      </a>
    </div>
