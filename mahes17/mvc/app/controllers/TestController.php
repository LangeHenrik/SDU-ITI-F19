<?php

class TestController extends Controller{

  public function index(){
      echo 'Go to mahes17/mvc/public/test/users to test the API';
  }

  public function users(){
    $users = $this->model('User')->getUsersAPI();
    header("Content-Type:application/json");
    $user = $users[0]['username'];
    echo json_encode($users);
  }


}
