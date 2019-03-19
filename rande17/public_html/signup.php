<?php
	require_once("class/loadall.php");

	if(isset($_POST['username'])){
		$function->signup($_POST['username'], $_POST['password'], $_POST['mail']);
	}
	$function->getSignupForm();
