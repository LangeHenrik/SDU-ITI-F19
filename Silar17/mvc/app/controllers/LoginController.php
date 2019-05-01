<?php

class LoginController extends Controller {
    
    public function index () {
        $this->view('login/login');
    }
    
    public function username() {
      $available = $this->model('User')->checkUsername();
    }
    
    public function register(){
      $this->model('User')->register();
      $this->view('login/login');
    }

    public function login() {
		    $loggedin = $this->model('User')->login();
        if ($loggedin){
        header('location: /silar17/mvc/public/picture');
        } else {
        $this->view('login/login');
        }      
	}
}