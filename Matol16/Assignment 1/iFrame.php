<?php
require_once 'db_config.php';


session_start();

    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    include("home.php");
    exit;
} else{
    include("login.php");
}






?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../MVC/public/css/indexStyle.css">

</head>
<body>
<?php



?>
</body>
</html>
