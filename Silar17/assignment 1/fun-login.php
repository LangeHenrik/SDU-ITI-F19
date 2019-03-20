<?php
require_once 'db_config.php';

try {
    $sql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$user = htmlentities($_POST['login_name']);
	$pass = htmlentities($_POST['login_password']);
	$sql_code = $sql->prepare("select *
	from silar17.site_user
	where user_username = :user");
	
	$sql_code->bindparam(":user", $user);

	$sql_code->execute();
	
	$result = $sql_code->fetch(PDO::FETCH_ASSOC);
	 
	
	if (password_verify($pass, $result['user_password'])) {
			session_start();
			$_SESSION['loggedin'] = true;
			$_SESSION["username"] = $user;
			$sql = null;
			header('Location: picture.php');
			$_SESSION['logintry'] = 0;
		} else {
			session_start();
			$sql = null;
			$_SESSION['logintry'] = $_SESSION['logintry'] + 1;
			header('Location: login.php');
			
		}
	
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}



?>
