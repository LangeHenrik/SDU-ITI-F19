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
        $loggedIn = isset($_SESSION['logged_in']);
        if($loggedIn) {
            $imageDAO = $this->model('ImageDAO');
            $parameters['images'] = $imageDAO->getAllImages();
            $this->view('home/feed', $parameters);
        }else{
            $this->view('home/loginform');
        }
    }

    public function restricted()
    {
        echo 'Welcome - you must be logged in';
    }

    public function profile($parameters = [])
    {
        if (isset($_SESSION['logged_in'])) {
            $this->view('home/profile');
        } else {
            $this->view('home/loginform', $parameters);
        }
    }

    public function login()
    {
        if (!isset($_SESSION['logged_in'])) {
            if ($this->post()) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                if (!$this->checkLoginCredentials($username, $password)) {
                    $this->view('home/unsuccesfullogin');
                } else {
                    $_SESSION['logged_in'] = true;
                    $this->view('home/profile');
                }
            }
        }
    }


    public function register($message = "")
    {
        $parameters['message'] = $message;
        $this->view('home/registerform', $parameters);
    }

    public function registeruser()
    {
        if ($this->post()) {
            $newUser = new User();
            $newUser->setPassword($_POST['password']);
            $newUser->setUsername($_POST['username']);
            $newUser->setFirstname($_POST['firstname']);
            $newUser->setLastname($_POST['lastname']);
            $newUser->setPhonenumber($_POST['phonenumber']);
            $newUser->setZip($_POST['zip']);
            $newUser->setCity($_POST['city']);
            $newUser->setEmail($_POST['email']);
            $newUser->setRepeatedPassword($_POST['repeated-password']);
            $newUser->setFirstLogin(true);

            $message = $this->getRegistrationInformationMessage($newUser);

            if($message == '') {
                $userDAO = $this->model('UserDAO');
                $userDAO->registerUser($newUser);
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $newUser->getUsername();
                $this->view('home/profile');
            } else {

                $parameters['message'] = $message;
                $this->view('home/registerform', $parameters);
            }


        }
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

    public function userpage($username = "") {
        $userDAO = $this->model('UserDAO');
            $user = $userDAO->getUserByUsername($username);
            $parameters['user'] = $user;
            $this->view('home/userpage', $parameters);


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


    //---- Utility functions ------/
    private function checkLoginCredentials($username, $password)
    {
        $valid = false;
        $userDAO = $this->model('userDAO');
        $user = $userDAO->getUserByUsername($username);
        if ($user) {
            if ($user->password == $password) {
                $valid = true;
            }
        } else {
            $valid = false;
        }
        return $valid;
    }

    private function getRegistrationInformationMessage($newUser)
    {
        $message = "";

        if ($this->usernameIsTaken($newUser->getUsername())) {
            $message .= "<div class='registration-alert'>That username is taken</div>";
        }
        if(!$this->passwordsMatch($newUser->getPassword(), $newUser->getRepeatedPassword())) {
            $message .= "<div class='registration-alert'>The passwords have to match</div>";
        }
        if(!$this->validEmail($newUser->getEmail())) {
            $message .= "<div class='registration-alert'>The email you entered is invalid</div>";
        }
        if (!$this->validPhonenumber($newUser->getPhonenumber())) {
            $message .= "<div class='registration-alert'>Phonenumber has to consists of 8 digits</div>";
        }
        if(!$this->validZip($newUser->getZip())) {
            $message .= "<div class='registration-alert'>Zipcode has to consists of 4 digits</div>";
        }
        return $message;

    }

    private function usernameIsTaken($username)
    {
        $userDAO = $this->model('UserDAO');
        return $userDAO->userExists($username);

    }

    private function validZip($zip)
    {
        return true;//(preg_match('/^[0-9]+$/', $zip) && strlen($zip) == 4);
    }

    private function passwordsMatch($password1, $password2)
    {
        return $password1 == $password2;
    }

    private function validEmail($email)
    {
        return true;//preg_match('[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}', $email);
    }

    private function validPhonenumber($phonenumber)
    {
        return (preg_match('/^[0-9]+$/',$phonenumber) && strlen($phonenumber) == 8);
    }


}