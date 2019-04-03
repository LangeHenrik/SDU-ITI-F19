<?php
include_once("../common/dao.php"); 
require_once("../common/alert.php");


$user = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$pw = filter_var($_POST['password']);
$rPw = filter_var($_POST['repeat-password']);
$fName = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
$lName = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
$zip = filter_var($_POST['zip'], FILTER_SANITIZE_NUMBER_INT);
$city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$phone = filter_var($_POST['phonenumber'], FILTER_SANITIZE_NUMBER_INT);

$alerts = 0;

if(isset($_POST['signup']))
{
    if(!preg_match("/^[a-zA-Z0-9æÆøØåÅ]{4,20}/", $_POST['username']))
    {
        Alert::message("Username must have atleast 4 characteres and a maximum of 15");
        ++$alerts;
    }
    if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/", $_POST['password'])) 
    {
        Alert::message("Password must be atleast 8 characters and contain 1 uppercase, lowercase and digit");
        ++$alerts;
    }
    if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/", $_POST['password'] && $pw !== $rPw))
    {
        Alert::message("Please repeat the password again");
        ++$alerts;
    }
    if(!preg_match("/^[a-zA-Z0-9_ ]{2,20}$/", $_POST['firstname']) || !preg_match("/^[a-zA-Z0-9]{2,8}$/", $_POST['lastname']))
    {
        Alert::message("Please enter a valid name");
        ++$alerts;
    }
    if(!preg_match("/^[0-9]{4}$/", $_POST['zip']))
    {
        Alert::message("Invalid ZIP code");
        ++$alerts;
    }
    if(!preg_match("/^[a-zA-Z0-9 ]*/", $_POST['city']))
    {
        Alert::message("Invalid City");
        ++$alerts;
    }
    if(!preg_match("/[a-zA-Z0-9æÆøØåÅ._-]+@[a-zA-Z0-9._-]+.[a-zA-Z]{2,4}/", $_POST['email']))
    {
        Alert::message("Invalid email");
        ++$alerts;
    }
    if(!preg_match("/^[+][0-9]{8,30}$/", $_POST['phonenumber']))
    {
        Alert::message("Invalid Phone Number, did you enter your country code? +..88888");
        ++$alerts;
    }

    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileDir = '../images/';
    $fileExt = explode('.', $fileName); // get the file extension by exploding by punctuation
    $fileActualExt = strtolower(end($fileExt)); // take de tend of arr, and make the ext lower
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

if(in_array($fileActualExt, $allowed))
{
    if($fileError === 0)
    {
        if($fileSize <= 1000000) //1gb
        {//unique prevent users uploading same filename, to ovewrite
            $fileNameNew = uniqid('', true).".".$fileActualExt; 
            $fileDestination = $fileDir.$fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);//upload the file to dir
        }
    } else 
    {
        echo "there was an error uploading your file";
    }
} else 
{
    echo "you can not upload this file type";
}
    if($alerts == 0)
    {
        try{
            //try and store user credentials in database
            $stmt = $conn->prepare(("INSERT INTO user (username, password, first_name, last_name, zip, 
            city, email, phone_number, profile_image) VALUES ('$user', '$pw', '$fName', '$lName', '$zip', '$city', '$email', '$phone', '$fileDestination');"));
        
        print_r($stmt);
        
            if($stmt->execute()){
                //echo "<br>SUCCES, record inserted in database<br>";
                $URL="/";    
                echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                //print_r($stmt->fetchObject());
        
            }
            else{
                echo "\nPDOStatement::errorInfo():\n";
                $arr = $stmt->errorInfo();
                print_r($arr);
            }
        }catch (PDOException $exception){
            echo "Error: " . $exception->getMessage();
        
        }
    }
    //echo '<br>'. "alerts:" . $alerts;
}





