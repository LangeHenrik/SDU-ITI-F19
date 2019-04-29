<?php

include_once(__DIR__."\\..\\core\\Database.php");

class UserTable extends Database {

    // [{"user_id":"1","username":"jack"},{"user_id":"2", "username":"jill"}]

    public function __construct(){
        $this -> tablename = 'User';
        parent::__construct();
        $this ->fieldarray = array("username", "fname", "lname", "city", "zip",
           "email", "phone", "pwd");
    }

}