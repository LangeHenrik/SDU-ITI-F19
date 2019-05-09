<?php


class LogoutService{
    
    public function logout(){
        if(isset($_POST['logout'])){    
            session_start();
            session_unset();
            session_destroy();
            header("Location: /todah16/mvc/public/home/login");
        }else {
            header("Location: /todah16/mvc/public/home/other");
            exit();    
            }
        
    }
    
    
}