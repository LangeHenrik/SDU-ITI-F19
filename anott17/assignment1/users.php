<?php

  require_once 'db_config.php';
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",
    $username,
    $password,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $getUsersStmt = $conn->prepare("SELECT user_name, front_name, last_name FROM person");

  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }


  $getUsersStmt->execute();
  $getUsersStmt->setFetchMode(PDO::FETCH_ASSOC);
  $result = $getUsersStmt->fetchAll();


  session_start();

  if (!(isset($_SESSION['Login'])) || $_SESSION['Login'] !== true) {
    echo 'You are not logged in.';
    return;
  }

  if (isset(($_POST["logout"]))) {
    header('Location: index.php');
    $_SESSION['Login'] = false;
    session_destroy();
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
          echo '<h1>Users</h1>';
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
    <div class="usersTableDiv">
      <table class="usersTable">
        <th>Username</th>
        <th>Frontname</th>
        <th>Lastname</th>
        <?php
        foreach ($result as $value)  {
          echo '<tr>';
          echo '<td>'. $value['user_name'] .'</td>';
          echo '<td>'. $value['front_name'] .'</td>';
          echo '<td>'. $value['last_name'] .'</td>';
          echo '</tr>';
        }
        ?>
      </table>
    </div>
  </body>
</html>
