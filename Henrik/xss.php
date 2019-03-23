<?php
	//header('Location: https://www.google.com');
?>
<form method="POST">
	<input type="text"/>
	<input type="submit"/>
</form>

<br><br>

<?php

print_r($_POST);
/*
	if(isset($_POST["header"])) :
		echo htmlentities($_POST["header"]);
	endif;

*/
