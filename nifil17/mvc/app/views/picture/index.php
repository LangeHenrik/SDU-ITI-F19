<?php

include '../app/views/partials/menu.php';

require_once '../app/models/Picture.php';

if (session_status() == PHP_SESSION_NONE) {
	header("localhost:8080/nifil17/mvc/public/home");
}
?>

<!DOCTYPE html>
<style>

.topnav {
  background-color: #333;
  overflow: hidden;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
	
td, th {
  border: 1px solid #dddddd;
  padding: 8px;
  vertical-align: middle;
  text-align: center;
}

img {
	  max-height: 250px;
}

</style>

<table>
<tr>
<th>
<span>Picture Id<span>
</th>
<th>
<span>User</span>
</th>
<th>
<span>Header<span>
</th>
<th>
<span>Description<span>
</th>
</tr>

<?php

foreach($viewbag['pics'] as &$value) {
    echo '<tr>';
    echo '<td>'.$value->picture_id.'</td>';
    echo '<td>'.$value->user.'</td>';
    echo '<td>'.$value->header.'</td>';
    echo '<td>'.$value->description.'</td>';
    echo '</tr>';
    echo '<tr>';
	echo "<td>".'<img src="data:image/jpeg;base64,'.base64_encode( $value->picture ).'"/>'."</td>";
    echo '</tr>';
}

?>

</table>
</html>
