<?php


  // if uploaded button is pressed
  $page = $_GET['page']; //We have four uploadsites and four upload tables
  if (isset($_POST['upload_button'])) {

    include 'dbh_inc.php';
    session_start();

  //Get all the submitted data from the form
  // I do not use all the variables, but it does not work without em...
    $file = $_FILES['file'];
    $image = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $text = $_POST['text'];
    $target = "../Assignment1/".basename($_FILES['file']['name']);//The path to store the uploaded image
    //overwriter if multiple of the same image is uploaded

    $fileExt = explode('.', $image); //Extract the extention (file type)
    $fileActualExt = strtolower(end($fileExt)); // lowercase , so we only need to check on the lowercase jpg ect
    $allowed = array('jpg', 'jpeg', 'png', 'gif', 'mp4');

    if (in_array($fileActualExt, $allowed)) {
      //  if ($fileError === 0) {
            $fileDest = '../Assignment1/'.$image;
            //Check if the textarea is empty
            if (empty($text)) {
              header('Location: ../Sem'.$page.'.php?error=emptyfields');
              //Send them back to the Sem1 page..
              exit();
            }

          else {
            //Store the image

            if ($page == 1) {
              $sql = 'INSERT INTO images1 (uidusers, idUs, path, tex) VALUES (?, ?, ?, ?)'; //The ? are placeholders
              $stmt = $connect->prepare($sql);
            }
            else if ($page == 2) {
              $sql = 'INSERT INTO images2 (uidusers, idUs, path, tex) VALUES (?, ?, ?, ?)'; //The ? are placeholders
              $stmt = $connect->prepare($sql);
            }
            else if ($page == 3) {
              $sql = 'INSERT INTO images3 (uidusers, idUs, path, tex) VALUES (?, ?, ?, ?)'; //The ? are placeholders
              $stmt = $connect->prepare($sql);
            }
            else if ($page == 4) {
              $sql = 'INSERT INTO images4 (uidusers, idUs, path, tex) VALUES (?, ?, ?, ?)'; //The ? are placeholders
              $stmt = $connect->prepare($sql);
            }
            else {
              header('Location: ../Sem'.$page.'.php?error=pageerror');
              exit();
            }

            if (!$stmt) {//Is there an error in the sql statement
              header('Location: ../Sem'.$page.'.php?error=sqlerror');
              exit();
            }
            else {
              $stmt->bindParam(1, $_SESSION['userUid']);
              $stmt->bindParam(2, $_SESSION['userId']);
              $stmt->bindParam(3, $fileDest);
              $stmt->bindParam(4, $text);
              //Bind the variables 1, 2, 3 and 4 to the placeholders
              $res = $stmt->execute();
              //executing the sql statement
              if (!$res) {
                header('Location: ../Sem'.$page.'.php?error=sqlerror');
                exit();
              }
              if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
                header('Location: ../Sem'.$page.'.php?Success');
                //Moving the uploaded image to the folder
                exit();
              }
              else {
                header('Location: ../Sem'.$page.'.php?error=nopicture');
                exit();
              }
            }
          }
      //  }
      // else {
      //      header('Location: ../Sem'.$page.'.php?error=filerror'.$fileError.'file');
      //    exit();}
     }
      else {
          header('Location: ../Sem'.$page.'.php?error=notallowed');
        exit();}
  }
  else {
    header('Location: ../Sem'.$page.'.php?error=not');
    exit();
  }
?>
