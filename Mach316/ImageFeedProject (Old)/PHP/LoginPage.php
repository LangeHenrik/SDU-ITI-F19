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
    <script src="../JS/formcheck.js"></script>
    <meta charset="UTF-8">

    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<div class="page-container">



    <?php

    require_once 'Model/DAOs/DatabaseManager.php';

    if(isset($_SESSION["username"])){
        echo "<navbar id=\"navbar\"><a class=\"navbar-link\" href=\"register\">Profile</a></navbar>";
    } else {
        echo "<navbar id=\"navbar\"><a class=\"navbar-link\" href=\"register\">Register</a></navbar>";
    }
    ?>


    <div class="main-content">



        <?php
        if (isset($_SESSION["username"])) {

            $currentUser = getCurrentUser();
            $currentUserName = $currentUser['username'];
            $currentFirstname = $currentUser['firstname'];
            $currentLastname = $currentUser['lastname'];
            $currentEmail = $currentUser['email'];
            $currentPhone = $currentUser['phonenumber'];
            $currentCity = $currentUser['city'];
            $currentZip = $currentUser['zip'];

            echo "
                    
                    <h1 class='profile-header'>Welcome {$_SESSION['username']}</h1>
                    <div class='update-user-block'>
                    <label>Username</label><input maxlength='30' type='text' value={$currentUserName}>
                   </div>
                   <div class='update-user-block'>
                    <label>Firstname</label><input maxlength='30' type='text' value={$currentFirstname} />
                    </div>
                    <div class='update-user-block'>
                    <label>Lastname</label><input maxlength='30' type='text' value={$currentLastname} />
                    </div>
                    <div class='update-user-block'>
                    <label>City</label><input type='text' maxlength='50' value={$currentCity} />
                    </div>
                    <div class='update-user-block'>
                    <label>Zip</label><input maxlength='4' id='update-user-zip' type='text' value={$currentZip} />
                    </div>
                    <div class='update-user-block'>
                    <label>Phonenumber</label><input maxlength='12' id='update-user-phonenumber' type='text' value={$currentPhone} />
                    </div>
                    <div class='update-user-block'>
                    <label>Email</label><input type='text' value={$currentEmail} />
                    </div>
                     <form action=\"LogOut.php\" method=\"post\">
                        <button id='btnSignOut' type=\"submit\" name='Sign out'>Sign out</button>
                    </form>";
        } else {

            echo " 

        <div class=\"login-page-form-container\">
            <h1>Begin your adventure on Æκóνæς!</h1>

            <form action='Register.php' id='registerform' method='post'>
                <label id='label-register-username' for=\"username\" style=\"color: blue;\">Username</label>
                <br>
                <input maxlength='30' id='register-username' type=\"text\" name=\"username\" id=\"name\"/>
                <br>
                <label id='label-register-firstname' for='firstname'>First name</label>
                <br>
                <input maxlength='30' id='register-firstname' type='text' name='firstname'/>
                <br>
                <label id='label-register-lastname' for='lastname'>Last name</label>
                <br>
                <input maxlength='30' type='text' id='register-lastname' name='lastname'/>
                <br>
                <label id='label-register-password' for=\"password\">Password</label>
                <br>
                <input maxlength='30' id='register-psw1' type=\"password\" name=\"password\" id=\"password\"/>
                <br>
                <label id='label-repeat-password' for=\"repeatPassword\" >Repeat Password</label>
                <br>
                <input maxlength='30' id='register-psw2' type=\"password\" name='repeatPassword'/>
                <br>
                <label id='label-register-phonenumber' for=\"phone\">Phone number</label>
                <br>
                <input id='phone-input-box' maxlength='12' type=\"text\" name=\"phonenumber\" id=\"phonenumber\"/>
                <br>
                <label id='label-register-email' for=\"email\">Email adress</label>
                <br>
                <input maxlength='100' id='register-email' type=\"text\" name=\"email\" id=\"email\"/>
                <br>
                <label id='label-register-zip' for=\"zip\">Zip code</label>
                <br>
                <input maxlength='4' id='zip-input-box' type=\"text\" name=\"zip\" id=\"zip\"/>
                <br>
                <label id='label-register-city' for='city'>City</label>
                <br>
                <input maxlength='50' id='register-city' type='text' name='city'/>
                <br>
                <input type=\"submit\" name=\"submit\"  id=\"btnSubmit\"/>
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