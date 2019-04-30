<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION["logged_in"])) {
  header("Location:Login.php");
}
?>

<?php

$post_title = filter_input(INPUT_POST, "post_title", FILTER_SANITIZE_STRING);
$post_description=filter_input(INPUT_POST, "post_description", FILTER_SANITIZE_STRING);

$post_title = htmlentities($post_title);
$post_description = htmlentities($post_description);

$regex_Title = "/^(\w|\s){1,50}$/";
$regex_Description = "/^([\x20-\x7D]|\s){1,500}+$/";

$title_match = preg_match($regex_Title, $post_title);
$description_match = preg_match($regex_Description, $post_description);

if(isset($_POST['submit'])){
  $name = $_FILES['image']['name'];
  $target_dir = "/billeder";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);

  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  $extensions_arr = array("jpg","jpeg","png","gif");

  if( in_array($imageFileType,$extensions_arr) ){
    $image_base64 = base64_encode(file_get_contents($_FILES['image']['tmp_name']) );
    $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

    if($title_match && $description_match){
      uploadPost($post_title, $post_description, $image);
      header("Location:Pictures.php");
    }
  }
}

 ?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Upload Picture</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="UploadPost.js"> </script>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <nav>
      <ul>
        <li><a href="Pictures.php">Pictures</a></li>
        <li><a href="Users.php">Users</a></li>
        <li><a href="UploadPic.php">Upload Picture</a></li>
        <li><a href="includes/Logout.php">Logout</a></li>
      </ul>
    </nav>
      <div class="Simple-center">
        <div class="Center-simple">

    <form action="UploadPic.php" method="POST" onsubmit="return checkFields()" enctype='multipart/form-data'>
					<label for="post_title">Title</label>
					<br>
					<?php
					if(isset($_POST["post_title"])){
						if($title_match){
							echo '<input type="text" name="post_title" id="post_title" value='.$post_title.' />';
						}else{
							echo '<input type="text" name="post_title" id="post_title" style="border:2px solid red;"/> ';
						}
					} else {
							echo '<input type="text" name="post_title" id="post_title"/>';
					}
					?>
					<br>
					<br>

					<label for="post_description">Description</label>
					<br>
					<?php
					if(isset($_POST["post_description"])){
						if($description_match){
							echo '<textarea name="post_description" id="post_description">'.$post_description.'</textarea>';
						}else{
							echo '<textarea name="post_description" id="post_description" style="border:2px solid red;"></textarea> ';
						}
					} else {
							echo '<textarea name="post_description" id="post_description"></textarea>';
					}
					?>
					<br>
					<br>

					<label for="image">Choose a picture</label>
					<br>
					<input type='file' name='image' />
					<br>
					<br>

					<input type="submit" name="submit" id="submit" value='Post'/>
				</form>
        </div>
        </div>
  </body>
</html>


<?php
function uploadPost($header, $description, $image){
		require_once 'includes/dbconfig.php';

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname",
			$username,
			$password,
			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

			$stmt = $conn->prepare("INSERT INTO post(header, description, picture) VALUES(:header, :description, :image);");

			$stmt->bindParam(':header',$header);
			$stmt->bindParam(':description',$description);
			$stmt->bindParam(':image',$image);

			$stmt->execute();

		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}

		$conn = null;
}
?>
