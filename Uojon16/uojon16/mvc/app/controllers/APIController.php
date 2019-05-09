<?php
require_once('../app/models/user.php');
class APIController extends Controller {
	
	public function index ($param) {
		
		
	}	
	
	
	public function users () {
        $users = $this->model('User')->apiGetUsers();
        $users_json = json_encode($users, JSON_PRETTY_PRINT);
        header("Content-Type:application/json");
        echo $users_json;
    }
	

}