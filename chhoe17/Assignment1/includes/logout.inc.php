<?php

	//If the user has clicked the logout button
	if (isset($_POST['submit'])) {
		session_start();
		//Then delete all SESSION variables
		session_unset();
		//And destroy the current session that is running
		session_destroy();
		header("Location: ../index.php");
		exit();
	}
