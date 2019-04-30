<?php 

if (!empty($_POST ) ) {
    if (checkFields()) {
		
require_once('db.php');
$conn = new PDO("mysql:host=$dbhost;dbname=adele2", $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$ins = $conn->prepare('INSERT INTO notendur(FullName,Username,Address, password) 
VALUES(:FullName,:Username,:Address,:password);'); 
	echo 'not not';
	$ins->bindParam(':FullName',$_POST['FullName']);
	$ins->bindParam(':Username',$_POST['Username']);
	$ins->bindParam(':Address',$_POST['Address']);
	$ins->bindParam(':password',$_POST['password']);
	$ins->execute();
 header("Location: UserPage.php");
		}
 }   
function checkFields(){
	$sucess = true;
	if(empty($_POST['FullName'])){
		$sucess = true;
}
if(empty($_POST['Username'])){
		$sucess = true;
}
if(empty($_POST['Address'])){
		$sucess = true;
}
if(empty($_POST['password'])){
		$sucess = true;
}
if(!$sucess){
echo "something does not work";
}
return $sucess;
}
?>


<head>
<title> registerUserPage</title>
<link rel="stylesheet" type= "text/css" href="style1.css">

<body>



<form method ="post" action = "">


<div class="registerbox">
	
	<img src="adele2.jpg"class="avatar">
	<h1> Register Here</h1>
	<form>
	
	<p>FullName</p>
	<input type="text"   name="FullName" placeholder="Enter full name" required>
	<p>Username</p>
	<input type="text" name="Username" placeholder="Enter Username" required>
	<br>	
	<p>Address</p>
	<input type="text" name="Address" placeholder="Enter address" required>
	<br>
	
	<p>password</p>
	<input type="text" name="password" placeholder="Enter new password" required>
		<br>
	<p>REenter password</p>
	<input type="text" name="repassword" placeholder="REenter password" required>
	<br>
	<input type="submit" value="Register"><br>

<a href="index.php"> Back to Login page</a><br>
</form>
</body>
</head>
<div id="demo">
<button type="button" onclick="loadDoc()">Click me</button>
</div>
<script>
function loadDoc() {
 var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
  
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "ajax_info.txt", true);
  xhttp.send();
}
</script>

</head>
</html>
