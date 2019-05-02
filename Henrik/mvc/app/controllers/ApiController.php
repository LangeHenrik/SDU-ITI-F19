<?php

class ApiController extends Controller {
	
	private $db;

	public function __construct(){
		header('Content-Type: application/json');
		$this->db = new Database();
	}

	public function index(){
		$error = (object) ["error" => "No method specified. The URL methods are: users, user & pictures"];
		echo json_encode($error);
	}

	public function users () {
		$sql = "SELECT user_id, username FROM users";
		$stmt = $this->db->conn->prepare($sql);
		$stmt->execute();
		$users = $stmt->fetchAll();
		echo json_encode($users);		
	}

	public function pictures ($param1, $param2) {
		if($this->post()){
			$postData = json_decode($_POST['json']);

			$sql = "SELECT * FROM users WHERE username = :username AND password = :password";
			$stmt = $this->db->conn->prepare($sql);
			$stmt->bindParam('username', $postData->username);
			$stmt->bindParam('password', $postData->password);
			$stmt->execute();
			$user = $stmt->fetchAll();

			$sql = "INSERT INTO pictures (title, description, image, user_id) VALUES (:title, :description, :image, :user_id)";
			$stmt = $this->db->conn->prepare($sql);
			$stmt->bindParam('title', $postData->title);
			$stmt->bindParam('description', $postData->description);
			$stmt->bindParam('image', $postData->image);
			$stmt->bindParam('user_id', $user[0]['user_id']);
			$stmt->execute();
			
			$image_id = $this->db->conn->lastInsertId();

			echo '{"image_id": "'.$image_id.'"}';
		} else {

			$sql = "SELECT * FROM pictures WHERE user_id = :user_id";
			$stmt = $this->db->conn->prepare($sql);
			$stmt->bindParam('user_id', $param2);
			$stmt->execute();
			$pics = $stmt->fetchAll();

			echo json_encode($pics);
		}
	}
	
}

