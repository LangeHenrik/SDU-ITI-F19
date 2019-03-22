<?php
	session_start();
	
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		//echo "Welcome to the user-space";
	} else {
		echo "Please log in first to see this page.";
		// redirecting...
		header("Location: login_page.php");
		die("Redirecting to login-page.php");
	}
	
	require_once 'db_config.php';
	
    try {
		
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",
        $username,
        $password,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		
		$stmt = $conn->prepare("SELECT user_Name, user_Image, user_img_type FROM rafha13.siteUser");
		
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
		
	} catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
		
    $conn = null;
	
?>

<!DOCTYPE html>
<html>
	<head>		
		<title>Assignment 1</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="javascript.js"></script>
		<link rel="stylesheet" type="text/css" href="css.css">
	
	</head>
	<!--Comment-->
	<body>
	
		<div class="nav">
			<a class="links" href="content_page.php"> <u> Content </u> </a> 
			<a class="active" href="user_page.php"> <u> Users </u> </a> 
			<a class="links" href="my_page.php"> <u> My Page </u> </a>
			
			
			
			<div class="account"> 
				<a class="links" href="logout.php"> <u> Logout </u> </a> 
			</div>
						
			<div class="weather">
				<img src="weather.png" style="height:35px"/>
			</div>
			
		</div>	
		
		<div class="back">
			<div class="add" style="left:15px">
				<h2 style="color:white">Absolute greatest place for ads!</h2>
			</div>
				
			<div class="maincolumn">
				
			
				<?php 
				for ($i = 0; $i < count($result); $i++) : ?>
					<div class="userbox">
						<?php if ($result[$i]["user_Image"] == null) : ?> 
							<img class="profilepic" src="stock.jpg" >
						<?php  else : 
							echo '
							<img class="profilepic" src="data:' . $result[$i]["user_img_type"] . '; base64, ' . base64_encode($result[$i]["user_Image"]) . '"/>
							';
						endif;
						?>
					
						<h1 class="name">
						<?=$result[$i]["user_Name"]?>
					</div>
				<?php endfor; ?>
				
				
			</div>
			
			<div class="add" style="right:15px">
				<h2 style="color:white">Absolute greatest place for ads!</h2>
			</div>
				
		</div>

	</body>
</html> 