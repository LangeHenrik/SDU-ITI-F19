<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(empty($_SESSION['user'])){
	header("Location: index.php");
}
require_once "db_config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My profile</title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="modal.css">
	<link rel="stylesheet" href="imgfeed.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">
</head>
	
<body>
	<!-- Modal code -->
	<div id="uploadModal" class="modal">
		<div class="modal-content">
			<div class="modal-header">
				<span class="close">&times;</span>
				<h2>Upload picture</h2>
			</div>
			<div class="modal-body">
				<form action="upload.php" id="upload" method="post" enctype="multipart/form-data">
					</br><textarea name="img_title" rows="2" cols="50" placeholder="Give your image a title.."></textarea></br>
					<textarea name="img_desc" rows="4" cols="50" placeholder="Give your image a description.."></textarea></br></br>
					<input type="file" name="fileToUpload" id="fileToUpload">
					<input type="submit" id="upload_btn" value="Upload">
				</form></br>
			</div>
			<div class="modal-footer">
				</br>
			</div>
		</div>
	</div>
	<!-- Navigation bar -->
	<div class="w3-bar w3-black">
		<a href="imgfeed.php" class="w3-bar-item w3-button w3-mobile">Picture feed</a>
		<a href="users.php" class="w3-bar-item w3-button w3-mobile">Users</a>
		<a href="#" id="upload_function" class="w3-bar-item w3-button w3-mobile">Upload picture</a>
		<a href="profile.php" class="w3-bar-item w3-button w3-mobile">My pictures</a>
		<a href="logout.php" class="w3-bar-item w3-button w3-mobile">Logout</a>
		<a href="profile.php" class="w3-bar-item w3-button w3-mobile w3-right"><?php echo $_SESSION['user'];?></a>
	</div>
	
	<!-- JS for opening modal -->
	<script>
	var modal = document.getElementById('uploadModal');
	var span = document.getElementsByClassName("close")[0];
	var btn = document.getElementById('upload_function');
	btn.onclick = function(){
		modal.style.display = "block";
	}
	
	span.onclick = function(){
		modal.style.display = "none";
	}
	
	window.onclick = function(event){
		if(event.target == modal){
			modal.style.display = "none";
		}
	}
	</script>
	
	<!-- Showing pictures -->
	<div class="flex-container">
		<?php
		if(isset($_SESSION['user'])){
			//Gets username from db
			$sql = "SELECT user_id FROM users WHERE username = :username;";
			$stmt = $conn -> prepare($sql);
			$stmt -> bindParam(":username", $_SESSION['user']);
			$stmt -> execute();
			$userid = $stmt -> fetch(PDO::FETCH_ASSOC);
			
			//Gets users pictures from db
			$sql = "SELECT * FROM images WHERE img_userid = :img_userid ORDER BY img_id DESC LIMIT 20;";
			$stmt = $conn -> prepare($sql);
			$stmt -> bindParam(":img_userid", $userid['user_id']);
			$stmt -> execute();
			$images = $stmt -> fetchAll();
		}else{
			header("location: index.php");
		}
		
		if($images !== null){
			foreach($images as $img){
				?>
				<div class="user">
					<!-- User info here -->
					<figure id="Test">
						<br><br><b><figcaption><?php echo $_SESSION['user'];?></figcaption></b><br>
						<i class="fas fa-user"></i>
						<div id="uploadedDate"><br>Date uploaded: <br><?php echo $img["img_uploaddate"];?></div>
					</figure>
					<form name="delete" method="post" action="delete.php">
						<input type="hidden" name="file_path" value="<?php echo $img["img_path"];?>">
						<input type="hidden" name="file_id" value="<?php echo $img["img_id"];?>">
						<input id="delBtn" type="submit" value="Delete image">
					</form>
				</div>
		
				<div class="images">
					<!-- Image stuff here -->
					<figure id="<?php echo $img["img_id"]; ?>">
						<b><figcaption><?php echo $img["img_header"]; ?></figcaption></b>
						<img class="img" src=<?php echo $img["img_path"]; ?>><br>
						<?php echo $img["img_desc"]; ?> <br><br>
					</figure>
				</div>
				<?php
			} 
		}?>
	</div>
</body>
</html>