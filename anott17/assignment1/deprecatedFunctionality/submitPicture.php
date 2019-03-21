<?php
session_start();

if (!(isset($_SESSION['Login'])) || ($_SESSION['Login'] !== true)) {
  echo 'You are not logged in.';
  return;
}

if (isset(($_POST["logout"]))) {
  header('Location: index.php');
  $_SESSION['Login'] = false;
  session_destroy();
}

$_SESSION['pictureUploadedMsg'] = ' ';
$target_dir = $_SERVER['DOCUMENT_ROOT'] . '/pictures/';
require_once 'db_config.php';
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname",
  $username,
  $password,
  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  $myPerson = $_SESSION['userNameGlobal'];
  $myTitle = htmlentities(filter_input(INPUT_POST, "pictureTitle", FILTER_SANITIZE_STRING));
  $myDesc = htmlentities(filter_input(INPUT_POST, "pictureDesc", FILTER_SANITIZE_STRING));
  $myImage = addslashes($_FILES['image']['name']);

  $sql = 'INSERT INTO picture(person, title, description, picture_file)
          VALUES (:person, :title, :description, :picture_file);';
  $stmt = $conn -> prepare($sql);

  if (empty($myImage)) {
    echo'choose a picture.';
  } else if ($_FILES['image']['size'] > 0){
    $stmt -> bindParam(':person', $myPerson);
    $stmt -> bindParam(':title', $myTitle);
    $stmt -> bindParam(':description', $myDesc);
    $stmt -> bindParam(':picture_file', $myImage);

    $queryExecuted = $stmt -> execute();

    if ($queryExecuted) {
      move_uploaded_file($_FILES['image']['tmp_name'], $target_dir .$myTitle);
    }
  }

  else {
    echo'notexecuted';
  }

} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}

$conn = null;
?>
