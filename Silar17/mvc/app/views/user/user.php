<?php include '../app/views/partials/menu.php'; ?>

<!-- Page content -->
<div class="-content -padding" style="max-width:1564px">

<!--  Section -->
  <div class="-container -padding-32" id="about">
  <h3 class="-border-bottom -border-light-grey -padding-16">Users</h3>
	<p>here you will find a complete list of users</p>
  </div>
	<?php 
	$names = $viewbag['names'];
	$index = 0;
	$type = 'user_username';
  if (isset($names[$index][$type])){
  for ($row = 0; $row < 5; $row = $row + 1) {
		echo "<div class=\"-row-padding\">";
		for ($col = 0; $col < 4; $col = $col + 1) {
		echo "<div class=\"-col l3 m6 -margin-bottom\">";
		$content = $this->model('User')->userImage($names[$index][$type]);
		echo '<img style="width:auto; max-width:100%; max-height:70%" src="data:'.$content['picture_type'].'; base64, ' .base64_encode($content['picture']).'"/>';
		echo "<h3>".$names[$index][$type]."</h3>"; 
			
		echo "<button class=\"-button -light-grey -block\">Contact</button>";
		echo "</div>";
		if (isset($names[$index + 1][$type])) {$index = $index + 1;} else {break;}
		}
	echo "</div>";
    echo "<div class=\"-divider\">";
	echo "</div>";
	if (isset($names[$index + 1][$type])){} else {break;}
  }
  } else {
	echo "<h3>There has not been any users yet use the link in upload to preload some users</h3>";
}
  ?>
<div class="-divider"></div>

<!-- End page content -->
</div>
<?php include ('../app/views/partials/footer.php'); ?>
