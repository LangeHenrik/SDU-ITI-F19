<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 20-03-2019
 * Time: 13:53
 */

error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
} else {
    header("location: picture_page.php");
}
