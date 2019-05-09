<?php
session_start();      
include_once '../app/services/Alert.php';      
Class Register extends Database {
    // Set user properties
    private $UserID;
    private $Username;
    private $First_Name;
    private $Last_Name;
    private $Zip;
    private $City;
    private $Email;
    private $Phone_Number;
    private $Profile_Image;

    // Db properties
    private $conn;
    private $table = 'user';

    public function __construct()
    {
        $this->conn = parent::connect();
    }

    public function signup($user, $pw, $rPw, $fName, $lName, $zip, $city, $email, $phone, $profileImage) {
        if($this->validate($user, $pw, $rPw, $fName, $lName, $zip, $city, $email, $phone))
        {
            $hashedPw = password_hash($pw, PASSWORD_DEFAULT);
            try{
                //try and store user credentials in database
                $stmt = $this->conn->prepare(("INSERT INTO Users (username, password, first_name, last_name, zip, 
                city, email, phone_number, profile_image) VALUES ('$user', '$hashedPw', '$fName', '$lName', '$zip', '$city', '$email', '$phone', '$profileImage');"));
    
            
                if($stmt->execute()){
                    $URL="home";    
                    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                    print_r($stmt->fetchObject());
                    return true;
                } else {
                    echo "\nPDOStatement::errorInfo():\n";
                    $arr = $stmt->errorInfo();
                    print_r($arr);
                    return false;
                }
            }catch (PDOException $exception){
                echo "Error: " . $exception->getMessage();
            }
        }

    }

    private function validate($user, $pw, $rPw, $fName, $lName, $zip, $city, $email, $phone) {
        $alerts = 0;    
        if(!preg_match("/^[a-zA-Z0-9æÆøØåÅ]{4,20}/", $user))
        {
            echo '<p style="color: red;">Username must have atleast 4 characters and a maxiumum of 15</p>';
            ++$alerts;
        }
        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/", $pw)) 
        {
            Alert::message("Password must be atleast 8 characters and contain 1 uppercase, lowercase and digit");
            ++$alerts;
        }
        if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/", $pw !== $rPw))
        {
            Alert::message("Please repeat the password again");
            ++$alerts;
        }
        if(!preg_match("/^[a-zA-Z0-9_ ]{2,20}$/", $fName) || !preg_match("/^[a-zA-Z0-9]{2,8}$/", $lName))
        {
            Alert::message("Please enter a valid name");
            ++$alerts;
        }
        if(!preg_match("/^[0-9]{4}$/", $zip))
        {
            Alert::message("Invalid ZIP code");
            ++$alerts;
        }
        if(!preg_match("/^[a-zA-Z0-9 ]*/", $city))
        {
            Alert::message("Invalid City");
            ++$alerts;
        }
        if(!preg_match("/[a-zA-Z0-9æÆøØåÅ._-]+@[a-zA-Z0-9._-]+.[a-zA-Z]{2,4}/", $email))
        {
            Alert::message("Invalid email");
            ++$alerts;
        }
        if(!preg_match("/^[+][0-9]{8,30}$/", $phone))
        {
            Alert::message("Invalid Phone Number, did you enter your country code? +..88888");
            ++$alerts;
        }
        if($alerts == 0)
        {
            return true;
        } else {
            return false;
        }
    }
    
}


