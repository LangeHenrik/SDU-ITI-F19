<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel ="stylesheet" type="text/css" href="style.css">
    <title></title>
  </head>
  <body>
    <div class="pictureDiv">
      <?php
        echo '
        <form class="logOutForm" method="post">
          <button name="logout" class="logOutButton">Log out</button>
        </form>';
        echo '<h1>Upload Pictures</h1>';
      ?>
    </div>
    <div class="menuDiv">
      <a href="pictures.php" class="menuButton">
        Pictures
      </a>
      <a href="uploadPictures.php" class="menuButton">
        Upload pictures
      </a>
      <a href="users.php" class="menuButton">
        Users
      </a>
    </div>
    <form action="submitPicture.php" method="POST" enctype="multipart/form-data" class="uploadPictureForm">
        <label>File: </label>
        <br>
        <input type="file" name="image" />
        <br>

        <label>Titel: </label>
        <br>
        <input type="text" name="pictureTitle">
        <br>

        <label>Description: </label>
        <br>
        <input type="text" name="pictureDesc">
        <br>

        <input type="submit" class="mainButton" />
    </form>
  </body>
</html>
