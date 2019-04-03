<?php
include("./common/dao.php"); 
include("./common/alert.php");

$username = $_POST['username'];
$password = $_POST['password'];
$userInfo = 0;
$_SESSION['user_id']= null;

if(isset($_POST['login'])) 
{
      $stmt = $conn->prepare("select * from user where username = '$username' and password = '$password';");
        $stmt->execute(); 
        $userInfo = $stmt->fetchObject();
        //print_r($userInfo);
        //echo "<br> <br>";
        //print_r($userInfo->Username);
        //print_r($userInfo->UserID);  
    if($userInfo > 0)
    {
        $_SESSION['user_id'] = $userInfo->UserID;   
        $URL="home";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo 'You have entered valid use name and password';
    } else 
    {
       Alert::message("Invalid username or password");
    }
}
?>