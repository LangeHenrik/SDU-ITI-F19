<?php
	require 'Login_required.php';
	
	/*
	$user1=array("Angel__After_the_Fall_13_Cover_by_AlexGarner.jpg","Derpette");
	$user2=array("aes_sedai___moraine_damodred_wot_by_endave-d681txn.jpg","Herpette");
	$users[]=$user1;
	$users[]=$user2; 
	*/

	require_once 'db_config.php';
		
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname",
		$username,
		$password,
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	
		$query = $conn->prepare("SELECT * FROM user;");
		 
		$query->execute();
		$query->setFetchMode(PDO::FETCH_ASSOC);
		$users = $query->fetchAll();
	} catch (PDOException $e) {
		$error = $e->getMessage();
		$users = array();
		echo "Error: " . $error;
	}
	
	$conn = null;
?>

<html>    
	<head>        
		<title>HCHB's Exercise</title>
			<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --> 
			<!-- <script src="myscripts.js"></script> --> 
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
			<div class="content">
				<?php
					// ****
					foreach ($users as $user){
						create_user_box('aes_sedai___moraine_damodred_wot_by_endave-d681txn.jpg',$user['username']);
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
function create_user_box($image_source, $username){
	
echo '<div class="user_box">';
echo '<div>';
echo '	<img src='.$image_source.' alt="'.$username.'" class="profile_picture"/>';
echo '	<div class="user_name"> '.$username.' </div>';
echo '</div>';
echo '</div>';
}
?>