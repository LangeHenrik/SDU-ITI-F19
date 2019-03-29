<?php

if (isset($_POST['Login'])) {

  include 'dbh.inc.php';

  $mailuid = $_POST['mailuid'];
  $password = $_POST['pwd'];

  if (empty($mailuid) || empty($password)) {
    header("Location: ../index.php?error=emptyfields");
    exit();
  }
  else {
    $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
    $stmt = $connect->prepare($sql);
    if (!$stmt) {
      header("Location: ../index.php?error=usernameOrEmailALreadyExist");
      exit();
    }
    else {
      $stmt->bindParam(1, $mailuid);
      $stmt->bindParam(2, $mailuid);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($row == true) {
        $pwdCheck = password_verify($password, $row['pwdUsers']);
        if ($pwdCheck == false) {
          header("Location: ../index.php?error=wrongpassword");
          exit();
        }
        elseif ($pwdCheck == true) {
          session_start();
          $_SESSION['userId'] = $row['idUsers'];
          $_SESSION['userUid'] = $row['uidUsers'];

          header("Location: ../index.php?login=success");
          exit();
        }
        else {
          header("Location: ../index.php?error=wrongpassword");
          exit();
        }
      }
      else {
        header("Location: ../index.php?error=nouser");
        exit();
      }
    }

  }
}
else {
  header("Location: ../index.php");
  exit();
}
