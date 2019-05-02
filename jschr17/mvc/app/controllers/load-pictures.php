<?php
    include_once('C:\Users\goope\Documents\GitHub\SDU-ITI-F19\jschr17\mvc\app\core\Database.php');
    $database = new Database();
    $conn = $database->getConn();
    $pictureNewCount = $_POST['pictureNewCount'];

    $sql = "SELECT * FROM images ORDER BY image_id DESC LIMIT $pictureNewCount";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row_count = $stmt->rowCount();

    //$result = mysqli_query($conn, $sql);
    if ($row_count > 0){

        while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){
            header("Content-type: image/jpeg");
            foreach ($row as $data_values){

                //$image2 = imagecreatefromstring($data_values['image']);

                $title = $data_values['title'];
                $image = $data_values['image'];
                $description = $data_values['description'];
                //header("Content-type: image/jpeg");
                //echo $image;

                echo '
                <div class="gallerybox">
                <h3>'.$title.'</h3>
                <img src="data:image/png;base64,'. base64_encode($image) .' "/>
                <p>'.$description.'</p>
                </div>
                <br>';

            /*echo '
            <div class="gallerybox">
            <h3>'.$row["title"].'</h3>
            <img src="data:image/jpeg;base64 '. base64_encode($row["image"]) .' ">
            <p>'.$row["description"].'</p>
            </div>
            <br>';*/
            }


        }
    } else {
        echo 'There are no pictures.';
    }
?>

