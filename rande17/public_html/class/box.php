<?php
class Box{

    function getLeftBox($page = 'index'){
        $content = "";
        switch ($page) {
            case 'index':
                break;
        }
        echo "<div class='left-content'>".$content."</div>";
    }

    function getMainBox($page = 'index'){
        global $DB;
        $content = "";
        switch ($page) {
            case 'index':
                break;
            case 'upload':
                $content = "<form action='upload.php' method='post' enctype='multipart/form-data'><input type='text' name='name' placeholder='imagename'><br/><input type='text' name='desc' placeholder='Image Description'><br/>Select image to upload:<input type='file' name='fileToUpload' id='fileToUpload'> <input type='submit' value='Upload Image' name='submit'></form>";
                break;
            case 'myimage':
                $result = $DB->query("SELECT name, image_id, description, rating FROM image WHERE user LIKE '".$_SESSION['ID']."'");
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $content .= "<div id='image' class='imgdiv'><img class='imgpage' src='".UPLOADPATH.$row['image_id']."' alt='".$row['name']."'></img></div>";
                    }
                } else {
                    $content .= "you have no images uploaded yet";
                }
                break;
        }
        echo "<div class='main-content' id='{$page}'>".$content."</div>";
    }

    function getRightBox($page = 'index'){
        $content = "";
        switch ($page) {
            case 'index':
                break;
        }
        echo "<div class='right-content'>".$content."</div>";
    }

    function getTitle($name){
        echo "<div class='title'>".$name."</div>";
    }
}
