<?php
$serverName = "localhost:3307";
$dbUser = "root";
$dbPassword = "";
$dbName = "spacebook";
    

	
	
class Database {
	function connect() {
		global $serverName, $dbUser, $dbPassword, $dbName, $connection;
		$connection = mysqli_connect($serverName, $dbUser, $dbPassword, $dbName);
	}
	
	function __construct () {
		$this->connect();
	}
	
	function query($stmt) {
		$connection->connect();
		$result = $stmt->get_result();
		$connection->close();
		
		return $result;
	}
	
	function execute($stmt) {
		$connection->connect();
		if(!$stmt->execute()) {
			$connection->close();
			return $stmt->error;
		}
		$connection->close();
	}
}

function connect() {
    global $serverName, $dbUser, $dbPassword, $dbName, $connection;
    $connection = mysqli_connect($serverName, $dbUser, $dbPassword, $dbName);
}

?>