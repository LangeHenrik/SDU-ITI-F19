<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(empty($_SESSION['user'])){
	header("Location: index.php");
}
require_once "db_config.php";
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Image Page</title>
</head>
<body>
<div>
		<a href="imagepage.php">Pictures</a>
		<a href="displayusers.php">Show table of users</a>
		<a href="newupload.php">Upload picture</a>
		<span style="float:right">Current user: <?php echo $_SESSION['user'];?></span>
	</div>

	<div>
		<?php
		if(isset($_SESSION['user'])){
			$sql = "SELECT * FROM images ORDER BY id DESC";
			$statement = $con -> prepare($sql);
			$statement -> execute();
			$images = $statement -> fetchAll();
		}else{
			header("location: index.php");
		}
		
		if($images !== null){
			foreach($images as $img){?>
					<div>
					<figure>
						<?php
						$sql = "SELECT username FROM user WHERE id = :id;";
						$statement = $con -> prepare($sql);
						$statement -> bindParam(":id", $img["userid"]);
						$statement -> execute();
						$username = $statement -> fetch(PDO::FETCH_ASSOC);
						?>
						<br><br><b><figcaption>Uploaded by: <?php echo $username['username'];?></figcaption></b><br>
						<i></i>
					</figure>
				</div>
		
				<div>
					<figure id="<?php echo $img["id"]; ?>">
						<b><figcaption><?php echo $img["header"]; ?></figcaption></b>
						<img src=<?php echo $img["path"]; ?>><br>
						<?php echo $img["description"]; ?> <br><br>
					</figure>
				</div>
				<hr>
			<?php
			}
		}?>
	</div>
	</body>
</html>