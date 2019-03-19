<?php
    # Starty session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    
    # establish db connection
    require_once 'db_config.php';

    try {

        $conn = new PDO("mysql:host=$servername;dbname=$dbname",
        $username,
        $password,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        $stmtGetUsers = $conn->prepare("SELECT username, firstname, lastname FROM picture_user");

        $stmtGetUsers->execute();
        $stmtGetUsers->setFetchMode(PDO::FETCH_ASSOC);
        $resultGetUsers = $stmtGetUsers->fetchAll();
        print_r($resultGetUsers);

    } catch (PDOexception $e) {
        echo "Error: " . $e->getMessage();
    }





	# Close db connection
	$conn = null;
?>

<h1>Users!</h1>
