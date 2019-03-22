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
		
		//Post detail
		
		$stmt1 = $conn->prepare("SELECT post_image, post_img_type, post_user, post_title, post_description FROM rafha13.content");
		
        $stmt1->execute();
        $stmt1->setFetchMode(PDO::FETCH_ASSOC);
        $result1 = $stmt1->fetchAll();
		
		//User detail
		
		
		$stmt2 = $conn->prepare("SELECT user_Image, user_img_type FROM rafha13.siteUser WHERE user_Name = :username");
		
		$stmt2->bindParam(':username', $_SESSION['username']);
		
		
		
		
        $stmt2->execute();
        $stmt2->setFetchMode(PDO::FETCH_ASSOC);
        $result2 = $stmt2->fetchAll();
		
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
			<a class="active" href="content_page.php"> <u> Content </u> </a> 
			<a class="links" href="user_page.php"> <u> Users </u> </a> 
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
		
			<!-- Create Post -->
			<p> Make post: </p>
			<form action="createPost.php" method="POST" enctype="multipart/form-data" id="formid">
				<input class="post_title" type="text" placeholder="Title..." name="title" />
				</br> </br>
				<textarea rows="15" cols="100" placeholder="Description..."  name="description" form="formid"></textarea>
				</br> </br>
				<p> Max size: 2MB </p>
				<input type="file" name="pickImg" />
				</br> </br>
				
				<button type="submit"> Post Content </button>
			</form>
			</br>
			
			<hr class="line">
			
			<!-- Posts -->
			<?php 
				for ($i = 0; $i < 20; $i++) {
					if (!isset($result1[$i]['post_image'])) {
						echo '
							<p> No more content to load </p>
						';
						break;
					} else {
						?>
						<div class="pictures">
							<div class="user">
								<div class="userbox" style="background-color:white">
									<?php 
										//profile image
										require_once 'db_config.php';

										try {
												
											$conn = new PDO("mysql:host=$servername;dbname=$dbname",
											$username,
											$password,
											array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
											
											$stmt3 = $conn->prepare("SELECT user_Image, user_img_type FROM rafha13.siteUser WHERE user_Name = :username");
											
											$stmt3->bindParam(':username', $result1[$i]["post_user"]);
	
											$stmt3->execute();
											$stmt3->setFetchMode(PDO::FETCH_ASSOC);
											$result3 = $stmt3->fetchAll();
										} catch (PDOException $e) {
											echo "Error: " . $e->getMessage();
										}
									
										$conn = null;
																						
										if ($result3[0]["user_Image"]  == null) {
											echo '
												<img class="profilepic" src="stock.jpg" >
											';
										} else {		
												
											
											echo '
													<img class="profilepic" src="data:' . $result3[0]["user_img_type"] . '; base64, ' . base64_encode($result3[0]["user_Image"]) . '"/>
											';
										}
										
										
										
										//user name
										echo '
													<h1 class="name" style="color:black">' . $result1[$i]["post_user"] .
													'</h1>
										';
									?>
								</div>
							</div>
							<div class="post">
								<div class="post_picture_box">
									<?php
										// post image
										echo '
													<img class="post_picture" src="data:' . $result1[$i]["post_img_type"] . '; base64, ' . base64_encode($result1[$i]["post_image"]) . '"/>
										';
									?>
								</div>					
								<div class="post_text">
									<?php
										// post title
										echo '
											<h1>' . $result1[$i]['post_title'] . '</h1>
										';
										// post description
										echo '
											<h2>' . $result1[$i]['post_description'] . '<h2>
										';
									?>
								</div>
							</div>
						</div>
						
						<hr class="line">
						
						<?php
					}
				}
			?>
			
		</div>
		
		<div class="add" style="right:15px">
			<h2 style="color:white">Absolute greatest place for ads!</h2>
		</div>
			
	</div>
		
	</body>
</html> 