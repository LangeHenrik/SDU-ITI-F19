<?php
		
		include './header.php'; 
		include './PDO.php';

		echo "<p> A list of users: First name, last name, zipcode and city<p>";

		//Limit 5 then use AJAX to call more after page is loaded
		$stmt = $conn-> prepare("Select person_id, firstName, lastName, zipcode, city FROM person ORDER BY person_id LIMIT 5");
		
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$users = $stmt->fetchAll();

		echo '<pre>'; // pre = preformatted text
        print_r($users);
        echo  '</pre>'; 



?>