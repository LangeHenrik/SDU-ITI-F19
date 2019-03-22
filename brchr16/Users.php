<?php
session_start();
if ( isset( $_SESSION['user_id'] ) )
{
	echo "Users:<br>";
	require_once('DbInfo.php');
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$getUsers = $conn->prepare("SELECT username FROM user");
		
		$getUsers->execute();
		$getUsers->setFetchMode(PDO::FETCH_ASSOC);
		$tempUsers = $getUsers->fetchAll();
		
		foreach ($tempUsers as $user)
		{
			echo $user['username']."<br>";
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
<a href = "Picture.php"> Back to picturepage </a>
</body>
</html>