
<?php
/*
if (session_status() == PHP_SESSION_NONE ) {
	Header("localhost:8080/mvc/public/home/");
}
*/


require_once('../app/models/image.php');
?>
<!DOCTYPE html>
<body>
<form onsubmit="" method="post">
  
</form>
<span>Images:</span>
</th>
<?php
foreach($viewbag['images'] as &$value) {
            echo "<br>";
			echo $value->title;
			echo "<br>";
            echo '<img src="data:image/jpeg;base64,'.base64_encode( $value->image ).'"/>';
			echo "<br>";
            echo $value->description;
            echo "<br>";
			echo "<br>";

        }
?>
<a href = "/brchr16/mvc/public/user/"> Users </a>
<br>
<a href = "/brchr16/mvc/public/image/uploadpage/"> Upload picture </a>
<br>
<a href = "/brchr16/mvc/public/home/logout"> Logout </a>
</body>
</html>