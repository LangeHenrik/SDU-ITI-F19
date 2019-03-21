<?php
require "header.php";

require_once "config.php";

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	echo "You need to login to upload pictures.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
	$target_dir = "images/";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	$i = 0;
	while (file_exists($target_file)) {
		$i++;
		$target_file = str_replace(".", "_" . $i . ".", $target_file);
	}
	
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}

	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	} else {
		if (!move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
			echo "Sorry, there was an error uploading your file.";
			$uploadOk = 0;
		}
	}
	
	$sql = "INSERT INTO images(title,description,source) VALUES(:title,:description,:source)";
	
	if($stmt = $conn->prepare($sql) and $uploadOk == 1){
		
		$stmt->bindParam(":title", $param_title, PDO::PARAM_STR);
		$stmt->bindParam(":description", $param_description, PDO::PARAM_STR);
		$stmt->bindParam(":source", $target_file, PDO::PARAM_STR);

		$param_title = trim($_POST["title"]);
		$param_description = trim($_POST["description"]);		
			
		if($stmt->execute()){
			echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
		} else {
			unlink($target_file);
			echo "Sorry, there was an error uploading your file.";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload Picture</title>
</head>
<body>
<h2>Upload picture<h2/>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data"> 
		<input type="file" name="file" required><br>
		<input type="text" name="title" placeholder="Title"><br>
		<textarea rows="3" cols="40" name="description" placeholder="Description"></textarea><br>
		<input type="submit" value="Upload">
	</form>
</body>
</html>
