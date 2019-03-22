<?php
if(session_status() == PHP_SESSION_NONE){
	session_start();
}

If(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]){
} else {
    header("Location:Index.php");
}



	require_once 'db_config.php';
		
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname",
		$username,
		$password,
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	
		$query = $conn->prepare("SELECT * FROM post limit 20");
		 
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



<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<link rel="stylesheet" type="text/css" href="Styling_index.css">
	<title></title>
</head>
<body>
		
	<div id="menu_bar"> 
	<form  method="post" action="logout.php" >
	<button id="logout" name="logout" class="menu_bar_button" >Logout</button> 	
	</form>		
	<form method="post" action="upload_page.php">
	<button id="uploadImages" class="menu_bar_button">User Site</button> 
	</form>
	<form method="post" action="SeeUsers.php">
	<button id="seeUsers" class="menu_bar_button">See Users</button> 
	</form>
	
</div>

<div id="left_white_bar">&nbsp;<a href="https://mail-order-bride.net/"> <div id="left_bar"> <img src="kissrus.png" alt ="russianBride" id="leftBride"> <p id="left_white_bar_text">Click To Order Russian Bride!</p></div></div>
	<div id="right_white_bar">&nbsp; <a href="https://sendacake.com/"><div id="right_bar"><img src="cake.jpg" alt ="cake" id="rightCake"> <p>Click to Order Cake!</p></div></div>
		</a>

		</a>
		<div id="imagebox">
	<form id="upload" align="center"  method="post" enctype="multipart/form-data">
	<input type="file" name="fileToUpload" id="fileToUpload">
	<br>
	<input type="text" name="pictitle" placeholder="Image Title">
	<br>
	<input type="text" name="picheader" placeholder="Picture Header">
		 <textarea id="text" cols="45" rows="4" name="picture_description" placeholder="Picture Description"></textarea>
      	<br>
		<input type="submit" value="Upload Image" name="submit">
		</div>


		<div class="content" id='content'>
				<?php 					
					foreach ($posts as $post){
						postImage($post['post_picture_location']);
					}
				?>
			</div>
			<div>
		
</body>
</html>


<?php
if(isset($_POST["submit"])){
$target_dir = "pictures/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = true;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = true;
    } else {
        echo "File is not an image.";
        $uploadOk = false;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = false;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = false;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = false;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == false) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	$pictureTitle = htmlentities(filter_var($_POST["pictitle"], FILTER_SANITIZE_STRING));
	$pictureHeader = htmlentities(filter_var($_POST["picheader"], FILTER_SANITIZE_STRING));
	$pictureDescription = htmlentities(filter_var($_POST["picture_description"], FILTER_SANITIZE_STRING));

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		require_once 'db_config.php';
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		$stmt = $conn->prepare("INSERT INTO post (post_title, post_header, post_description, post_picture_location) 
							VALUES (:post_title, :post_header, :post_description, :post_picture_location)");
		$stmt->bindParam(':post_title', $pictureTitle);
		$stmt->bindParam(':post_header', $pictureHeader);
		$stmt->bindParam(':post_description', $pictureDescription);	
		$stmt->bindParam(':post_picture_location', $target_file);
		$stmt->execute();
	} else {
        echo "Sorry, there was an error uploading your file.";
    }	
}	
}
?>
<?php
function postImage($picture){
echo '<div class="post">';
echo '	<img alt="Failure to load image is your fault!" src="'.$picture.'" />';
echo '</div>';
}
?>

 
	
			
