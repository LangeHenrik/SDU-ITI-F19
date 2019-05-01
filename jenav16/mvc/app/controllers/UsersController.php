<?php

class UsersController extends Controller{


    public function index ($param = "default") {
        //This is a proof of concept - we do NOT want HTML in the controllers!
        echo '<br><br>Default users controller<br>';
        echo 'Param: ' . $param . '<br><br>';
    }


    public function user($user){
        //This is a proof of concept - we do NOT want HTML in the controllers!
        echo '<br><br>Upload user called<br>';
        echo 'Param: ' . $user . '<br><br>';
    }

    public function all()
    {
        echo '<br><br>All user method called<br>';




    }


}