<?php
session_start();
if($_SESSION['Login'] === true) {
  echo 'You are now logged in as: '. $_SESSION['userNameGlobal'];
  echo '<form method="post">
    <button name="logout">LogOut</button>
  </form>';

  if(isset(($_POST["logout"]))) {
    header('Location: index.php');
    session_destroy();
  }
}
?>
