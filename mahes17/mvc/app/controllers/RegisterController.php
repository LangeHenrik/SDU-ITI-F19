<?php

class RegisterController extends Controller {

	public function index ($param) {

    include_once("..\models\Register.php");
      $this->view('home/register', $viewbag);
	}

public function user(){
  if(isset($_POST)){
    $registerModel = new Register();
    $registerModel->registerUser();

  }
}

}
