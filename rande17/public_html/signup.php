<?php
	require_once("class/loadall.php");

	if(isset($_POST['username'])){

			$function->signup($_POST['username'], $_POST['password'], $_POST['mail'], $_POST['fname'], $_POST['lname'], $_POST['phone'], $_POST['city'], $_POST['zip']);
	}

	$function->getSignupForm();
