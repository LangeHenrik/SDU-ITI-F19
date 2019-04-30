<?php
	require 'Login_required.php';
	
	// **** 
	// SELECT * FROM post ORDER BY created ASC LIMIT 20 OFFSET 20;

	require_once 'db_config.php';
		
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname",
		$username,
		$password,
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	
		$query = $conn->prepare("SELECT * FROM post ORDER BY time_created DESC LIMIT 20;");
		 
		$query->execute();
		$query->setFetchMode(PDO::FETCH_ASSOC);
		$posts = $query->fetchAll();
	} catch (PDOException $e) {
		$error = $e->getMessage();
		$posts = array();
		echo "Error: " . $error;
	}
	
	$conn = null;
?>

<html>    
	<head>        
		<title>HCHB's Exercise</title>
			<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --> 
			<script src="Posts.js"></script>
			<!-- <link rel="shortcut icon" type="image/png" href="/favicon.png"/> --> 
			<!-- <body background="bgimage.jpg">  -->
			<!-- <body bgcolor="#E6E6FA">  -->
			<link rel="stylesheet" type="text/css" href="GeneralLook.css">
	</head>
	<body> 
		<?php
			include 'NavigationBar.php';
		?>
		<div class='main'>
			<?php
				include 'GeneralContentLeft.php';
			?>
			
			<div class="content" id='content'>
				<?php 					
					foreach ($posts as $post){
						create_post_box($post['picture'],$post['header'],$post['description']);
					}
				?>
			</div>
			
			<?php
				include 'GeneralContentRight.php';
			?>
		</div>
	</body>
</html>

<?php
function create_post_box($picture, $header, $text){
	
echo '<div class="post_box">';
echo '	<h1>'.$header.'</h1>';
echo '	<img alt="Failure to load image is your fault!" src="'.$picture.'" />';
echo '	<p class="post_text"> '.$text.' </p>';
echo '</div>';

}
?>