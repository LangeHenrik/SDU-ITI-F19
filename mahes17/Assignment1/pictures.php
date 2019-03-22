<?php
?>

<html>

<head>

</head>

<body>

	<?php include 'header.php';
	
		include 'PDO.php';

		$stmt = $conn->prepare("SELECT * FROM picture LIMIT 10");
		
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$result = $stmt->fetchAll();


		//SHOW PICS SOMEHOW??
		
	?>

	<img src = "getFromSQL"> 



<br/>

<br/>

</body>

</html>
