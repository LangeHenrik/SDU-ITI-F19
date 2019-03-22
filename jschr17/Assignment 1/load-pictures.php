

<?php
    include 'config.php';
    $pictureNewCount = $_POST['pictureNewCount'];

    $sql = "SELECT * FROM images ORDER BY imgorder DESC LIMIT $pictureNewCount";
    $result = mysqli_query($link3, $sql);
    if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo '
            <div class="gallerybox">
            <h3>'.$row["title"].'</h3>
            <img src="images/'.$row["imgName"].'">
            <p>'.$row["imgdesc"].'</p>
            </div>
            <br>';
        }
    } else {
        echo 'There are no pictures.';
    }
?>

