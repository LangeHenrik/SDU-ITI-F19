<?php
session_start();
if ( isset( $_SESSION['user_id'] ) ) {	
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    header("Location: index.php");
}

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
  <a class="active" href="pictures.php">Pictures</a>
  <a href="users.php">Users</a>
  <a href="uploadpicture.php">Upload Picture</a>
</div> 
<div name="picturebox" class="scrollbox">
<table>
<tr>
<th> Description </th>
<th> Picture </th>
<th> Title </th>
</tr>
<tr>
<td> A test picture </td>
<td> <img src="scooby.jpg" alt="" border=3></img></td>
<td> The admin </td>
</tr>
<?php
		require_once('db_config.php');
		$conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT *FROM images ORDER BY id LIMIT 20;");
		$results = array();
		if ($stmt->execute()) {
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$results[] = $row;
		}
}		
		foreach($results as $result) {
			echo "<tr>";
			echo "<td>".$result['description']."</td>";
			echo "<td>".'<img src="data:image/jpeg;base64,'.base64_encode( $result['image'] ).'"/>'."</td>";
			echo "<td>".$result['title']."</td>";
			echo "</tr>";

		}
		?>
</table>
</div>
<p id="description"></p>
<p id="image"></p>
<p id="uploader"></p>
</body>
</html>




