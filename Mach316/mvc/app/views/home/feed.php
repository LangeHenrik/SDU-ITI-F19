
<html>
<?php include '../app/views/partials/navigationbar.php';
echo "<link rel='stylesheet' href='../../app/css/general.css'>";
echo "<link rel='stylesheet' href='../../app/css/feed.css'>";
;


?>


<div class="main-content">
<h1>Feed page</h1>

<?php
$images = $parameters['images'];

$postRenderer = new PostRenderer();
echo $postRenderer->renderPosts($images)

?>

</div>
</html>
