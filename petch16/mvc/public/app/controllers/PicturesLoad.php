<?php
    include_once('\petch16\mvc\public\app\libraries\Database.php');
    $database = new Database();
    $conn = $database->getConn();
    $pictureNewCount = $_POST['pictureNewCount'];

    $sql = "SELECT * FROM images ORDER BY image_id DESC LIMIT $pictureNewCount";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row_count = $stmt->rowCount();

    if ($row_count > 0){

        while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){
            header("Content-type: image/jpeg");
            foreach ($row as $data_values){

                $title = $data_values['title'];
                $image = $data_values['image'];
                $description = $data_values['description'];

                echo '
                <div class="gallerybox">
                <h3>'.$title.'</h3>
                <img src="data:image/png;base64,'. base64_encode($image) .' "/>
                <p>'.$description.'</p>
                </div>
                <br>';
            }
        }
    } else {
        echo 'There are no pictures.';
    }
?>