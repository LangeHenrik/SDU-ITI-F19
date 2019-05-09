<?php

class UsersController extends Controller {
	private $viewbag=[];
	public function index () {
        $users=$this->model('User');
        $this->viewbag["allusers"]=$users->getAllUsers();
        $this->view("home/users",$this->viewbag);
    }
}