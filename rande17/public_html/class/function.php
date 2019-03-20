<?php

include_once("db.php");

class Functions {

    function getLoginForm(){
        require_once("form.php");
        $form = new Forms;
        $form->login();
    }

    function getSignupForm(){
        require_once("form.php");
        $form = new Forms;
        $form->signup();
    }

    function saveusername(){
        if(isset($_POST['save_cookie'])){
            if($_POST['save_cookie'] == "checked"){
                $user = $_POST['username'];
                if(isset($user)){
                    setcookie("user", $user, time() + (86400 * 30));
                }
            }}
    }

    function enforceLogin(){
        global $DB;
        $result = $DB->query("SELECT NOW()");
        session_start();
        if(!$_SESSION['loggedin']){
            header("location: login.php");
        }
    }

    function login($user, $password){
        global $DB;
        $users = [];
        $stmt = $DB->prepare("SELECT * FROM user WHERE username=? ");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $users = $result->fetch_assoc();
        $pass = hash('sha512', $password.$users['salt']);

        if($users['ID'] == NULL || $users['password'] != $pass){
            die("User not found or Password is incorrect!");
        }else{
            if(!isset($_SESSION)){
                session_start();
            }
            $_SESSION['loggedin'] = true;
            $_SESSION['ID'] = $users['ID'];
            $_SESSION['name'] = $users['name'];
            echo "Welcome ";
            header("location: /");
        }
    }
    function logout(){
        session_start();
        session_destroy();
        header("location: login.php");
    }

    function getUUID(){
        $UUID = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
        return $UUID;
    }

    function getSalt($length = 64){
        $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charlength = strlen($char);
        $salt = '';
        for($i = 0 ; $i < $charlength; $i++){
            $salt .= $char[mt_rand(0, $charlength - 1)];
        }
        return $salt;
    }

    function signup($username, $password, $mail, $fname, $lname, $phone, $city, $zip){
        global $function, $DB;
        $ID = $function->getUUID();
        $salt = $function->getSalt();
        echo $salt;
        $password = hash('sha512', $password.$salt);
        if ($stmt = $DB->prepare("INSERT INTO user (ID, username, password, salt, mail, fname, lname, phone, city, zip) VALUES (?,?,?,?,?,?,?,?,?,?)")) {
            $stmt->bind_param("ssssssssss", $ID, $username, $password, $salt, $mail, $fname, $lname, $phone, $city, $zip);
            $stmt->execute();
        }
        header("location: login.php");
    }

    function getMenu(){
        echo '<div class="menu"> 
			<div class="menuitem"><a href="/">Forside</a></div>
			<div class="menuitem"><a href="/myimage.php">Billeder</a></div>
			<div class="menuitem"><a href="/profile.php">Profil</a></div>
			<div class="menuitem"><a href="/logout.php">Log ud</a></div>
		      </div>';
    }

    function checkLoggedIn(){
        session_start();

        if(isset($_SESSION['loggedin'])){
            header("location: /");
        }
    }

    function drawLeft(){
        require_once("box.php");
        $box = new Box;
        $box->getLeftBox();
    }
    function drawRight(){
        require_once("box.php");
        $box = new Box;
        $box->getRightBox();
    }
    function drawMain($page = 'index'){
        require_once("box.php");
        $box = new Box;
        $box->getMainBox($page);
    }

    function getHeadline($name){
        require_once("box.php");
        $box = new Box;
        $box->getTitle($name);
    }
}

$function = new Functions;
