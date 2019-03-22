<?php
session_start();

//Check if locked in, if not go to login page.
if(!$_SESSION['isLogged']) {
  header("location:index.php"); 
  die(); 
}

//sets current page
$_SESSION['page'] = "Users";

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-
		UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
		crossorigin="anonymous">
		
		<title>Users</title>
		
		<meta name="viewport" content="width=divice-width, initial-scale=1.0">
		
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
		<div class="topnav">
		
			<a href="index.php">Login</a>
			
			<a class="active" href="Users.php">Users</a>
			
			<a href="Pictures.php">Pictures</a>
			
			<a href="logout.php">Log Out</a>
			
		</div> 
		
		<div class="addcolumn">
		
			<div class="add">
			
				<h1 class="addtext" >Absolute greatest place for ads!</h1>
				
			</div>
			
		</div>
		
		<div class="maincolumn">
		
		<?php
		
			require_once 'db_config.php';

			try {
				//connect to DB and gets all user info.
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $conn->prepare("Select * From users");

				$stmt->execute();
				
				$rows = $stmt->rowCount();

				$USERS = $stmt->fetchAll();

			} catch (PDOException $pe) {
				die("Could not connect to the database $dbname :" . $pe->getMessage());
			}

			//prints out all users in userbox div
			for ($x = 0; $x < $rows; $x++) {
				$username = htmlentities($USERS[$x]['username']);
				$fname = htmlentities($USERS[$x]['firstname']);
				$lname = htmlentities($USERS[$x]['lastname']);
				$phone = htmlentities($USERS[$x]['phone']);
				$email = htmlentities($USERS[$x]['email']);
				$zip = htmlentities($USERS[$x]['zip']);
				$city = htmlentities($USERS[$x]['city']);
				$image = $USERS[$x]['imagetmp'];
				$exttype = htmlentities($USERS[$x]['exttype']);
				
				//decode for æøå
				$username = html_entity_decode($username, ENT_QUOTES, 'UTF-8');
				$fname = html_entity_decode($fname, ENT_QUOTES, 'UTF-8');
				$lname = html_entity_decode($lname, ENT_QUOTES, 'UTF-8');
				$city = html_entity_decode($city, ENT_QUOTES, 'UTF-8');
				$email = html_entity_decode($email, ENT_QUOTES, 'UTF-8');
				
				echo '<html>
					<div class="userbox">
						<h1 class="name">' . $fname . ' ' . $lname . '</h1>
						<div class="profilepicbox">
							<img class="profilepic" src="data:' . $exttype . '; base64, ' . htmlentities(base64_encode($image)) . '"/>
						</div>
						<div class="profileInfo">
							<table style="width: 100%; height:75%;">
							  <tr>
								<td class="tdUser"><b>Username</b></td>
								<td class="tdUser">' . $username . '</td>
								<td class="tdUser"><b>City</b></td>
								<td class="tdUser">' . $city . '</td>
							  </tr>
							  <tr>
								<td class="tdUser"><b>Phone</b></td>
								<td class="tdUser">' . $phone . '</td>
								<td class="tdUser"><b>Zip</b></td>
								<td class="tdUser">' . $zip . '</td>
							  </tr>
							  <tr>
								<td class="tdUser"><b>Email</b></th>
								<td class="tdUser" class="threecol" colspan="3">' . $email . '</th>
							  </tr>
							</table>
						</div>
					</div>
				</html>';
			} 

			$conn = null;

		?>
		</div>
		
		<div class="addcolumn">
		
			<div class="add">
			
				<h1 class="addtext" >Absolute greatest place for ads!</h1>
				
			</div>
			
		</div>

	</body>
</html>