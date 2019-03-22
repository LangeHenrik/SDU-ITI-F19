<?php 

    include "includes/top.php";

    $postId = $_GET['postId'];
    $target_dir = "assets/img/";
    $postImg = "";

    require_once 'includes/db.php';

    $sql = "SELECT postId, postImg FROM posts WHERE postId = '$postId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data
        $row = $result->fetch_assoc();
        
        $postImg = $row['postImg'];
        $file = $target_dir . $postImg;

        //Delete image from folder
        if (!unlink($file)) {
            echo ("Error deleting $file");
        } else {
            echo ("Deleted $file");
        }

        //Delete the post from the database
        $sql2 = "DELETE FROM posts WHERE postId = '$postId'";

        if ($conn->query($sql2) === TRUE) {
            $conn->close();
            /* Redirect */
            header("Location: posts.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();

    } else {
        echo "<p>No post exist</p>";
    }

    include "includes/bot.php";
?>