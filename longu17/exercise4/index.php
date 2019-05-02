<?php
if(isset($_POST["username"]) && isset($_POST["password"])) {
  if($_POST["username"] !== "Loc" && $_POST["password"] !== "123") {

    $message = "Username or password wrong.";
    echo "
    <script 
    type='text/javascript'>alert('$message');
    </script>";

    
  }
  else {
    header('Location: homepage.php');
    
  }

}
?>

<form method="post">
  Username:
  <input type="text" name="username" value=""><br><br>

  Password:
  <input type="text" name="password" value=""><br><br>

  <input type="submit" name="submit" value="Submit">
</form>
