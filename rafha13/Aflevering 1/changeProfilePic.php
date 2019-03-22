<?php
	session_start();
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		//echo "Welcome to the user-space";
	} else {
		echo "Please log in first to see this page.";
		// redirecting...
		header("Location: login_page.php");
		die("Redirecting to login-page.php");
	}
	
	require_once 'db_config.php';
	
    try {
		
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		
		//print_r($_FILES);
		
		
		$type= htmlentities($_FILES['profileImg']['type']);
		$imagetmp= file_get_contents($_FILES['profileImg']['tmp_name']);
		
		$stmt = $conn->prepare("UPDATE rafha13.siteUser SET user_Image = :imagetmp, user_img_type = :image_type WHERE user_Name = :userName");

		
		$stmt->bindParam(':image_type', $type);
		$stmt->bindParam(':imagetmp', $imagetmp, PDO::PARAM_LOB);		
		$stmt->bindParam(':userName', $_SESSION['username']);		
		
		
        $stmt->execute();
		
	} catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
		
    $conn = null;
	
	header('Location: my_page.php');
?> 