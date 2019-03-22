<?php 
	// Delete the user
	echo 'deleting...';
	
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
		
		$stmt =$conn->prepare("DELETE FROM rafha13.siteUser WHERE user_Name = :userName");
	
		$stmt->bindParam(':userName', $_SESSION['username']);		
		
		
        $stmt->execute();
		
	} catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
		
    $conn = null;
	
	header('Location: login_page.php');
?>