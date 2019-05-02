<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 29-04-2019
 */

include_once("../Core/database.php");


class Login
{
    public function VerifyUser($myusername, $mypassword)
    {

        $result = checkUser($myusername);
        if (password_verify($mypassword, $result[0]['password'])) {
            session_start();
            $_SESSION['login_user'] = $myusername;

            header("location: ../View/index.php");
        } else {
            echo "<script> alert(\"Wrong username or password\"); </script>";
        }
    }
}
?>