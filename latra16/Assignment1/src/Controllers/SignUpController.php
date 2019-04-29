<?php

namespace Controllers;

use Router\IRequest;
use Services\DBService;
use Models\DTO\UserDTO;
use config\Database;

class SignUpController extends Controller{


    private $db;


    public function __construct(){
       parent::__construct();
       $this->db = new DBService(new Database());
    }

    /**
     * 
     */
    public function render(IRequest $request) : string {
        if(!isset($_SESSION)){
            session_start();
        }
        if(isset($_SESSION['username'])){
            header('Location: /', true, 303);
            die();   
        }
        return $this->html("Register");
    }

    /**
     * 
     */
    public function register(IRequest $request){
        $body = $request->getBody();
        if($body['username']) $username = htmlentities(filter_var($body['username'], FILTER_SANITIZE_STRING));
        if($body['password']) $password = htmlentities(filter_var($body['password'], FILTER_SANITIZE_STRING));
        if($body['firstname']) $firstname = htmlentities(filter_var($body['firstname'], FILTER_SANITIZE_STRING));
        if($body['lastname']) $lastname = htmlentities(filter_var($body['lastname'], FILTER_SANITIZE_STRING));
        if($body['city']) $city = htmlentities(filter_var($body['city'], FILTER_SANITIZE_STRING));
        if($body['zip']) $zip = htmlentities(filter_var($body['zip'], FILTER_SANITIZE_NUMBER_INT));
        if($body['email']) $email = htmlentities(filter_var($body['email'], FILTER_SANITIZE_EMAIL));
        if($body['phone']) $phone = htmlentities(filter_var($body['phone'], FILTER_SANITIZE_NUMBER_INT));

        $hashPassword = hash("ripemd160", $password);

        $user = new UserDTO($username, $hashPassword, $firstname, $lastname, $city, $zip, $email, $phone);
        
        // Check if user already exists
        if($this->db->getUserByUsername($username)){
            $errmsg = ["Unfortunately, your username is not available."];
            return $this->html("register", ["errmsg" => $errmsg]);
        }

        // Validate username
        if(!preg_match('/[a-zA-Z][a-zA-Z0-9.\-_]{5,31}/', $username)){
            $errmsg = ["Username not valid due to one of the following rules: The first character must be a letter. The username can only contain alphanumeric characters, periods, hyphens, and underscores. The username is 6-32 characters long."];
            return $this->html("register", ["errmsg" => $errmsg]);
        }

        // Validate password
        if(!preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}/', $password)){
            $errmsg = ["Your password must at least contain 8 characters, at least one uppercase letter, one lowercase letter, one number, and one special character."];
            return $this->html("register", ["errmsg" => $errmsg]);
        }

        // Validate first name
        if(!(strlen($firstname) >= 1)){
            $errmsg = ["Your first name must contain at least 1 character."];
            return $this->html("register", ["errmsg" => $errmsg]);
        }

        // Validate last name
        if(!(strlen($lastname) >= 1)){
            $errmsg = ["Your last name must contain at least 1 character."];
            return $this->html("register", ["errmsg" => $errmsg]);
        }

        // Validate city
        if(!(strlen($city) >= 1)){
            $errmsg = ["Your city must contain at least 1 character."];
            return $this->html("register", ["errmsg" => $errmsg]);
        }

        // Validate zip
        if(!preg_match('/[0-9]/', $zip)){
            $errmsg = ["Your zip code can only contain numbers."];
            return $this->html("register", ["errmsg" => $errmsg]);
        }

        // Validate email
        if(!preg_match('/[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/', $email)){
            $errmsg = ["Your email seems to be invalid."];
            return $this->html("register", ["errmsg" => $errmsg]);
        }

        // Validate phone
        if(!preg_match('/[0-9]/', $phone)){
            $errmsg = ["Your phone number can only contain numbers."];
            return $this->html("register", ["errmsg" => $errmsg]);
        }
        
        $result = $this->db->registerUser($user);
        if(!$result){ 
            $errmsg = ["Please try again later."];
            return $this->html("register", ["errmsg" => $errmsg]);
        }
        else{
            header('Location: /login', true, 303);
            die();
        }
    }
    
}

?>