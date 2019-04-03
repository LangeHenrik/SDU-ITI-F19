<?php
// Always start this first
session_start();
$tablename = 'users';
if ( ! empty( $_POST ) ) {
    if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
		//filter input variables
		$filteredUn = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$filteredPw = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
		// validate the input real quick
		if(!validate($filteredUn,$filteredPw)){
			header("Location: index.php");
		} else {
		
		require_once('db_config.php');
		$conn = new PDO("mysql:host=$servername;port=3307;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// retrieve password from username
		$stmt = $conn->prepare("SELECT * FROM users WHERE username=:username");
		$stmt->bindParam(':username', $filteredUn);
		$stmt->execute();
		$temp = $stmt->fetch();
		$hashedPw = $temp['password'];
		$userid = $temp['id'];
    	// Verify user password and set $_SESSION
    	if ( password_verify($filteredPw,$hashedPw) ) {
    		$_SESSION['username'] = $filteredUn;
			$_SESSION['user_id'] = $userid;
			$_SESSION['valid'] = true;
			$_SESSION['timeout'] = time();
			 header("Location: pictures.php");
    	} else {
			$_SESSION['error'] = "Wrong username or password.";
			header("Location: index.php");

		}
		}
    }
}
function validate($u, $p) {
	require_once('validationregex.php');
	if(!filter_var($u, FILTER_VALIDATE_REGEXP,array( // validate username
         "options" => array("regexp"=>$unR)))) {
			 session_unset();
			 $_SESSION['error'] = "Username not valid.";
			 return false;
		 } else if(!filter_var($p,FILTER_VALIDATE_REGEXP,array( // validate username
         "options" => array("regexp"=>$pwR)))) {
			 session_unset();
			$_SESSION['error'] = "Password not valid";
			return false;
		 } else {
			 return true;
		 }
}
?>
