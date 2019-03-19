<!DOCTYPE html>

<!-- ____________________________________PHP____________________________________-->
<?php

  session_start();
  if (!isset($_SESSION["username"])) {
    header("location:login.php");
  }

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
    $header = $_POST['header'];

    // prepare
    $sql = $db->prepare("INSERT INTO photo (photo_image, photo_text, photo_header) VALUES ('$image', '$text', '$header')");
    $sql->execute(); // Stores the submitted data into the database table: photo

    // Move the uploaded image into the folder: images
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
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

    <div class="content" id="content">
      <?php
        echo '<h1>You are now logged in '.trim($_SESSION["name"]).'. Good for you!</h1><br>';
      ?>

      <form class="upload" action="pictures.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="size" value="1000000">
        <div>
          <input type="file" name="image">
          <br><br>
        </div>
        <div>
          <label class="header" for="header">Header &nbsp; </label>
          <input type="text" size="40" name="header" placeholder="Header here..">
          <br><br>
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


          $stmt = $db->prepare("SELECT * FROM photo;");
          //$stmt->bindParam(":id", $id);
          $stmt->execute();

          $count = $stmt->rowCount();
          if ($count >= 20) {
            for ($i=0; $i < 20; $i++) {
              $row = $stmt->fetch(PDO::FETCH_ASSOC);

              echo "<div id='img_div'>";
                echo "<h3>".$row['photo_header']."</h3>";
                echo "<img src='images/".$row['photo_image']."'>";
                echo "<p>".$row['photo_text']."</p>";
              echo "</div>";

              //echo "<";
            }
          } else {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div id='img_div'>";
                  echo "<h3>".$row['photo_header']."</h3>";
                  echo "<img src='images/".$row['photo_image']."'>";
                  echo "<p>".$row['photo_text']."</p>";
                echo "</div>";

                //echo "<";
              }
          }


        /*  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div id='img_div'>";
              echo "<img src='images/".$row['photo_image']."'>";
              echo "<p>".$row['photo_text']."</p>";
            echo "</div>";

            echo "<";
          }*/
        ?>
<!-- ____________________________________PHP____________________________________-->
    </div>

  </body>
</html>
