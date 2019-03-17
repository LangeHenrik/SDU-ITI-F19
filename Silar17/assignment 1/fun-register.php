<?php
require_once 'db_config.php';

try {
    $sql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$username = $_POST['Username'];
	$password = $_POST['Password'];
	$firstname = $_POST['Firstname'];
	$lastname = $_POST['Lastname'];
	$zip = $_POST['Zip'];
	$city = $_POST['City'];
	$email = $_POST['Email'];
	$phone = $_POST['Phone'];
	$sql_code = "INSERT INTO silar17.site_user (user_username, user_password, user_fname, user_lname, user_zip, user_city, user_email, user_phone) VALUES ('{$username}','{$password}' ,'{$firstname}', '{$lastname}','{$zip}', '{$city}', '{$email}', '{$phone}')";

	$sql->exec($sql_code);

} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
$sql = null;
echo "you have been registered";

sleep(5)
header('Location: login.php');
?>
