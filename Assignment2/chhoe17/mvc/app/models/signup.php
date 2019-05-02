<?php

require_once ("../Core/database.php");


class Signup extends Database { 


    public function signUpUser($name, $phone, $email, $zip, $password) { 


        //check if the user has clicked the login button
	if (isset($_POST['submit'])) {

		//Then we include the database connection
		include_once '../Core/database.php';
		require_once '../Core/database.php';

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
			header("Location: ../views/home/signupView.php?signup=empty");
			exit();

		} else {
			if (
				!preg_match("/[\w\s]+/", $name) || !preg_match("/^(\\+)[0-9]{8,30}$/", $phone) ||
				!preg_match("/[^@]+@[^@]+\.[^@]+/", $email) || !preg_match("/^[0-9]{4}$/", $zip) ||
				!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/", $password)
			) {
	
				header("Location: ../views/home/signupView.php?signup=invalid");
				exit();
			} else {
				//Check email
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					header("Location: ../views/home/signupView.php?signup=emailInvalid");
					exit();
				} else {
					
					$stmt = $this->conn->prepare("SELECT * FROM users WHERE user_id=:user_id");  
					$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
	
	
					if (!$stmt->execute()) {
						header("Location: ../views/home/signupView.php?signup=usertaken");
						exit();
					} else {
						//Hashing of the Password
						$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
						//Insert user to database
						$sql = "INSERT INTO users (username, user_phone, user_email, user_zip, password) 
        						VALUES (:name, :phone, :email, :zip, :hashedPwd)";

	
						$stmt= $this->conn->prepare($sql);
						$stmt->execute([':name'     => $name, 
									':phone'    => $phone, 
									':email'    => $email, 
									':zip'      => $zip, 
									':hashedPwd'=> $hashedPwd 
									]);
						header("Location: ../views/home?signup=success");
						exit();
					}
				}
			}}

    }

} }
