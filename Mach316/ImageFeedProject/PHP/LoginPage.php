<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/LoginPage.css">
    <link rel="stylesheet" href="../CSS/Navbar.css">
    <link rel="stylesheet" href="../CSS/General.css">
    <script src="../JS/navbar.js"></script>
    <script src="../JS/LoginPage.js"></script>

    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<div class="page-container">
    <?php
    if(isset($_SESSION["username"])){
        echo "<navbar id=\"navbar\"><a class=\"navbar-link\" href=\"LoginPage.php\">Profile</a></navbar>";
    } else {
        echo "<navbar id=\"navbar\"><a class=\"navbar-link\" href=\"LoginPage.php\">Register</a></navbar>";
    }
    ?>

    <div class="main-content">

        <?php
        if (isset($_SESSION["username"])) {
            echo "

                    <h1 class='profile-header'>Welcome {$_SESSION['username']}</h1>
                     <form action=\"LogOut.php\" method=\"post\">
                        <button id='btnSignOut' type=\"submit\" name='Sign out'>Sign out</button>
                    </form>";
        } else {
            echo " 

        <div class=\"login-page-form-container\">
            <h1>Begin your adventure on Æκóνæς!</h1>

            <form id='registerform' action='Register.php' method=\"post\">
                <label for=\"username\" style=\"color: blue;\">Username</label>
                <br>
                <input type=\"text\" name=\"username\" id=\"name\"/>
                <br>
                <label for='firstname'>First name</label>
                <br>
                <input type='text' name='firstname'/>
                <br>
                <label for='lastname'>Last name</label>
                <br>
                <input type='text' name='lastname'/>
                <br>
                <label for=\"password\">Password</label>
                <br>
                <input type=\"password\" name=\"password\" id=\"password\"/>
                <br>
                <label for=\"repeatPassword\" >Repeat Password</label>
                <br>
                <input type=\"password\" name='repeatPassword'/>
                <br>
                <label for=\"phone\">Phone number</label>
                <br>
                <input type=\"text\" name=\"phonenumber\" id=\"phonenumber\"/>
                <br>
                <label for=\"email\">Email adress</label>
                <br>
                <input type=\"text\" name=\"email\" id=\"email\"/>
                <br>
                <label for=\"zip\">Zip code</label>
                <br>
                <input type=\"text\" name=\"zip\" id=\"zip\"/>
                <br>
                <label for='city'>City</label>
                <br>
                <input type='text' name='city'/>
                <br>
                <input type=\"submit\" name=\"submit\" id=\"btnSubmit\"/>
            </form>
            <form action='getLoginPage.php' method='get'>
            <button id=\"btnAlreadyMember\">Already a member?</button>
            </form>
        </div>
    ";
        }


        ?>
    </div>
</div>


</body>
</html>