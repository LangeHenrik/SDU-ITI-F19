<?php
    require_once 'db_config.php';
	
    try {
		
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",
        $username,
        $password,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		
		$hashed_password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
		

        $stmt = $conn->prepare("INSERT INTO rafha13.siteUser (user_Name, user_Password, user_Firstname, user_Lastname, user_ZIP, user_City, user_Email, user_Phone) VALUES (:username, :password, :firstname, :lastname, :zip, :city, :email, :phone)");
		
		
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
        //$result = $stmt->fetchAll();
        //print_r($result);
		
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
		
    $conn = null;

	
	header('Location: login_page.php');
?>
