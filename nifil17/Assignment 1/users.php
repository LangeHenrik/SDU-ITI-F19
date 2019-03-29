<?php
session_start();
if ( isset( $_SESSION['user_id'] ) ) {
} else {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<style>

.topnav {
  background-color: #333;
  overflow: hidden;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
	
td, th {
  border: 1px solid #dddddd;
  padding: 8px;
  vertical-align: middle;
  text-align: center;
}

img {
	  max-height: 250px;
}

</style>
<body>
	<div class="topnav">
	<a  href="pictures.php">Pictures</a>
	<a class="active" href="users.php">Users</a>
	<a  href="upload.php">Upload Picture</a>
</div> 
<table>
<tr>
<th> First name </th>
<th> Last name </th>
<th> Zip code </th>
<th> City </th>
<th> Email </th>
<th> Phone number </th>
</tr>

<?php
	require_once('db_config.php');
	$conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$st = $conn->prepare("SELECT firstname,lastname,zip,city,email,number FROM user");
	$results = array();
	if ($st->execute()) {
		while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
			$results[] = $row;
		}
	}	
	foreach($results as $result) {
		echo '<tr>';
		echo '<td>'.$result['firstname'].'</td>';
		echo '<td>'.$result['lastname'].'</td>';
		echo '<td>'.$result['zip'].'</td>';
		echo '<td>'.$result['city'].'</td>';
		echo '<td>'.$result['email'].'</td>';
		echo '<td>'.$result['number'].'</td>';
		echo '</tr>';
	}
?>

</table>
</body>
</html>

