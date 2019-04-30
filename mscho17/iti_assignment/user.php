<?php
if(session_status() == PHP_SESSION_NONE){
	session_start();
}

If(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]){
	echo "still set";
} else {
	echo "not set";
    header("Location:Index.php");
}


function getUsers(){
	require_once 'db_config.php';
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	$stmt = $conn->prepare("SELECT * FROM user_login");
	$stmt->execute();
	$result = $stmt->fetchAll();

	foreach ($result as $resultArray){
		echo '<div class="user_list">';
		$toPrint = $resultArray["user_name"] . "<br>";
		echo $toPrint;

	}
}

?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">

</head>
<div>
	<?php include 'topBar.php'; ?>
</div>
<div>
	<p> listing a list of all users </p>
	<div>
		<?php getUsers()?>	
	</div>	
</div>






</html>