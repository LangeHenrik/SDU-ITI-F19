<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 29-04-2019
 */

?>
<html lang="en">
<head>
    <link href="css/global.css" type="text/css" rel="stylesheet">
    <title>users</title>
</head>
<body>


<h1>Username List</h1>

<?php

include_once "../Controllers/userController.php";
include_once "../Models/Users.php";


$model = new Users();
$userController = new userController($model);
$userController->getUserList();

?>

</body>


</html>