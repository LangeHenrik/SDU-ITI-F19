<?php
class Api extends Database {

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
									 VALUES (:image, :title, :description, :username)");
		$sql->bindparam('image', $image);
		$sql->bindparam('title', $title);
		$sql->bindparam('description', $description);
		$sql->bindparam('username', $username);
		$sql->execute();
		$lastInsertID = $this->conn->lastInsertId();

		return $lastInsertID;
   }

   public function selectPictures($userID) {
     $sql   = "SELECT login_username FROM login WHERE login_id = :userID";
     $stmt  = $this->conn->prepare($sql);
     $stmt->bindParam('userID', $userID);
     $stmt->execute();
		 $stmt->setFetchMode(PDO::FETCH_ASSOC);
		 $result = $stmt->fetch();

		 $username = $result['login_username'];
 		return $username;
   }
}
