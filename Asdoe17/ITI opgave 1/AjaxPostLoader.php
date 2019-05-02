<?php
	require_once 'includes/dbconfig.php';

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname",
		$username,
		$password,
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

		$numberOfPosts = 20;
		$offset = $_GET['q']*$numberOfPosts;

		$query = $conn->prepare("SELECT * FROM post ORDER BY time_created DESC LIMIT ".$numberOfPosts." OFFSET ".$offset.";");

		$query->execute();
		$query->setFetchMode(PDO::FETCH_ASSOC);
		$posts = $query->fetchAll();
	} catch (PDOException $e) {
		$error = $e->getMessage();
		echo "Error: " . $error;
	}

	$conn = null;
?>




<?php
	foreach ($posts as $post){
		create_post_box($post['picture'],$post['header'],$post['description']);
	}
?>



<?php
function create_post_article($picture, $header, $text){

  echo '<div class="wrapper">';
  echo '<article class="pic-text">';
  echo '  <h2>'.$header.'</h2>';
  echo '  <p>' .$text.' </p>';
  echo '</article>';
  echo '  <img alt="Failure to load picture, What did you do?" class="img-artc-pic" src="'.$picture.'" />';
  echo '</div>';

}
?>
