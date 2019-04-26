<?php
  if (isset($_POST['login_submit'])) {
      include 'dbh.php';

      $uid = $_POST['username'];
      $pwd = $_POST['password'];

      if (empty($uid)|| empty($pwd)) {
          header("Location: ../login.php?error=emptyfields");
          exit();
      } else {
          $stmt = $conn->prepare("SELECT * from users where username = :username");
          if (!$stmt) {
              header("Location: ../login.php?error=sqlerror");
              exit();
          } else {
              $stmt->bindParam(':username', $uid);
              $stmt->execute();
              $user = $stmt->fetch(PDO::FETCH_ASSOC);
              if ($user == true) {
                  $pwdcheck = password_verify($pwd, $user['pwdusers']);
                  if ($pwdcheck == false) {
                      header("Location: ../login.php?error=wrongpwd");
                      exit();
                  } elseif ($pwdcheck == true) {
                      session_start();
                      $_SESSION['userid']= $user['idusers'];
                      $_SESSION['useruid']= $user['username'];
                      header("Location: ../index.php?login=success");
                      exit();
                  } else {
                      header("Location: ../login.php?error=wrongpwd");
                      exit();
                  }
              } else {
                  header("Location: ../login.php?error=NoUser");
                  exit();
              }
          }
      }
      $conn = null;
  } else {
      header("Location: ../login.php");
      exit();
  }
