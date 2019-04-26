<?php


?>
<!DOCTYPE html>


<style>
/* Add a black background color to the top navigation */
.topnav {
  background-color: #333;
  overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Add a color to the active/current link */
.topnav a.active {
  background-color: #4CAF50;
  color: white;
}
.scrollbox {
width: 80%;
height: 75%;
border-style: solid;
overflow: auto;
position: absolute;
top: 50%;
left: 50%;
transform: translateX(-50%) translateY(-50%);
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
  <a  href="uploadpicture.php">Upload Picture</a>
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
		$conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT firstname,lastname,zip,city,email,phonenumber from users");

		$results = array();
		if ($stmt->execute()) {
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
			echo '<td>'.$result['phonenumber'].'</td>';
			
			echo '</tr>';

		}
		

?>
</table>
</body>

</html>









