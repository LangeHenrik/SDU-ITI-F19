<?php

class LoginController extends Controller {
	
	public function index () {
        if ($this->model('User')->loginUser()) {
        } else {
            $_SESSION['logged_in'] = true;
            $this->view('content_page/content_page');
        }
	}
    
    public function create () {
        $model = $this->model('User')->createUser();
    }

    public function error () {
        $this->view('login_page/error_login_page');
    }

    public function dummy () {
        $model = $this->model('User')->dummydata();
        $this->view('login_page/login_page');
    }

}