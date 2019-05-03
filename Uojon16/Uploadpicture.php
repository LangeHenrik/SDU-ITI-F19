<?php
session_start();
if ( isset( $_SESSION['user_id'] ) )
{
	
	if ( !empty( $_POST ) ) 
	{
	
	if ( !empty($_FILES["imageuploader"]["tmp_name"]) ) 
	{
		$fileName = $_FILES["imageuploader"]["name"];
		$fileTemp = $_FILES["imageuploader"]["tmp_name"];
		
		if (move_uploaded_file($fileTemp, "uploads/" . $fileName))
		{
			
			require_once('db.php');
			$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$getPw = $conn->prepare("INSERT INTO picture (picturename, username, title) VALUES (:picturename, :username, :title);");
			$getPw->bindParam(':picturename', $fileName);
			$getPw->bindParam(':username', $_SESSION['user_id']);
			$getPw->bindParam(':title', $_POST['title']);
		
			$getPw->execute();
			echo "Picture has been uploaded";
			$conn = null;
		}
		else
		{
			echo "Upload failed";
		}
		
	}
	}
}
else 
{
	session_destroy();
	header("Location: index.php");
			

}
?>
<!DOCTYPE html>
<body>
<form action="uploadpicture.php" method="post" enctype="multipart/form-data">
    
    <legend>Upload your image</legend>
    <label for="title">Title for your image:</label>
	<br>
    <input type="text" name="title" required><br>
    <br>
    <input type="file" name="imageuploader" id="imageuploader">
	<br><br>
    <input type="submit" value="Upload picture" id="submit"/>
    
</form>
<a href = "UserPage.php"> Back to user page </a>
</body>
</html>