<?php
//Checks if the user pressented the register button. 
    require 'dbh.inc.php';

if(isset($_POST['register-submit'])){    
    
  
    
    $username = $_POST['uname'];
    $password = $_POST['psw'];
    $f_name = $_POST['fname'];
    $l_name = $_POST['lname'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];
    $e_mail = $_POST['e-mail'];
    $phone = $_POST['phone_number'];
    
    if(checkUser($username, $conn)){
     if(insertUserinfo($username, $password, $f_name, $l_name, $zip, $city, $e_mail, $phone, $conn)){
         header("Location: ../Dankify_login.php");
     }  
    }
    
} else {
    header("Location: ../index.php");
    exit();    
}



//Fucntion to check if the user exists in the database.
function checkUser ($user, $conn) {
    $sql_register = "SELECT user_name FROM users WHERE user_name=?";
    $stmt = mysqli_stmt_init($conn);  
    
    if(!mysqli_stmt_prepare($stmt, $sql_register)){
        echo "There was a unexpected error.";
        return false;
    } else {
        mysqli_stmt_bind_param($stmt, "s", $user);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                echo "Username already taken, consult Dio."; 
                return false;
            } else {
                return true;
            }
    }
    
    
    
}

//Function to insert the data given in the POST form, where the password is hashed.     
function insertUserinfo ($username, $psw, $f_name, $l_name, $zip, $city, $e_mail, $phone, $conn){
    
    $sql_insert = "INSERT INTO `users`(`user_name`, `passw`, `first_name`, `last_name`, `zip`, `city`, `email`, `phone_number`) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql_insert)){
        echo "There was a unexpected error.";
        return false;
    } else {
        $hashPwd = password_hash($psw, PASSWORD_DEFAULT);
        
        mysqli_stmt_bind_param($stmt, "ssssdssd", $username, $hashPwd, $f_name, $l_name, $zip, $city, $e_mail, $phone);
        $result = mysqli_stmt_execute($stmt);
        return true;
        exit();
    }
    
}



