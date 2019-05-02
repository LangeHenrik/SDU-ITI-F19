<?php


if (isset($_POST['signup_submit'])) {
  include 'dbh.php';

  $firstN = $_POST['firstname'];
  $lastN = $_POST['lastname'];
  $email = $_POST['email'];
  $zip = $_POST['zip'];
  $city = $_POST['city'];
  $phoneN = $_POST['phonenumber'];
  $uid = $_POST['username'];
  $email = $_POST['email'];
  $pwd = $_POST['password'];
  $repwd = $_POST['rep_password'];
  if (empty($uid) ||empty($email) ||empty($pwd) ||empty($repwd)) {
    //header("Location: ../signup.php?error=emptyfields&username=".$uid."&email=".$email);
    exit();
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)&&!preg_match("/^[a-zA-Z0-9]*$/",$uid)) {
    //header("Location: ../signup.php?error=invalidEmail&invalidusername");
    exit();
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //header("Location: ../signup.php?error=invalidEmail&username=".$uid);
    exit();
  }
  elseif (!preg_match("/^[a-zA-Z0-9]*$/",$uid)) {
    //header("Location: ../signup.php?error=invalidusername&email=".$email);
    exit();
  }
  elseif (!preg_match("/^[a-zA-ZÆØÅæøå]*$/",$firstN)) {
    //header("Location: ../signup.php?error=invalidname");
    exit();
  }
  elseif (!preg_match("/^[a-zA-ZÆØÅæøå]*$/",$lastN)) {
    //header("Location: ../signup.php?error=invalidname");
    exit();
  }
  elseif (!preg_match("/^[0-9]*$/",$zip)) {
    //header("Location: ../signup.php?error=invalidzip");
    exit();
  }
  elseif (!preg_match("/^[a-zA-ZÆØÅæøå]*$/",$city)) {
    //header("Location: ../signup.php?error=invalidcity");
    exit();
  }
  elseif (!preg_match("/^[0-9]*$/",$phoneN)) {
    //header("Location: ../signup.php?error=invalidphoneNr");
    exit();
  }
  elseif ($pwd !== $repwd) {
    //header("Location: ../signup.php?error=passwordcheck&username=".$uid."&email=".$email);
    exit();
  }
  else {

    $stmt = $conn->prepare("SELECT username from users where username = :username");
    if (!$stmt) {
      //header("Location: ../signup.php?error=sqlerror");
      exit();
    }
    $stmt->bindParam(':username', $uid);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
      //header("Location: ../signup.php?error=usernameInUse&email=".$email);
      exit();
    }
  }
    try{
    $stmt = $conn->prepare("INSERT INTO users (fname, lname, zip, city, phoneN, username, email, pwdusers)
    VALUES (:fname, :lname, :zip, :city, :phoneN, :username, :email, :password)");
    if (!$stmt) {
      //header("Location: ../signup.php?error=sqlerror");
      exit();
    }
    $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);
    $stmt->bindParam(':fname', $firstN);
    $stmt->bindParam(':lname', $lastN);
    $stmt->bindParam(':zip', $zip);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':phoneN', $phoneN);
    $stmt->bindParam(':username', $uid);
    $stmt->bindParam(':password', $hashedpwd);
    $stmt->bindParam(':email', $email);
    $res = $stmt->execute();
    if (!$res){
      //header("Location: ../signup.php?error=sqlerror");
      exit();
    }
    else {
        //header("Location: ../signup.php?signup=success");
        exit();
    }
  }
  catch(PDOException $e){
    //header("Location: ../signup.php?error=sqlerror");
    exit();
  }

  $conn = null;

}
else{
  //header("Location: ../signup.php");
  exit();
}


?>
