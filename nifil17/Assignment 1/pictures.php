<?php
session_start();
if ( isset( $_SESSION['user_id'] ) ) {
} else {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<body>
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

body {
	background-color: green;
}

.label{
	position: absolute;
	left:50%;
	top: 0px;
	font-size: 32px;
	transform: translateX(-50%) translateY(-50%);
}

.picturesForm{
	width: 80%;
	height: 80%;
	border-style: solid;
	background-color: white;
	padding: 10px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);	
}

.pictures{
	width:80%;
	height:80%;
	position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
}

.field{
	width:100%;
	height:10%;
	margin-bottom: 3px;
	font-size: 32px;
}

.submit{
	width:100%;
	height:10%;
	margin-bottom: 3px;
	font-size: 32px;
}

</style>
<script>
$(document).ready(function(){
    $('#getUser').on('click',function(){
        $.ajax({
            type:'POST',
            url:'retrievepics.php',
            dataType: "json",
            success:function(data){
				console.log(data.result);
                    $('#description').text(data.result.username);
                    $('#picture').text(data.result.firstname);
                    $('#user').text(data.result.lastname);
            }
        });
    });
});
</script>

<div class="topnav">
	<a class="active" href="pictures.php">Pictures</a>
	<a href="users.php">Users</a>
	<a href="upload.php">Upload</a>
</div> 
<div name="picturebox" class="scrollbox">
<table>
<tr>
<th> Description </th>
<th> Picture </th>
<th> Header </th>
</tr>

<?php
	require_once('db_config.php');
	$conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$st = $conn->prepare("SELECT * FROM picture ORDER BY picid LIMIT 20;");
	$results = array();
	if ($st->execute()) {
		while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
			$results[] = $row;
		}
	}		
	foreach($results as $result) {
		echo "<tr>";
		echo "<td>".$result['description']."</td>";
		echo "<td>".'<img src="data:image/jpeg;base64,'.base64_encode( $result['picture'] ).'"/>'."</td>";
		echo "<td>".$result['header']."</td>";
		echo "</tr>";
	}
?>

</table>
</div>
	<p id="description"></p>
	<p id="picture"></p>
	<p id="user"></p>
</body>
</html>

