<?php
  include "header.php";
  include "config.php";

  if (isset($_POST['upload'])) {
      // The path to store the uploaded image




      // Get all the sumbmitted data from the form
      $file = $_FILES['file'];
      $image = $_FILES['file']['name'];
      $fileTmpName = $_FILES['file']['tmp_name'];
      $fileSize = $_FILES['file']['size'];
      $fileError = $_FILES['file']['error'];
      $fileType = $_FILES['file']['type'];
      $comment = $_POST['comment'];
      $target =   "posts/".basename($_FILES['file']['name']);
      $fileDest = "posts/".$image;
      // prepare
      // There are nothing checking the filetype at the moment. This feature might come at a later state.

      $sql = "INSERT INTO posts (uploaded_by, image_path, comment) VALUES (:id,:image, :comment);";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(":id",$_SESSION['id'],PDO::PARAM_STR);
      $stmt->bindParam(":image",$fileDest,PDO::PARAM_STR);
      $stmt->bindParam(":comment",$comment,PDO::PARAM_STR);


      $stmt->execute(); // Stores the submitted data into the database table: photo
      // Move the uploaded image into the folder: images
      if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
        $msg = "Image uploaded succesfully";
        header("location:startpage.php");
      } else {
        $msg = "There was a problem uploading image";
      }

    }

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/uploadImgStyle.css">
    <title>Add post</title>

    <script>
    // 1. create a new XMLHttpRequest object -- an object like any other!
    var myRequest = new XMLHttpRequest();
    // 2. open the request and pass the HTTP method name and the resource as parameters
    myRequest.open('GET', 'surprise.html');
    // 3. write a function that runs anytime the state of the AJAX request changes
    myRequest.onreadystatechange = function () {
        // 4. check if the request has a readyState of 4, which indicates the server has responded (complete)
        if (myRequest.readyState === 4) {
            // 5. insert the text sent by the server into the HTML of the 'ajax-content'
            document.getElementById('ajax_content').innerHTML = myRequest.responseText;
        }
    };

    function sendAjax() {
        myRequest.send();
        document.getElementById('reveal').style.display = 'none';
    }

    </script>


  </head>
  <body>
    <div class="content">
    <form class="upload" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
       <input type="hidden" name="size" value="1000000">
       <div>
         <input type="file" name="file">
         <br><br>
       </div>
       <div>
         <textarea name="comment" rows="3" cols="40" placeholder="Say something about this image..."></textarea>
       </div>
       <div>
         <input type="submit" name="upload" value="Upload Image">
       </div>
     </form>





    <div class="ajax_content">
        <h1>Today's your special day!</h1>
        <button id="reveal" onclick="sendAjax()" class="button">Why's that?</button>
        <div id="ajax_content">

        </div>
    </div>
        </div>

  </body>
</html>
