<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 20-03-2019
 * Time: 14:31
 */
session_start();
session_destroy();
header("location: login.php");