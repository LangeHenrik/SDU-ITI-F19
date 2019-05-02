<?php
include_once "../app/core/Database.php";


class LoginService(){


if(isset($_POST['login'])){
    
    require 'dbh.inc.php';
    
    $username = $_POST['uname'];
    $password = $_POST['psw'];
    
    checkUser($username, $conn);
    checkLogin($username, $password, $conn);
            
        
        
    
    
    
    
} else {
    header("Location: ../index.php");
    exit();    
}



private function checkLogin($username, $password, $conn){
    $sql_login = "SELECT user_name, passw FROM users WHERE user_name=? OR email =?;";
    $stmt = mysqli_stmt_init($conn);
    
     if(!mysqli_stmt_prepare($stmt, $sql_login)){
        echo "There was a unexpected error.";
        return false;
    } else {
    
    
    
    mysqli_stmt_bind_param($stmt, "ss", $username, $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){ 
                $pwdCheck = password_verify($password, $row['passw']);
                if(!$pwdCheck){
                    echo "Please try again, wrong password";
                    return false;
                    header("Location: ../index.php");
                    exit();
                }
                session_start();
                $_SESSION['userID'] = $row['user_id'];
                $_SESSION['user_name'] = $row['user_name'];
                        
                header("Location: ../index.php?login=success");
                exit();
    
            } else {
                echo "An error occurred.";
                return false;
            }
     }
}


private function checkUser ($user, $conn) {
    $query= "SELECT user_name FROM users WHERE user_name=?";
    $stmt = mysqli_stmt_init($conn);  
    
    if(!mysqli_stmt_prepare($stmt, $query)){
        echo "There was a unexpected error.";
        return false;
    } else {
        mysqli_stmt_bind_param($stmt, "s", $user);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                return true;
            } else {
                echo "Could not find the username, consult Dio."; 
                return false;
                
            }
    }
    
    
    
}
    
}