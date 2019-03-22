<?php
include_once 'header.php';
include_once "includes/db_config.php";

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
            <form action="upload.inc.php" id="upload" method="POST" enctype="multipart/form-data">
              <input type="text" name="filetitle" placeholder="Image title">
              <input type="text" name="filedesc" placeholder="Image description">
              <input type="file" id="file" name="file">
              <button type="submit" name="submit">Upload</button>
            </form>
          </div>';


            }

            if (isset($_SESSION['u_id'])) {
              echo ' <section class="picture-links">
          <div class="wrapper">
            <h2>Pictures</h2> ';

              ?>

            <div id="pictures">
                <?php



                $sql = "SELECT * FROM pictures WHERE userid = '{$_SESSION['u_id']}'";

                //$sql = "SELECT * FROM pictures ORDER BY userid DESC LIMIT 20;";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $pictures = $stmt->fetchAll();

                // if ($pictures !== null) {
                foreach ($pictures as $pic) {
                  ?>
                <li>
                    <figure id="<?php echo $pic['id']; ?>">
                        <b>
                            <figcaption><?php echo $pic["titlePicture"] ?>
                                <img src=<?php echo $pic["imageFullNamePicture"]  ?>>
                                <?php echo $pic["descPicture"] ?> <br>
                    </figure>
                </li>

                <?php

              }
              
              

            }
            ?>



            </div>



        </div>
    </section>

</body>

</html>

<?php
include_once 'footer.php';
?> 