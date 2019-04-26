<?php
session_start();

//Check if locked in, if not go to login page.
if(!$_SESSION['isLogged']) {
  header("location:index.php"); 
  die(); 
}

//sets current page
$_SESSION['page'] = "Pictures";

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-
		UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
		crossorigin="anonymous">
		
		<title>Pictures</title>
		
		<meta name="viewport" content="width=divice-width, initial-scale=1.0">
		
		<link rel="stylesheet" type="text/css" href="style.css">
		
		<script src="javascript.js"></script>
	</head>
	
	<body>
		<div class="topnav">
		
			<a href="index.php">Login</a>
			
			<a href="Users.php">Users</a>
			
			<a class="active" href="Pictures.php">Pictures</a>
			
			<a href="logout.php">Log Out</a>
			
		</div> 
		
		<div class="addcolumn">
		
			<div class="add">
			
				<h1 class="addtext" >Absolute greatest place for ads!</h1>
				
			</div>
			
		</div>
		
		<div class="maincolumn">
			<!--form for uploading pictures with Header and comment-->
			<div class="upload">
				<form action="upload.php" method="post" enctype="multipart/form-data">
					<h1 class="header3"> Make a post: </h1>
					<input type="text" name="postHeader" id="Header" placeholder="Header" >
					<br>
					<textarea class="subject" type="text" name="subject" id="Subject" placeholder="What's on your mind?"></textarea>
					<br>
					<input class="signUP" type="file" name="imageToUpload" id="imageToUpload">
					<br>
					<button type="submit" class="signUP">Make Post</button>
				</form>	
			</div>
			
			<hr>
			
			
			<?php
				require_once 'db_config.php';

				try {
					//connect to DB and gets all posts
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					$stmt = $conn->prepare("Select * From posts");

					$stmt->execute();
					
					$rows = $stmt->rowCount();

					$posts = $stmt->fetchAll();

				} catch (PDOException $pe) {
					die("Could not connect to the database $dbname :" . $pe->getMessage());
				}

				//set det amount af post that has to be loaded
				$_SESSION['count'] = 20;
				
				//prints out the 20 newest post with the newest on top and the oldest on det bottom
				for ($x = $rows - 1; $x >= 0 && $x >= $rows-$_SESSION['count'] && $rows > 0; $x--) {
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

				$conn = null;
			?>
			
			<!--ajaxcontainer for loading more posts-->
			<div id="ajaxcontainer"></div>
			
		</div>
		
		<div class="addcolumn">
		
			<div class="add">
			
				<h1 class="addtext" >Absolute greatest place for ads!</h1>
				
			</div>
			
		</div>
		
	</body>
	
</html>

<script>
//Ajax caller: calling for 20 more post, when the user reaches the bottom, every time the user does so.

window.onscroll = function(ev) {
	
	var body = document.body;
	var html = document.documentElement;

	var heightDocument = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight );
	
    if ((window.innerHeight + window.scrollY) >= heightDocument - 1) {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("ajaxcontainer").innerHTML = this.responseText;
				heightDocument = heightDocument;
			}
		};
		xmlhttp.open("GET", "ajax.php", true);
		xmlhttp.send();
    };
};

</script>
