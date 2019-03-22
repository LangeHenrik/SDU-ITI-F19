<?php
	//check if the user has clicked the login button
	if (isset($_POST['submit'])) {

		//Then we include the database connection
		include_once 'db_config.php';
		require_once 'db_config.php';

		
		// then get the data from the signup form
		$phone = $_POST['phone'];
		$zip = $_POST['zip'];
		$email = $_POST['email'];
		$name = $_POST['name'];
		$password = $_POST['password'];

		//Error handlers
		//Error handlers are important to avoid any mistakes the user might have made when filling out the form!
		//Check for empty fields
		if (empty($name) || empty($phone) || empty($email) || empty($zip) || empty($password)) {
			header("Location: ../signup.php?signup=empty");
			exit();

		} else {
			if (
				!preg_match("/[\w\s]+/", $name) || !preg_match("/^(\\+)[0-9]{8,30}$/", $phone) ||
				!preg_match("/[^@]+@[^@]+\.[^@]+/", $email) || !preg_match("/^[0-9]{4}$/", $zip) ||
				!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/", $password)
			) {
	
				header("Location: ../signup.php?signup=invalid");
				exit();
			} else {
				//Check email
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					header("Location: ../signup.php?signup=email");
					exit();
				} else {
					
					$stmt = $conn->prepare("SELECT * FROM users WHERE user_id=:user_id");  
					$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
	
	
					if (!$stmt->execute()) {
						header("Location: ../signup.php?signup=usertaken");
						exit();
					} else {
						//Hashing of the Password
						$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
						//Insert user to database
						$sql = "INSERT INTO users (user_name, user_phone, user_email, user_zip, user_password) 
        						VALUES (:name, :phone, :email, :zip, :hashedPwd)";

	
						$stmt= $conn->prepare($sql);
						$stmt->execute([':name'     => $name, 
									':phone'    => $phone, 
									':email'    => $email, 
									':zip'      => $zip, 
									':hashedPwd'=> $hashedPwd 
									]);
						header("Location: ../signup.php?signup=success");
						exit();
					}
				}
			}}}