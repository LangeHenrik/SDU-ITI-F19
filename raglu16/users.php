<?php
	require "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Users</title>
	<style>
	table {
		font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}
	
	td, th {
		border: 1px solid #dddddd;
		text-align: left;
		padding: 8px;
	}
	</style>
</head>
<body>
<h2>Users<h2/>
<table style="width:100%;">
	<tr>
		<th>Username</th>
		<th>Name</th>
		<th>Zip</th>
		<th>City</th>
		<th>E-mail</th>
		<th>Phone number</th>
	</tr>
    <?php
		require "db_conn.php";
		$stmt=$conn->prepare("SELECT username, firstname, lastname, zip, city, email, phonenumber FROM users");
		$stmt->execute();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    ?>
	<tr>
		<td><?php echo $row["username"]; ?></td>
		<td><?php echo $row["firstname"] . " " . $row["lastname"]; ?></td>
		<td><?php echo $row["zip"]; ?></td>
		<td><?php echo $row["city"]; ?></td>
		<td><?php echo $row["email"]; ?></td>
		<td><?php echo $row["phonenumber"]; ?></td>
    </tr>
    <?php
		}
    ?>
</table>



<body/>