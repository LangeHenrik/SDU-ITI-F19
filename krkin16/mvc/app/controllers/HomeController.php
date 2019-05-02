<?php
class HomeController extends Controller {
	
	public function index ($param = null) {
		$users = getUser();
		
		$usernames = array();
		$count = 0;
		foreach($users as $u) {
			$usernames[$count++] = $u->username;
		}
		
		$viewbag = ["users"=>$usernames, "user"=>$_SESSION["user_name"]];
			$viewbag["displayUser"] = "";
		if($param!=null) {
			$viewbag["displayUser"] = $param[0];
		}
		
		$this->view("home/index", $viewbag);
		
	}
	
	public function displayOwn() {
		$this->index([$_SESSION["user_name"]]);
	}
	
	public function restricted () {
		echo 'Welcome - you must be logged in';
	}
	
	public function logout() {
		unset($_SESSION["user_name"]);
		header('Location: ..', true, 302);
	}
	
	public function loggedout() {
		echo 'You are now logged out';
	}
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	public function uploadNewImage() {
		if(isset($_POST["submit_image"])) {
			$path = $_FILES["file_to_upload"]["tmp_name"];
			$name = $_FILES["file_to_upload"]["name"];

			if(!is_uploaded_file($path) || !exif_imagetype($path)) {
				echo "Please only upload images";
				header("Location: home"); //Make sure the same form can't be sent twice!
				exit();
			}

			$newName = explode(".", $name);
			$newName = $this->generateRandomString(5) . "." .$newName[1];

			$newPath = "user_images\\".$newName;

			rename($path, $newPath);

			uploadImage($_POST["file_name"], $_POST["file_description"], $newPath);

			header("Location: home "); //Make sure the same form can't be sent twice!
			exit; // Location header is set, pointless to send HTML, stop the script
		}
	}
	
	public function deleteImage($imageId) {
		echo "run";
		require_once "../app/ajax_calls/delete_image.php";
		deleteImageById($imageId);
	}
	
	public function getImagesInRange($start_index = 0, $amount = 20, $displayUser = null) {
		require_once "../app/ajax_calls/get_image_data.php";
		echo getImagesJson($start_index, $amount, $displayUser);
	}
}