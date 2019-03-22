<?php
//Php called by the ajaxs call for getting more posts

session_start();

require_once 'db_config.php';

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$stmt = $conn->prepare("Select * From posts");

	$stmt->execute();
	
	$rows = $stmt->rowCount();

	$posts = $stmt->fetchAll();

} catch (PDOException $pe) {
	die("Could not connect to the database $dbname :" . $pe->getMessage());
}

//offset for the posts already loaded
$temp = $rows - 20;

//loads the next 20 posts
for ($x = $temp - 1; $x >= 0 && $x >= $temp-$_SESSION['count'] && $temp > 0; $x--) {
	
	$image = $posts[$x]['imagetmp'];
	$header = $posts[$x]['header'];
	$comm = $posts[$x]['comm'];
	$exttype = $posts[$x]['exttype'];
	
	echo '<html>
		<div class="post">
			<div class="headerPost">
				<h1 style="font-size:2.5vw;"><b>' . htmlentities($header) . ' </b></h1>
			</div>
			<div class="postText">
				<div class="commPost">
						<p style="font-size:1.5vw;">	' . htmlentities($comm) . ' </p>
				</div>
			</div>
			<div class="postPicframe">
				<img class="postPic" src="data:' . $exttype . '; base64, ' . htmlentities(base64_encode($image)) . '"/>
			</div>
		</div>
		<hr>
	</html>';
}

//changes the offset for next ajax call.
if ($temp > 0) {
	$_SESSION['count'] = $_SESSION['count'] + 20;
}

$conn = null;
?>