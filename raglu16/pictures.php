<?php
require "header.php";

require_once "config.php";

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	echo "You need to login to see pictures";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pictures</title>
</head>
<body>
<h2>Pictures<h2/>
<?php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	$stmt = $conn->prepare("SELECT * FROM images"); //sql select query
	$stmt->execute();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
    ?>
		<img src="<?php echo $row["source"]; ?>" width=800px> <br>
		<h4><?php if(isset($row["title"])){echo "[no title]";} else{echo $row["title"];}  ?><h4/>
		<h6><?php if(isset($row["description"])){echo "[no description]";} else{echo $row["description"];} ?><h6/><br>
    <?php
	}
}
    ?>
<body/>