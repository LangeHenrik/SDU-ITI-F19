<?php
// Did they click the login buttom
if (isset($_POST['login-submit'])) {

  include 'dbh_inc.php';

  $mailuid = $_POST['mailuid'];
  $passwordUser = $_POST['pwd'];

  //Check if any field was empty
  if (empty($mailuid) || empty($passwordUser)) {
    header('Location: ../index.php?error=emptyfields');
    //Send them back to the index page..
    exit();
  }

  else {
    $sql = "SELECT * FROM users WHERE uidusers=? OR emailUsers=?"; //? is a placeholder
    $stmt = $connect->prepare($sql);

    if (!$stmt) { // if there is an error in the connection
      header('Location: ../index.php?error=emptyfields');
      //Send them back to the index page..
      exit();
    }
    else {
      $stmt->bindParam(1, $mailuid);
      $stmt->bindParam(2, $mailuid);
      //Bind the variables to the placeholders
      $stmt->execute();
      //Execute the statekemtn

      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($row == true) {
        $pwdCheck = password_verify($passwordUser, $row['pwd']);
        if ($pwdCheck == false) {
          header('Location: ../index.php?error=wrongpwd');
          //Send them back to the index page..
          exit();
        }
        else if ($pwdCheck == true) { // $pwdCheck can be 0 or 1, but if there is somekind of mistake we make an else if
          session_start();
          $_SESSION['userId'] = $row['idUsers'];
          $_SESSION['userUid'] = $row['uidusers'];

          header('Location: ../index.php?login=success');
          //Send them to the index page, now logged in
          exit();
        }
        else { // just in case
          header('Location: ../index.php?error=wrongpwdjustincase');
          //Send them back to the index page..
          exit();
        }
      }

      else { // no user , wrong username
        header('Location: ../index.php?error=nouser');
        //Send them back to the index page..
        exit();
      }
    }
  }
}

else {//if the user try to enter the login page without entering the login button
    //We send them back to the index page
    header("Location: ../index.php");
    exit();
}
