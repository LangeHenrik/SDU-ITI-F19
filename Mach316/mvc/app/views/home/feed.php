
<html>
<?php include '../app/views/partials/navigationbar.php';
echo "<link rel='stylesheet' href='../../app/css/general.css'>";
echo "<link rel='stylesheet' href='../../app/css/feed.css'>";
;


?>


<div class="main-content">
<h1 class="header-feed">Feed page</h1>

<?php
$images = $parameters['images'];

$postRenderer = new PostRenderer();
$posts = $postRenderer->renderPosts($images);
echo "<div class='posts-container'>$posts</div>"

?>

</div>
</html>
