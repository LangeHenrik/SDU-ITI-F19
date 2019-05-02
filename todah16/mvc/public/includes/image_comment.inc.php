<?php
require 'dbh.inc.php';

session_start();

$user_name =$_SESSION['user_name'];

$id = $_GET['id'];

$comment = $_POST['comment'];






if(insertComment($user_name, $id, $comment, $conn)){
    header("Location: ../index.php?comment=successful");
}


function insertComment($user_name, $id, $comment, $conn){
   
    $sql_insert = "INSERT INTO `comments`(`user_name`, `img_id`, `text`) VALUES (?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql_insert)){
        echo "There was a unexpected error.";
        return false;
    } else {
        mysqli_stmt_bind_param($stmt, "sds", $user_name, $id, $comment);
        mysqli_stmt_execute($stmt);
        return true;   
}
}
