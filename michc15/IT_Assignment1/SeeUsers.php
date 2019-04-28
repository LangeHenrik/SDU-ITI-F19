<?php
if(session_status() == PHP_SESSION_NONE){
	session_start();
}

If(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]){
} else {
    header("Location:Index.php");
}

function getUsers(){
	require_once 'db_config.php';
	$conn = new PDO("mysql:host=$servername;dbname=$dbname",
	$username,
	$password, 
	array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	
	$stmt = $conn->prepare("SELECT * FROM user_login");
	$stmt->execute();
	$result = $stmt->fetchAll();
	foreach ($result as $resultArray){
		echo '<div class="user_list">';
		$toPrint = $resultArray["user_name"] . "<br>";
		echo $toPrint;
	}
}
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<link rel="stylesheet" type="text/css" href="Styling_index.css">
	<title></title>
</head>
<body>
		<div id="menu_bar"> 
	<form  method="post" action="logout.php" >
	<button id="logout" class="menu_bar_button" >Logout</button> 
	</form>	
	<form method="post" action="upload_page.php">
	<button id="uploadImages" class="menu_bar_button">User Site</button> 
	</form>
	<form method="post" action="SeeUsers.php">
	<button id="seeUsers" class="menu_bar_button">See Users</button> 
	</form>


	
</div>

<div id="left_white_bar">&nbsp;<a href="https://mail-order-bride.net/"> <div id="left_bar"> <img src="kissrus.png" alt ="russianBride" id="leftBride"> <p id="left_white_bar_text">Click To Order Russian Bride!</p></div></div>
	<div id="right_white_bar">&nbsp; <a href="https://sendacake.com/"><div id="right_bar"><img src="cake.jpg" alt ="cake" id="rightCake"> <p>Click to Order Cake!</p></div> </div>
		</a>
		</a>
	<div>
	<p> Current users in database: </p>
	<div>
		<?php getUsers()?>	
	</div>	
</div>	
	<p><b>Start typing a name in the input field below:</b></p>
<form> 
First name: <input type="text" onkeyup="showHint(this.value)">
</form>
<p>Suggestions: <span id="txtHint"></span></p>				
		
</body>
</html>


<script>
function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>

