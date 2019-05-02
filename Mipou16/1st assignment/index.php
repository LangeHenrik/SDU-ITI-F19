	<?php
session_start();
require_once "db_config.php";
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <head>
  <link href="styles/style.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body id="opgave">
    <h1 class="hidden"></h1>
	<body>
<div id="head">
</div>
<table id="maincontent">
	<tbody><tr>
		<td align="center" valign="middle">
		<h1>Login</h1>
				<br>
		  <br>
		  <form id="loginform" method="post" onsubmit="return validate()">
     
	<table>
	
		<tbody><tr>
			<td>Brugernavn</td>
			<td colspan="2"><input type="text" name="username" id="username" class="inputtext" required="required" maxlength="20" pattern="[A-Za-z0-9_?]{1,20}" autofocus="autofocus">
			</td>
		</tr>
		<tr>
			<td>Adgangskode </td>
			<td colspan="2"><input type="password" name="password" id="password" class="inputtext" required="required" maxlength="40"></td>
		</tr>
		<tr>
			<td>
			<input type="submit" align="center" name="login" value="Login" class="submit" style="float:left">
			</td>
			<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["username"];
        $db_pwd = $_POST["password"];
        //echo $name. " ".$db_pwd ."<br>";
        $sql = 'SELECT username, pwd FROM user WHERE username="' .
            $name . '";';
        //echo $sql . "<br>";
        $stmt = $conn -> prepare($sql);
		$stmt  -> execute();
        $result = $stmt -> fetch(PDO::FETCH_NUM);
        //echo $result[0]." ". $result[1]." ";
        if ($result[0]===$name && password_verify($db_pwd, $result[1])){
            $_SESSION['user'] = $name;
            header("Location:forside.php");
        }else{
            print '<br> <div class="login_error">forkert brugernavn eller adgangskode</div>';
        }
    }
    ?>		
		</tr>
		<tr>
			<td>
			Har du ikke en konto? <a href="register.php"><u>Registrer</u></a>			
			</td>	
		
		</tr>
		</tbody>
	</table>
	</form>
</body>
  </body>
</html>
