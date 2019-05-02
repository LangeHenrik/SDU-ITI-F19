<?php
include_once("./common/dao.php"); 
//include_once("./models/userprofile.php");
$userid = $_SESSION['user_id'];

try{
    //try and store user credentials in database
    $user = $conn->prepare("SELECT * FROM user WHERE userid = $userid");
    $user->execute();
    $response = $user->fetchObject();
    $info = get_object_vars($response); 

}catch (PDOException $exception)
{
    echo "Error: " . $exception->getMessage();
}

?>
