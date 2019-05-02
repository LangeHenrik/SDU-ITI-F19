<?php	


class Mypage extends Database {

    public function loadData () {
		$stmt = $this->conn->prepare("SELECT user_Image, user_img_type, username, user_Firstname, user_Lastname, user_ZIP, user_City, user_Email, user_phone FROM rafha13.siteUser WHERE username = :username");
		
		$stmt->bindParam(':username', $_SESSION['username']);
		
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user = $stmt->fetchAll();
        
        return $user;
    }

    public function changePicture () {
 		$type= htmlentities($_FILES['profileImg']['type']);
		$imagetmp= file_get_contents($_FILES['profileImg']['tmp_name']);
		
		$stmt = $this->conn->prepare("UPDATE rafha13.siteUser SET user_Image = :imagetmp, user_img_type = :image_type WHERE username = :userName");

		
		$stmt->bindParam(':image_type', $type);
		$stmt->bindParam(':imagetmp', $imagetmp, PDO::PARAM_LOB);		
		$stmt->bindParam(':userName', $_SESSION['username']);		
		
		
        $stmt->execute();
		
	
	    header("Location: /rafha13-2/mvc/public/mypage");
    }

    public function deleteUser () {
        // delete user
		$stmt1 = $this->conn->prepare("DELETE FROM rafha13.siteUser WHERE username = :userName");
	
		$stmt1->bindParam(':userName', $_SESSION['username']);		
        $stmt1->execute();

        // delete users posts

        $stmt2 = $this->conn->prepare("DELETE FROM rafha13.content WHERE post_user = :userName");

        $stmt2->bindParam(':userName', $_SESSION['username']);		
        $stmt2->execute();


        
        unset($_SESSION['logged_in']);
	
	    header('Location: /rafha13-2/mvc/public');
    }
}
        
?>
