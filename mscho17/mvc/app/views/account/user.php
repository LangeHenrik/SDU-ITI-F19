<?php 
function getUsers($viewbag){
	foreach ($viewbag as $resultArray){
	echo '<div class="user_list">';
	$toPrint = $resultArray["username"] . "<br>";
	echo $toPrint;

	}
}
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="/mscho17/mvc/public/css/styles.css">

</head>
<div>
	<?php include '../app/views/partials/topBar.php'; ?>
</div>
<div>
	<p> listing a list of all users </p>
	<div>
		<?php getUsers($viewbag)?>	
	</div>	
</div>


</html>