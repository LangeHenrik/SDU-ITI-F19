<?php

class CommentController extends Controller {
	
	public function index ($param = null) {
		$imageId = $param;
		$image =  getImage($imageId);
		$image->user = getUser($image->user);
		$viewbag = ["image"=>$image, "comments"=>getComments($imageId)];
		
		$this->view("comment/Comment", $viewbag);
		
	}
	
	
	public function restricted () {
		echo 'Welcome - you must be logged in';
	}
	
	public function loggedout() {
		echo 'You are now logged out';
	}
	
	public function postComment($imageId) {
	    if(isset($_POST["submit_comment"])) {
			if($_POST["text"]!=="") {
				
				$text = $_POST["text"];
				$user = $_SESSION["user_name"];
				
				submitComment($text, $imageId, $user);
				header("Location: ../" . $imageId); //Make sure the same form can't be sent twice!
				exit; // Location header is set, pointless to send HTML, stop the script
			}
		}	
	}
	
}



