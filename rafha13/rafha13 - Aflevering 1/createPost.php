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
		
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		
		print_r($_FILES);
		
		$info = getimagesize($_FILES['pickImg']['tmp_name']);
		$type = $info['mime'];
		//$type= htmlentities($_FILES['pickImg']['type']);
		$imagetmp= file_get_contents($_FILES['pickImg']['tmp_name']);

        $stmt = $conn->prepare("INSERT INTO rafha13.content (post_image, post_img_type, post_user, post_title, post_description) VALUES (:image, :type, :user, :title, :description)");
		
		$stmt->bindParam(':type', $type);
		$stmt->bindParam(':image', $imagetmp, PDO::PARAM_LOB);	
		$stmt->bindParam(':title', $_POST['title']);
		$stmt->bindParam(':description', $_POST['description']);
		$stmt->bindParam(':user', $_SESSION['username']);	
		
        $stmt->execute();
		
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
		
    $conn = null;
	
	
	header('Location: content_page.php');
?>