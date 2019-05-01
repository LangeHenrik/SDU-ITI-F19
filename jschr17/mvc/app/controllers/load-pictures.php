<?php
    include_once(__DIR__ . '/../../../app/core/Database.php');
    $database = new Database();
    $conn = $database->getConn();

    $pictureNewCount = $_POST['pictureNewCount'];

    $sql = "SELECT * FROM images ORDER BY imgorder DESC LIMIT $pictureNewCount";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row_count = $stmt->fetchColumn();

    //$result = mysqli_query($conn, $sql);
    if ($row_count > 0){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            header("Content-type: image/jpeg");
            echo '
            <div class="gallerybox">
            <h3>'.$row["title"].'</h3>
            <img src="$row["image"]">
            <p>'.$row["imgdesc"].'</p>
            </div>
            <br>';
        }
    } else {
        echo 'There are no pictures.';
    }
?>

