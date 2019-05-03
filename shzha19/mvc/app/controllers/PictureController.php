<?php

class PictureController extends Controller {

	public function insertPost() {
		if(!empty($_FILES['image']['name'])){
			$this->model('Picture')->insertPost($_POST['title'],$_POST['description']);
		}	
		else{
			echo "<script>alert('Please upload a picture');history.back(-1);</script>";
			exit;
		}			
	}
	
	public function deletePost($image_id) {
		$this->model('Picture')->deletePost($image_id);
		
	}
	
	
	
	
	
	
}

?>