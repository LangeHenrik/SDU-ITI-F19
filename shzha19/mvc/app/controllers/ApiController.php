<?php

class ApiController extends Controller{
	
	private $db;
	
	public function __construct(){
		header('Content-Type: application/json');
		$this->db = new Database();
	}
	
	public function index(){
		$error = (object)["error" => "No method"];
		echo json_encode($error);
	}
	
	//GET localhost:8080/xx/mvc/public/api/users
	//output:	[{"user_id":"1","username":"jack"},{"user_id":"2", "username":"jill"}]
	public function users(){
		$sql = "select user_id,username from usersinfo";
		$stmt = $this->db->conn->prepare($sql);
		$stmt->execute();
		$users = $stmt->fetchall(PDO::FETCH_ASSOC);
		//print_r($users);
		echo json_encode($users);
	}
	
	/*
	public function user($input){
		$sql = "select user_id,username from usersinfo where user_id = :user_id";
		$stmt = $this->db->conn->prepare($sql);
		$stmt->bindParam(':user_id',$input);
		$stmt->execute();
		$users = $stmt->fetchall(PDO::FETCH_ASSOC);
		echo json_encode($users);
	}
	*/
	
	
	public function pictures($para1,$para2=-1){
		
		//GET localhost:8080/xx/mvc/public/api/pictures/user/2
		//[{"image": "blob","title": "some title", "description":"my description"}]
		if($this->get()){
			$sql = "select image,title,description from postview,usersinfo where user_id = :user_id and postview.username = usersinfo.username";
			
			$stmt = $this->db->conn->prepare($sql);
			$stmt->bindParam(':user_id',$para2);
			$stmt->execute();
			/* output base64
			
			$arr = explode('/',$stmt->fetchColumn());
			$image_path = "./".$arr[4]."/".$arr[5];
				
			$image_info = getimagesize($image_path);
			$image_type = $image_info['mime'];
			$image_data = fread(fopen($image_path, 'r'), filesize($image_path));
			//echo 'data:' . $image_type . ';base64,' . base64_encode($image_data);
			//echo str_replace("\\/", "/",  json_encode("image_data=>data:".$image_type.";base64,".base64_encode($image_data)));
			*/
			
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			echo json_encode($result);
			
			
			
		}
		if($this->post()){
			//POST localhost:8080/xx/mvc/public/api/pictures/user/2
			//input:{"image": "blob","title": "some title", "description":"my description","username":"username","password":"actual password"}
			//output:{"image_id": "246"}
			
			//$postData = json_decode(file_get_contents("php://input"));
			//print_r($postData);
			$postData = json_decode($_POST['json']);
			
			$sql = "insert into postview(username,title,description,image) select :username,:title,:description,:image from dual where exists (select 1 from usersinfo where username = :username and password = :password and user_id = :user_id)";
			//put pictures into file
			$base64 = $postData->image;
			
			$path = "./pictures";
			
			
			
			if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64, $result)){
				$type = $result[2];
				$newpath = $path."/".time().".{$type}";
				file_put_contents($newpath, base64_decode(str_replace($result[1], '', $base64)));
			}
			
			
			$arr = explode('/', $newpath);
			$dbpath = "/shzha19/mvc/public/pictures/".$arr[2];
			
			
			
			
			$pwdmd5 = md5($postData->password);
			$stmt = $this->db->conn->prepare($sql);
			$stmt->bindParam(':username',$postData->username);
			$stmt->bindParam(':password',$pwdmd5);
			$stmt->bindParam(':user_id',$para2);
			$stmt->bindParam(':title',$postData->title);
			$stmt->bindParam(':description',$postData->description);
			$stmt->bindParam(':image',$dbpath);
			//$stmt->bindParam(':blob',$)
			//$stmt->execute();
			//$users = $stmt->fetchall();
			//$users = $stmt->rowCount();
			//echo $users;
			//print_r($users);
			// another method:
			$inserted = $stmt->execute();
			if($inserted){
				$id = $this->db->conn->lastInsertID();//return ID
				$arr = array ('image_id' => $id);
				echo json_encode($arr);  
				
			}
			
			
			
			
		}

	}



}





?>