<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <head>
  <link href="styles/style.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <title>Registrer</title>
  </head>
  <body id="opgave">
    <h1 class="hidden"></h1>
	<body>
	<?php
	require_once "config.php";
	$fname =$lname =$username = $password = $repeat_pwd = $city = $zip = $email = $phone="";
	$er_fname =$er_lname=$er_username = $er_password = $er_repeat = $er_city = $er_zip = $er_email = $er_phone =$er_dontmatch="";
	$errors = array();
	
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
     if (empty($_POST["fname"])){
        $er_fname= "Fornavn krævet";
        array_push($errors, $er_fname);
    } else{
        //echo "test_input...";
        $fname = test_input($_POST["fname"]);
        if (!preg_match("/^([a-zA-Z])+$/",$fname)){
            //echo "regex check...";
            $er_fname="kun bogstaver modtages";
            array_push($errors, $er_fname);
        }
    }
     if (empty($_POST["password"])){
        $er_password= "Password krævet";
        array_push($errors, $er_password);
    } elseif (empty($_POST["repeat_pwd"])){
        $er_repeat= "gentag password";
        array_push($errors, $er_repeat);
    } elseif ($_POST["password"] != $_POST["repeat_pwd"]){
        $er_dontmatch="password er ikke ens";
        array_push($errors, $er_dontmatch);
    } else{
        $password = test_input($_POST["password"]);
        if (!preg_match("/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}/", $password)) {
            $er_password = "Password skal indeholde mindst et stort bogstav et lille bogstav og et tal";
            array_push($errors, $er_password);
        }
    }
     if (empty($_POST["last"])){
        $er_lname = "Efternavm krævet";
        array_push($errors, $er_lname);
    }else {
        $lname = test_input($_POST["last"]);
        if (!preg_match("/([a-zA-Z])+/",$lname)){
            $er_lname="kun bogstaver modtages;
            array_push($errors, $er_lname);
        }
    }
     if (empty($_POST["username"])){
        $er_username = "brugernavn krævet";
        array_push($errors, $er_username);
    }else{
        $username = test_input($_POST["username"]);
        if (!preg_match("/([a-zA-Z0-9])+/",$username)){
            $er_username="kun bogstaver og tal i et ord!";
            array_push($errors, $er_username);
        }
    }
     if (empty($_POST["city"])){
        $er_city = "By krævet";
        array_push($errors, $er_city);
    }else{
        $city = test_input($_POST["city"]);
        if (!preg_match("/([a-zA-Z])+/",$city)){
            $er_city="kun bogstaver modtages";
            array_push($errors, $er_city);
        }
    }
     if (empty($_POST["zip"])){
        $er_zip ="Post nr krævet";
        array_push($errors, $er_zip);
    }else{
        $zip =test_input($_POST["zip"]);
        if (strlen($zip)!=4){
            $er_city="Post nr skal være 4 cifre";
            array_push($errors, $er_city);
        }
    }
     if (empty($_POST["email"])){
        $er_email ="Email krævet";
        array_push($errors, $er_email);
    }else{
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $er_email = "forkert email format";
            array_push($errors, $er_email);
        }
    }
     if (empty($_POST["phone"])){
        $er_phone ="tlf krævet";
        array_push($errors, $er_phone);
    }else{
        $phone= test_input($_POST["phone"]);
        if (!preg_match("/([0-9])+/",$phone)){
            $er_phone="kun numre modtages";
            array_push($errors, $er_phone);
        }
    }
    if (count($errors)==0){
        $new_user = 'INSERT INTO user (username, pwd, fname, lname, city, zip, email, phone) 
              VALUES (:username, :password, :fname, :lname, :city, :zip, :email, :phone);';
        $stmt = $conn->prepare($new_user);
        $stmt -> bindParam(":username", $_POST["username"]);
        $pwd_hash = password_hash($_POST["password"], PASSWORD_BCRYPT);
        $stmt -> bindParam(":password", $pwd_hash);
        $stmt -> bindParam(":fname", $_POST["fname"]);
        $stmt -> bindParam(":lname", $_POST["last"]);
        $stmt -> bindParam(":city", $_POST["city"]);
        $stmt -> bindParam(":zip", $_POST["zip"]);
        $stmt -> bindParam(":email", $_POST["email"]);
        $stmt -> bindParam(":phone", $_POST["phone"]);
        $stmt -> execute();
    }
}
		function test_input($in){
    // echo "inside test_input...";
    $in = trim($in);
    $in = stripslashes($in);
    $in = htmlspecialchars($in);
    return $in;
}
	<div id="head">
	</div>
	<table id="maincontent">
	<tbody><tr>
		<td align="center" valign="middle">
		<h1>Registrer</h1>
				<br>
		  <br>
		  <form id="registerform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
		  <?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (count($errors)==0) {
            if ($stmt) {
                header('Location:index.php?');
            }
        }else {
            print "<p class='login_error'>Registrering fejlede.</p>";
        }
    }?>
     
	<table>
	
		<tbody>
		<tr>
		<td>Fornavn</td>
		<td colspan="2"><input type="text" name="fname" id="firstname" class="inputtext" required="required" maxlength="20" autofocus="autofocus">
		<span class="error"><?php print $er_fname?></span>
		</td>
		</tr>
		<tr>
		<td>Efternavn </td>
		<td colspan="2"><input type="text" name="last" id="lastname" class="inputtext" required="required" maxlength="40">
        <span class="error"><?php print $er_lname?></span>
		</td>	
		</tr>
		<tr>
		<td>brugernavn </td>
		<td colspan="2"><input type="text" name="username" id="lastname" class="inputtext" required="required" maxlength="40">
        <span class="error"><?php print $er_username?></span>
		</td>	
		</tr>
		<tr>
		<td>Email</td>
		<td colspan="2"> <input type="text" name="email" maxlength="100" />
        <span class="error"><?php print $er_email?></span>
		</td>
		</tr>
		<tr>
		<td>By</td>
		<td colspan="2"> <input type="text" name="city" maxlength="100" />
        <span class="error"><?php print $er_city?></span>
		</td>
		</tr>
		<td>Post nr.</td>
		<td colspan="2"> <input type="text" name="number" maxlength="100" />
        <span class="error"><?php print $er_zip?></span>
		</td>
		</tr>
		<tr>
		<td>Tlf</td>
		<td colspan="2">
		<input type="text" name="phone" maxlength="8" />
		<span class="error"><?php print $er_phone?></span>
		</td>
		</tr>
		<tr>
		<td>Password</td>
		<td colspan="2">
		<input type="password" name="password" maxlength="32" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;" required>
		<span class="error"><?php print $er_password?></span>
		</td>
		</tr>
		<tr>
		<td>Bekræft password</td>
		<td colspan="2">
		<input type="password" name="repeat_pwd" maxlength="32" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');" required>
		<span class="error"><?php print $er_repeat?></span>
        <span class="error"><?php print  $er_dontmatch?></span>
		</td>
		</tr>
		</td>
		<tr>
			<td>
			<input type="submit" align="center" name="login" value="Register" class="registrer" style="float:left">
			</td>	
		
		</tr>
	</tbody>
	</table>
	</form>
</body>
  </body>
</html>
