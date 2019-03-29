<?php

if (isset($_POST['submit-upload'])) {
 session_start();
  include 'dbh.inc.php';

  $file = $_FILES['file'];

  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg', 'jpeg', 'png', 'pdf');

  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize < 1000000) {
        $fileNameNew = uniqid('', true).".".$fileActualExt;
        $fileDestination = '../uploads/'.$fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);

        $stmt = $connect->prepare("INSERT INTO images (idUser, uidUsers, path, name)
        VALUES (?, ?, ?, ?);");
        if (!$stmt) {
          header("Location: ../upload.php?error=sqlerror");
          exit();
        }
        $stmt->bindParam(1, $_SESSION['userId']);
        $stmt->bindParam(2, $_SESSION['userUid']);
        $stmt->bindParam(3, $fileDestination);
        $stmt->bindParam(4, $fileNameNew);

        $res = $stmt->execute();
        if (!$res){
          header("Location: ../upload.php?error=sqlerrorRES");
          exit();
        }
        header("Location: ../upload.php?uploadsuccess");
      }else {
        echo "Your file is to large!";
      }
    } else {
      echo "There was an error uploading your file!";
    }
  } else {
    echo "You cannot upload files of this type!";
  }
  $connect = null;
}
