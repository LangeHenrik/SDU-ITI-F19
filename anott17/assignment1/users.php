<?php

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

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel ="stylesheet" type="text/css" href="style.css">
    <title></title>
    <script>
    function showUser(str) {
        if (str == "") {
            console.log(str);
            document.getElementById("searchResults").innerHTML = " ";
            return;
        } else {
            console.log(str);
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("searchResults").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","getUserName.php?q="+str,true);
            xmlhttp.send();
        }
    }
    </script>
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
      <div class="headerDiv">Here you can search for a specific user name for more information:</div>
      <form class = "searchForUsersForm">
        User name: <input type="text" onkeyup="showUser(this.value)">
      </form>
      <div id="searchResults">

      </div>

    </div>
    <div class="usersTableDiv">
      <!-- <h2>Here is a list of all users:</h2> -->
      <div class="headerDiv">Here is a list of all users:</div>
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
