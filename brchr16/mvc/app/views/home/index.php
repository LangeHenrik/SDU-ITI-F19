<?php include '../app/views/partials/menu.php'; ?>
<!--
Hello there,

?>-->
<!DOCTYPE html>
<body>
<form onsubmit="" method="post" action="/brchr16/mvc/public/home/login">
    <label for="name">name</label>
    <br> 
    <input type="text" name="username" id="username" required/> 
    <br> 
    <label for="password">password</label>
    <br> 
    <input type="password" name="password" id="password" required/> 
    <br>
    <input type="submit" value="login" id="login"/> 
</form>
<a href = "/brchr16/mvc/public/signup/"> Signup </a>
</body>
