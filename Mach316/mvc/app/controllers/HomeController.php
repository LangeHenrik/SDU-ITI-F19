<?php

class HomeController extends Controller
{

    public function index()
    {
       $this->view('home/index');
    }




    public function feed()
    {
        $loggedIn = isset($_SESSION['logged_in']);
        if ($loggedIn) {
            $imageDAO = $this->model('ImageDAO');
            $parameters['images'] = $imageDAO->getAllImages();
            $this->view('home/feed', $parameters);
        } else {
            $this->view('home/loginform');
        }
    }

    public function restricted()
    {
        echo 'Welcome - you must be logged in';
    }

    public function profile()
    {

        $parameters = [];

        if (isset($_SESSION['logged_in'])) {

            $userDAO = $this->model('UserDAO');
            $username = $_SESSION['username'];
            $user = $userDAO->getUserByUsername($username);
            $parameters['user'] = $user;
            $this->view('home/profile', $parameters);
        } else {
            $this->view('home/loginform', $parameters);
        }
    }

    public function login()
    {
        if (!isset($_SESSION['logged_in'])) {

            $userDAO = $this->model('userDAO');

            if ($this->post()) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                if (!$this->checkLoginCredentials($username, $password, $userDAO)) {
                    $this->view('home/unsuccesfullogin');
                } else {
                    $user = $userDAO->getUserByUsername($username);
                    $userid = $user->getId();

                    $_SESSION['logged_in'] = true;
                    $_SESSION['username'] = $username;
                    $_SESSION['userid'] = $userid;
                    $parameters['user'] = $user;
                    $this->view('home/profile', $parameters);
                }
            }
        }
    }


    public function register($message = "")
    {
        $parameters['message'] = $message;
        $this->view('home/registerform', $parameters);
    }


    public function deleteImage() {
        if($this->post()) {

            $imageID = $_POST['imageID'];
            $imageDAO = $this->model('ImageDAO');
            $imageDAO->deleteImage($imageID);
        }
        $userID = $_SESSION['userid'];
        $images = $imageDAO->getUserImages($userID);
        $parameters['images'] = $images;
        header('Location: managepictures');
    }


    public function comment() {
        if($this->post()) {

            $commentDAO = $this->model('CommentDAO');
            $userDAO = $this->model('UserDAO');
            $author = $userDAO->getUserByUsername($_SESSION['username']);
            $comment = new Comment();

            $commentText = $_POST['comment'];
            $authorID = $author->getId();
            $authorUsername = $author->getUsername();
            $imageID = $_POST['imageID'];

            $comment->setAuthorID($authorID);
            $comment->setAuthorUsername($authorUsername);
            $comment->setComment($commentText);
            $comment->setImageID($imageID);

            $result =  $commentDAO->addImageComment($comment);

            if($result) {
                header('Location: feed');
            } else {
                echo "Something went wrong. Comment was not submitted";
            }


        }
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

            if ($message == '') {
                $userDAO = $this->model('UserDAO');
                $userDAO->registerUser($newUser);
                $userID = $userDAO->getUserByUsername($newUser->getUsername())->getId();
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $newUser->getUsername();
                $_SESSION['userid'] = $userID;

                $this->view('home/profile');
            } else {

                $parameters['message'] = $message;
                $this->view('home/registerform', $parameters);
            }


        }
    }


    public function managepictures()
    {
        $imageDAO = $this->model('ImageDAO');
        $userID = $_SESSION['userid'];
        $images = $imageDAO->getUserImages($userID);

        $parameters['images'] = $images;
        $this->view('home/managepictures', $parameters);
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

        $imageDAO = $this->model('ImageDAO');
        $userDAO = $this->model('UserDAO');
        $users = $userDAO->getAllUsers();

        foreach ($users as $user) {
            $userId = $user->getId();
            $userImages = $imageDAO->getUserImages($userId);
            $user->setImages($userImages);
        }


        $parameters['users'] = $users;
        $this->view('home/users', $parameters);
    }

    public function userpage($username = "")
    {

        $userDAO = $this->model('UserDAO');
        $imageDAO = $this->model('ImageDAO');
        $user = $userDAO->getUserByUsername($username);
        $userID = $user->getId();
        $images = $imageDAO->getUserImages($userID);
        $parameters['user'] = $user;
        $parameters['images'] = $images;

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
    private function checkLoginCredentials($username, $password, $userDAO)
    {
        $username = htmlentities($username);
        $password = htmlentities($password);

        $valid = false;

        $user = $userDAO->getUserByUsername($username);
        if ($user) {
            if (password_verify($password, $user->password)) {
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
        if (!$this->passwordsMatch($newUser->getPassword(), $newUser->getRepeatedPassword())) {
            $message .= "<div class='registration-alert'>The passwords have to match</div>";
        }
        if (!$this->validEmail($newUser->getEmail())) {
            $message .= "<div class='registration-alert'>The email you entered is invalid</div>";
        }
        if (!$this->validPhonenumber($newUser->getPhonenumber())) {
            $message .= "<div class='registration-alert'>Phonenumber has to consists of 8 digits</div>";
        }
        if (!$this->validZip($newUser->getZip())) {
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
        return (preg_match('/^[0-9]+$/', $phonenumber) && strlen($phonenumber) == 8);
    }


}