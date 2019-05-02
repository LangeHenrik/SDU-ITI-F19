
<?php
function getPictures($viewbag){
	
foreach ($viewbag['pictures'] as $value){
			$picturepath = $value["image"];
			$picturetitle = $value["title"];
		echo "<div class='pictureframes'>";
		echo "<label>$picturetitle</label>"; 
		echo "<img src='$picturepath'>";
		echo "</div>";
		}
	
	
}
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="/mscho17/mvc/public/css/styles.css">

</head>
<div>
	<?php include '../app/views/partials/topBar.php'; ?>
</div>
<div id="pictureContainer">
	<?php getPictures($viewbag)?>
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
  xhttp.open("GET", "posts/loadpictures/" + (numberOfExtraPics * 20), true);
  xhttp.send();
  numberOfExtraPics++;
}
</script>