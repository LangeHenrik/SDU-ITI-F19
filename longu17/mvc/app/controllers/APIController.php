<?php
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
class APIController extends Controller {
	
	public function index () { 	}

	//krav 1
	public function users() {
		$user = $this->model('User');
		$user->getUsers();
	}

	//krav 2+3
	public function pictures($user, $id) {
		$user = $this->model($user);
		$username = $user->username($id);
		$userid = $user->userID($username);

		if ($_SERVER['REQUEST_METHOD'] == "GET") 
		{
			$user->getImages($username, $userid);

		} else if($_SERVER['REQUEST_METHOD'] == "POST") {
			
			if(isset($_POST['json']))
			{
				$testBody = json_decode($_POST['json'], true); //get object from json
				
				$username = filter_var($testBody["username"], FILTER_SANITIZE_STRING);
				$password = filter_var($testBody["password"], FILTER_SANITIZE_STRING);

				$image = filter_var($testBody["image"], FILTER_SANITIZE_STRING);
				$title = filter_var($testBody["title"], FILTER_SANITIZE_STRING);
				$description = filter_var($testBody["description"], FILTER_SANITIZE_STRING);
				
				if($user->login($username, $password))
				{
					$check = 'data:image/jpeg;base64,';
					$tmpImg = $image;

					if (substr($tmpImg, 0, strlen($check)) == $check)//if contains check string
					{
						$tmpImg = substr($tmpImg, strlen($check));
					}

					$user->apiUpload($userid, $tmpImg, $title, $description);	

					echo json_encode(array 
					(
						'user_id' => $userid

					));
				} 
			}
			
		} else {
			echo json_encode(
				array('message' => 'no http requests;')
			);
		}
	}
	
}