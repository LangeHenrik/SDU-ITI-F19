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

  require_once 'db_config.php';
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
      move_uploaded_file($file_tmp, "pictures/".$hashedPicFile);

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
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel ="stylesheet" type="text/css" href="style.css">
    <title></title>
  </head>
  <body>
    <div class="pictureDiv">
      <?php
        echo '
        <form class="logOutForm" method="post">
          <button name="logout" class="logOutButton">Log out</button>
        </form>';
        echo '<h1>Upload pictures</h1>';
      ?>
    </div>
    <div class="menuDiv">
      <a href="pictures.php" class="menuButton">
        Pictures
      </a>
      <a href="uploadPictures.php" class="menuButton">
        Upload pictures
      </a>
      <a href="users.php" class="menuButton">
        Users
      </a>
    </div>
    <form action="" enctype="multipart/form-data" class="uploadPictureForm" method="post">

      <label for="image">Picture file</label>
      <br>
      <input type="file" name="image">
      <br>

      <label for="pictureName">Picture  name</label>
      <br>
      <input type="text" name="pictureName">
      <br>

      <label for="pictureDesc">Picture description</label>
      <br>
      <textarea name="pictureDesc" rows="5" cols="50"></textarea>
      <br>

      <!-- <label for="pictureDesc">Picture description</label>
      <br>
      <input type="text" name="pictureDesc">
      <br> -->

      <input type="submit" value="Upload" name="submit" class="mainButton">
    </form>
  </body>
</html>
