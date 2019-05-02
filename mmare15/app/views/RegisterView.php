<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">

        body{ font: 14px sans-serif; background-image: url("../images/loginbackground.jpg")}

        .topleft {
            position: absolute;
            top: 8px;
            left: 16px;
            font-size: 18px;
            color: aliceblue;
        }

    </style>
</head>
<body>
    <div class="wrapper">
        <h1 class="topleft">Sign Up</h1>
        <p>Please fill this form to create an account.</p>

        <div class ="loginbox">


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" placeholder="Username" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
</div>

<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
    <label>Password</label>
    <input type="password" placeholder="Password" name="password" class="form-control" value="<?php echo $password; ?>">
    <span class="help-block"><?php echo $password_err; ?></span>
</div>

<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
    <label>Confirm Password</label>
    <input type="password" placeholder="Password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
    <span class="help-block"><?php echo $confirm_password_err; ?></span>
</div>

<label for="email"><b>Email</b></label>
<input type="text" placeholder="Enter Email" name="username" required value="<?php echo $username; ?>" >


<label for="phone"><b>Phone</b></label>
<input type="text" placeholder="Enter phone number" name="phone" required>

<label for="firstname"><b>First Name</b></label>
<input type="text" placeholder="firstname" name="firstname" required>



<label for="lastname"><b>Last Name</b></label>
<input type="text" placeholder="lastname" name="lastname" required>

<label for="city"><b>City</b></label>
<span id="txtHint"></span>
<input placeholder="City" type="text" onkeyup="showHint(this.value)">

<script>
    function showHint(str) {
        if (str.length == 0) {
            document.getElementById("txtHint").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "gethint.php?q=" + str, true);
            xmlhttp.send();
        }
    }
</script>

<! -- Ajax functionality -->
<span id="txtHint"></span></p>

<label for="zipcode"><b>Zip</b></label>
<input type="text" placeholder="zipcode" name="zip" required>



<div class="form-group">
    <input type="submit" class="btn btn-primary" value="Submit">
    <input type="reset" class="btn btn-default" value="Reset">
</div>

<p>Already have an account? <a href="login.php">Login here</a>.</p>
</form>
</div>
</div>
</body>
</html>

