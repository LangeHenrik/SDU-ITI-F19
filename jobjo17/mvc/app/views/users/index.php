<?php

require_once('../app/models/user.php');
include '../app/views/partials/menu.php';
?>
<!DOCTYPE html>
<body>
<table>
<tr>
<th>
<span>Username<span>
</th>
<th>
<span>Name</span>
</th>
<th>
<span>City</span>
</th>
<th>
<span>Image</span>
</th>
<th>
<span>Email</span>
</th>
<th>
<span>Phone</span>
</th>
</tr>
<?php
foreach($viewbag['users'] as &$value) {
	echo '<tr>';
	echo '<td>'.$value->user_name.'</td>';
	echo '<td>'.$value->first_name." ".$value->last_name.'</td>';
	echo '<td>'.$value->city.'</td>';
	echo '<td>'.'image'.'</td>';
	echo '<td>'.$value->email.'</td>';
	echo '<td>'.$value->phone.'</td>';
	echo '</tr>';
}

?>
</table>
</body>






</html>