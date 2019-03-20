<?php
require_once 'db_config.php';

try {
    $sql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$name = $_REQUEST['user'];
	$sql_code = "
	select * 
	from silar17.site_user
	where user_username = ?"; 
	$stmt = $sql->prepare($sql_code);
	$stmt->bindParam(1, $name);
	$stmt->execute();
	$available = "";
	
	$result = $stmt->fetch();
	$result2 = $result['user_username'];
	if ($result2 == null){
		$available="1";
		echo $available; 
	echo $result2;
	} else {
		$available="0";
		echo $available;
	}
} catch (PDOException $pe) {
	echo "i die";
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
$sql = null;

?>
