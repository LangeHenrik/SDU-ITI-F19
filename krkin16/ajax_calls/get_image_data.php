<?php
    require "../database.php";

    $displayUser = null;
    if(isset($_GET["user_images"])) {
        $displayUser = $_GET["user_images"];
    }

    echo json_encode(imagesInRange($_GET["start_index"], $_GET["amount"], $displayUser));
?>