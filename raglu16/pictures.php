<?php
require "header.php";

require_once "db_conn.php";

if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
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
		<div style="border-style: solid; border-color: grey; width: 800px">
			<img src="<?php echo $row["source"]; ?>" width=800px> <br>
			<h4><?php if(isset($row["title"])){echo $row["title"];} else{echo "[no title]";}  ?><h4/>
			<span style="font-weight:normal"><?php if(isset($row["description"])){echo $row["description"];} else{echo "[no description]";} ?><span/>
		<div/>
    <?php
	}
}
    ?>
<body/>