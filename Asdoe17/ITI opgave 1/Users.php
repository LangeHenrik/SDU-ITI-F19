<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION["logged_in"])) {
  header("Location:Login.php");
}

require_once 'includes/dbconfig.php';

try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname",
		$username,
		$password,
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

		$query = $conn->prepare("SELECT * FROM users;");

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

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Users</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<div class="wrapper">
    <?php
    					foreach ($users as $user){
    						create_user_box('userimage.jpg',$user['user_username']);
    					}
    				?>
          </div>
  </body>
</html>

<?php
function create_user_box($image_source, $username){

echo '<article class="pic-text">';
//echo '<div>';
echo '	<img src='.$image_source.' alt="'.$username.'" class="img-artc-pic"/>';
echo '	<h2> '.$username.' </h2>';
//echo '</div>';
echo '</article>';
}
?>
