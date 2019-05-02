<?php


class RegisterService{
    
    public function register($Users, $UserModel){
    if(isset($_POST['register-submit'])){    
    
     $isNewUser = true;
    
    $username = $_POST['uname'];
    $password = $_POST['psw'];
    $f_name = $_POST['fname'];
    $l_name = $_POST['lname'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];
    $e_mail = $_POST['e-mail'];
    $phone = $_POST['phone_number'];
    
        
    foreach($Users as $user){
  
        if($user->user_name == $username) {
            $isNewUser = false;
            echo $user->user_name;
        } 
    }    
    if($isNewUser == true){    
    $hashPwd = password_hash($password, PASSWORD_DEFAULT);    
    
    $newUser = new NewUser($username, $hashPwd, $f_name, $l_name, $zip, $city, $e_mail, $phone);     
      
        return $newUser;   
    }
        
    
} else {
    header("Location: /todah16/mvc/public/home/register");
    exit();    
}
        
    }
    
    
}