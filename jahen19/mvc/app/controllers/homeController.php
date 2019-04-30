<?php

class HomeController extends Controller {

	public function index ($param) {
        $viewbag = array();

        if ( ! isset($_SESSION['username'])) {
            $viewbag['notloggedin'] = true;
        } else {
            if ($param == "my") {
                $viewbag['myfeed'] = true;
                $username = $_SESSION['username'];
            } else {
                $username = false;
            }

            $db = new Database();
            $images = $db->getImages($username);
            $viewbag['images'] = $images;
            $viewbag['city'] = $db->getUserCity($_SESSION['username']);
        }

        $this->view('home/index', $viewbag);
	}

	public function other ($param1 = 'first parameter', $param2 = 'second parameter') {
        // redirect user to index
        header("Location: /jahen19/mvc/public/home");
        echo "/jahen19/mvc/public/home";
        return;
	}

	public function login() {
        if ($this->post()) {
            $db = new Database();
            if($db->checkUserPassword($_POST['username'], $_POST['password'])) {
                // password correct, log user in
                $_SESSION['username'] = $_POST['username'];
            } else {
                // invalid username / password combination
                $this->logout();
            }
        }
	}

    public function register() {
        $this->view('home/register');
    }

	public function logout() {
		if($this->post()) {
			session_unset();
            $_SESSION['username'] = NULL;
			header('Location: /jahen19/mvc/public/home/');
            echo "Successfully logged out";
		}
	}

}
