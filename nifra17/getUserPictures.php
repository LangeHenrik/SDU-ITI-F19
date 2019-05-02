<?php

	function getPersonalImagesByName() {
	
	$q = $_GET['q'];
	
	require_once 'db_config.php';
	try{
	$conn = new PDO("mysql:host=$servername;dbname=$dbname",
    $username,
    $password,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	
	$personalUsername = $q;
   
    $stmt = $conn->prepare('select * from images WHERE username = :username');
	
	$stmt->bindParam(':username', $personalUsername);

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $conn = null;
	
	}catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    return $result;
	
	}
	
	?>
	
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
	
body{
	margin:0;
	font-family: Arial, Helvetica, sans-serif;
}

form {
    margin: 5px;
    border: 2px solid #e5e5e5;

}

.topnav {
	overflow: hidden;
	background-color: #333;
}

.topnav a {
	float: left;
	color: #f2f2f2;
	text-align: center;
	padding: 14px 16px;
	font-size: 17px;
}

.topnav a.active {
	background-color: #4CAF50;
	color: white;
}

*.box {
    min-width: 25px;
    margin-top: 0px;
    padding: 16px;
    border: 5px solid #ccc;
    box-sizing: border-box

}

*.boxInside a {
	width:800px;
	float:left;
	text-align: left;
	padding: 14px 16px;
	display: inline-block;
	border: 1px solid #ccc;
    box-sizing: border-box;
    margin-bottom: 20px;
}

.resize {
    max-width: 100%;
    max-height: 100%;

}

.resize img {
    max-width: 50%;
    max-height: 50%;

}

.title {
	
	font-size: 25px;
	color:#FF0000;
	
	
}

</style>

<body>

	
<?php

$latestPersonalimages = getPersonalImagesByName();


for($item = 0; $item <= sizeof($latestPersonalimages)-1; $item++) {

	
	echo '<div class="boxInside">';
	echo '<form>';
	echo '<fieldset>';
    echo '<h2>' . $latestPersonalimages[$item]['title'] . '</h2>';
    echo '<h5>' . 'Submitted by: ' .$latestPersonalimages[$item]['username']. '</h5>';
    echo '<div class="resize">';
    echo '<img src="' .$latestPersonalimages[$item]['path']. '"/>';
	echo '</div>';
    echo '<h4>' . 'Description:' . '</h4>' . $latestPersonalimages[$item]['description'];
	echo '</form>';
	echo '</fieldset>';
	
    echo '</div>';

}


?>


</body>

</head>
</html>
