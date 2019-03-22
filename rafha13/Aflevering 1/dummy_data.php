<?php
	//dummy data
	require_once 'db_config.php';
	
    try {
		
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",
        $username,
        $password,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		
		// Create 6 users!
		
		$usernames = array("signe1", "emil1", "lasse1", "jonas1", "anders1", "rosa1");
		$firstnames = array("Signe", "Email", "Lasse", "Jonas", "Anders", "Rosa");
		$emails = array("signe@gmail.com", "emil@gmail.com", "lasse@gmail.com", "jonas@gmail.com", "anders@gmail.com", "rosa@gmail.com");
		$phones = array("+12345678", "+98765432", "+976878123", "+917826391287639", "+718237128", "+1236129386");
			

		
		for ($i = 0; $i < 6; $i++) {
			$username = $usernames[$i];
			$password = "Admin1234";		
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);
			$firstname = $firstnames[$i];
			$lastname = "Jensen";
			$zip = 5000;
			$city = "Odense";
			$email = $emails[$i];
			$phone = $phones[$i];
			
			$filename = "Users/pic" . ($i+1) . ".jpg";
			$profilepicture = fopen($filename, "rb");
			$image = fread($profilepicture, filesize($filename));
			fclose($profilepicture);
			$type = 'image/jpg';
			

			$stmt = $conn->prepare("INSERT INTO rafha13.siteUser (user_Image, user_img_type, user_Name, user_Password, user_Firstname, user_Lastname, user_ZIP, user_City, user_Email, user_Phone) VALUES (:image, :type, :username, :password, :firstname, :lastname, :zip, :city, :email, :phone)");
			
			
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
			
			$filename = "Posts/post_img" . ($i+1) . ".jpg";
			$profilepicture = fopen($filename, "rb");
			$image = fread($profilepicture, filesize($filename));
			fclose($profilepicture);
			$type = 'image/jpg';
			
	        $stmt = $conn->prepare("INSERT INTO rafha13.content (post_image, post_img_type, post_user, post_title, post_description) VALUES (:image, :type, :user, :title, :description)");
		
			$stmt->bindParam(':type', $type);
			$stmt->bindParam(':image', $image, PDO::PARAM_LOB);	
			
			$stmt->bindParam(':title', $title);
			$stmt->bindParam(':description', $description);
			$stmt->bindParam(':user', $usernames[rand(0,5)]);
			
			
			$stmt->execute();
		}
		

		
		

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
		
    $conn = null;
	
	echo 'Dummy-data for the rafha13 database has been generated';
	echo '</br>';
	echo 'Created 2 tables; rafha13.siteUser and rafha13.content';
	echo '</br>';
	echo 'The site now contains 6 users, and 12 posts';
	
	header('location: login_page.php');
?>