<?php
class User extends Database {
	
	public $user_id;
	public $user_username;
	public $user_password;
	public $user_fname;
	public $user_lname;
	public $user_zip;
	public $user_city;
	public $user_email;
	
	public function login(){
		$username = htmlentities($_POST['login_name']);
		$password = htmlentities($_POST['login_password']);
		$sql = "SELECT user_username, user_password from silar17.site_user WHERE user_username = ?";
		$stmt = $this->conn->prepare($sql);

		$stmt->bindParam(1, $username);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		if (password_verify($password, $result['user_password'])) {
			$_SESSION['logged_in'] = true;
			$_SESSION["username"] = $username;
			$_SESSION['logintry'] = 0;
			return true;
		} else {
			$_SESSION['logintry'] = $_SESSION['logintry'] + 1;
			return false;	
		}
	}

	public function logout(){
		unset($_SESSION['username']);
	}

	public function getImage($index) {
		$sql = "SELECT picture_created, picture_user, picture_type, picture 
		FROM silar17.picture
		order by picture_created desc";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(1, $username);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$array = $stmt->fetchAll();

		if(!empty($array[$index]['picture'])) {
			return $array[$index];
			
		} else {
			$filename = "images/nopic.jpg";
			$picture = fopen($filename, "rb");
			$array1['picture'] = fread($picture, filesize($filename));
			fclose($picture);
			$array1['picture_type'] = 'image/jpeg';
			return $array1;
		}
	}

	public function preloadImage(){
		for ($i = 1; $i < 21; $i = $i + 1){
	
			$user = "User{$i}";
			$created = date("Y-m-d H:i:s");
			$title = "title{$i}";
			$comment = "comment{$i}";
			$likes = $i;
			$filename = "images/picture".$i.".jpg";
			$picture = fopen($filename, "rb");
			$image = fread($picture, filesize($filename));
			fclose($picture);
			$type = 'image/jpeg';
			
			$sql_code = "INSERT IGNORE INTO picture (picture_user, picture_created, picture_title, picture_comment, picture_likes, picture_type, picture) 
			VALUES (:username, :created , :title, :comment, :likes, :image_type, :image)";
			$stmt = $this->conn->prepare($sql_code);
			
			$stmt->bindParam("username", $user);
			$stmt->bindParam("created", $created);
			$stmt->bindParam("title", $title);
			$stmt->bindParam("comment", $comment);
			$stmt->bindParam("likes", $likes);
			$stmt->bindParam("image_type", $type);
			$stmt->bindParam("image", $image, PDO::PARAM_LOB);
			
			$stmt->execute();
			sleep(1);
			}
	} //virker

	public function register(){
		$user = htmlentities($_POST['Username']);
		$password = htmlentities($_POST['Password']);
		$firstname = htmlentities($_POST['Firstname']);
		$lastname = htmlentities($_POST['Lastname']);
		$zip = htmlentities($_POST['Zip']);
		$city = htmlentities($_POST['City']);
		$email = htmlentities($_POST['Email']);
		$phone = htmlentities($_POST['Phone']);

		$password = password_hash($password, PASSWORD_DEFAULT);
		
		$sql_code = "INSERT INTO silar17.site_user 
		(user_username, user_password, user_fname, user_lname, user_zip, user_city, user_email, user_phone) 
		VALUES (:username, :pass, :firstname, :lastname, :zip, :city, :email, :phone)";
		$stmt = $this->conn->prepare($sql_code);
		
		$stmt->bindParam(":username", $user);
		$stmt->bindParam(":pass", $password);
		$stmt->bindParam(":firstname", $firstname);
		$stmt->bindParam(":lastname", $lastname);
		$stmt->bindParam(":zip", $zip);
		$stmt->bindParam(":city", $city);
		$stmt->bindParam(":email", $email);
		$stmt->bindParam(":phone", $phone);
		
		$stmt->execute();
	}

	public function upload(){
		$title = htmlentities($_POST['title']); 
		$comment = htmlentities($_POST['comment']); 
		$image = htmlentities($_POST['picture']);
		$user = htmlentities($_SESSION['username']);
		$created = date("Y-m-d H:i:s");
		$likes = 0; 
		$info = getimagesize($_FILES['picture']['tmp_name']);
		$type = $info['mime'];
		$image = fopen($_FILES['picture']['tmp_name'], 'rb');
		
		
		$sql_code = "INSERT INTO picture (picture_user, picture_created, picture_title, picture_comment, picture_likes, picture_type, picture) 
		VALUES (:username, :created , :title, :comment, :likes, :image_type, :image)";
		$stmt = $this->conn->prepare($sql_code);
		
		$stmt->bindParam("username", $user);
		$stmt->bindParam("created", $created);
		$stmt->bindParam("title", $title);
		$stmt->bindParam("comment", $comment);
		$stmt->bindParam("likes", $likes);
		$stmt->bindParam("image_type", $type);
		$stmt->bindParam("image", $image, PDO::PARAM_LOB);
		
		$stmt->execute();
	}

	public function userImage($picture_user){
		$sql_code ="
		SELECT * from picture
		where picture_user = :user_username";
		
		$stmt = $this->conn->prepare($sql_code);
		
		$stmt->bindparam(":user_username", $picture_user);
		$stmt->execute();

		$stmt->setFetchMode(PDO::FETCH_ASSOC);

		$array = $stmt->fetchALL();

		if(!empty($array[0]['picture'])) {
			return $array[0];
			
		} else {
			$filename = "images/nopic.jpg";
			$picture = fopen($filename, "rb");
			$array1['picture'] = fread($picture, filesize($filename));
			fclose($picture);
			$array1['picture_type'] = 'image/jpeg';
			return $array1;
		}
	}

	public function getImage4User(){
		$sql_code = "
		SELECT * from (SELECT user_username, user_id
		FROM silar17.site_user
		order by user_id) alias
		group by user_username order by user_id "; 
		$stmt = $this->conn->prepare($sql_code);
		$stmt->execute();
		$names = $stmt->fetchALL();
		$type = "user_username";
		return $names;
	}

	public function getImage4Picture(){
		$sql_code = "
		SELECT picture_created, picture_user, picture_likes, picture_title, picture_comment 
		FROM silar17.picture
		order by picture_created desc"; 
		$stmt = $this->conn->prepare($sql_code);
		$stmt->execute();
		$data = $stmt->fetchALL();
		$type = 'picture_title';
		return $data;
	}

	
}


?> 