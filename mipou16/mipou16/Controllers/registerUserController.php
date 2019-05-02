<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 29-04-2019
 */

include_once("../Core/database.php");
include_once("../Models/newUser.php");

$model = new newUser();

$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
if (isset($_POST)) {
    if (!empty($_POST)) {

        $myusername = $_POST['username'];
        $mypassword = $_POST['password'];
        $myfirstname = $_POST['firstname'];
        $mylastname = $_POST['lastname'];
        $myzip = $_POST['zip'];
        $mycity = $_POST['city'];
        $myemail = $_POST['email'];
        $myphone = $_POST['phone'];
        $count = strlen(getUsername($myusername));


        if ($count === 0) {
            registerUser($myusername, $mypassword, $myfirstname, $mylastname, $myzip, $mycity, $myemail, $myphone);




            $model->NewUserCreated();
        } else {
            $model->Error();
        }
    }
}