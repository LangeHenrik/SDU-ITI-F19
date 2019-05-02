<form method="post">
  <input type="text" name="userName">
  <input type="password" name="password">
  <input type="submit">
</form>

<?php
  if(isset($_POST["userName"]) && isset($_POST["password"])) {
    if(($_POST["userName"] == "Henrik") && ($_POST["password"] == "Lange")) {
      session_start();
      $_SESSION['userNameGlobal'] =  $_POST["userName"];
      $_SESSION['Login'] = true;
      header('Location: userpage.php');
    } else {
      echo 'Wrong username and/or password';
    }
  }
?>
