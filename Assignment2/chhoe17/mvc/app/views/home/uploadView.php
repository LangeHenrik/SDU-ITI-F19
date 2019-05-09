<?php
include_once 'menu.php';
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    <section class="main-container">
        <div class="main-wrapper">
            <h2>Manage your pictures</h2>

            <?php
            //display a message and images if logged in!
            if (isset($_SESSION['u_id'])) {
              echo "Upload your pictures";

              echo '<div class="picture-upload">
            <h2>Upload</h2>
            <br>
            <br>
            <br>
            <form action="../../Controllers/UploadController.php" id="upload" method="POST" enctype="multipart/form-data">
              <input type="text" name="filetitle" placeholder="Image title">
              <input type="text" name="filedesc" placeholder="Image description">
              <input type="file" id="file" name="file">
              <button type="submit" name="submit">Upload</button>
            </form>
          </div>';


            }

           
            ?>

<?php
            //Check if user is logged in
         if (isset($_SESSION['u_id'])) {
            include ("../../controllers/ShowPicController.php");
        }
        ?>



            </div>



        </div>
    </section>

</body>

</html>