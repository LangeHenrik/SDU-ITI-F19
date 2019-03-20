<?php
require_once("class/loadall.php");
$function->checkLoggedIn();
$function->getLoginForm();
if(isset($_POST['username'])){
    $function->login($_POST['username'], $_POST['password']);
}
$function->saveusername();
