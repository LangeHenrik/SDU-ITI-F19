<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(empty($_SESSION['user'])){
	header("Location: index.php");
}
require_once "db_config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Display of users</title>
</head>
<body>
<div>
		<a href="imagepage.php">Pictures</a>
		<a href="displayusers.php">Show table of users</a>
		<a href="newupload.php">Upload picture</a>
		<span style="float:right">Current user: <?php echo $_SESSION['user'];?></span>
	</div>
<div>
	<table>
		<thead>
		<tr>
			<th>Username</th>
			<th>Full name</th>
		</tr>
		</thead>
		<tbody>
		<?php
			$sql = "SELECT username, name FROM user;";
			$statement = $con -> prepare($sql);
			$statement -> execute();
			
			while($users = $statement -> fetch(PDO::FETCH_NUM)){ ?>
				<tr>
					<td><?php echo $users[0] ?></td>
					<td><?php echo $users[1] ?></td>
				</tr>
				<?php
			}?>
		</tbody>
	</table>
	</div>
	</body>
	</html>