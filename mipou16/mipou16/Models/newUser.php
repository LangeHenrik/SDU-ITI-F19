<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 29-04-2019
 */


class newUser {


    public function NewUserCreated(){

        header("location: ../View/login.php");
    }
    public function Error(){

        $message = "Username already exist";

        echo "<script type='text/javascript'>alert('$message');</script>";
        
    }
}