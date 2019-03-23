<?php
require_once 'dbconfig.php';
$usernamer = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$passwordr = filter_var($_POST['password'], FILTER_SANITIZE_STRING);


try{
  $conn = new PDO("mysql:host=$servername;dbname=$dbname",
  $username,
  $password,
  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


  $stmt = $conn->prepare("SELECT user_password FROM users WHERE user_username = :username;");


  $stmt->bindParam(':username', $usernamer);
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $result = $stmt->fetchAll();

  $passwordHash = $result[0]['user_password'];

  if (password_verify($passwordr, $passwordHash)) {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    $_SESSION["logged_in"]=true;
    header("Location:../Pictures.php");
  }

} catch (PDOException $e) {
  $error = $e->getMessage();
  echo "Error: " . $error;
}

  $conn = null;

 ?>
