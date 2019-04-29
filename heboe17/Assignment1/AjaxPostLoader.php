<?php
	require_once 'db_config.php';
		
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
function create_post_box($picture, $header, $text){
	
echo '<div class="post_box">';
echo '	<h1>'.$header.'</h1>';
echo '	<img alt="Failure to load image is your fault!" src="'.$picture.'" />';
echo '	<p class="post_text"> '.$text.' </p>';
echo '</div>';

}
?>