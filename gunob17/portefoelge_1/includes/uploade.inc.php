<?php
if (isset($_POST['uploade_submit'])) {
  session_start();
  include 'dbh.php';


      $file = $_FILES['file'];
      $fileName = $_FILES['file']['name'];
      $fileTmpName = $_FILES['file']['tmp_name'];
      $fileSize = $_FILES['file']['size'];
      $fileError = $_FILES['file']['error'];
      $fileType = $_FILES['file']['type'];

      $fileExt = explode('.',$fileName);
      $fileActualExt = strtolower(end($fileExt));
      $allowed = array('jpg', 'jpeg', 'png', 'gif' );
      if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
          if ($fileSize < 100000000) {
            $newnamefile = uniqid('',true).".".$fileActualExt;
            $filedestination = '../uploades/'.$newnamefile;
            move_uploaded_file($fileTmpName, $filedestination);

            $stmt = $conn->prepare("INSERT INTO pictures(idus, username, path, name)
            VALUES (:userid, :username , :pathname, :name);");
            if (!$stmt) {
              header("Location: ../uploade.php?error=sqlerror");
              exit();
            }
            $stmt->bindParam(':userid', $_SESSION['userid']);
            $stmt->bindParam(':username', $_SESSION['useruid']);
            $stmt->bindParam(':pathname', $filedestination);
            $stmt->bindParam(':name', $newnamefile);

            $res = $stmt->execute();

            header("Location: ../index.php?uploade=success");
          }
          else {
            header("Location: ../uploade.php?error=toLarge");

          }
        }
        else {
            header("Location: ../uploade.php?error=uploadeerror");
          //echo "there was an error uploading this file";
        }
      }
      else {
          header("Location: ../uploade.php?error=wrongfileext");
        //echo "unable to uploade file of this type";
      }


  }


 ?>
