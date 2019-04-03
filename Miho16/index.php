<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 22-03-2019
 * Time: 12:50
 */
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['username'])) {
    header("location: startpage.php");
} else {
    header("location: gallery.php");
}