<?php

class User extends Database {

	private $preparedLoginCheck;
	private $preparedGetUsername;
	private $prepareInsertUser;
	public function __construct() {
		parent::__construct();
		$this->preparedLoginCheck = $this->conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
		$this->preparedGetUsername = $this->conn->prepare("SELECT * from users WHERE username = :username");
		$this->prepareInsertUser = $this->conn->prepare("INSERT INTO users (username, firstname, lastname, zip, city, email, phone, password) 
			VALUES(:username, :firstname,:lastname,:zip,:city,:email,:phone,:password)");
	}

	public function login(){
		if(isset($_POST["login-username"]) && isset($_POST["login-password"])) {
			$usernameLogin = htmlentities(filter_input(INPUT_POST, "login-username", FILTER_SANITIZE_STRING));
			$passwordLogin = htmlentities(filter_input(INPUT_POST, "login-password", FILTER_SANITIZE_STRING));
			$this->preparedLoginCheck->bindparam(':username', $usernameLogin);
			$this->preparedLoginCheck->bindparam(':password', $passwordLogin);
			$this->preparedLoginCheck->execute();
			$this->preparedLoginCheck->setFetchMode(PDO::FETCH_ASSOC);
			$result = $this->preparedLoginCheck->fetchAll();
			if (count($result) == 1) {
			foreach($result as $row){
				$_SESSION['loggedInUser'] =  $row['id'];
				$_SESSION['logged_in'] = true;
				header('Location: /magle17/mvc/public/home/');
			}
			} else {
				return "Forkert brugernavn eller adgangskode! Prøv igen, så kan du se blærede billeder!";
			}
		}
		return "";
	}

	public function registerUser(){
		if (isset($_POST["register-username"])) {
			$usernameInput = htmlentities(filter_input(INPUT_POST, "register-username", FILTER_SANITIZE_STRING));
			$passwordInput = htmlentities(filter_input(INPUT_POST, "register-password", FILTER_SANITIZE_STRING));
			$frontNameInput = htmlentities(filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_STRING));
			$lastNameInput = htmlentities(filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_STRING));
			$zipInput = htmlentities(filter_input(INPUT_POST, "zip", FILTER_SANITIZE_NUMBER_INT));
			$cityInput = htmlentities(filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING));
			$emailAdressInput = htmlentities(filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING));
			$phoneNumberInput = htmlentities(filter_input(INPUT_POST, "phone", FILTER_SANITIZE_STRING));
			
			$this->preparedGetUsername->bindparam(':username', $usernameInput);
			$this->preparedGetUsername->execute();
			$this->preparedGetUsername->setFetchMode(PDO::FETCH_ASSOC);
			$result = $this->preparedGetUsername->fetchAll();
		
		
			if (count($result) == 1) {
			  $_SESSION['registerMessage'] = "EFTERABER! Dit brugernavn er allerede taget! Eller også er adgangskoden for kort";
			}
			else{
			  $this->prepareInsertUser->bindparam(':username', $usernameInput);
			  $this->prepareInsertUser->bindparam(':password', $passwordInput);
			  $this->prepareInsertUser->bindparam(':lastname', $lastNameInput);
			  $this->prepareInsertUser->bindparam(':firstname', $frontNameInput);
			  $this->prepareInsertUser->bindparam(':zip', $zipInput);
			  $this->prepareInsertUser->bindparam(':city', $cityInput);
			  $this->prepareInsertUser->bindparam(':phone', $phoneNumberInput);
			  $this->prepareInsertUser->bindparam(':email', $emailAdressInput);
			  $success=$this->prepareInsertUser->execute();
			}
		  }
	}
}


