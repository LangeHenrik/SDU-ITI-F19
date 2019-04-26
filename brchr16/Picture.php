<?php
session_start();
if ( isset( $_SESSION['user_id'] ) )
{
	echo "Welcome to the picturepage!<br><br><br>";
	
	require_once('DbInfo.php');
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$getPictures = $conn->prepare("SELECT picturename, username, title FROM picture");
		
		$getPictures->execute();
		$getPictures->setFetchMode(PDO::FETCH_ASSOC);
		$tempPictures = $getPictures->fetchAll();
		
		foreach ($tempPictures as $picture)
		{
			$pictureName = $picture['picturename'];
			echo $picture['title']."<br>";
			echo "<img src='Pictures/$pictureName'><br>";
			echo "Uploaded by: ";
			echo $picture['username']."<br><br>";
		}
		$conn = null;
}
else 
{
	session_destroy();
	header("Location: index.php");
			
}

?>
<!DOCTYPE html>
<body>
<form onsubmit="" method="post">
    
	
    
     
</form>

<a href = "Users.php"> Users </a>
<br>
<a href = "Uploadpicture.php"> Upload picture </a>
</body>
</html>