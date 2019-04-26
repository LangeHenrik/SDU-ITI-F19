<?php

class HomeController extends Controller {

	public function index ($param) {
        $viewbag = array();
        if ( isset($_SESSION['username'])) {
            $db = new Database();
            $images = $db->getImages();

            //        print_r($images);
            $viewbag = $images;
        } else {
            $viewbag['notloggedin'] = true;
        }
        $this->view('home/index', $viewbag);
	}

	public function other ($param1 = 'first parameter', $param2 = 'second parameter') {
		$user = $this->model('User');
		$user->name = $param1;
		$viewbag['username'] = $user->name;
		$this->view('home/index', $viewbag);
	}

	public function restricted () {
		echo 'Welcome - you must be logged in';
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
			header('Location: /jahen19/mvc/public/home/');
		}
	}

}
