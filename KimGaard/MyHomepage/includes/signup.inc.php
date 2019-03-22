<?php
if (isset($_POST['signup-submit'])) {

  require 'dbh.inc.php';

  $username = $_POST['uid'];
  $email = $_POST['mail'];
  $password = $_POST['pwd'];
  $passwordConfirm = $_POST['pwd-confirm'];

  if (empty($username) || empty($email) || empty($password) || empty($passwordConfirm)) {
    header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
    exit();
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../signup.php?error=invalidmailuid");
    exit();
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invalidmail&uid=".$username);
    exit();
  }
  elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../signup.php?error=invaliduid&mail=".$email);
    exit();
  }
  elseif ($password !== $passwordConfirm) {
    header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
    exit();
  }
  else {
    $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
    $stmt = $connect->prepare($sql);
    if (!$stmt) {
      header("Location: ../signup.php?error=sqlerrorSELECTFROMWHERE");
      exit();
    }

    else {
      $stmt->bindParam(1, $username);
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        header("Location: ../signup.php?error=usertaken&mail=".$email);
        exit();
      }
      else {
        $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
        $stmt = $connect->prepare($sql);
        if (!$stmt) {
          header("Location: ../signup.php?error=sqlerrorINSERTINTO");
          exit();
        }
        else {
          $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

          $stmt->bindParam(1, $username);
          $stmt->bindParam(2, $email);
          $stmt->bindParam(3, $hashedPwd);
          $stmt->execute();
          header("Location: ../login.php?signup=success");
          exit();
        }
      }
    }
  }
  $connect = null;
}
else {
  header("Location: ../signup.php");
  exit();
}
