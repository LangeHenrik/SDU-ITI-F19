
<?php
	require_once("class/loadall.php");
	$function->enforceLogin();
	$function->getMenu();
	$function->drawLeft();
	$function->drawMain('upload');
	$function->drawMain('myimage');
?>

