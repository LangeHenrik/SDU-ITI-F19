<!DOCTYPE html>

<!-- ____________________________________PHP____________________________________-->
<?php

  global $pdo;

  $msg = "";
  // If upload button is pressed
  if (isset($_POST['upload'])) {
    // The path to store the uploaded image
    $target = "images/".basename($_FILES['image']['name']);

    // Connect to the database
    require_once("db_config.php");
    $object = new db_config_class;
    $db = $object->connect();

    // Get all the sumbmitted data from the form
    $image = $_FILES['image']['name'];
    $text = $_POST['text'];

    $sql = $db->prepare("INSERT INTO photo (photo_image, photo_text) VALUES ('$image', '$text')");
    $sql->execute(); // Stores the submitted data into the database table: photo

    // Move the uploaded image into the folder: images
    if (move_uploaded_files($_FILES['image']['tmp_name'], $target)) {
      $msg = "Image uploaded succesfully";
    } else {
      $msg = "There was a problem uploading image";
    }
  }

?>

<!-- ____________________________________PHP____________________________________-->

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
    <title>Pictures</title>
  </head>
  <body>
    <header>
      <div class="container">
        <div class="logo">
          <img src="img/logo.png" height="50" alt="" title="">
        </div>

        <nav>
          <li><a href="pictures.php">Pictures</a></li>
          <li><a href="about.php">About</a></li>
        </nav>
        </div>
      </div>
    </header>

    <div class="content" id="content">
      <form class="upload" action="pictures.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="size" value="1000000">
        <div>
          <input type="file" name="image">
        </div>
        <div>
          <textarea name="text" rows="4" cols="40" placeholder="Say something about this image..."></textarea>
        </div>
        <div>
          <input type="submit" name="upload" value="Upload Image">
        </div>
      </form>

<!-- ____________________________________PHP____________________________________-->
        <?php
          // Connect to the database
          require_once("db_config.php");
          $object = new db_config_class;
          $db = $object->connect();

          $sql = $db->prepare("SELECT * FROM photo");
          $sql->execute();

          $result = $sql->fetchAll();

          while ($row = $result) {
            echo "<div id='img_div'>";
              echo "<img src='images/".$row['photo_image']."'>";
              echo "<p>".$row['text']."</p>";
            echo "</div>";
          }
        ?>
<!-- ____________________________________PHP____________________________________-->
    </div>

  </body>
</html>
