<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="pictureDiv">
      <?php
        echo '
        <form class="logOutForm" action="/soben14/mvc/public/home/logout" method="post">
          <button name="logout" class="logOutButton">Log out</button>
        </form>';
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
