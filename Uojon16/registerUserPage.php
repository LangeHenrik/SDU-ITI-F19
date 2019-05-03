<?php 

if (!empty($_POST ) ) {
    if (checkFields()) {
		
require_once('db.php');
$conn = new PDO("mysql:host=$dbhost;dbname=adele2", $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$ins = $conn->prepare('INSERT INTO user(FullName,Username,Address, password) 
VALUES(:FullName,:Username,:Address,:password);'); 
	echo 'not not';
	$ins->bindParam(':FullName',$_POST['FullName']);
	$ins->bindParam(':Username',$_POST['Username']);
	$ins->bindParam(':Address',$_POST['Address']);
	$ins->bindParam(':password',$_POST['password']);
	$ins->execute();
 header("Location: index.php");
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
	
	<img src="images/adele2.jpg"class="avatar">
	<h1> Register Here</h1>
	<form>
	
	<p>FullName</p>
	<input id= "fullnameField" input type="text"   name="FullName" onblur="checkFullname()" placeholder="Enter full name" required>
	<p>Username</p>
	<input id= "usernameField"input type="text" name="Username" onblur="checkUsername()" placeholder="Enter Username" required>
	<br>	
	<p>Address</p>
	<input id= "addressField"input type="text" name="Address"onblur="checkAddress()"  placeholder="Enter address" required>
	<br>
	
	<p>password</p>
	<input id= "pass"input type="password" name="password"onblur="checkPassword()"  placeholder="Enter new password" required>
		<br>
	<p>REenter password</p>
	<input id= "repass"input type="password" name="repassword" onblur="checkRepeatPassword() " placeholder="REenter password" required>
	<br>
	<input type="submit" value="Register"><br>

<a href="index.php"> Back to Login page</a><br>
</form>
<script>
function checkFullname() {

    var fullname = document.getElementById("fullnameField").value;
    var regex = /^[a-zA-Z ,.'-]{2,30}$/;
	


    if (regex.test(fullname)) {
        document.getElementById("fullnameField").style.color = "green";
        return regex.test(fullname);

    }
    else {
        document.getElementById("fullnameField").style.color = "red";
        return regex.test(fullname)
    }

}
function checkUsername() {

    var username = document.getElementById("usernameField").value;
    var regex = /^[a-zA-Z\d]{5,20}$/;


    if (regex.test(username)) {
        document.getElementById("usernameField").style.color = "green";
        return regex.test(username);

    }
    else {
        document.getElementById("usernameField").style.color = "red";
        return regex.test(username)
    }

}
function checkAddress() {

    var Address = document.getElementById("addressField").value;
    var regex = /^[a-zA-Z0-9\s,.'-]{3,}$/ ;


    if (regex.test(Address)) {
        document.getElementById("addressField").style.color = "green";
        return regex.test(Address);

    }
    else {
        document.getElementById("addressField").style.color = "red";
        return regex.test(Address)
    }

}
function checkPassword() {


    var password = document.getElementById("pass").value;
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;


    if (regex.test(password)) {
        document.getElementById("pass").style.color = "green";
        return regex.test(password);

    }
    else {
        document.getElementById("pass").style.color = "red";
        return regex.test(password)
    }

}
function checkRepeatPassword() {



    var password = document.getElementById("pass").value;
    var repassword = document.getElementById("repass").value;
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;


    if (regex.test(repassword) && password === repassword) {
        document.getElementById("repass").style.color = "green";
        return regex.test(repassword) && password === repassword;

    }
    else {
        document.getElementById("repass").style.color = "red";
        return regex.test(repassword && password === repassword)
    }

}



function checkFields() {


    if ( checkFullname() && checkUsername() && checkAddress() &&  checkPassword() && checkRepeatPassword() ) {

        return true;
    }
    else {

        return false;
    }
}
</script>

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
