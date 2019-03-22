<?php
require "header.php";
?>


<main>
    <?php
    if (isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
        echo '<div class="row">
        <div class="container">
            <form action="resources/gallery.res.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-25">
                        <label for="title">Image Title</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="title" name="imagetitle" placeholder="Title..">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="description">Image Description</label>
                    </div>
                    <div class="col-75">
                        <textarea id="desc" name="imagedesc" placeholder="Write a description.." style="height:100px"></textarea>
                    </div>
                </div>

                <div class="row">
                    <input type="file" name="image" >
                    <input type="hidden" name="userId" value='.$userId.'>
                    <button type="submit" name="image-submit" >Upload</button>
                </div>
            </form>
        </div>
        </div>';
    }
    else {
        echo '<div class="row"><h1>Log in to upload images</h1></div>';
    }
    ?>
    <div class="row">

        <div class="leftcolumn">
            <div class="card">
                <div class="flex-container">
                    <?php
                    include_once 'resources/databaseHandler.res.php';


                    $sql = "SELECT * FROM gallery WHERE idUsers = '$userId' ORDER BY idGallery DESC;";
                    $statement = mysqli_stmt_init($connection);
                    if (!mysqli_stmt_prepare($statement, $sql)) {
                        echo "SQL statement failed!";
                    }
                    else {
                        mysqli_stmt_execute($statement);
                        $result = mysqli_stmt_get_result($statement);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $galleryUid = $row["idUsers"];
                            $sqlUser = "SELECT uidUsers FROM users WHERE idUsers = '$galleryUid';";
                            if (!mysqli_stmt_prepare($statement, $sqlUser)) {
                                echo "SQL statement failed!";
                            }
                            else {
                                mysqli_stmt_execute($statement);
                                $resultUser = mysqli_stmt_get_result($statement);
                                $rowUser = mysqli_fetch_assoc($resultUser);
                            }
                            echo '<div class="gallery">
                                    <form action="resources/gallery.res.php" method="post" enctype="multipart/form-data">
                                        <h2>'.$row["titleGallery"].'</h2>
                                        <p>By: '.$rowUser["uidUsers"].'</p>
                                        <!--<img style="background-image: url(resources/gallery/'.$row["imageNameGallery"].');"></img>-->
                                        <img src="resources/gallery/'.$row["imageNameGallery"].'">
                                        <div class="desc">'.$row["descGallery"].'</div>
                                        <button type="submit" name="image-delete" value="'.$row["imageNameGallery"].'" >Delete</button>
                                    </div>
                                </form>';
                        }
                    }


                    ?>

                </div>
            </div>

        </div>
        <div class="rightcolumn">
            <div class="card">
                <h2>About Me</h2>
                <a target="_blank" href="resources/sam.jpg">
                    <img src="resources/sam.jpg" alt="Sam" style="width: 100%;">
                </a>
                <p>Some text..</p>
            </div>
        </div>
    </div>

</main>

<?php
require "footer.php";
?>
