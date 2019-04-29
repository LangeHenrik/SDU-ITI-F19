<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="mvc/app/css/home.css">
    <link rel="stylesheet" type="text/css" href="mvc/app/css/login.css">
    <?php echo "<link rel='stylesheet' href='../css/navbar.css'>"?>
    <title>Register</title>
</head>
<body>

<?php
//require_once "config.php";
$fname =$lname =$username = $password = $repeat_pwd = $city = $zip = $email = $phone="";
$er_fname =$er_lname=$er_username = $er_password = $er_repeat = $er_city = $er_zip = $er_email = $er_phone =$er_dontmatch="";
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if (empty($_POST["fname"])){
        $er_fname= "First Name required";
        array_push($errors, $er_fname);
    } else{
        //echo "test_input...";
        $fname = test_input($_POST["fname"]);
        if (!preg_match("/^([a-zA-Z])+$/",$fname)){
            //echo "regex check...";
            $er_fname="First name should be one word, use letters only";
            array_push($errors, $er_fname);
        }
    }

    if (empty($_POST["password"])){
        $er_password= "Password required";
        array_push($errors, $er_password);
    } elseif (empty($_POST["repeat_pwd"])){
        $er_repeat= "Repeat the password";
        array_push($errors, $er_repeat);
    } elseif ($_POST["password"] != $_POST["repeat_pwd"]){
        $er_dontmatch="Passwords do not match";
        array_push($errors, $er_dontmatch);
    } else{
        $password = test_input($_POST["password"]);
        if (!preg_match("/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}/", $password)) {
            $er_password = "Password must contain at least one lowercase letter, at least
            one uppercase letter, at least one number";
            array_push($errors, $er_password);
        }
    }

    if (empty($_POST["last"])){
        $er_lname = "Last name required";
        array_push($errors, $er_lname);
    }else {
        $lname = test_input($_POST["last"]);
        if (!preg_match("/([a-zA-Z])+/",$lname)){
            $er_lname="Last name should be one word, use only letters";
            array_push($errors, $er_lname);
        }
    }

    if (empty($_POST["username"])){
        $er_username = "Create username required";
        array_push($errors, $er_username);
    }else{
        $username = test_input($_POST["username"]);
        if (!preg_match("/([a-zA-Z0-9])+/",$username)){
            $er_username="Use letters and digits only, one word";
            array_push($errors, $er_username);
        }
    }

    if (empty($_POST["city"])){
        $er_city = "City required";
        array_push($errors, $er_city);
    }else{
        $city = test_input($_POST["city"]);
        if (!preg_match("/([a-zA-Z])+/",$city)){
            $er_city="City should be one word, use letters only";
            array_push($errors, $er_city);
        }
    }

    if (empty($_POST["zip"])){
        $er_zip ="ZIP code required";
        array_push($errors, $er_zip);
    }else{
        $zip =test_input($_POST["zip"]);
        if (strlen($zip)!=4){
            $er_city="ZIP code should be 4 digits long";
            array_push($errors, $er_city);
        }
    }

    if (empty($_POST["email"])){
        $er_email ="Email required";
        array_push($errors, $er_email);
    }else{
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $er_email = "Invalid email format";
            array_push($errors, $er_email);
        }
    }

    if (empty($_POST["phone"])){
        $er_phone ="Phone number required";
        array_push($errors, $er_phone);
    }else{
        $phone= test_input($_POST["phone"]);
        if (!preg_match("/([0-9])+/",$phone)){
            $er_phone="Use numbers only";
            array_push($errors, $er_phone);
        }
    }
    if (count($errors)==0){
//        $new_user = 'INSERT INTO user (username, pwd, fname, lname, city, zip, email, phone)
//              VALUES (:username, :password, :fname, :lname, :city, :zip, :email, :phone);';
//        $stmt = $conn->prepare($new_user);
//        $stmt -> bindParam(":username", $_POST["username"]);
//        $pwd_hash = password_hash($_POST["password"], PASSWORD_BCRYPT);
//        $stmt -> bindParam(":password", $pwd_hash);
//        $stmt -> bindParam(":fname", $_POST["fname"]);
//        $stmt -> bindParam(":lname", $_POST["last"]);
//        $stmt -> bindParam(":city", $_POST["city"]);
//        $stmt -> bindParam(":zip", $_POST["zip"]);
//        $stmt -> bindParam(":email", $_POST["email"]);
//        $stmt -> bindParam(":phone", $_POST["phone"]);
//        $stmt -> execute();
    }
}

?>
<!--action="--><?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?><!--"-->
<?php include '../app/views/partials/menu.php';?>
<form class="register" action ="register" method="post">
    <h1>Register</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (count($errors)==0) {
            if ($stmt) {
                //header('Location:login.php?');
                 print " <p class='register_message'>Now you are registered! Login in <a href=\"login.php\">here</a>.</p>";
            }
        }else {
            print "<p class='login_error'>Registration failed.</p>";
        }
    }?>
    <label>First name:</label>
    <input name="fname" type="text" class="field_register">
        <span class="error"><?php print $er_fname?></span>
    <label>Last name:</label>
    <input name="last" type="text" class="field_register">
        <span class="error"><?php print $er_lname?></span>
    <label>Create username:</label>
    <input name="username" type="text" class="field_register">
        <span class="error"><?php print $er_username?></span>
    <label>Create password:</label>
    <input name="password" type="password" class="field_register">
        <span class="error"><?php print $er_password?></span>
    <label>Repeat password:</label>
    <input name="repeat_pwd" type="password" class="field_register">
        <span class="error"><?php print $er_repeat?></span>
        <span class="error"><?php print  $er_dontmatch?></span>
    <label>City:</label>
    <input name="city" type="text" class="field_register">
        <span class="error"><?php print $er_city?></span>
    <label>ZIP:</label>
    <input name="zip" type="number" class="field_register">
        <span class="error"><?php print $er_zip?></span>
    <label>Email:</label>
    <input name="email" type="email" class="field_register">
        <span class="error"><?php print $er_email?></span>
    <label>Phone number:</label>
    <input name="phone" type="number" class="field_register">
        <span class="error"><?php print $er_phone?></span>
    <br><br>
    <div id="register">
        <input type="submit" id="button_register" value="Register">
        <p class="message">Already have an account? Login in <a href="login.php">here</a>.</p>
    </div>
</form>

</body>
</html>