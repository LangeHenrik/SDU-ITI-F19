<?php include '../app/views/partials/menu.php'; ?>
<!--
Hello there,

?>-->

		
<!DOCTYPE html>

<body>
<form onsubmit="" method="post" action="/uojon16/mvc/public/home/login/">

<h1> Login Here</h1>
    <label for="name"><b>Username<b></label>
    <br> 
    <input type="text" name="username" id="username" required/> 
    <br> 
    <label for="password">Password</label>
    <br> 
    <input type="password" name="password" id="password" required/> 
    <br>
    <input type="submit" value="login" id="login"/> 
</form>
<br>
<a href = "/uojon16/mvc/public/signup/"> Register </a>
</body>
</html>