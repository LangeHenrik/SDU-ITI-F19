
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
<th><br><br>

<span>Name</span>
</th>

<th><br><br>
<span>City</span>
</th>

<th><br><br>
<span>Email</span>
</th>
<th><br><br>
<span>Image</span>
</th>


<br><br>
<a href = "/uojon16/mvc/public/home/"> Back to login page </a>
<br><br>
<a href = "/uojon16/mvc/public/Image/"> Upload pictures </a>

<?php
require_once('../app/models/Image.php');


foreach($viewbag['images'] as &$value) {
            echo "<tr>";
            echo "<td>".$value->description."</td>";
            echo "<td>".'<img src="data:image/jpeg;base64,'.base64_encode( $value->image ).'"/>'."</td>";
            echo "<td>".$value->title."</td>";
            echo "</tr>";

        }
		?>
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