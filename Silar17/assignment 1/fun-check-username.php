<?php
require_once 'db_config.php';

try {
    $sql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$name = $_REQUEST['user'];
	$sql_code = "select exists (
	select user_username
	from site_user
	where user_username = ?)"; 
	$stmt = $sql->prepare($sql_code);
	$stmt->bindParam(1, $name);
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result = $stmt->fetch();
	echo $result;

} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
$sql = null;

?>
