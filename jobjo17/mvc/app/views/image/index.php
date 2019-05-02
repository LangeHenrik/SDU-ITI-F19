<?php
require_once('../app/models/image.php');
include '../app/views/partials/menu.php'; 
?>
<!DOCTYPE html>
<body>
<div name="picturebox" class="scrollbox">
<table>
<tr>
<th> Description </th>
<th> Picture </th>
<th> Title </th>
</tr>
<tr>
<td> A test picture </td>
<td> <img src="scooby.jpg" alt="" border=3></img></td>
<td> The admin </td>
</tr>
<?php	
		foreach($viewbag['images'] as &$value) {
			echo "<tr>";
			echo "<td>".$value->description."</td>";
			echo "<td>".'<img src="data:image/jpeg;base64,'.base64_encode( $value->image ).'"/>'."</td>";
			echo "<td>".$value->title."</td>";
			echo "</tr>";

		}
		?>
</table>
</div>
<p id="description"></p>
<p id="image"></p>
<p id="uploader"></p>
</body>
</html>




