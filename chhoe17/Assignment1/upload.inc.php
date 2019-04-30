<?php
include "upload.php";
  //Find the ID of the USER
  session_start();
  include_once 'includes/db_config.php';


  $pictureTitle = ($_POST["filetitle"]);
  $pictureText = ($_POST["filedesc"]);
//Fnd ID from the user
  //$user = $_SESSION["u_id"];
  $user = $_SESSION['u_id'];

  $queryUserID = 'SELECT user_id from '.'users'. ' where user_name="'. $user.'";';

  $stmt = $conn -> prepare($queryUserID);

  $stmt -> execute();
  $result = $stmt -> fetch(PDO::FETCH_ASSOC);


  //FileDic
  $fileDirectory = "uploads/";


  $fileHandled = $fileDirectory . basename($_FILES["file"]["name"]);
  


  //The tmp_name fpor temp dic
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $fileHandled)) {
    
      $picture = 'INSERT INTO pictures (titlePicture, descPicture, userid, imageFullNamePicture) 
      VALUES (:titlePicture, :descPicture, :userid, :imageFullNamePicture);';
      $stmt = $conn->prepare($picture);
      $stmt -> bindParam(":titlePicture", $pictureTitle);
      $stmt -> bindParam(":descPicture", $pictureText);
      $stmt -> bindParam(":userid", $user);
      $stmt -> bindParam(":imageFullNamePicture", $fileHandled);
      $stmt -> execute(); 
      header("Location: upload.php?`Success");
      ?>

  <?php } else {

        header("Location: upload.php?Error");
  }
  header("Location: upload.php");


