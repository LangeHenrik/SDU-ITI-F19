<?php

include_once(__DIR__."\\..\\core\\Database.php");

class UserTable extends Database {

    // [{"user_id":"1","username":"jack"},{"user_id":"2", "username":"jill"}]
//    public $user_id;
//    public $username;

    public function __construct(){
        $this -> tablename = 'User';
        parent::__construct();
        $this ->fieldarray = array("id","username", "fname", "lname", "city", "zip",
           "email", "phone", "pwd");
    }

}