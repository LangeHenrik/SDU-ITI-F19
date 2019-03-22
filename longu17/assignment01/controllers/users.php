<?php
include_once("./common/dao.php"); 

try{
    //try and store user credentials in database
    $result = $conn->prepare("SELECT * FROM user;");
    $result->execute();
    $users = $result -> fetchAll();
}catch (PDOException $exception)
{
    echo "Error: " . $exception->getMessage();
}


?>
