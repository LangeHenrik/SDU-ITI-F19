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
	<title>Users</title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="modal.css">
	<link rel="stylesheet" href="users.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">
</head>

<script>
	function getHint(str){
		if(str.length === 0){
			document.getElementById("hint").innerHTML="";
			return;
		} else {
			let xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function(){
				if(this.readyState === 4 && this.status === 200){
					document.getElementById("hint").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", "gethint.php?q=" + str, true);
			xmlhttp.send();
			document.getElementById("hint").innerHTML = "Loading...";
		}
	}
</script>

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
	
	<div class="search">
	<form>
		<h2>Search for username:</h2><br> <input type="text" onkeyup="getHint(this.value)">
	</form>
	<p> Suggestions: <span id="hint"></span></p>
	</div>
	
	<div style="overflow-x:auto;">
	<table>
		<thead>
		<tr>
			<td>Username</td>
			<td>First name</td>
			<td>Last name</td>
			<td>E-mail</td>
			<td>Phone number</td>
			<td>Zip code</td>
			<td>City</td>
			<td>Member since</td>
		</tr>
		</thead>
		<tbody>
		<?php
			$sql = "SELECT username, firstn, lastn, zip, city, email, phonenumber, created FROM users;";
			$stmt = $conn -> prepare($sql);
			$stmt -> execute();
			
			while($users = $stmt -> fetch(PDO::FETCH_NUM)){ ?>
				<tr>
					<td><?php echo $users[0] ?></td>
					<td><?php echo $users[1] ?></td>
					<td><?php echo $users[2] ?></td>
					<td><?php echo $users[5] ?></td>
					<td><?php echo $users[6] ?></td>
					<td><?php echo $users[3] ?></td>
					<td><?php echo $users[4] ?></td>
					<td><?php echo $users[7] ?></td>
				</tr>
				<?php
			}?>
		</tbody>
	</table>
	</div>
</body>
</html>