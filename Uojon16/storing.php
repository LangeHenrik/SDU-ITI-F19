<?php 
session_start();

if ( ! empty( $_POST ) ) {
    if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
		require_once('db.php');
	$conn = new PDO("mysql:host=$dbhost;dbname=adele2", $dbusername, $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // retrieve password from username
  $getPw = $conn->prepare("SELECT password FROM notendur WHERE username='".$_POST['username']."'"); 
	$getPw->execute();

$temp = $getPw->fetch();
		$passwordPw = $temp['password'];
    	// Verify user password and set $_SESSION
    	if ( $_POST['password']== $passwordPw ) {
    		$_SESSION['user_id'] = $_POST['username'];
			$_SESSION['valid'] = true;
			$_SESSION['timeout'] = time();
			 header("Location: UserPage.php");
    	} else {
			session_destroy();
			header("Location: index.php");

		}
 }   
}
?>