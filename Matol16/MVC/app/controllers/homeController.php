<?php

class HomeController extends controller{
    public function index(){
                $this->view('home/index');
    }
    public function register(){
                $this->view('home/register');
    }

    public function other($param1 = 'first parameter', $param2 = 'second parameter'){
        $user = $this->model('User');
        $user->name = $param1;
        $data['username'] = $user->name;
        $this->view('home/index', $data);
    }

    public function login() {
        $_SESSION['logged_in'] = true;
        $this->view('home/login');


    }
    public function restricted () {
        echo 'Welcome - you must be logged in';
    }

    public function logout() {

        if($this->post()) {
            session_unset();
            header('Location: /mvc/public/home/loggedout');
        } else {
            echo 'You can only log out with a post method';
        }
    }

    public function loggedout() {
        $this->view('home/loggedout');
        echo 'You are now logged out';
    }

    public function pictures(){
        $this->view('home/pictures');
    }


}