<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
   <meta name="viewport" charset="utf-8" content="width=device-witdh, initial-scale=1.0">
    <!--<meta charset="utf-8">-->
	<script src= "js/showUserPictures.js"></script>
    <link rel ="stylesheet" type="text/css"  href="css/style.css">
    
    <title></title>
  </head>
  
  <body>
  
    <div class="pictureDiv">
      <?php
        echo '
        <form class="logOutForm" action="/nifra17/mvc/public/home/logout" method="post">
          <button name="logout" class="logOutButton">Log out</button>
        </form>';
        echo '<h1>Pictures</h1>';
      ?>
    </div>
    <div class="topnav">
      <a href="pictures" class="menuButton">
        Pictures
      </a>
      <a href="upload" class="menuButton">
        Upload pictures
      </a> 
      <a href="user" class="menuButton">
        AJAX
      </a>

    </div>