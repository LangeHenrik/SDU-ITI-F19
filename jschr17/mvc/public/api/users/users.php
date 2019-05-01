<?php
class User{
    public $user_id;
    public $username;

    //constructor
    public function __construct(int $user_id, string $username){
        $this->user_id = $user_id;
        $this->username = $username;
    }
}


?>