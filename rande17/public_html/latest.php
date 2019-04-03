<?php
$content = "<h1>Latest Images</h1>";
require_once("class/function.php");
$function->enforceLogin();
$result = $DB->query("SELECT image_id, name FROM image ORDER BY created DESC LIMIT 20");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $content .= "<div id='image' class='imgdiv'><img class='imgpage' src='" . UPLOADPATH . $row['image_id'] . "' alt='" . $row['name'] . "'></img></div>";
    }
} else {
    $content .= "no images uploaded yet";
}
echo $content;
