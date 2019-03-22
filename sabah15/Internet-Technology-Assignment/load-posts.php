<?php
    include_once 'resources/databaseHandler.res.php';

    $postNewCount = $_POST['postNewCount'];

    $sql = "SELECT * FROM gallery ORDER BY idGallery DESC LIMIT $postNewCount;";
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
                                            <h2>'.$row["titleGallery"].'</h2>
                                            <p>By: '.$rowUser["uidUsers"].'</p>
                                            <img src="resources/gallery/'.$row["imageNameGallery"].'">
                                            <div class="desc">'.$row["descGallery"].'</div>
                                        </div>';
        }
    }


?>