
<?php
/*
if (session_status() == PHP_SESSION_NONE ) {
	Header("localhost:8080/mvc/public/home/");
}
*/
require_once('../app/models/User.php');
?>
<!DOCTYPE html>
<table>
<th>
<span>Name</span>
</th>
<th>
<span>City</span>
</th>
<th>
<span>Email</span>
</th>
<th>
<span>Image</span>
</th>
<?php

foreach($viewbag['tempUsers'] as &$value)
{
	echo'
	<tr>
	<td>
	'.$value['username']."<br>";'
	</td>)
	</tr>';

}
?>

</table>

</html>