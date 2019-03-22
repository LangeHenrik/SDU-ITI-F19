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
	SELECT * from (SELECT user_username, user_id
	FROM silar17.site_user
	order by user_id) alias
	group by user_username order by user_id "; 
	$stmt = $sql->prepare($sql_code);
	$stmt->execute();
	$names = $stmt->fetchALL();
	$type = "user_username";
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
    <!-- Float links to the right. Hide them on small screens -->
    <div class="-right">
	  <a href="picture.php" class="-bar-item -button">Pictures</a>
      <a href="picture-upload.php" class="-bar-item -button">Upload</a>
      <a href="user-php" class="-bar-item -button">Users</a>
      <a href="contact.php" class="-bar-item -button">Contact</a>
	  <a href="login.php" class="-bar-item -button"> Login</a>
	  <a href="fun-logout.php" class="-bar-item -button"> logout</a>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="-content -padding" style="max-width:1564px">

<!--  Section -->
  <div class="-container -padding-32" id="about">
    <h3 class="-border-bottom -border-light-grey -padding-16">Users</h3>
    <p>here you will find a complete list of users
    </p>
  </div>
  <?php 
  if (isset($names[$index][$type])){
  for ($row = 0; $row < 5; $row = $row + 1) {
		echo "<div class=\"-row-padding\">";
		for ($col = 0; $col < 4; $col = $col + 1) {
		echo "<div class=\"-col l3 m6 -margin-bottom\">";
		echo "<img src=\"fun-user-image.php?picture_user={$names[$index][$type]}\" alt={$names[$index][$type]} style=\"width:auto; max-width:100%; max-height:70%\">"; 
		echo "<h3>".$names[$index][$type]."</h3>"; 
		
		echo "<button class=\"-button -light-grey -block\">Contact</button>";
		echo "</div>";
		if (isset($names[$index + 1][$type])) {$index = $index + 1;} else {break;}
		}
	echo "</div>";
    echo "<div class=\"-divider\">";
	echo "</div>";
	if (isset($names[$index + 1][$type])){} else {break;}
  }
  } else {
	echo "<h3>There has not been any users yet use the link in upload to preload some users</h3>";
}
  ?>
  
   
  <div class="-divider">
  </div>

<!-- End page content -->
</div>


<!-- Footer -->
<footer class="-center -black -padding-16">
  <p>Powered by <a href="https://sso.sdu.dk/" title="Silar17-assignment1" target="_blank" class="-hover-text-green">Larsen</a></p>
</footer>

</body>
</html>