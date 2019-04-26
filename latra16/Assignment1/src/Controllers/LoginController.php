<?php

namespace Controllers;

use Router\IRequest;
use Services\DBService;
use Models\User;
use config\Database;

class LoginController extends Controller{

    private $db;


    public function __construct(){
       parent::__construct();
       $this->db = new DBService(new Database());
    }

    /**
     * 
     */
    public function render(IRequest $request) : string {
        return $this->html("Login");
    }

    /**
     * 
     */
    public function login(IRequest $request) {
        $body = $request->getBody();
        if($body['username']) $username = htmlentities(filter_var($body['username'], FILTER_SANITIZE_STRING));
        if($body['password']) $password = htmlentities(filter_var($body['password'], FILTER_SANITIZE_STRING));

        $user = $this->db->getUserByCredentials($username, $password);
        if($user){
            $this->startSession($user);
            header('Location: /', true, 303);
            die();
        } else {
            $errmsg = ["Wrong credentials."];
            return $this->html("login", ["errmsg" => $errmsg]);
        }
    }

    public function logout(IRequest $request) {
        session_start();
        $_SESSION = array();
        session_destroy();
        header('Location: /login', true, 303);
        die();
    }

    public function startSession(User $user){
        session_start();
        $_SESSION["id"] = $user->id;
        $_SESSION["username"] = $user->username;
        $_SESSION["firstname"] = $user->firstname;
        $_SESSION["lastname"] = $user->lastname;
        $_SESSION["email"] = $user->email;
    }
    
}

?>