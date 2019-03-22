<?php
if(session_status() == PHP_SESSION_NONE){
	session_start();
}

If(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]){
} else {
    header("Location:Index.php");
}


function getPictures(){
	
	require_once 'db_config.php';
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		$stmt = $conn->prepare("SELECT * FROM post LIMIT 20 ");
		$stmt -> execute();
		$result = $stmt->fetchAll();
		foreach ($result as $value){
			$picturepath = $value["post_picture_location"];
			$picturetitle = $value["post_title"];
		echo "<div class='pictureframes'>";
		echo "<label>$picturetitle</label>"; 
		echo "<img src='$picturepath'>";
		echo "</div>";
		}
	
	
}
?>


<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles.css">

</head>
<div>
	<?php include 'topBar.php'; ?>
</div>
<div id="pictureContainer">
	<?php getPictures()?>
</div>
<div>
	<div>
		<button onclick="loadMorePictures()">LOAD MORE PICTURES!!!!</button>
	</div>
</div>

</html>

<script>
var numberOfExtraPics = 1;

function loadMorePictures() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		var ele = document.createElement('div');

		ele.innerHTML = this.response;
		document.getElementById("pictureContainer").appendChild(ele);
		
    }
  };
  xhttp.open("GET", "ajaxcaller.php?numm=" + (numberOfExtraPics * 20), true);
  xhttp.send();
  numberOfExtraPics++;
}
</script>