<html>
	<h1> Error logging in... </h1>
	<h3> 404 - User not found. <h3>
	<form action="login_page.php" method="get">
		<input type="submit" value="Try again!" />
	</form>	
</html>

<?php
    require_once 'db_config.php';
	
    try {
		
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",
        $username,
        $password,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		
		$stmt = $conn->prepare("SELECT * FROM rafha13.siteUser WHERE user_Name = :username");	
		
		$stmt->bindParam(':username', $_POST['username']);
		
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        //print_r($result);
		
		//$user = $_POST['user_Name'];
		if ($result == null) {
			// do nothing
		} else {
			$pass = $result[0]["user_Password"];
			
			if (password_verify($_POST['password'], $pass)) {
				header('Location: content_page.php');
				ob_start();
				session_start();
				$_SESSION['loggedin'] = true;
				$_SESSION['username'] = $_POST['username'];	
			} else {
				// cannot login, error!
			}
		}
		
		
		
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
		
    $conn = null;
	
?>
