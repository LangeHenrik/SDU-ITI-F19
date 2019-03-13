<?php
session_start();
?>


<html>
<link rel="stylesheet" href="../CSS/Navbar.css">
<link rel="stylesheet" href="../CSS/General.css">
<script src="../JS/navbar.js"></script>
<script src="../JS/LoginPage.js"></script>
<head>

</head>

<body>


<?php


if(isset($_SESSION["username"])){
    echo "<navbar id=\"navbar\"><a class=\"navbar-link\" href=\"LoginPage.php\">Profile</a></navbar>";
} else {
    echo "<navbar id=\"navbar\"><a class=\"navbar-link\" href=\"LoginPage.php\">Register</a></navbar>";
}
echo "
<div class=\"loginform\">
                <h2>Login to your account</h2>
                <form action=\"LogIn.php\" method='post'>
                    <input type=\"text\" name=\"username\" placeholder=\"username\"/>
                    <input type=\"password\" name=\"password\" placeholder=\"password\"/>
                    <button type=\"submit\" class=\"btn\" id=\"btnLogin\">Login</button>
                    <a class=\"btnCreateNewUser\"
                       id=\"btnSubmit\"
                       href=\"file:///Users/bruger/Desktop/InternetTechnologiesRepo/Mach316/ImageFeedProject/PHP/LoginPage.html\">Create new user</a>
                </form>
            </div>";
?>


</body>

</html>


