<?php
class Api extends Database {

	private function getUserNameFromID($id) {
	$sql = $this->conn->prepare("SELECT login_username FROM login WHERE login_id = :userid");
	$sql->bindparam(':userid', $id);
	$sql->execute();
	$sql->setFetchMode(PDO::FETCH_ASSOC);
	$result = $sql->fetch();
	$username = $result['login_username'];
	return $username;
	}

	public function validateUser($username,$password){
		 $sql = $this->conn->prepare("SELECT login_id, login_password FROM login WHERE login_username = :username");
		 $sql->bindparam(':username', $username);
		 $sql->execute();
		 $sql->setFetchMode(PDO::FETCH_ASSOC);
		 $result = $sql->fetch();
		 if (password_verify($password, $result['login_password'])) {
			 echo "approved";
			 return $result['login_id'];
		 } else {
			 echo "not approved";
			 return 'error';
		 }
	 }

	 public function selectUsers() {

     $sql   = "SELECT * FROM login ORDER BY login_id";
     $stmt  = $this->conn->prepare($sql);
     $stmt->execute();
		 $users = $stmt->fetchAll();

		 for($i = 0; $i < sizeof($users);$i++){
			 $users[$i]['user_id'] = $users[$i]['login_id'];
			 $users[$i]['username'] = $users[$i]['login_username'];
		 }
/*
     while ($outputData = $stmt->fetch(PDO::FETCH_ASSOC)) {
       $users[$outputData['login_id']] = array(
         'user_id'   => $outputData['login_id'],
         'username'  => $outputData['login_username']
       );
     }*/
     return $users;
   }

   public function uploadPicture($image, $title, $description, $username) {
		 $sql = $this->conn->prepare("INSERT INTO photo (photo_image, photo_text, photo_header, photo_user)
									VALUES (:image, :description, :title, :username)");
		 $sql->bindparam('image', $image);
		 $sql->bindparam('description', $description);
		 $sql->bindparam('title', $title);
		 $sql->bindparam('username', $username);
		 $sql->execute();

		 $lastInsertID = $this->conn->lastInsertId();


/*
		 	$username = $this->getUserNameFromID($userid);
			$sql = $this->conn->prepare("INSERT INTO photo (photo_image, photo_text, photo_header, photo_user)
									 VALUES (:image, :description, :title, :username)");
			$sql->bindparam('image', $image);
			$sql->bindparam('description', $description);
			$sql->bindparam('title', $title);
			$sql->bindparam('username', $username);
			$sql->execute();
			$lastInsertID = $this->conn->lastInsertId();*/

			return $lastInsertID;
   }

   public function selectPictures($userID) {
		 $sql = "SELECT photo_id, photo_header, photo_text, photo_image FROM photo WHERE photo_id = :userID";

		 $stmt = $this->conn->prepare($sql);
		 $stmt->bindParam('userID', $userID);
		 $stmt->execute();
		 $pictures = $stmt->fetchAll();

		 for ($i=0; $i < sizeof($pictures); $i++) {
		 	$pictures[$i]['image_id'] = $pictures[$i]['photo_id'];
			$pictures[$i]['title'] = $pictures[$i]['photo_header'];
			$pictures[$i]['description'] = $pictures[$i]['photo_text'];
			$pictures[$i]['image'] = $pictures[$i]['photo_image'];
		 }

		 return $pictures;

   }
}
