<?php
class UploadController extends Controller {
	
	public function index () {
		$viewbag = $this->initialiseViewbag();
		echo $_SESSION['userid'];
		$this->view('home/Upload', $viewbag);
	}
	
	public function post(){
		
		$viewbag = $this->initialiseViewbag();
		
		if(isset($_POST['submit'])){
			$post_title = filter_input(INPUT_POST, "post_title", FILTER_SANITIZE_STRING);
			$post_description=filter_input(INPUT_POST, "post_description", FILTER_SANITIZE_STRING);
		
			$regex_Title = "/^(\w|\s){1,50}$/";
			$regex_Description = "/^([\x20-\x7D]|\s){1,500}+$/";
		
			$title_match = preg_match($regex_Title, $post_title);
			$description_match = preg_match($regex_Description, $post_description);
			
			$name = $_FILES['image']['name'];
			$target_dir = "upload/";
			$target_file = $target_dir . basename($_FILES["image"]["name"]);
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$extensions_arr = array("jpg","jpeg","png","gif");
			
			if( in_array($imageFileType,$extensions_arr) ){
				$image_base64 = base64_encode(file_get_contents($_FILES['image']['tmp_name']) );
				$image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
				
				if($title_match && $description_match){
					$post = $this->model('Post');
					$post->uploadPost($post_title, $post_description, $image, $_SESSION['userid']);
					header("Location: /heboe17/mvc/public/Posts");
				}	
			}
			
			$viewbag['header']=$post_title;
			$viewbag['description']=$post_description;
			$viewbag['header_box_correct']=$title_match;
			$viewbag['description_box_correct']=$description_match;
		}
		
		$this->view('home/Upload', $viewbag);
	}
	
	private function initialiseViewbag(){
		$viewbag['header']="";
		$viewbag['description']="";
		$viewbag['header_box_correct']=True;
		$viewbag['description_box_correct']=True;

		return $viewbag;
	}
	

}
?>