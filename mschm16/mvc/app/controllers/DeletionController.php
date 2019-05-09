<?php 

$imgname = "";
$postID = $_GET['postID'];
$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);     
$imgpath = $pathroot . '/mschm16/mvc/app/models/uploads/';
require $pathroot . '/mschm16/mvc/app/core/Database.php';

$dbc = new Database();
$dbc->connectToDB();
$sqlfind = "SELECT postId, postImg FROM posts WHERE postId = '$postID'";
$result = mysqli_query($dbc->connectToDB(),$sqlfind);
    
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imgname = $row["postImg"];
    echo $imgname;
    $fullpath = $imgpath . $imgname;
    echo $fullpath;

    if (!unlink($fullpath)) {
        echo "Couldn't delete file.";
        echo $fullpath;
    } else {
        echo "File deleted.";
    }

    $sqldel = "DELETE FROM posts WHERE postId = '$postID'";

    if ($dbc->connectToDB()->query($sqldel)) {
        $dbc->connectToDB()->close();
        header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/mschm16/mvc/app/views/home/myposts.php" . $location);
        exit;
    } else { 
        echo "Nothing found.";
    }
}
?>