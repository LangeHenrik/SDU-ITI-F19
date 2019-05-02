<?php
class apiController extends Controller {

	public function index ($param) {
header('Content-Type: Application/json');
	}

	public function all(){
		$viewbag['pictures'] = $this -> model('pictures')->getAllPictures();
		$this -> view('pictures/picture_site', $viewbag);
	}
	public function byUserId($id){
		$viewbag['pictures']= $this -> model('pictures')->getById($id);
		$this -> view('pictures/picture_site', $viewbag);
	}
public function pictures($user, $id){
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$this -> model('apiPicture')->uploadPicture($id);
}
		if ($_SERVER['REQUEST_METHOD'] == 'GET'){
		$viewbag['pictures'] =	$this -> model('apiPicture')->getById($id);
		$this -> view('api/pictures', $viewbag);
}

}
public function view_upload(){
	$this -> view('pictures/uploade_picture');
}

public function users($id = 0){
	if ($_SERVER['REQUEST_METHOD'] = 'GET'){
	$viewbag['users'] = $this->model('user')->getuser($id);
	$this -> view('api/user_output', $viewbag);}
}
}
