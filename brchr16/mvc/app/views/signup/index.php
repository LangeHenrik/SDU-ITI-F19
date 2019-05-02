
<?php
/*
if (session_status() == PHP_SESSION_NONE ) {
	Header("localhost:8080/mvc/public/home/");
}
*/

?>
<!DOCTYPE html>
<body>
<form onsubmit="" method="post" action="/brchr16/mvc/public/home/signup">
    <label for="username">username</label>
    <br> 
    <input type="text" name="username" id="username" required/> 
    <br> 
    <label for="password">password</label>
    <br> 
    <input type="password" name="password" id="password" required/> 
    <br>
	<label for="repeat password">repeat password</label>
    <br> 
    <input type="password" name="repeat password" id="repeat password" required/> 
    <br>
    <label for="firstname">firstname</label>
    <br>
    <input type="text" name="firstname" id="firstname" required/> 
    <br> 
    <label for="lastname">lastname</label>
    <br>
    <input type="text" name="lastname" id="lastname" required/>
    <br> 
    <label for="zip">zip code</label>
    <br> 
    <input type="text" name="zip" id="zip" required/> 
    <br> 
	<label for="city">city</label>
    <br> 
    <input type="text" name="city" id="city" required/> 
    <br>
	<label for="email">email</label>
    <br> 
    <input type="text" name="email" id="email" required/> 
    <br> 
	<label for="phonenumber">phonenumber</label>
    <br> 
    <input type="text" name="phonenumber" id="phonenumber" required/> 
    <br> 
    <input type="submit" value="create user" id="submit"/> 
</form>
<a href = "/brchr16/mvc/public/home/"> Return to loginpage </a>
</body>
</html>