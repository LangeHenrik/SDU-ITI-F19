<?php
session_start();

require 'db_config.php';

// check whether user is logged in
if (!isset($_SESSION['username'])) {
    die("Failed: you need to log in first.");
}

// construct filepath
$filename = $_GET['filename'];
$filepath = $upload_path . $filename;

// check whether file exists
if (file_exists($filepath)) {
    // set appropriate headers so browsers can display the image
    header('Content-Length: ' . filesize($filepath));
    header('Content-type: ' . mime_content_type($filepath));

    readfile($filepath);
} else {
    http_response_code(404);
    echo "Error 404: File Not Found";
    die();
}
?>
