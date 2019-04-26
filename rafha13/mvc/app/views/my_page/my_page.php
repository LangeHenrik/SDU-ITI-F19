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
		
		$stmt = $conn->prepare("SELECT user_Image, user_img_type, user_Name, user_Firstname, user_Lastname, user_ZIP, user_City, user_Email, user_phone FROM rafha13.siteUser WHERE user_Name = :username");
		
		$stmt->bindParam(':username', $_SESSION['username']);
		
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
		//print_r($result);
		
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
			<a class="links" href="user_page.php"> <u> Users </u> </a> 
			<a class="active" href="my_page.php"> <u> My Page </u> </a>
			
			
			
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
				<div class="profilebox">
					<h1> <?=$result[0]["user_Name"]?> </h1>
					<p> Password: SECRET! </p>
					<p> First name: <?=$result[0]["user_Firstname"]?> </p>
					<p> Last name: <?=$result[0]["user_Lastname"]?> </p>
					<p> ZIP-code: <?=$result[0]["user_ZIP"]?> </p>
					<p> City: <?=$result[0]["user_City"]?> </p>
					<p> Email address: <?=$result[0]["user_Email"]?> </p>
					<p> Phone number: <?=$result[0]["user_phone"]?> </p>
				
					<?php if ($result[0]["user_Image"] == null) : ?> 
						<img class="profilepic" src="stock.jpg" >
					<?php  else : 
						echo '
							<img class="profilepic" src="data:' . $result[0]["user_img_type"] . '; base64, ' . base64_encode($result[0]["user_Image"]) . '"/>
							';
						endif;
					?>
						
					</br>
					
					<form action="changeProfilePic.php" method="POST" enctype="multipart/form-data" id="upload-picture">
						Change my profile picture:
						
						</br></br>
						<input type="file" name="profileImg">
						</br>
						<!--<input type="submit">-->
						<button type="submit"> Change ProfilePic </button>
					</form>
					</br> </br> </br> </br>
					
					<button onclick="ajaxfunction()"> Delete Account...! </button>
					</br>
					<div id="ajaxcall"></div>
				</div>
				
				
				
				
			</div>
			
			<div class="add" style="right:15px">
				<h2 style="color:white">Absolute greatest place for ads!</h2>
			</div>
				
		</div>

	</body>
</html> 

<script>
	//AJAX call:
	
		function ajaxfunction() {
		
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("ajaxcall").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", "ajax_delete.php", true);
			xmlhttp.send();
		
		}        
</script>