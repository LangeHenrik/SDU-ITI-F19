<?php



class LoginService {

public function login($Users){
if(isset($_POST['login'])){
    
    //require 'dbh.inc.php';
    
    $db = new Database();
    $conn = $db->conn;
    
    $username = $_POST['uname'];
    $password = $_POST['psw'];
    
    
    foreach($Users as $user){
        if($user->user_name == $username || $user->email == $username){
            if(!password_verify($password, $user->passw)){
                 echo "Please try again, wrong password";
                 exit();    
            } else {
                session_start();
                $_SESSION['userID'] = $user->id;
                $_SESSION['user_name'] = $user->user_name;
                $_SESSION['logged_in'] = true;
                header("Location: /todah16/mvc/public/home/other");
                exit();
            }
        }
    }
    
    
    //$this->checkUser($username, $conn);
    //$this->checkLogin($username, $password, $conn);
            
        
        
    
    
    
    
} else {
    header("Location: /todah16/mvc/public/home/login");
    exit();    
}

}

}