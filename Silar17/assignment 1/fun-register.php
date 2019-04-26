<?php
require_once 'db_config.php';


try {
    $sql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$user = htmlentities($_POST['Username']);
	$password = htmlentities($_POST['Password']);
	$password = password_hash($password, PASSWORD_DEFAULT);
	$firstname = htmlentities($_POST['Firstname']);
	$lastname = htmlentities($_POST['Lastname']);
	$zip = htmlentities($_POST['Zip']);
	$city = htmlentities($_POST['City']);
	$email = htmlentities($_POST['Email']);
	$phone = htmlentities($_POST['Phone']);
	
	$sql_code = "INSERT INTO silar17.site_user 
	(user_username, user_password, user_fname, user_lname, user_zip, user_city, user_email, user_phone) 
	VALUES (:username, :pass, :firstname, :lastname, :zip, :city, :email, :phone)";
	$stmt = $sql->prepare($sql_code);
	
	$stmt->bindParam(":username", $user);
	$stmt->bindParam(":pass", $password);
	$stmt->bindParam(":firstname", $firstname);
	$stmt->bindParam(":lastname", $lastname);
	$stmt->bindParam(":zip", $zip);
	$stmt->bindParam(":city", $city);
	$stmt->bindParam(":email", $email);
	$stmt->bindParam(":phone", $phone);
	
	$stmt->execute();

} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
$sql = null;

header('Location: login.php');
?>
