<?php
session_start();
if (isset($_SESSION['username'])){
	
} else {
	header('Location: login.php');
}
$index = 0;

require_once 'db_config.php';

try {
    $sql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
	$sql_code = "
	SELECT picture_created, picture_user, picture_likes, picture_title, picture_comment 
	FROM silar17.picture
	order by picture_created desc"; 
	$stmt = $sql->prepare($sql_code);
	$stmt->execute();
	$data = $stmt->fetchALL();
	$type = 'picture_title';
	} catch (PDOException $pe) {
	echo "i die";
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
$sql = null;

?>
<html>
<title>Silar17-assignment1</title>
<!-- may not be neseary <meta charset="UTF-8"> -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="javaScript.js"></script>

<link rel="stylesheet" type="text/css" href="style.css">
<body>

<!-- Navgiation bar (sit on top) -->
<div class="-top">
  <div class="-nav">
    <a href="index.php" class="-bar-item -button">
	<b>Larsen</b> Solutions</a>
    <div class="-right">
	  <a href="picture.php" class="-bar-item -button">Pictures</a>
      <a href="picture-upload.php" class="-bar-item -button">Upload</a>
      <a href="user.php" class="-bar-item -button">Users</a>
      <a href="contact.php" class="-bar-item -button">Contact</a>
	  <a href="login.php" class="-bar-item -button"> Login</a>
	  <a href="fun-logout.php" class="-bar-item -button"> logout</a>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="-content -padding" style="max-width:1564px">

 <!-- solutions Section -->
  <div class="-container -padding-32" id="projects">
    <h3 class="-border-bottom -border-light-grey -padding-16">Pictures</h3>
</div>

<?php 
if (isset($data[$index][$type])){
  for ($row = 0; $row < 5; $row = $row + 1) {
		echo "<div class=\"-row-padding\">";
		for ($col = 0; $col < 4; $col = $col + 1) {
		echo "<div class=\"-col l3 m6 -margin-bottom\">";
		echo "<img src=\"fun-image.php?picture_index={$index}\" alt={$data[$index][$type]} style=\"width:auto; max-width:100%; max-height:70%\">"; 
		echo "<h3>".$data[$index]['picture_title']."</h3>"; 
		echo "<p>".$data[$index]['picture_comment']."</p>";
		echo "<h3>".$data[$index]['picture_likes'];
		echo "<button class=\"-button -light-grey -block\">Like</button></h3>";
		echo "</div>";
		if (isset($data[$index + 1]['picture_title'])) {$index = $index + 1;} else {break;}
		}
	if (isset($data[$index + 1]['picture_title'])) {} else {break;}	
	echo "</div>";
    echo "<div class=\"-divider\">";
	echo "</div>";
  }
} else {
	echo "<h3>There has not been any oploads yet use the link in upload to preload some pictures</h3>";
}
  ?>

<!-- End page content -->
</div>


<!-- Footer -->
<footer class="-center -black -padding-16">
  <p>Powered by <a href="https://sso.sdu.dk/" title="Silar17-assignment1" target="_blank" class="-hover-text-green">Larsen</a></p>
</footer>

</body>
</html>