<?php
if(session_status() == PHP_SESSION_NONE){
	session_start();
}

If(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]){
} else {
    header("Location:Index.php");
}
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles.css">

</head>
<body>
<div>
	<?php include 'topBar.php'; ?>
</div>

<form method="post" enctype="multipart/form-data">
    Select image to upload:
	<br>
    <input type="file" name="fileToUpload" id="fileToUpload">
	<br>
	<input type="text" name="picture_description" placeholder="description">
	<br>
	<input type="text" name="pictitle" placeholder="title">
	<br>
	<input type="text" name="picheader" placeholder="header">
	<br>
    <input type="submit" value="Upload Image" name="uploadImage">
</form>

</body>
</html>


<?php
if(isset($_POST["uploadImage"])){
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
if ($_FILES["fileToUpload"]["size"] > 5000000) {
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
		$stmt = $conn->prepare("INSERT INTO post (post_user_id, post_title, post_header, post_description, post_picture_location) 
							VALUES (:post_user_id, :post_title, :post_header, :post_description, :post_picture_location)");
		$stmt->bindParam(':post_user_id', $_SESSION['user_id']);
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