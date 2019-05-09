<?php
class apiController extends Controller {
	
	public function index(){
		echo "cannot find method";
	}
	
	public function users () {
		if ($this->get()) {
			$user = $this->model('user');
			
			$user_list=$user->getUserList();
			
			$usersObject = array();
			foreach($user_list as $aUser){
				$shortUser['user_id']=$aUser['user_id'];
				$shortUser['username']=$aUser['username'];
				$usersObject[]=$shortUser;
			}
			echo json_encode($usersObject);
		}
	}
	public function pictures ($param, $user_id) {
		$user_id = filter_var($user_id, FILTER_SANITIZE_NUMBER_INT);

		if($this->post()) {
			$this->postPicture($user_id);
		} else if ($this->get()) {
			$this->getPictures($user_id);
		}
	}
	private function postPicture($user_id){
		$message = json_decode($_POST['json']);
		$header = filter_var($message->title, FILTER_SANITIZE_STRING);
		$description = filter_var($message->description, FILTER_SANITIZE_STRING);
		$image = filter_var($message->image, FILTER_SANITIZE_STRING);
		$username = filter_var($message->username, FILTER_SANITIZE_STRING);
		$password = filter_var($message->password, FILTER_SANITIZE_STRING);

		$user = $this->model('user');
		$post = $this->model('post');
		
		$aUser = $user->getUserByID($user_id);
		$post_object = array();
		
		if ($username==$aUser['username'] && password_verify($password, $aUser['password_hash'])){
			$post_id = $post->uploadPost($header, $description, $image, $user_id);
			$post_object['image_id'] = $post_id;
			echo json_encode($post_object);
		}
	}
	
	private function getPictures($user_id){	
		$post = $this->model('post');
		
		$posts = $post->getPostsByUserID($user_id);
		
		$post_list = array();
		foreach ($posts as $aPost){
			$tempPost['title']=$aPost['header'];
			$tempPost['description']=$aPost['description'];
			$tempPost['image']=$aPost['picture'];
			$post_list[]=$tempPost;
		}
		
		echo json_encode($post_list);
	}


}