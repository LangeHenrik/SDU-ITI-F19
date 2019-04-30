<?php include 'includes/top.php'; ?>

<?php 
    $name = $pass = $cPass = $fName = $lName = $mail = $phone = $zip = $city = "";

    $nameErr = $passErr = $cPassErr = $comparePassErr = $fNameErr = $lNameErr = $mailErr = $phoneErr = $zipErr = $cityErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
            $nameErr = "Username is required";
        } else {
            $name = test_input($_POST["username"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["firstName"])) {
            $fNameErr = "First name is required";
        } else {
            $fName = test_input($_POST["firstName"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$fName)) {
                $fNameErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["lastName"])) {
            $lNameErr = "Last name is required";
        } else {
            $lName = test_input($_POST["lastName"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$lName)) {
                $lNameErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["mail"])) {
            $mailErr = "Email is required";
        } else {
            $mail = test_input($_POST["mail"]);
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $mailErr = "Invalid email format";
            }
        }

        if (empty($_POST["password"])) {
            $passErr = "Password is required";
        } else {
            $pass = test_input($_POST["password"]);
        }

        if (empty($_POST["confirm_password"])) {
            $cPassErr = "Confirm Password is required";
        } else {
            $cPass = test_input($_POST["confirm_password"]);
        }

        if (empty($_POST["phone"])) {
            $phoneErr = "Phone number is required";
        } else {
            $phone = test_input($_POST["phone"]);
        }

        if (empty($_POST["zip"])) {
            $zipErr = "Zip code is required";
        } else {
            $zip = test_input($_POST["zip"]);
        }

        if (empty($_POST["city"])) {
            $cityErr = "City is required";
        } else {
            $city = test_input($_POST["city"]);
        }
        
        if ($pass != $cPass && !isset($cPass)) {
            $comparePassErr = "Both passwords must be identical";
        } else {

            if (!empty($name) && !empty($pass)) {
                require_once 'includes/db.php';

                $sql = "INSERT INTO users (userName, userFirst, userLast, userPass, userMail, userPhone, userZip, userCity)
                        VALUES ('$name', '$fName', '$lName', '$pass', '$mail', '$phone', '$zip', '$city')";

                if ($conn->query($sql) === TRUE) {
                    $conn->close();
                    /* Redirect */
                    header("Location: login.php");
                    exit;
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
            }
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<h1>Register</h1>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <span class="error"><?php echo $nameErr;?></span>
    <input type="text" name="username" id="uname" placeholder="Username">

    <span class="error"><?php echo $fNameErr;?></span>
    <input type="text" name="firstName" id="fname" placeholder="First Name">

    <span class="error"><?php echo $lNameErr;?></span>
    <input type="text" name="lastName" id="lname" placeholder="Last Name">

    <span class="error"><?php echo $comparePassErr;?></span>
    <span class="error"><?php echo $passErr;?></span>
    <input type="password" name="password" id="pass" placeholder="Password">
    
    <span class="error"><?php echo $cPassErr;?></span>
    <input type="password" name="confirm_password" id="cpass" placeholder="Confirm password">

    <span class="error"><?php echo $mailErr;?></span>
    <input type="email" name="mail" id="mail" placeholder="Email">

    <span class="error"><?php echo $phoneErr;?></span>
    <input type="text" name="phone" id="phone" placeholder="Phone number">

    <span class="error"><?php echo $zipErr;?></span>
    <input type="text" name="zip" id="zip" placeholder="Zip code">

    <span class="error"><?php echo $cityErr;?></span>
    <input type="text" name="city" id="city" placeholder="City">

    <input type="submit" value="Register">
</form>

<?php include 'includes/bot.php'; ?>