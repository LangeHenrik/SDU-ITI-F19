<?php
require_once "db_config.php";

$sql = "SELECT username FROM users;";
$stmt = $conn -> prepare($sql);
$stmt -> execute();
$result = array();

while($row = $stmt -> fetch(PDO::FETCH_NUM)){
	array_push($result, $row[0]);
}

if(isset($_GET["q"])){
	$q = $_GET["q"];
	$hint = "";
	
	if($q != ""){
		$q = strtolower($q);
		$length = strlen($q);
		foreach($result as $hint_name){
			if(stristr($q, substr($hint_name, 0, strlen($q)))){
				if($hint === "") {
					$hint = $hint_name;
				} else {
					$hint .= ", $hint_name";
				}
			}
		}
	}
	
	echo $hint === "" ? "No suggestions" : $hint;
}