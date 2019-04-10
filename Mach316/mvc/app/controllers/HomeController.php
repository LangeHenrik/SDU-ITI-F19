<?php

class HomeController extends Controller
{

    public function index($param)
    {
        //This is a proof of concept - we do NOT want HTML in the controllers!
        echo '<br><br>Home Controller Index Method<br>';
        echo 'Param: ' . $param . '<br><br>';
    }

    public function other($param1 = 'first parameter', $param2 = 'second parameter')
    {
        $user = $this->model('UserDAO');
        $user->name = $param1;
        $parameters['username'] = $user->name;
        $this->view('home/index', $parameters);
    }

    public function feed()
    {
        $imageDAO = $this->model('ImageDAO');
        $parameters['images'] = $imageDAO->getAllImages();

        $this->view('home/feed', $parameters);
    }

    public function restricted()
    {
        echo 'Welcome - you must be logged in';
    }

    public function profile()
    {
        if(isset($_SESSION['logged_in'])) {
            $this->view('home/profile');
        } else {
            $this->view('home/loginform');
        }
    }

    public function login()
    {
        if (!isset($_SESSION['logged_in'])) {
            if ($this->post()) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                if(!$this->checkLoginCredentials($username, $password)) {
                    $this->view('home/unsuccesfullogin');
                } else {
                    $_SESSION['logged_in'] = true;
                    $this->view('home/profile');
                }
            }
        }
    }

    public function checkLoginCredentials($username, $password) {
        $valid = false;
        $userDAO = $this->model('userDAO');
        $user = $userDAO->getUserByUsername($username);
        if($user) {
            if($user->password == $password) {
                $valid = true;
            }
        } else {
            $valid = false;
        }
        return $valid;
    }


    public function managepictures()
    {
        $this->view('home/managepictures');
    }

    public function searchusers($searchparam = "")
    {

        $userDAO = $this->model('UserDAO');
        $searchparam = $_POST['searchparam'];
        $parameters['result'] = $userDAO->searchUsers($searchparam);

        //$parameters['result'] = $searchparam;
        $this->view('home/searchusers', $parameters);
    }

    public function users()
    {
        $this->view('home/users');
    }

    public function logout()
    {

        if ($this->post()) {
            session_unset();
            header('Location: profile');
        } else {
            echo 'You can only log out with a post method';
        }
    }



}