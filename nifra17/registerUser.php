<?php
    require_once 'db_config.php';
	
    try {
		
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",
        $username,
        $password,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		
		$usernameToStore = $_POST['createusername'];
		$passwordToStore = $_POST['createpassword'];

        
		$stmt = $conn->prepare("INSERT INTO usertest(username, password) VALUES(:username, :password)");
		$stmt->bindParam(':username', $usernameToStore);
		$stmt->bindParam(':password', $passwordToStore);
		
        $stmt->execute();
        #$stmt->setFetchMode(PDO::FETCH_ASSOC);
        #$result = $stmt->fetchAll();
        #print_r($result);
		
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
		
    $conn = null;
	
	session_start();
	$_SESSION["username"] = $usernameToStore;
	
	
	
	?>
