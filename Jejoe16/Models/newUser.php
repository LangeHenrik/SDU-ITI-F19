<?php
/**
 * Created by PhpStorm.
 * User: Jesper
 * Date: 23-04-2019
 * Time: 22:16
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