<?php

include '../app/views/partials/menu.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Display of users</title>
</head>
<body>
	<table>
		<thead>
		<tr>
			<th>Username</th>
			<th>Full name</th>
		</tr>
		</thead>
		<tbody>
		<?php
			$sql = "SELECT username, fullname FROM users;";
			$statement = $conn -> prepare($sql);
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