<?php

class SignupController extends Controller {

    public function index ($param) {
        Controller::view($param);
    }

    public function other ($param1 = 'first parameter', $param2 = 'second parameter') {
        $user = $this->model('User');
        $user->name = $param1;
        $viewbag['username'] = $user->name;
        $this->view('index', $viewbag);
    }
}