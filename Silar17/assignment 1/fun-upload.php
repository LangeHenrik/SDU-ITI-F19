<?php
require_once 'db_config.php';

   try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }
	catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


header('Location: picture-upload.php');

?>
