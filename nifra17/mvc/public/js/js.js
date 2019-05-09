console.log("My Script");

function checkLogin(){
	#Validate login info
	if(isset($_POST["username"]) && isset($_POST["password"])) {
		$inputUsername = htmlentities(filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING));
		$inputPassword = htmlentities(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING));

		foreach ($resultGetUsers as $value) {
			#print_r("<br>username: " . $value["username"] . " password: " . $value["password"]);
			if ($inputUsername === $value["username"] && $inputPassword === $value["password"]) {
				$_SESSION["username"] = $inputUsername;
				$_SESSION["login"] = true;
				header('location: home.php');
			}
			else{
				echo "invalid username or password";
			}
		}

		$_SESSION["loginResult"] = "Wrong username og password!";
	}
	
#Validate register info	
	if(isset($_POST["createUsername"])) {
		$inputUsername = htmlentities(filter_input(INPUT_POST, "createUsername", FILTER_SANITIZE_STRING));
		
		foreach ($resultGetUsers as $value) {
			if($inputUsername === $value["username"]){
				$_SESSION["registerResult"] = "Username already in use, please choose another";
				break;
			}
		}
		
		$inputPassword = htmlentities(filter_input(INPUT_POST, "createPassword", FILTER_SANITIZE_STRING));
		
		if (!isset($_SESSION["registerResult"])) {
			try{
				$stmtCreateUser->bindparam(':username', $inputUsername);
				$stmtCreateUser->bindparam(':password', $inputPassword);
				
				$stmtCreateUser->execute();
				$stmtCreateUser->setFetchMode(PDO::FETCH_ASSOC);
				$resultCreateUser = $stmtCreateUser->fetchAll();
				
			}catch(PDOexception $e){
				#echo "Something went wrong " .$e->getMessage();
			}
		}
	}
			
			
	$conn = null;
?>
}