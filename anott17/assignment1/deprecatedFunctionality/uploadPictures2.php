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

  // $working_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
  // require_once 'db_config.php';
  // try {
  //   $conn = new PDO("mysql:host=$servername;dbname=$dbname",
  //   $username,
  //   $password,
  //   array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  //
  //   $insertPictureStmt = $conn->prepare("INSERT INTO picture(person, title, description, picture_file)
  //                                     VALUES(:person, :title, :description, :picture_file)");
  //
  // } catch (PDOException $e) {
  //   echo "Error: " . $e->getMessage();
  // }
  //
  // if (isset($_POST['image'])) {
  //   $userInput = htmlentities(filter_input(INPUT_POST, $_SESSION['userNameGlobal'], FILTER_SANITIZE_STRING));
  //   $pictureTitleInput = htmlentities(filter_input(INPUT_POST, "pictureName", FILTER_SANITIZE_STRING));
  //   $pictureDescInput = htmlentities(filter_input(INPUT_POST, "pictureDesc", FILTER_SANITIZE_STRING));
  //   // //$imageInput = htmlentities(filter_input(INPUT_POST, addslashes (file_get_contents($_FILES['myImage']['tmp_name'])), FILTER_SANITIZE_STRING));
  //   // $imageInput = addslashes (file_get_contents($_FILES['myImage']['tmp_name']));
  //   //$imageInput = addslashes(file_get_contents($_FILES['myImage']['tmp_name']));
  //   $imageInput = addslashes($_FILES['image']['name']);
  //
  //   $insertPictureStmt->bindparam(':person', $userInput);
  //   $insertPictureStmt->bindparam(':title', $pictureTitleInput);
  //   $insertPictureStmt->bindparam(':description', $pictureDescInput);
  //   $insertPictureStmt->bindparam(':picture_file', $imageInput);
  //   $didExecute = $insertPictureStmt->execute();
  //
  //   if ($didExecute) {
  //     move_uploaded_file($_FILES['image']['tmp_name'], $target_dir .$pictureTitleInput);
  //   }
  // }

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
    <form action="insert_file.php" class="uploadPictureForm" method="post">

      <label for="image" style="color: black">Picture file</label>
      <br>
      <input type="file" name="image">
      <br>

      <label for="pictureName" style="color: black">Picture  name</label>
      <br>
      <input type="text" name="pictureName">
      <br>

      <label for="pictureDesc" style="color: black">Picture description</label>
      <br>
      <input type="text" name="pictureDesc">
      <br>

      <input type="submit" value="Upload" name="submit" class="mainButton">
    </form>
    <?php echo 'user name: ' .$_SESSION['userNameGlobal'] ?>
  </body>
</html>
