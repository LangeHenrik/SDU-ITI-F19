<?php
session_start();
if ( ! empty( $_POST ) ) {
    if ( isset( $_POST['image'] ) && isset( $_POST['header'] ) ) {
		$tmpname = $_POST['image'];
		$fp = fopen($_POST['image'], 'rb'); // read binary
		try {
			require_once('db_config.php');
			$conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$st = $conn->prepare("INSERT INTO picture(picture, user, header, description) VALUES(:picture, :user, :header, :description)");
			$st->bindParam(':picture', $fp, PDO::PARAM_LOB);
			$st->bindParam(':user', $_SESSION['username']);
			$st->bindParam(':header', $_POST['header']);
			$st->bindParam(':description', $_POST['descr']);
			$st->execute();
			header("Location: pictures.php");
		}catch(PDOException $e)
		{
			'Error : ' .$e->getMessage();
		}
	} else {
	}
} else {
}
?>

