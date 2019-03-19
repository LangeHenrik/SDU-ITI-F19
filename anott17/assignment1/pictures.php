<?php
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
        session_start();

        if($_SESSION['Login'] === true) {
          echo '
          <form class="logOutForm" method="post">
            <button name="logout">LogOut</button>
          </form>';
          echo '<h1>Photos</h1>';

          if(isset(($_POST["logout"]))) {
            header('Location: index.php');
            session_destroy();
          }
        }
      ?>
    </div>
  </body>
</html>
