<?php include '../app/views/partials/menu.php'; ?>

<div >
<form>
<select name="users" onchange="showUserPictures(this.value)">
  <option value="">Show pictures from:</option>
  <option value="Admin">Admin</option>
  <option value="Test1">Test1</option>
  </select>
</form>
<br>
<div id="txtHint"></div>


</div>


<body>

<?php /*
foreach ($viewbag as $value) {
	echo '<div class="boxInside">';
	echo '<form>';
	echo '<fieldset>';
    echo '<h2>' . [$value]['title'] . '</h2>';
    echo '<h5>' . 'Submitted by: ' .[$value]['username']. '</h5>';
    echo '<div class="resize">';
    echo '<img src="' .[$value]['image']. '"/>';
	echo '</div>';
    echo '<h4>' . 'Description:' . '</h4>' . [$value]['description'];
	echo '</form>';
	echo '</fieldset>';
	
    echo '</div>';

	
}*/
?>
	
<?php
/*
$latestPersonalimages[] = $userPicture;

for($item = 0; $item <= sizeof($latestPersonalimages)-1; $item++) {

	
	echo '<div class="boxInside">';
	echo '<form>';
	echo '<fieldset>';
    echo '<h2>' . $latestPersonalimages[$item]['title'] . '</h2>';
    echo '<h5>' . 'Submitted by: ' .$latestPersonalimages[$item]['username']. '</h5>';
    echo '<div class="resize">';
    echo '<img src="' .$latestPersonalimages[$item]['path']. '"/>';
	echo '</div>';
    echo '<h4>' . 'Description:' . '</h4>' . $latestPersonalimages[$item]['description'];
	echo '</form>';
	echo '</fieldset>';
	
    echo '</div>';

}
*/

?>


</body>
