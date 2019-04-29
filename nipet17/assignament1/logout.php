<?php
  session_start();
  session_destroy();
  header("location:login.php");

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <meta http-equiv="refresh" content="1";url="login.php" />
  </body>
</html>
