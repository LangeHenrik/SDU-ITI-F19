

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

</style>
</head>

<div class="topnav">
	<a class="active" href="#Home">Home</a>
	<a href="/uploadfile.html">Upload Image</a>
	<a href="/myprofile.php">My Profile</a>
	<a href="/ajax.php">AJAX</a>
	<a href="/new.php"<button type="submit">Logout</button> </a>
	


</div>


<body>



<form>
<select name="users" onchange="showUserPictures(this.value)">
  <option value="">Show pictures from:</option>
  <option value="Admin">Admin</option>
  <option value="Test1">Test1</option>
  </select>
</form>
<br>
<div id="txtHint"></div>

<script>
function showUserPictures(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getUserPictures.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
