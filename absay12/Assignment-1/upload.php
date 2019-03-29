<?php
  session_start();

  if(!isset($_SESSION['Login'])){
    die("Please login first.");
  }

  if (!(isset($_SESSION['Login'])) || ($_SESSION['Login'] !== true)) {
    echo 'You are not logged in.';
    return;
  }
  if (isset(($_POST["logout"]))) {
    header('Location: index.php');
    $_SESSION['Login'] = false;
    session_destroy();
  }
  require_once 'include/config.php';
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",
    $username,
    $password,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $insertPictureStmt = $conn->prepare("INSERT INTO picture(person, title, description, picture_file, date_uploaded)
                                      VALUES(:person, :title, :description, :picture_file, now())");
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  if (isset($_FILES['image'])) {
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $tmp = explode('.',$_FILES['image']['name']);
    $file_ext=strtolower(end($tmp));
    $dotString = '.';
    $hashedPicFile = hash("sha1", $file_name).$dotString.$file_ext;
    $extensions= array("jpeg","jpg","png");
    if(in_array($file_ext, $extensions) === false) {
      $erros[]="extensions not allowed";
    }
    if ($file_size > 20000000) {
      $errors[]="file too big";
    }
    if(empty($errors)==true){
      ///move_uploaded_file($file_tmp, "pictures/".$file_name);
      move_uploaded_file($file_tmp, "img/".$hashedPicFile);
      $userInput = $_SESSION['userNameGlobal'];
      $pictureTitleInput = htmlentities(filter_input(INPUT_POST, "pictureName", FILTER_SANITIZE_STRING));
      $pictureDescInput = htmlentities(filter_input(INPUT_POST, "pictureDesc", FILTER_SANITIZE_STRING));
      //$imageInput = $file_name;
      $imageInput = $hashedPicFile;
      $insertPictureStmt->bindparam(':person', $userInput);
      $insertPictureStmt->bindparam(':title', $pictureTitleInput);
      $insertPictureStmt->bindparam(':description', $pictureDescInput);
      $insertPictureStmt->bindparam(':picture_file', $imageInput);
      $didExecute = $insertPictureStmt->execute();
    } else {
      print_r($errors);
    }
  }
  $conn = null;
?>
<!DOCTYPE html> 
<html lang="da"> 
<head> 
  <meta charset="utf-8"> 
  <title>Absay12 - Upload</title> 
  <link rel="stylesheet" href="css/reset.css"> 
    <link rel="stylesheet" href="css/grid.css"> 
  <link rel="stylesheet" href="css/core.css"> 
  <link rel="stylesheet" href="css/rwd.css"> 
</head> 
<body> 
<!--Navigation-->
<div class="row col100">
  <div><?php include 'include/nav.php';?></div>
</div> 

<div class="after_nav">
    <h1>Upload a image!</h1>
    </div>
    
<div class="row col100">
  <div>
    <form action="" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="image" id="fileToUpload"><br>
    <br>
    <label>Header</label>
    <input type="text" name="pictureName">
    <label>Description</label>
    <textarea name="pictureDesc" rows="5" cols="50"></textarea>
    <input class="form-submit-button" type="submit" value="Upload Image" name="submit">
</form>
  </div>
</div>

</body> 
</html>