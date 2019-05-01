<?php
class User extends Database {
	
	private $_username, $_pwd, $_firstName, $_lastName,$_zipcode,$_city,$_email,$_phonenumber;
	 

	// // constructer for user
	// //public function __construct($username,$pwd, $lastName,$zipcode,$city,$email,$phonenumber){
	// public function __construct(){
	// 	// $_username = $username;
	// 	// $_pwd = $pwd; 
	// 	// $_firstName = $firstName;
	// 	// $_lastName = $lastName;
	// 	// $_zipcode = $zipcode;
	// 	// $_city = $city;
	// 	// $_email = $email;
	// 	// $_phonenumber = $phonenumber;
	// }

	// public function login($username,$pwd){	
		
	// 	if($username == "" || $pwd == ""){
	// 		return false;
	// 	}
		
	// 	$sql = "SELECT username,pwd FROM users WHERE username = $username;";
		
	// 	echo $sql;
		
	// 	$stmt = $this->conn->prepare($sql);
	// 	$stmt->bindParam(":username",$username);
	// 	$stmt->execute();
	// 	$users = $stmt->fetchAll();

	// 	if(isset($users[0]) && sizeof($users) == 1 && $users[0]['username']==$username){
	// 		$hashed_pwd = $users[0]['pwd'];
	// 		if(password_verify($pwd,$hashed_pass) ){
	// 			$_SESSION['logged_in'] = true;
	// 				// sets session variables
	// 			$_SESSION["username"] = $users[0]['username'];
    //             $_SESSION["firstname"] = $users[0]["firstname"];
    //             $_SESSION["lastname"] = $users[0]["lastname"];
    //             $_SESSION["zipcode"] = $users[0]["zipcode"];
    //             $_SESSION["city"] = $users[0]["city"];
    //             $_SESSION["email"] = $users[0]["email"];
    //             $_SESSION["phonenumber"] = $users[0]["phonenumber"];
	// 			return true;

	// 		}else{
	// 			return false;
	// 		}
			
	// 	}

	// }

	// public function logout(){
	// 	$_SESSION['logged_in'] = false;
		
	// }


	// public function showUsers(){
	//     $sql = "SELECT * FROM users";
	// 	$stmt = $this->conn->prepare($sql);
	// 	$stmt->execute();
		
	// 	$userList = $stmt->fetchAll();
		
	// 	return $userList;
	// }

	public function login($username,$password){
		
		$sql = "SELECT username,pwd FROM users WHERE username = $username;";
				
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':username',$username);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$users = $stmt->fetchAll();

		if(isset($users[0]) && sizeof($users) == 1 && $users[0]['username']==$username){
			$hashed_pwd = $users[0]['pwd'];
			if(password_verify($pwd,$hashed_pass) ){
				$_SESSION['logged_in'] = true;
					// sets session variables
				$_SESSION["username"] = $users[0]['username'];
                $_SESSION["firstname"] = $users[0]["firstname"];
                $_SESSION["lastname"] = $users[0]["lastname"];
                $_SESSION["zipcode"] = $users[0]["zipcode"];
                $_SESSION["city"] = $users[0]["city"];
                $_SESSION["email"] = $users[0]["email"];
                $_SESSION["phonenumber"] = $users[0]["phonenumber"];
				return true;

			}else{
				return false;
			}
			
		}	
	}

	public function getUserlist(){
		$sql = "Select * FROM users";
		$sql->execute();
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		$userList = $sql->fetchAll();
	}
















}