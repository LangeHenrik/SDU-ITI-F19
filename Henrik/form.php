<form action="form.php" action="post">

<input type="text" name="vname" value="myValue"/>
<input type="submit"/>
</form>


<h1>$_REQUEST</h1>
<?php
	print_r($_REQUEST);
?>


<h1>$_GET</h1>
<?php
	print_r($_GET);
?>


<h1>$_POST</h1>	
<?php
	print_r($_POST);
?>
