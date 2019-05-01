<?php
$index = 0;
$type = 'picture_title';
include '../app/views/partials/menu.php';
$data = $viewbag['data'];
echo "</div>";

if (isset($data[$index][$type])){
  for ($row = 0; $row < 5; $row = $row + 1) { //5
		echo "<div class=\"-row-padding\">";
		for ($col = 0; $col < 4; $col = $col + 1) { //4
		echo "<div class=\"-col l3 m6 -margin-bottom\">";
		$content = $this->model('User')->getImage($index);
		echo '<img style="width:auto; max-width:100%; max-height:70%" src="data:'.$content['picture_type'].'; base64, ' .base64_encode($content['picture']).'"/>';	
		echo "<h3>".$data[$index]['picture_title']."</h3>"; 
		echo "<p>".$data[$index]['picture_comment']."</p>";
		echo "<h3>".$data[$index]['picture_likes'];
		echo "<button class=\"-button -light-grey -block\">Like</button></h3>";
		echo "</div>";
		if (isset($data[$index + 1]['picture_title'])) {$index = $index + 1;} else {break;}
		}
	if (isset($data[$index + 1]['picture_title'])) {} else {break;}	
	echo "</div>";
    echo "<div class=\"-divider\">";
	echo "</div>";
  }
} else {
	echo "<br><br>";
	echo "<h3>There has not been any oploads yet use the link in upload to preload some pictures</h3>";
} ?>

<!-- End page content -->
</div>

<!-- Footer -->
<?php include '../app/views/partials/footer.php'; ?>