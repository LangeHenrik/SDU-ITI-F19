<?php

class UserController extends Controller{
    public function index(){
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
            header('Location: /mvc/public/home/login');
        } else{
            $this->view('user/login');
        }
    }

    public function login(){
        if($this->model('User')->login($_POST['username'], $_POST['pass_1'])){
            header('Location: /mvc/public/picture/getall');
        } else{
            echo "DET KA' DU SKU GODT GLEMME!!";
        }
    }


    public function logout(){
        session_unset();
        header('Location: /mvc/public/user');
    }
    public function register(){
        $error = false;
        $data['errors'] = array();
        if(empty($_POST['username'])){
            echo "Please enter a username! ";
            $error = true;
            array_push($data, "No username entered! ");
        } elseif (($this->model('User')->checkForUser($_POST['username']))){
            $error = true;
            array_push($data, "User already exists!");
            echo 'An account with that username already exists ';
            $username = "|Already Exists|";
        } else{
            $username = $_POST['username'];
        }

        if (empty($_POST["pass_1"])){
            $error = true;
            array_push($data, "No password entered!");
            echo "Please enter a password! ";
        }elseif(strlen($_POST["pass_1"]) < 8){
            $error = true;
            array_push($data, "Too short password");
            echo "Password needs a length of atleast 8 ";
        }
        elseif($_POST["pass_1"] != ($_POST["pass_2"])){
            $error = true;
            array_push($data, "Both passwords must be the same!");
            echo "Both passwords must be the same! ";
        }
        else{
            $password = $_POST["pass_1"];
        }

        if (empty($_POST["name_1"])){
            $error = true;
            array_push($data, "No first name entered!");
            echo "Please enter a first name! ";
        }else{
            if(empty($_POST["name_2"])){
                $error = true;
                array_push($data, "No last name entered!");
                echo "Please enter a last name! ";
            } else{
                $name = $_POST["name_1"] . " " . $_POST["name_2"];
            }
        }

        if (empty($_POST["zip"])){
            $error = true;
            array_push($data, "No zip code entered!");
            echo "Please enter a Zip code! ";
        }else{
            $zip = $_POST["zip"];
        }

        if (empty($_POST["city"])){
            $error = true;
            array_push($data, "No city entered!");
            echo "Please enter a City! ";
        }else{
            $city = $_POST["city"];
        }

        if (empty($_POST["email"])){
            $error = true;
            array_push($data, "No email entered!");
            echo "Please enter a email! ";
        }else{
            $email = $_POST["email"];
        }

        if (empty($_POST["ph_number"])){
            $error = true;
            array_push($data, "No email entered!");
            echo "Please enter a phone number! ";
        }else{
            $ph_number = $_POST["ph_number"];
        }

        if($error){
            $this->view("home/register",$data);
        }else{
            $this->model('User')->register($username, $password,$name, $zip, $city,$email, $ph_number);
            header('Location: /mvc/public/home/index');
        }
    }

    public function userlist(){
        $data['users'] = $this->model('User')->getAllUsers();
        $this->view('home/userlist',$data);
    }
}
