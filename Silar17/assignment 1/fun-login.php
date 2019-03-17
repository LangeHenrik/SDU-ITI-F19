<?php
require_once 'db_config.php';

try {
    $sql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$user = $_POST['login_name'];
	$password = $_POST['login_password'];
	$sql_code = $sql->prepare("(select *
	from silar17.site_user
	where user_username = '{$user}' and user_password = '{$password}')");

	$sql_code->execute();
	$sql_code->setFetchMode(PDO::FETCH_ASSOC);
	$result = $sql_code->fetchALL();

	if ($result != NULL) {
			//ob_start();
			session_set_cookie_params(3600);
			session_start();
			$_SESSION['loggedin'] = true;
			$_SESSION["username"] = $user;
			$sql = null;
			$_SESSION['logintry'] = 0;
			header('Location: picture.php');
		} else {
			session_set_cookie_params(10);
			session_start();
			$sql = null;
			$_SESSION['logintry'] = $_SESSION['logintry'] + 1; 
			header('Location: login.php');
			
		}
	
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}



?>
