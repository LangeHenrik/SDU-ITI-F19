<?php

class User extends Database {
	
	public $name;

	public function createUser () {
		// find free user_id
		$stmt1 = $this->conn->prepare("SELECT siteUser.user_id FROM rafha13.siteUser");

		$stmt1->execute();
        $stmt1->setFetchMode(PDO::FETCH_ASSOC);
		$userid = $stmt1->fetchAll();

		//print_r($userid);
		
		$id = 1;

		foreach ($userid as $tmp) : 
			if (in_array($id, $tmp)) {
				$id++;
			} 
		endforeach;

		// create
		$hashed_password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
			  
		
		$stmt = $this->conn->prepare("INSERT INTO rafha13.siteUser (user_id, username, user_Password, user_Firstname, user_Lastname, user_ZIP, user_City, user_Email, user_Phone) VALUES (:id, :username, :password, :firstname, :lastname, :zip, :city, :email, :phone)");
				
		$stmt->bindParam(':id', $id);		
		$stmt->bindParam(':username', $_POST['newUsername']);
		$stmt->bindParam(':password', $hashed_password);
		$stmt->bindParam(':firstname', $_POST['newFirstname']);
		$stmt->bindParam(':lastname', $_POST['newLastname']);
		$stmt->bindParam(':zip', $_POST['newZip']);
		$stmt->bindParam(':city', $_POST['newCity']);
		$stmt->bindParam(':email', $_POST['newEmail']);
		$stmt->bindParam(':phone', $_POST['newPhone']);
				
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);


		header('Location: /rafha13-2/mvc/public');
	}

	public function loginUser () {
		$stmt = $this->conn->prepare("SELECT * FROM rafha13.siteUser WHERE username = :username");	
			
		$stmt->bindParam(':username', $_POST['username']);
			
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$result = $stmt->fetchAll();
		//print_r($result);
		
		//$user = $_POST['username'];
		if ($result == null) {
			echo 'result was null';
			header('Location: /rafha13-2/mvc/public/login/error');
			// do nothing
		} else {
			$pass = $result[0]["user_Password"];
			
			if (password_verify($_POST['password'], $pass)) {
				header('Location: /rafha13-2/mvc/public/content');
				ob_start();
				session_start();
				$_SESSION['loggedin'] = true;
				$_SESSION['username'] = $_POST['username'];	
			} else {
				header('Location: /rafha13-2/mvc/public/login/error');
			}
		}
		
}

	public function dummydata () {

		
		// Create 6 users!
		
		$usernames = array("signe1", "emil1", "lasse1", "jonas1", "anders1", "rosa1");
		$firstnames = array("Signe", "Email", "Lasse", "Jonas", "Anders", "Rosa");
		$emails = array("signe@gmail.com", "emil@gmail.com", "lasse@gmail.com", "jonas@gmail.com", "anders@gmail.com", "rosa@gmail.com");
		$phones = array("+12345678", "+98765432", "+976878123", "+917826391287639", "+718237128", "+1236129386");
			

		
		for ($i = 0; $i < 6; $i++) {
			$userid = $i+1;
			$username = $usernames[$i];
			$password = "Admin1234";		
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);
			$firstname = $firstnames[$i];
			$lastname = "Jensen";
			$zip = 5000;
			$city = "Odense";
			$email = $emails[$i];
			$phone = $phones[$i];
			
			$filename = "images/dummydata/pic" . ($i+1) . ".jpg";
			$profilepicture = fopen($filename, "rb");
			$image = fread($profilepicture, filesize($filename));
			fclose($profilepicture);
			$type = 'image/jpg';
			

			$stmt = $this->conn->prepare("INSERT INTO rafha13.siteUser (user_Image, user_img_type, user_ID, username, user_Password, user_Firstname, user_Lastname, user_ZIP, user_City, user_Email, user_Phone) VALUES (:image, :type, :userid, :username, :password, :firstname, :lastname, :zip, :city, :email, :phone)");
			
			$stmt->bindParam(':userid', $userid);
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':password', $hashed_password);
			$stmt->bindParam(':firstname', $firstname);
			$stmt->bindParam(':lastname', $lastname);
			$stmt->bindParam(':zip', $zip);
			$stmt->bindParam(':city', $city);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':phone', $phone);
			
			$stmt->bindParam('type', $type);
			$stmt->bindParam(':image', $image, PDO::PARAM_LOB);
			
			$stmt->execute();
		}
		
		// Create content from the users!
		
		$description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
		
		for ($i = 0; $i < 12; $i++) {
			
			$title = "Post nr. " . ($i+1);
			
			$filename = "images/dummydata/post_img" . ($i+1) . ".jpg";
			$profilepicture = fopen($filename, "rb");
			$image = fread($profilepicture, filesize($filename));
			fclose($profilepicture);
			$type = 'image/jpg';
			$postid = $i+1;
			
			$stmt = $this->conn->prepare("INSERT INTO rafha13.content (image_id, image, post_img_type, post_user, title, description) VALUES (:postid, :image, :type, :user, :title, :description)");
		
			$stmt->bindParam(':type', $type);
			$stmt->bindParam(':image', $image, PDO::PARAM_LOB);	
			
			$stmt->bindParam(':postid', $postid);
			$stmt->bindParam(':title', $title);
			$stmt->bindParam(':description', $description);
			$stmt->bindParam(':user', $usernames[rand(0,5)]);
			
			
			$stmt->execute();
		}

		/*
		echo 'Dummy-data for the rafha13 database has been generated';
		echo '</br>';
		echo 'Created 2 tables; rafha13.siteUser and rafha13.content';
		echo '</br>';
		echo 'The site now contains 6 users, and 12 posts';
		*/
		
		header('Location: /rafha13-2/mvc/public');

	}
}