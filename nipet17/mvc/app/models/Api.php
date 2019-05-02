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
     $users = array();
     $sql   = "SELECT * FROM login ORDER BY login_id";
     $stmt  = $this->conn->prepare($sql);
     $stmt->execute();

     while ($outputData = $stmt->fetch(PDO::FETCH_ASSOC)) {
       $users[$outputData['login_id']] = array(
         'user_id'   => $outputData['login_id'],
         'username'  => $outputData['login_username']
       );
     }
     return $users;
   }

   public function uploadPicture($image, $title, $description, $username) {
		 	$username = $this->getUserNameFromID($userid);
			$sql = $this->conn->prepare("INSERT INTO photo (photo_image, photo_text, photo_header, photo_user)
									 VALUES (:image, :description, :title, :username)");
			$sql->bindparam('image', $image);
			$sql->bindparam('description', $description);
			$sql->bindparam('title', $title);
			$sql->bindparam('username', $username);
			$sql->execute();
			$lastInsertID = $this->conn->lastInsertId();

		return $lastInsertID;
   }

   public function selectPictures($userID) {
		 $username 	= $this->getUserNameFromId($userID);
		 $sql   		= "SELECT photo_id, photo_header, photo_text, photo_image FROM photo WHERE photo_user = :username";
     $stmt  		= $this->conn->prepare($sql);
     $stmt->bindParam('username', $username);
     $stmt->execute();
		 $stmt->setFetchMode(PDO::FETCH_ASSOC);
		 $result 		= $stmt->fetchAll();

			return $result;
   }
}
