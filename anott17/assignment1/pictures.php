<?php

  session_start();

  if (!(isset($_SESSION['Login'])) || ($_SESSION['Login'] !== true)) {
    echo 'You are not logged in.';
    return;
  }

  if (isset(($_POST["logout"]))) {
    header('Location: index.php');
    $_SESSION['Login'] = false;
    session_destroy();
  }

  require_once 'db_config.php';
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",
    $username,
    $password,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $getPictureStmt = $conn->prepare("SELECT person, title, description, picture_file FROM picture ORDER BY date_uploaded DESC LIMIT 20");

    $queryExecuted = $getPictureStmt->execute();
    $getPictureStmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $getPictureStmt->fetchAll();

  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
?>

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
        echo '<h1>Pictures</h1>';
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
    <div class="pictureContainer">
        <?php
        foreach ($result as $value)  {
          $picTmp = $value['picture_file'];
          $personTmp = $value['person'];
          $titleTmp = $value['title'];
          $descTmp = $value['description'];
          echo '<br>';
          echo "<img src='pictures/$picTmp' alt='' class='picturesImg'>";
          echo '<br>';
          echo '<p class = "picturesP">Title</p>';
          echo "<p class='titleP'>$titleTmp</p>";
          echo '<br>';
          echo '<p class = "picturesP">Posted by</p>';
          echo "<p class ='personP'>$personTmp</p>";
          echo '<br>';
          echo '<p class = "picturesP">Description</p>';
          echo "<p class='descP'>$descTmp</p>";
          echo '<br>';
          echo '<hr>';
        }
        ?>
    </div>
  </body>
</html>
