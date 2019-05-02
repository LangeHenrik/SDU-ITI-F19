<?php
require "HomeController.php";

class CommentController extends HomeController {
	private $image;
	public function index ($param = null) {
		$imageId = $param;
		$this->image =  Image::getImage($imageId);
		$this->image->user = User::getUser($this->image->user);
		$viewbag = ["image"=>$this->image, "comments"=>Comment::getComments($imageId)];
		
		$this->view("comment/Comment", $viewbag);
		
	}
	function __construct() {
		require_once "../app/models/User.php";
		require_once "../app/models/Image.php";
		require_once "../app/models/Comment.php";
	}
	
	
	public function postComment($imageId) {
	    if(isset($_POST["submit_comment"])) {
			if($_POST["text"]!=="") {
				
				$text = $_POST["text"];
				$user = $_SESSION["user_name"];
				$userId = User::getId($user);
				
				
				Comment::submitComment($text, $imageId, $userId);
				header("Location: ../" . $imageId); //Make sure the same form can't be sent twice!
				exit; // Location header is set, pointless to send HTML, stop the script
			}
		}	
	}
	
}



