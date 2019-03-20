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

    $getPictureStmt = $conn->prepare("SELECT person, title, description, picture_file FROM picture LIMIT 20");

    $queryExecuted = $getPictureStmt->execute();
    $getPictureStmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $getPictureStmt->fetchAll();

    $target_dir = '.../pictures/';

  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  //
  // $getPictureStmt->execute();
  // $getPictureStmt->setFetchMode(PDO::FETCH_ASSOC);
  // $result = $getPictureStmt->fetchAll();

  $targetDir = '../uploads/';
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
      ?>
    </div>
  </body>
</html>
